<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WilayahKerjaModel;
use App\Models\KorsdaModel;
use ZipArchive;

class PetaKorsda extends BaseController
{
    protected $wilayahModel;
    protected $korsdaModel;

    protected $uploadDir;

    public function __construct()
    {
        $this->wilayahModel = new WilayahKerjaModel();
        $this->korsdaModel  = new KorsdaModel();

        $this->uploadDir = FCPATH . 'uploads/wilayah/';

        // Pastikan folder upload tersedia
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    // =========================================================
    // INDEX
    // =========================================================

    public function index()
{
    $wilayah = $this->wilayahModel
        ->select('
            wilayah.*,
            korsda.nama_wilayah,
            kecamatan.nama_kecamatan
        ')
        ->join(
            'korsda',
            'korsda.id = wilayah.korsda_id',
            'left'
        )
        ->join(
            'kecamatan',
            'kecamatan.id = korsda.kecamatan_id',
            'left'
        )
        ->orderBy('wilayah.id', 'DESC')
        ->findAll();

    $data = [
        'title'   => 'Data Wilayah KORSDA',
        'wilayah' => $wilayah,
    ];

    return view('admin/korsda/peta/index', $data);
}

    // =========================================================
    // CREATE
    // =========================================================

    public function create()
{
    $korsda = $this->korsdaModel
        ->select('
            korsda.id,
            korsda.kecamatan_id,
            korsda.nama_wilayah,
            kecamatan.nama_kecamatan
        ')
        ->join(
            'kecamatan',
            'kecamatan.id = korsda.kecamatan_id',
            'left'
        )
        ->orderBy('korsda.nama_wilayah', 'ASC')
        ->findAll();

    $data = [
        'title'  => 'Tambah Wilayah KORSDA',
        'korsda' => $korsda,
    ];

    return view(
        'admin/korsda/peta/create',
        $data
    );
}

    // =========================================================
    // STORE
    // =========================================================

   public function store()
{
    // =====================================================
    // 1. VALIDASI FORM
    // =====================================================

    $rules = [
        'korsda_id' => [
            'label'  => 'KORSDA',
            'rules'  => 'required|integer',
            'errors' => [
                'required' => 'KORSDA wajib dipilih.',
                'integer'  => 'KORSDA tidak valid.',
            ],
        ],

        'nama_wilayah' => [
            'label'  => 'Nama Wilayah',
            'rules'  => 'required|min_length[3]',
            'errors' => [
                'required'   => 'Nama wilayah wajib diisi.',
                'min_length' => 'Nama wilayah minimal 3 karakter.',
            ],
        ],

        'file_peta' => [
            'label'  => 'File Peta',
            'rules'  => 'uploaded[file_peta]|max_size[file_peta,51200]|ext_in[file_peta,zip]',
            'errors' => [
                'uploaded' => 'File ZIP wajib dipilih.',
                'max_size' => 'Ukuran ZIP maksimal 50 MB.',
                'ext_in'   => 'File harus berformat ZIP.',
            ],
        ],

        'keterangan' => [
            'label'  => 'Keterangan',
            'rules'  => 'permit_empty',
        ],
    ];

    if (!$this->validate($rules)) {

        return redirect()
            ->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }


    // =====================================================
    // 2. AMBIL DATA FORM
    // =====================================================

    $korsdaId = (int) $this->request->getPost('korsda_id');

    $namaWilayah = trim(
        $this->request->getPost('nama_wilayah')
    );

    $keterangan = trim(
        $this->request->getPost('keterangan')
    );


    // =====================================================
    // 3. DEBUG KORSDA
    // =====================================================

    $korsda = $this->korsdaModel->find($korsdaId);

    if (!$korsda) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'KORSDA dengan ID ' . $korsdaId . ' tidak ditemukan.'
            );
    }


    // =====================================================
    // 4. AMBIL FILE ZIP
    // =====================================================

    $file = $this->request->getFile('file_peta');

    if (!$file || !$file->isValid()) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'File ZIP tidak valid.'
            );
    }


    // =====================================================
    // 5. PASTIKAN FOLDER
    // =====================================================

    if (!is_dir($this->uploadDir)) {

        mkdir(
            $this->uploadDir,
            0777,
            true
        );
    }


    // =====================================================
    // 6. SIMPAN ZIP
    // =====================================================

    $namaFile = $file->getRandomName();

    try {

        $file->move(
            $this->uploadDir,
            $namaFile
        );

    } catch (\Throwable $e) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Gagal upload ZIP: ' .
                $e->getMessage()
            );
    }


    $zipPath =
        $this->uploadDir .
        $namaFile;


    // =====================================================
    // 7. EKSTRAK ZIP
    // =====================================================

    $folderName = pathinfo(
        $namaFile,
        PATHINFO_FILENAME
    );

    $extractPath =
        $this->uploadDir .
        $folderName .
        DIRECTORY_SEPARATOR;


    if (!is_dir($extractPath)) {

        mkdir(
            $extractPath,
            0777,
            true
        );
    }


    $zip = new \ZipArchive();

    $openResult = $zip->open($zipPath);

    if ($openResult !== true) {

        $this->safeDeleteFile($zipPath);
        $this->deleteDirectory($extractPath);

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'ZIP tidak dapat dibuka.'
            );
    }


    // =====================================================
    // 8. EKSTRAK
    // =====================================================

    if (!$zip->extractTo($extractPath)) {

        $zip->close();

        $this->safeDeleteFile($zipPath);
        $this->deleteDirectory($extractPath);

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'ZIP gagal diekstrak.'
            );
    }

    $zip->close();


    // =====================================================
    // 9. CARI SHP
    // =====================================================

    $shpFile = $this->findFileByExtension(
        $extractPath,
        'shp'
    );


    if (!$shpFile) {

        $this->safeDeleteFile($zipPath);
        $this->deleteDirectory($extractPath);

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'File SHP tidak ditemukan di dalam ZIP.'
            );
    }


    // =====================================================
    // 10. CEK OGR2OGR
    // =====================================================

    $ogr2ogr =
        'C:\\OSGeo4W\\bin\\ogr2ogr.exe';


    if (!file_exists($ogr2ogr)) {

        $this->safeDeleteFile($zipPath);
        $this->deleteDirectory($extractPath);

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'ogr2ogr.exe tidak ditemukan.'
            );
    }


    // =====================================================
    // 11. KONVERSI GEOJSON
    // =====================================================

    $geojsonName =
        $folderName .
        '.geojson';

    $geojsonPath =
        $this->uploadDir .
        $geojsonName;


    $resultConvert =
        $this->convertShpToGeoJson(
            $ogr2ogr,
            $shpFile,
            $geojsonPath
        );


    if (!$resultConvert['success']) {

        $this->safeDeleteFile($zipPath);
        $this->safeDeleteFile($geojsonPath);
        $this->deleteDirectory($extractPath);

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                $resultConvert['message']
            );
    }


    // =====================================================
    // 12. DATA YANG AKAN DISIMPAN
    // =====================================================

    $data = [
        'korsda_id'    => $korsdaId,
        'nama_wilayah' => $namaWilayah,
        'file_peta'    => $namaFile,
        'file_geojson' => $geojsonName,
        'keterangan'   => $keterangan,
    ];


    // =====================================================
    // 13. DEBUG DATABASE
    // =====================================================

    try {

        $db = \Config\Database::connect();

        $db->transStart();


        $insertId = $this->wilayahModel->insert(
            $data,
            true
        );


        if (!$insertId) {

            $errors =
                $this->wilayahModel->errors();

            $db->transRollback();

            $this->safeDeleteFile($zipPath);
            $this->safeDeleteFile($geojsonPath);
            $this->deleteDirectory($extractPath);

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Data wilayah gagal disimpan. ' .
                    (!empty($errors)
                        ? implode(', ', $errors)
                        : 'Tidak ada pesan error dari Model.')
                );
        }


        $db->transComplete();


        if ($db->transStatus() === false) {

            $this->safeDeleteFile($zipPath);
            $this->safeDeleteFile($geojsonPath);
            $this->deleteDirectory($extractPath);

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Transaksi database gagal.'
                );
        }

    } catch (\Throwable $e) {

        $this->safeDeleteFile($zipPath);
        $this->safeDeleteFile($geojsonPath);
        $this->deleteDirectory($extractPath);

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'ERROR DATABASE: ' .
                $e->getMessage()
            );
    }


    // =====================================================
    // 14. HAPUS FOLDER EKSTRAK
    // =====================================================

    $this->deleteDirectory(
        $extractPath
    );


    // =====================================================
    // 15. BERHASIL
    // =====================================================

    return redirect()
        ->to(
            base_url('admin/korsda/wilayah')
        )
        ->with(
            'success',
            'Data wilayah berhasil disimpan.'
        );
}

    // =========================================================
    // EDIT
    // =========================================================

   public function edit($id)
{
    $wilayah = $this->wilayahModel->find($id);

    if (!$wilayah) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
            'Data wilayah tidak ditemukan.'
        );
    }

    $korsda = $this->korsdaModel
        ->select('
            korsda.id,
            korsda.kecamatan_id,
            korsda.nama_wilayah,
            kecamatan.nama_kecamatan
        ')
        ->join(
            'kecamatan',
            'kecamatan.id = korsda.kecamatan_id',
            'left'
        )
        ->orderBy('korsda.nama_wilayah', 'ASC')
        ->findAll();

    $data = [
        'title'   => 'Edit Wilayah KORSDA',
        'wilayah' => $wilayah,
        'korsda'  => $korsda,
    ];

    return view(
        'admin/korsda/peta/edit',
        $data
    );
}

    // =========================================================
    // UPDATE
    // =========================================================

    public function update($id)
    {
        $wilayah = $this->wilayahModel->find($id);

        if (!$wilayah) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data wilayah tidak ditemukan.'
            );
        }

        // -----------------------------------------------------
        // 1. VALIDASI
        // -----------------------------------------------------

        $rules = [
            'korsda_id' => [
                'label'  => 'KORSDA',
                'rules'  => 'required|integer',
                'errors' => [
                    'required' => 'KORSDA wajib dipilih.',
                    'integer'  => 'KORSDA tidak valid.',
                ],
            ],

            'nama_wilayah' => [
                'label'  => 'Nama Wilayah',
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama wilayah wajib diisi.',
                ],
            ],

            'file_peta' => [
                'label'  => 'File ZIP',
                'rules'  => 'permit_empty|max_size[file_peta,51200]|ext_in[file_peta,zip]',
                'errors' => [
                    'max_size' => 'Ukuran file ZIP maksimal 50 MB.',
                    'ext_in'   => 'File peta harus berformat ZIP.',
                ],
            ],

            'keterangan' => [
                'label'  => 'Keterangan',
                'rules'  => 'permit_empty',
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // -----------------------------------------------------
        // 2. CEK KORSDA
        // -----------------------------------------------------

        $korsdaId = (int) $this->request->getPost(
            'korsda_id'
        );

        $korsda = $this->korsdaModel->find(
            $korsdaId
        );

        if (!$korsda) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'KORSDA yang dipilih tidak ditemukan.'
                );
        }

        $data = [
            'korsda_id'    => $korsdaId,
            'nama_wilayah' => trim(
                $this->request->getPost('nama_wilayah')
            ),
            'keterangan'   => trim(
                $this->request->getPost('keterangan')
            ),
        ];

        // -----------------------------------------------------
        // 3. CEK APAKAH ZIP DIGANTI
        // -----------------------------------------------------

        $file = $this->request->getFile(
            'file_peta'
        );

        $replaceFile = (
            $file &&
            $file->isValid() &&
            !$file->hasMoved()
        );

        if ($replaceFile) {

            // ---------------------------------------------
            // Hapus file lama
            // ---------------------------------------------

            if (!empty($wilayah['file_peta'])) {

                $oldZip =
                    $this->uploadDir .
                    $wilayah['file_peta'];

                $this->safeDeleteFile(
                    $oldZip
                );
            }

            if (!empty($wilayah['file_geojson'])) {

                $oldGeojson =
                    $this->uploadDir .
                    $wilayah['file_geojson'];

                $this->safeDeleteFile(
                    $oldGeojson
                );
            }

            // ---------------------------------------------
            // Simpan ZIP baru
            // ---------------------------------------------

            $namaFile =
                $file->getRandomName();

            try {

                $file->move(
                    $this->uploadDir,
                    $namaFile
                );

            } catch (\Throwable $e) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Gagal menyimpan ZIP baru: ' .
                        $e->getMessage()
                    );
            }

            $zipPath =
                $this->uploadDir .
                $namaFile;

            // ---------------------------------------------
            // Folder ekstrak
            // ---------------------------------------------

            $folderName =
                pathinfo(
                    $namaFile,
                    PATHINFO_FILENAME
                );

            $extractPath =
                $this->uploadDir .
                $folderName .
                DIRECTORY_SEPARATOR;

            if (!is_dir($extractPath)) {
                mkdir(
                    $extractPath,
                    0777,
                    true
                );
            }

            // ---------------------------------------------
            // Buka ZIP
            // ---------------------------------------------

            $zip = new ZipArchive();

            if ($zip->open($zipPath) !== true) {

                $this->safeDeleteFile(
                    $zipPath
                );

                $this->deleteDirectory(
                    $extractPath
                );

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'ZIP baru tidak dapat dibuka.'
                    );
            }

            // ---------------------------------------------
            // Ekstrak
            // ---------------------------------------------

            if (!$zip->extractTo($extractPath)) {

                $zip->close();

                $this->safeDeleteFile(
                    $zipPath
                );

                $this->deleteDirectory(
                    $extractPath
                );

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Gagal mengekstrak ZIP baru.'
                    );
            }

            $zip->close();

            // ---------------------------------------------
            // Cari SHP
            // ---------------------------------------------

            $shpFile =
                $this->findFileByExtension(
                    $extractPath,
                    'shp'
                );

            if (!$shpFile) {

                $this->safeDeleteFile(
                    $zipPath
                );

                $this->deleteDirectory(
                    $extractPath
                );

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'SHP tidak ditemukan dalam ZIP baru.'
                    );
            }

            // ---------------------------------------------
            // OGR2OGR
            // ---------------------------------------------

            $ogr2ogr =
                'C:\\OSGeo4W\\bin\\ogr2ogr.exe';

            if (!file_exists($ogr2ogr)) {

                $this->safeDeleteFile(
                    $zipPath
                );

                $this->deleteDirectory(
                    $extractPath
                );

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'ogr2ogr.exe tidak ditemukan.'
                    );
            }

            // ---------------------------------------------
            // GeoJSON baru
            // ---------------------------------------------

            $geojsonName =
                $folderName .
                '.geojson';

            $geojsonPath =
                $this->uploadDir .
                $geojsonName;

            $resultConvert =
                $this->convertShpToGeoJson(
                    $ogr2ogr,
                    $shpFile,
                    $geojsonPath
                );

            if (!$resultConvert['success']) {

                $this->safeDeleteFile(
                    $zipPath
                );

                $this->safeDeleteFile(
                    $geojsonPath
                );

                $this->deleteDirectory(
                    $extractPath
                );

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        $resultConvert['message']
                    );
            }

            $data['file_peta'] =
                $namaFile;

            $data['file_geojson'] =
                $geojsonName;

            // ---------------------------------------------
            // Hapus folder ekstrak
            // ---------------------------------------------

            $this->deleteDirectory(
                $extractPath
            );
        }

        // -----------------------------------------------------
        // 4. UPDATE DATABASE
        // -----------------------------------------------------

        try {

            $updated =
                $this->wilayahModel->update(
                    $id,
                    $data
                );

        } catch (\Throwable $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Gagal memperbarui database: ' .
                    $e->getMessage()
                );
        }

        if (!$updated) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Data wilayah gagal diperbarui: ' .
                    implode(
                        ', ',
                        $this->wilayahModel->errors()
                    )
                );
        }

        return redirect()
            ->to(
                base_url('admin/korsda/wilayah')
            )
            ->with(
                'success',
                'Data wilayah berhasil diperbarui.'
            );
    }

    // =========================================================
    // DELETE
    // =========================================================

    public function delete($id)
    {
        $wilayah =
            $this->wilayahModel->find($id);

        if (!$wilayah) {
            return redirect()
                ->to(
                    base_url('admin/korsda/wilayah')
                )
                ->with(
                    'error',
                    'Data wilayah tidak ditemukan.'
                );
        }

        // -----------------------------------------------------
        // Hapus ZIP
        // -----------------------------------------------------

        if (!empty($wilayah['file_peta'])) {

            $zipPath =
                $this->uploadDir .
                $wilayah['file_peta'];

            $this->safeDeleteFile(
                $zipPath
            );
        }

        // -----------------------------------------------------
        // Hapus GeoJSON
        // -----------------------------------------------------

        if (!empty($wilayah['file_geojson'])) {

            $geojsonPath =
                $this->uploadDir .
                $wilayah['file_geojson'];

            $this->safeDeleteFile(
                $geojsonPath
            );
        }

        // -----------------------------------------------------
        // Soft delete database
        // -----------------------------------------------------

        $this->wilayahModel->delete($id);

        return redirect()
            ->to(
                base_url('admin/korsda/wilayah')
            )
            ->with(
                'success',
                'Data wilayah berhasil dihapus.'
            );
    }

    // =========================================================
    // KONVERSI SHP → GEOJSON
    // =========================================================

    private function convertShpToGeoJson(
        string $ogr2ogr,
        string $shpFile,
        string $geojsonPath
    ): array {

        // Hapus GeoJSON lama jika ada
        if (file_exists($geojsonPath)) {
            unlink($geojsonPath);
        }

        $command =
            '"' . $ogr2ogr . '" ' .
            '-f "GeoJSON" ' .
            '-t_srs EPSG:4326 ' .
            '"' . $geojsonPath . '" ' .
            '"' . $shpFile . '" ' .
            '2>&1';

        $output = [];
        $status = 0;

        exec(
            $command,
            $output,
            $status
        );

        if (
            $status !== 0 ||
            !file_exists($geojsonPath)
        ) {

            return [
                'success' => false,
                'message' =>
                    'Gagal mengubah SHP menjadi GeoJSON. ' .
                    implode(' ', $output),
            ];
        }

        // -----------------------------------------------------
        // Validasi JSON
        // -----------------------------------------------------

        $json = file_get_contents(
            $geojsonPath
        );

        if ($json === false) {

            return [
                'success' => false,
                'message' =>
                    'GeoJSON berhasil dibuat tetapi tidak dapat dibaca.',
            ];
        }

        json_decode($json);

        if (json_last_error() !== JSON_ERROR_NONE) {

            return [
                'success' => false,
                'message' =>
                    'File GeoJSON yang dihasilkan tidak valid.',
            ];
        }

        return [
            'success' => true,
            'message' => 'GeoJSON berhasil dibuat.',
        ];
    }

    // =========================================================
    // CARI FILE BERDASARKAN EXTENSION
    // =========================================================

    private function findFileByExtension(
        string $directory,
        string $extension
    ): ?string {

        if (!is_dir($directory)) {
            return null;
        }

        $iterator =
            new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator(
                    $directory,
                    \FilesystemIterator::SKIP_DOTS
                )
            );

        foreach ($iterator as $file) {

            if (
                $file->isFile() &&
                strtolower(
                    $file->getExtension()
                ) === strtolower($extension)
            ) {
                return $file->getPathname();
            }
        }

        return null;
    }

    // =========================================================
    // HAPUS FILE
    // =========================================================

    private function safeDeleteFile(
        string $path
    ): void {

        if (
            !empty($path) &&
            file_exists($path) &&
            is_file($path)
        ) {
            @unlink($path);
        }
    }

    // =========================================================
    // HAPUS DIRECTORY RECURSIVE
    // =========================================================

    private function deleteDirectory(
        string $directory
    ): void {

        if (!is_dir($directory)) {
            return;
        }

        $items =
            new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator(
                    $directory,
                    \FilesystemIterator::SKIP_DOTS
                ),
                \RecursiveIteratorIterator::CHILD_FIRST
            );

        foreach ($items as $item) {

            if ($item->isDir()) {
                @rmdir(
                    $item->getPathname()
                );
            } else {
                @unlink(
                    $item->getPathname()
                );
            }
        }

        @rmdir($directory);
    }
}