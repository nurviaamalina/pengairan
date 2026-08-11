<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KegiatanModel;
use App\Models\FotoKegiatanModel;

class AdminKegiatan extends BaseController
{
    protected $kegiatanModel;
    protected $fotoModel;

    public function __construct()
    {
        $this->kegiatanModel = new KegiatanModel();
        $this->fotoModel     = new FotoKegiatanModel();
    }

    public function index()
{
    $data = [
        'title'     => 'Data Kegiatan',
        'kegiatan'  => $this->kegiatanModel
                            ->orderBy('tanggal','DESC')
                            ->findAll()
    ];

    return view('admin/KegiatanAdmin/index', $data);
}

// =========================================================
// FORM IMPORT
// =========================================================

public function import()
{
    return view('admin/KegiatanAdmin/import', [
        'title' => 'Import Data Kegiatan Lama'
    ]);
}


// =========================================================
// PROSES IMPORT EXCEL + ZIP
// =========================================================

public function importProcess()
{
    $excel = $this->request->getFile('excel');
    $zip   = $this->request->getFile('zip');

    // =====================================================
    // 1. VALIDASI EXCEL
    // =====================================================

    if (!$excel || !$excel->isValid()) {

        return redirect()
            ->back()
            ->with(
                'error',
                'File Excel belum dipilih atau tidak valid.'
            );
    }

    $excelExtension = strtolower(
        $excel->getClientExtension()
    );

    if (!in_array($excelExtension, ['xlsx', 'xls'], true)) {

        return redirect()
            ->back()
            ->with(
                'error',
                'File Excel harus berformat XLSX atau XLS.'
            );
    }


    // =====================================================
    // 2. VALIDASI ZIP
    // =====================================================

    if (!$zip || !$zip->isValid()) {

        return redirect()
            ->back()
            ->with(
                'error',
                'File ZIP belum dipilih atau tidak valid.'
            );
    }

    if (
        strtolower(
            $zip->getClientExtension()
        ) !== 'zip'
    ) {

        return redirect()
            ->back()
            ->with(
                'error',
                'File dokumentasi harus berupa ZIP.'
            );
    }


    // ZipArchive harus bernilai null sebelum berhasil dibuka
    $zipArchive = null;


    try {

        // =================================================
        // 3. BACA EXCEL
        // =================================================

        $spreadsheet =
            \PhpOffice\PhpSpreadsheet\IOFactory::load(
                $excel->getTempName()
            );

        $sheet =
            $spreadsheet->getActiveSheet();

        $rows =
            $sheet->toArray(
                null,
                true,
                true,
                true
            );


        // =================================================
        // 4. BUKA ZIP
        // =================================================

        $zipArchive = new \ZipArchive();

        $zipResult =
            $zipArchive->open(
                $zip->getTempName()
            );

        if ($zipResult !== true) {

            $zipArchive = null;

            return redirect()
                ->back()
                ->with(
                    'error',
                    'File ZIP tidak dapat dibuka.'
                );
        }


        // =================================================
        // 5. INDEX SEMUA FILE DALAM ZIP
        // =================================================

        $zipFiles = [];

        for (
            $i = 0;
            $i < $zipArchive->numFiles;
            $i++
        ) {

            $fileName =
                $zipArchive->getNameIndex($i);

            if (!$fileName) {
                continue;
            }

            $fileName =
                str_replace(
                    '\\',
                    '/',
                    $fileName
                );

            // Abaikan folder
            if (
                str_ends_with(
                    $fileName,
                    '/'
                )
            ) {
                continue;
            }

            $zipFiles[] = $fileName;
        }


        // =================================================
        // 6. DATABASE
        // =================================================

        $db =
            \Config\Database::connect();

        $kegiatanTable =
            $db->table('kegiatan');

        $fotoTable =
            $db->table('foto_kegiatan');


        // =================================================
        // 7. FOLDER UPLOAD
        // =================================================

        // SEMUA DATA LAMA HASIL IMPORT
        // akan mengikuti struktur yang sama dengan
        // data kegiatan baru.

        $thumbnailPath =
            FCPATH . 'uploads/kegiatan/thumbnail/';

        $dokumentasiPath =
            FCPATH . 'uploads/kegiatan/dokumentasi/';


        // Buat folder thumbnail jika belum ada
        if (!is_dir($thumbnailPath)) {

            if (!mkdir(
                $thumbnailPath,
                0777,
                true
            ) && !is_dir($thumbnailPath)) {

                throw new \RuntimeException(
                    'Folder thumbnail tidak dapat dibuat.'
                );
            }
        }


        // Buat folder dokumentasi jika belum ada
        if (!is_dir($dokumentasiPath)) {

            if (!mkdir(
                $dokumentasiPath,
                0777,
                true
            ) && !is_dir($dokumentasiPath)) {

                throw new \RuntimeException(
                    'Folder dokumentasi tidak dapat dibuat.'
                );
            }
        }


        // =================================================
        // 8. COUNTER
        // =================================================

        $berhasil = 0;
        $dilewati = 0;
        $gagal    = 0;

        $errors = [];


        // =================================================
        // 9. PROSES SETIAP BARIS EXCEL
        // =================================================

        foreach (
            $rows as $index => $row
        ) {

            // Baris pertama = header
            if ($index === 1) {
                continue;
            }


            // =================================================
            // DATA EXCEL
            // =================================================

            // A = Kode kegiatan
            $kode =
                trim(
                    (string) ($row['A'] ?? '')
                );

            // B = Judul kegiatan
            $judul =
                trim(
                    (string) ($row['B'] ?? '')
                );

            // C = Tanggal
            $tanggalRaw =
                $row['C'] ?? '';

            // D = Nama thumbnail
            $namaThumbnail =
                trim(
                    (string) ($row['D'] ?? '')
                );


            // =================================================
            // LEWATI BARIS KOSONG
            // =================================================

            if (
                $kode === '' &&
                $judul === '' &&
                $tanggalRaw === '' &&
                $namaThumbnail === ''
            ) {
                continue;
            }


            $rowErrors = [];


            // =================================================
            // 10. VALIDASI
            // =================================================

            if ($kode === '') {

                $rowErrors[] =
                    'Kode kegiatan kosong.';
            }

            if ($judul === '') {

                $rowErrors[] =
                    'Nama kegiatan kosong.';
            }

            if ($namaThumbnail === '') {

                $rowErrors[] =
                    'Nama thumbnail kosong.';
            }


            // =================================================
            // 11. KONVERSI TANGGAL
            // =================================================

            $tanggal = '';

            if ($tanggalRaw !== '') {

                try {

                    // Tanggal Excel berupa angka
                    if (
                        is_numeric(
                            $tanggalRaw
                        )
                    ) {

                        $tanggalObj =
                            \PhpOffice\PhpSpreadsheet\Shared\Date
                                ::excelToDateTimeObject(
                                    $tanggalRaw
                                );

                        $tanggal =
                            $tanggalObj->format(
                                'Y-m-d'
                            );

                    } else {

                        $tanggalRaw =
                            trim(
                                (string) $tanggalRaw
                            );


                        // Coba YYYY-MM-DD
                        $date =
                            \DateTime::createFromFormat(
                                'Y-m-d',
                                $tanggalRaw
                            );


                        if (
                            $date &&
                            $date->format(
                                'Y-m-d'
                            ) === $tanggalRaw
                        ) {

                            $tanggal =
                                $tanggalRaw;

                        } else {

                            // Coba format tanggal lainnya
                            $timestamp =
                                strtotime(
                                    $tanggalRaw
                                );

                            if (
                                $timestamp !== false
                            ) {

                                $tanggal =
                                    date(
                                        'Y-m-d',
                                        $timestamp
                                    );
                            }
                        }
                    }

                } catch (\Throwable $e) {

                    $tanggal = '';
                }
            }


            if ($tanggal === '') {

                $rowErrors[] =
                    'Tanggal tidak valid.';
            }


            // =================================================
            // 12. CARI FILE DALAM FOLDER KODE KEGIATAN
            // =================================================
            //
            // Contoh ZIP:
            //
            // Kegiatan/
            // ├── KG1/
            // │   ├── thumbnail1.jpg
            // │   ├── foto_random1.jpg
            // │   └── foto_random2.jpg
            //
            // ├── KG2/
            // │   ├── thumbnail2.jpg
            // │   └── foto_random3.jpg
            //
            // Kode Excel:
            // KG1
            // KG2
            //
            // =================================================

            $folderFiles = [];

            $kodeLower =
                strtolower(
                    trim(
                        $kode,
                        '/ '
                    )
                );


            foreach (
                $zipFiles as $zipFile
            ) {

                $normalizedZipFile =
                    str_replace(
                        '\\',
                        '/',
                        $zipFile
                    );


                $parts =
                    explode(
                        '/',
                        $normalizedZipFile
                    );


                /*
                 * Kita cari folder yang namanya sama
                 * dengan kode kegiatan.
                 *
                 * Contoh:
                 *
                 * Kegiatan/KG1/foto.jpg
                 *
                 * parts:
                 * [0] Kegiatan
                 * [1] KG1
                 * [2] foto.jpg
                 */

                if (
                    count($parts) < 3
                ) {
                    continue;
                }


                // Ambil posisi file
                $fileName =
                    array_pop($parts);


                // Folder paling akhir sebelum file
                $folderName =
                    end($parts);


                if (
                    strtolower(
                        trim(
                            $folderName
                        )
                    )
                    !==
                    $kodeLower
                ) {
                    continue;
                }


                // Pastikan benar-benar file gambar/file
                if ($fileName === '') {
                    continue;
                }


                $folderFiles[] =
                    $normalizedZipFile;
            }


            // =================================================
            // 13. FOLDER KEGIATAN TIDAK DITEMUKAN
            // =================================================

            if (
                empty($folderFiles)
            ) {

                $rowErrors[] =
                    'Folder "' .
                    $kode .
                    '" tidak ditemukan di dalam ZIP.';
            }


            // =================================================
            // 14. CARI THUMBNAIL
            // =================================================

            $thumbnailZipPath = null;


            foreach (
                $folderFiles as $file
            ) {

                $namaFileZip =
                    basename($file);


                if (
                    strtolower(
                        $namaFileZip
                    )
                    ===
                    strtolower(
                        $namaThumbnail
                    )
                ) {

                    $thumbnailZipPath =
                        $file;

                    break;
                }
            }


            if (!$thumbnailZipPath) {

                $rowErrors[] =
                    'Thumbnail "' .
                    $namaThumbnail .
                    '" tidak ditemukan dalam folder ' .
                    $kode .
                    '.';
            }


            // =================================================
            // 15. JIKA DATA ERROR
            // =================================================

            if (!empty($rowErrors)) {

                $gagal++;

                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' =>
                        $rowErrors

                ];

                continue;
            }


            // =================================================
            // 16. BUAT SLUG
            // =================================================

            $slug =
                url_title(
                    $judul,
                    '-',
                    true
                );


            // =================================================
            // 17. CEK DUPLIKAT
            // =================================================

            $existing =
                $kegiatanTable
                    ->where(
                        'slug',
                        $slug
                    )
                    ->get()
                    ->getRowArray();


            if ($existing) {

                $dilewati++;

                continue;
            }


            // =================================================
            // 18. BACA THUMBNAIL DARI ZIP
            // =================================================

            $thumbnailContent =
                $zipArchive->getFromName(
                    $thumbnailZipPath
                );


            if (
                $thumbnailContent === false
            ) {

                $gagal++;

                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' => [

                        'Thumbnail tidak dapat dibaca dari ZIP.'

                    ]

                ];

                continue;
            }


            // =================================================
            // 19. VALIDASI EXTENSION
            // =================================================

            $thumbnailExtension =
                strtolower(
                    pathinfo(
                        $namaThumbnail,
                        PATHINFO_EXTENSION
                    )
                );


            $allowedExtensions = [

                'jpg',
                'jpeg',
                'png',
                'webp'

            ];


            if (
                !in_array(
                    $thumbnailExtension,
                    $allowedExtensions,
                    true
                )
            ) {

                $gagal++;

                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' => [

                        'Format thumbnail tidak diperbolehkan.'

                    ]

                ];

                continue;
            }


            // =================================================
            // 20. BUAT NAMA THUMBNAIL BARU
            // =================================================

            $thumbnailBaru =
                uniqid(
                    'kegiatan_',
                    true
                )
                . '.'
                . $thumbnailExtension;


            // =================================================
            // 21. SIMPAN THUMBNAIL
            // =================================================

            $savedThumbnail =
                file_put_contents(
                    $thumbnailPath .
                    $thumbnailBaru,
                    $thumbnailContent
                );


            if (
                $savedThumbnail === false
            ) {

                $gagal++;

                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' => [

                        'Thumbnail gagal disimpan ke folder uploads/kegiatan/thumbnail/.'

                    ]

                ];

                continue;
            }


            // =================================================
            // 22. TRANSACTION DATABASE
            // =================================================

            $db->transStart();


            // =================================================
            // 23. INSERT KEGIATAN
            // =================================================

            $insertKegiatan =
                $kegiatanTable->insert([

                    'judul' =>
                        $judul,

                    'slug' =>
                        $slug,

                    'deskripsi' =>
                        '-',

                    'thumbnail' =>
                        $thumbnailBaru,

                    'tanggal' =>
                        $tanggal,

                    'tahun' =>
                        date(
                            'Y',
                            strtotime(
                                $tanggal
                            )
                        ),

                    'created_at' =>
                        date(
                            'Y-m-d H:i:s'
                        ),

                    'updated_at' =>
                        date(
                            'Y-m-d H:i:s'
                        )

                ]);


            // Jika insert gagal
            if (!$insertKegiatan) {

                $db->transRollback();


                // Hapus thumbnail
                if (
                    file_exists(
                        $thumbnailPath .
                        $thumbnailBaru
                    )
                ) {

                    unlink(
                        $thumbnailPath .
                        $thumbnailBaru
                    );
                }


                $gagal++;

                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' => [

                        'Gagal menyimpan data kegiatan ke database.'

                    ]

                ];

                continue;
            }


            // Ambil ID kegiatan
            $kegiatanId =
                $db->insertID();


            // =================================================
            // 24. SIMPAN FOTO DOKUMENTASI
            // =================================================

            foreach (
                $folderFiles as $file
            ) {

                // Jangan simpan thumbnail sebagai dokumentasi
                if (
                    strtolower(
                        basename($file)
                    )
                    ===
                    strtolower(
                        $namaThumbnail
                    )
                ) {
                    continue;
                }


                // Extension foto
                $extension =
                    strtolower(
                        pathinfo(
                            $file,
                            PATHINFO_EXTENSION
                        )
                    );


                // Hanya gambar
                if (
                    !in_array(
                        $extension,
                        $allowedExtensions,
                        true
                    )
                ) {
                    continue;
                }


                // Ambil isi gambar
                $imageContent =
                    $zipArchive->getFromName(
                        $file
                    );


                if (
                    $imageContent === false
                ) {
                    continue;
                }


                // Nama file baru
                $namaFotoBaru =
                    uniqid(
                        'kegiatan_foto_',
                        true
                    )
                    . '.'
                    . $extension;


                // Simpan ke folder dokumentasi
                $savedFoto =
                    file_put_contents(
                        $dokumentasiPath .
                        $namaFotoBaru,
                        $imageContent
                    );


                if (
                    $savedFoto === false
                ) {
                    continue;
                }


                // Simpan ke database
                $insertFoto =
                    $fotoTable->insert([

                        'kegiatan_id' =>
                            $kegiatanId,

                        'foto' =>
                            $namaFotoBaru,

                        'created_at' =>
                            date(
                                'Y-m-d H:i:s'
                            )

                    ]);


                // Jika insert foto gagal
                if (!$insertFoto) {

                    // Hapus file foto
                    if (
                        file_exists(
                            $dokumentasiPath .
                            $namaFotoBaru
                        )
                    ) {

                        unlink(
                            $dokumentasiPath .
                            $namaFotoBaru
                        );
                    }
                }
            }


            // =================================================
            // 25. SELESAIKAN TRANSACTION
            // =================================================

            $db->transComplete();


            // =================================================
            // 26. CEK TRANSACTION
            // =================================================

            if (!$db->transStatus()) {

                // Hapus thumbnail
                if (
                    file_exists(
                        $thumbnailPath .
                        $thumbnailBaru
                    )
                ) {

                    unlink(
                        $thumbnailPath .
                        $thumbnailBaru
                    );
                }


                // Cari dokumentasi yang sudah tersimpan
                $fotoYangTersimpan =
                    $fotoTable
                        ->where(
                            'kegiatan_id',
                            $kegiatanId
                        )
                        ->findAll();


                foreach (
                    $fotoYangTersimpan as $foto
                ) {

                    $fotoPath =
                        $dokumentasiPath .
                        $foto['foto'];


                    if (
                        file_exists(
                            $fotoPath
                        )
                    ) {

                        unlink(
                            $fotoPath
                        );
                    }
                }


                $gagal++;


                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' => [

                        'Transaksi database gagal.'

                    ]

                ];


                continue;
            }


            // =================================================
            // 27. BERHASIL
            // =================================================

            $berhasil++;
        }


        // =====================================================
        // 28. TUTUP ZIP
        // =====================================================

        if ($zipArchive !== null) {

            $zipArchive->close();

            $zipArchive = null;
        }


        // =====================================================
        // 29. PESAN HASIL IMPORT
        // =====================================================

        $pesan =
            'Import selesai. ' .
            $berhasil .
            ' kegiatan berhasil';


        if ($dilewati > 0) {

            $pesan .=
                ', ' .
                $dilewati .
                ' kegiatan dilewati karena sudah ada';
        }


        if ($gagal > 0) {

            $pesan .=
                ', ' .
                $gagal .
                ' kegiatan gagal';
        }


        $pesan .= '.';


        // Simpan detail error ke session
        if (!empty($errors)) {

            session()->setFlashdata(
                'import_errors',
                $errors
            );
        }


        // =====================================================
        // 30. KEMBALI KE INDEX
        // =====================================================

        return redirect()
            ->to(
                base_url(
                    'admin/kegiatan'
                )
            )
            ->with(
                'success',
                $pesan
            );


    } catch (\Throwable $e) {

        // =====================================================
        // ERROR UMUM
        // =====================================================

        if ($zipArchive !== null) {

            try {

                $zipArchive->close();

            } catch (\Throwable $closeError) {

                // Abaikan error saat menutup ZIP
            }

            $zipArchive = null;
        }


        return redirect()
            ->back()
            ->with(
                'error',
                'Import gagal: ' .
                $e->getMessage()
            );
    }
}
public function create()
{
    return view('admin/KegiatanAdmin/create');
}

public function store()
{
    // ==========================
    // Upload Thumbnail
    // ==========================
    $thumbnail = $this->request->getFile('thumbnail');

    $namaThumbnail = '';

    if ($thumbnail && $thumbnail->isValid() && !$thumbnail->hasMoved()) {

        $namaThumbnail = $thumbnail->getRandomName();

        $thumbnail->move('uploads/kegiatan/thumbnail', $namaThumbnail);
    }

    // ==========================
    // Simpan Data Kegiatan
    // ==========================
    $this->kegiatanModel->insert([

        'judul'      => $this->request->getPost('judul'),

        'slug'       => url_title(
                            $this->request->getPost('judul'),
                            '-',
                            true
                        ),

        'deskripsi'  => $this->request->getPost('deskripsi'),

        'thumbnail'  => $namaThumbnail,

        'tanggal'    => $this->request->getPost('tanggal'),

        'tahun'      => date(
                            'Y',
                            strtotime(
                                $this->request->getPost('tanggal')
                            )
                        )

    ]);

    // Ambil ID kegiatan yang baru disimpan
    $kegiatanId = $this->kegiatanModel->getInsertID();

    // ==========================
    // Upload Dokumentasi
    // ==========================
    $dokumentasi = $this->request->getFiles();

    if (isset($dokumentasi['dokumentasi'])) {

        foreach ($dokumentasi['dokumentasi'] as $file) {

            if ($file->isValid() && !$file->hasMoved()) {

                $namaFoto = $file->getRandomName();

                $file->move(
                    'uploads/kegiatan/dokumentasi',
                    $namaFoto
                );

                $this->fotoModel->insert([

                    'kegiatan_id' => $kegiatanId,

                    'foto' => $namaFoto

                ]);

            }

        }

    }

    return redirect()
            ->to(base_url('admin/kegiatan'))
            ->with('success', 'Kegiatan berhasil ditambahkan.');
}

public function edit($id)
{
    $data = [

        'kegiatan' => $this->kegiatanModel->find($id),

        'foto' => $this->fotoModel
                        ->where('kegiatan_id',$id)
                        ->findAll()

    ];

    return view(
        'admin/KegiatanAdmin/edit',
        $data
    );
}

public function update($id)
{
    $kegiatan = $this->kegiatanModel->find($id);

    $thumbnail = $this->request->getFile('thumbnail');

    $namaThumbnail = $kegiatan['thumbnail'];

    if ($thumbnail->isValid() && !$thumbnail->hasMoved()) {

        if (
            !empty($kegiatan['thumbnail']) &&
            file_exists('uploads/kegiatan/thumbnail/' . $kegiatan['thumbnail'])
        ) {

            unlink(
                'uploads/kegiatan/thumbnail/' . $kegiatan['thumbnail']
            );

        }

        $namaThumbnail = $thumbnail->getRandomName();

        $thumbnail->move(
            'uploads/kegiatan/thumbnail',
            $namaThumbnail
        );
    }

    $this->kegiatanModel->update($id,[

    'judul' => $this->request->getPost('judul'),

    'slug' => url_title(
        $this->request->getPost('judul'),
        '-',
        true
    ),

    'deskripsi' => $this->request->getPost('deskripsi'),

    'thumbnail' => $namaThumbnail,

    'tanggal' => $this->request->getPost('tanggal'),

    'tahun' => date(
        'Y',
        strtotime($this->request->getPost('tanggal'))
    )

]);

$dokumentasi = $this->request->getFiles();

if (isset($dokumentasi['dokumentasi'])) {

    foreach ($dokumentasi['dokumentasi'] as $file) {

        if ($file->isValid() && !$file->hasMoved()) {

            $namaFoto = $file->getRandomName();

            $file->move(
                'uploads/kegiatan/dokumentasi',
                $namaFoto
            );

            $this->fotoModel->insert([

                'kegiatan_id' => $id,

                'foto' => $namaFoto

            ]);

        }

    }

}

$dokumentasi = $this->request->getFiles();

if (isset($dokumentasi['dokumentasi'])) {

    foreach ($dokumentasi['dokumentasi'] as $file) {

        if ($file->isValid() && !$file->hasMoved()) {

            $namaFoto = $file->getRandomName();

            $file->move(
                'uploads/kegiatan/dokumentasi',
                $namaFoto
            );

            $this->fotoModel->insert([

                'kegiatan_id' => $id,

                'foto' => $namaFoto

            ]);
        }
    }
}

    return redirect()
            ->to(base_url('admin/kegiatan'))
            ->with('success','Data berhasil diperbarui.');
}

public function deleteFoto($id)
{
    $foto = $this->fotoModel->find($id);

    if (!$foto) {
        return redirect()->back()->with('error', 'Foto tidak ditemukan.');
    }

    if (file_exists('uploads/kegiatan/dokumentasi/' . $foto['foto'])) {
        unlink('uploads/kegiatan/dokumentasi/' . $foto['foto']);
    }

    $this->fotoModel->delete($id);

    return redirect()->back()->with('success', 'Foto berhasil dihapus.');
}

public function delete($id)
{
    $kegiatan = $this->kegiatanModel->find($id);

    if (!$kegiatan) {

        return redirect()
                ->to(base_url('admin/kegiatan'))
                ->with('error','Data tidak ditemukan');

    }

    // ==========================
    // Hapus Thumbnail
    // ==========================

    if (
        !empty($kegiatan['thumbnail']) &&
        file_exists('uploads/kegiatan/thumbnail/' . $kegiatan['thumbnail'])
    ) {

        unlink(
            'uploads/kegiatan/thumbnail/' . $kegiatan['thumbnail']
        );

    }

    // ==========================
    // Hapus Semua Dokumentasi
    // ==========================

    $foto = $this->fotoModel
                ->where('kegiatan_id',$id)
                ->findAll();

    foreach($foto as $item){

        if(
            file_exists(
                'uploads/kegiatan/dokumentasi/' . $item['foto']
            )
        ){

            unlink(
                'uploads/kegiatan/dokumentasi/' . $item['foto']
            );

        }

    }

    // ==========================
    // Hapus Data Dokumentasi
    // ==========================

    $this->fotoModel
            ->where('kegiatan_id',$id)
            ->delete();

    // ==========================
    // Hapus Data Kegiatan
    // ==========================

    $this->kegiatanModel->delete($id);

    return redirect()
            ->to(base_url('admin/kegiatan'))
            ->with(
                'success',
                'Kegiatan berhasil dihapus.'
            );

}
}