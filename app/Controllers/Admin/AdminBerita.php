<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BeritaModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AdminBerita extends BaseController
{
    protected $beritaModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
    }

    // Menampilkan daftar berita
    public function index()
    {
        $data = [
            'title'   => 'Data Berita',
            'berita'  => $this->beritaModel
                            ->orderBy('tanggal', 'DESC')
                            ->findAll()
        ];

        return view('admin/BeritaAdmin/index', $data);
    }

    // Form tambah berita
    public function create()
    {
        $data = [
            'title' => 'Tambah Berita'
        ];

        return view('admin/BeritaAdmin/create', $data);
    }

    // Simpan berita

    /**
 * Proses import berita lama dari Excel + ZIP
 */

        public function import()
{
    return view('admin/BeritaAdmin/import', [
        'title' => 'Import Data Berita Lama'
    ]);
}

public function importProcess()
{
    $excel = $this->request->getFile('excel');
    $zip   = $this->request->getFile('zip');

    // ==================================================
    // 1. VALIDASI EXCEL
    // ==================================================

    if (!$excel || !$excel->isValid()) {
        return redirect()
            ->back()
            ->with('error', 'File Excel belum dipilih atau tidak valid.');
    }

    $excelExtension = strtolower(
        $excel->getClientExtension()
    );

    if (!in_array($excelExtension, ['xlsx', 'xls'])) {
        return redirect()
            ->back()
            ->with('error', 'File Excel harus XLSX atau XLS.');
    }


    // ==================================================
    // 2. VALIDASI ZIP
    // ==================================================

    if (!$zip || !$zip->isValid()) {
        return redirect()
            ->back()
            ->with('error', 'File ZIP belum dipilih atau tidak valid.');
    }

    if (
        strtolower($zip->getClientExtension()) !== 'zip'
    ) {
        return redirect()
            ->back()
            ->with('error', 'File gambar harus berupa ZIP.');
    }


    try {

        // ==================================================
        // 3. BACA EXCEL
        // ==================================================

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


        // ==================================================
        // 4. BUKA ZIP
        // ==================================================

        $zipArchive = new \ZipArchive();

        if (
            $zipArchive->open(
                $zip->getTempName()
            ) !== true
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'File ZIP tidak dapat dibuka.'
                );
        }


        // ==================================================
        // 5. INDEX FILE DALAM ZIP
        // ==================================================

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


        // ==================================================
        // 6. MODEL
        // ==================================================

        $beritaModel =
            new \App\Models\BeritaModel();


        // ==================================================
        // 7. FOLDER UPLOAD
        // ==================================================

        $uploadPath =
            FCPATH . 'uploads/berita/';

        if (!is_dir($uploadPath)) {

            mkdir(
                $uploadPath,
                0777,
                true
            );
        }


        // ==================================================
        // 8. COUNTER
        // ==================================================

        $berhasil = 0;
        $dilewati = 0;
        $gagal    = 0;

        $errors = [];


        // ==================================================
        // 9. PROSES SETIAP BARIS EXCEL
        // ==================================================

        foreach (
            $rows as $index => $row
        ) {

            // Baris pertama adalah header
            if ($index == 1) {
                continue;
            }


            // ----------------------------------------------
            // AMBIL DATA
            // ----------------------------------------------

            $kode =
                trim($row['A'] ?? '');

            $judul =
                trim($row['B'] ?? '');

            $isi =
                trim($row['C'] ?? '');

            $publikator =
                trim($row['D'] ?? '');

            $tanggalRaw =
                $row['E'] ?? '';

            $namaGambar =
                trim($row['F'] ?? '');


            // ----------------------------------------------
            // LEWATI BARIS KOSONG
            // ----------------------------------------------

            if (
                $kode === '' &&
                $judul === '' &&
                $isi === '' &&
                $publikator === '' &&
                $tanggalRaw === '' &&
                $namaGambar === ''
            ) {
                continue;
            }


            $rowErrors = [];


            // ==================================================
            // 10. VALIDASI
            // ==================================================

            if ($judul === '') {
                $rowErrors[] =
                    'Judul berita kosong.';
            }

            if ($isi === '') {
                $rowErrors[] =
                    'Isi berita kosong.';
            }

            if ($publikator === '') {
                $rowErrors[] =
                    'Publikator kosong.';
            }

            if ($namaGambar === '') {
                $rowErrors[] =
                    'Nama gambar kosong.';
            }


            // ==================================================
            // 11. KONVERSI TANGGAL
            // ==================================================

            $tanggal = '';

            if ($tanggalRaw !== '') {

                try {

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

                } catch (
                    \Throwable $e
                ) {

                    $tanggal = '';
                }
            }


            if ($tanggal === '') {

                $rowErrors[] =
                    'Tanggal tidak valid.';
            }


            // ==================================================
            // 12. CARI GAMBAR
            // ==================================================

            $gambarZipPath = null;

            foreach (
                $zipFiles as $file
            ) {

                if (
                    strtolower(
                        basename($file)
                    )
                    ===
                    strtolower(
                        $namaGambar
                    )
                ) {

                    $gambarZipPath =
                        $file;

                    break;
                }
            }


            if (!$gambarZipPath) {

                $rowErrors[] =
                    'Gambar "' .
                    $namaGambar .
                    '" tidak ditemukan di ZIP.';
            }


            // ==================================================
            // 13. JIKA VALIDASI GAGAL
            // ==================================================

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


            // ==================================================
            // 14. CEK DUPLIKAT
            // ==================================================

            $slug =
                url_title(
                    $judul,
                    '-',
                    true
                );


            $existing =
                $beritaModel
                    ->where(
                        'slug',
                        $slug
                    )
                    ->first();


            if ($existing) {

                $dilewati++;

                continue;
            }


            // ==================================================
            // 15. AMBIL GAMBAR DARI ZIP
            // ==================================================

            $imageContent =
                $zipArchive->getFromName(
                    $gambarZipPath
                );


            if (
                $imageContent === false
            ) {

                $gagal++;

                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' => [
                        'Gambar tidak dapat dibaca dari ZIP.'
                    ]

                ];

                continue;
            }


            // ==================================================
            // 16. VALIDASI EXTENSION
            // ==================================================

            $extension =
                strtolower(
                    pathinfo(
                        $namaGambar,
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
                    $extension,
                    $allowedExtensions
                )
            ) {

                $gagal++;

                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' => [
                        'Format gambar tidak diperbolehkan.'
                    ]

                ];

                continue;
            }


            // ==================================================
            // 17. NAMA FILE BARU
            // ==================================================

            $namaFileBaru =
                uniqid(
                    'berita_',
                    true
                )
                . '.'
                . $extension;


            // ==================================================
            // 18. SIMPAN GAMBAR
            // ==================================================

            $saved =
                file_put_contents(
                    $uploadPath .
                    $namaFileBaru,
                    $imageContent
                );


            if ($saved === false) {

                $gagal++;

                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' => [
                        'Gambar gagal disimpan.'
                    ]

                ];

                continue;
            }


            // ==================================================
            // 19. INSERT DATABASE
            // ==================================================

            try {

                $inserted =
                    $beritaModel->insert([
                        'judul' =>
                            $judul,

                        'slug' =>
                            $slug,

                        'isi' =>
                            $isi,

                        'gambar' =>
                            $namaFileBaru,

                        'publikator' =>
                            $publikator,

                        'tanggal' =>
                            $tanggal,

                        'views' =>
                            0
                    ]);

            } catch (
                \Throwable $e
            ) {

                // Hapus gambar jika database gagal
                if (
                    file_exists(
                        $uploadPath .
                        $namaFileBaru
                    )
                ) {

                    unlink(
                        $uploadPath .
                        $namaFileBaru
                    );
                }


                $gagal++;

                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' => [
                        'Database error: ' .
                        $e->getMessage()
                    ]

                ];

                continue;
            }


            if (!$inserted) {

                if (
                    file_exists(
                        $uploadPath .
                        $namaFileBaru
                    )
                ) {

                    unlink(
                        $uploadPath .
                        $namaFileBaru
                    );
                }


                $gagal++;

                $errors[] = [

                    'baris' =>
                        $index,

                    'kode' =>
                        $kode,

                    'errors' => [
                        'Data gagal disimpan ke database.'
                    ]

                ];

                continue;
            }


            // ==================================================
            // 20. BERHASIL
            // ==================================================

            $berhasil++;
        }


        // ==================================================
        // 21. TUTUP ZIP
        // ==================================================

        $zipArchive->close();


        // ==================================================
        // 22. PESAN HASIL
        // ==================================================

        $pesan =
            'Import selesai. ' .
            $berhasil .
            ' berita berhasil';

        if ($dilewati > 0) {

            $pesan .=
                ', ' .
                $dilewati .
                ' berita dilewati karena sudah ada';
        }

        if ($gagal > 0) {

            $pesan .=
                ', ' .
                $gagal .
                ' berita gagal';
        }

        $pesan .= '.';


        // Simpan detail error
        if (!empty($errors)) {

            session()->setFlashdata(
                'import_errors',
                $errors
            );
        }


        // ==================================================
        // 23. KEMBALI KE INDEX
        // ==================================================

        return redirect()
            ->to(
                base_url(
                    'admin/berita'
                )
            )
            ->with(
                'success',
                $pesan
            );

    } catch (
        \Throwable $e
    ) {

        if (isset($zipArchive)) {
            $zipArchive->close();
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
    public function store()
    {
        $gambar = $this->request->getFile('gambar');

        $namaGambar = null;

        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {

            $namaGambar = $gambar->getRandomName();

            $gambar->move(FCPATH . 'uploads/berita', $namaGambar);
        }

        $this->beritaModel->save([

            'judul' => $this->request->getPost('judul'),

            'slug' => url_title(
                $this->request->getPost('judul'),
                '-',
                true
            ),

            'isi' => $this->request->getPost('isi'),

            'gambar' => $namaGambar,

            'publikator' => $this->request->getPost('publikator'),
            'tanggal'     => $this->request->getPost('tanggal'),

            'views' => 0

        ]);

        return redirect()->to('/admin/berita')
                         ->with('success', 'Berita berhasil ditambahkan.');
    }

    // Form edit
    public function edit($id)
    {
        $berita = $this->beritaModel->find($id);

        if (!$berita) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/BeritaAdmin/edit', [
            'title' => 'Edit Berita',
            'berita' => $berita
        ]);
    }

    // Update berita
    public function update($id)
    {
        $berita = $this->beritaModel->find($id);

        $gambar = $this->request->getFile('gambar');

        $namaGambar = $berita['gambar'];

        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {

            if (!empty($berita['gambar']) &&
                file_exists(FCPATH . 'uploads/berita/' . $berita['gambar'])) {

                unlink(FCPATH . 'uploads/berita/' . $berita['gambar']);
            }

            $namaGambar = $gambar->getRandomName();

            $gambar->move(FCPATH . 'uploads/berita', $namaGambar);
        }

        $this->beritaModel->update($id, [

            'judul' => $this->request->getPost('judul'),

            'slug' => url_title(
                $this->request->getPost('judul'),
                '-',
                true
            ),

            'isi' => $this->request->getPost('isi'),

            'gambar' => $namaGambar,

            'publikator' => $this->request->getPost('publikator'),

            'tanggal' => $this->request->getPost('tanggal')

        ]);

        return redirect()->to('/admin/berita')
                         ->with('success', 'Berita berhasil diperbarui.');
    }

    // Hapus berita
    public function delete($id)
    {
        $berita = $this->beritaModel->find($id);

        if ($berita) {

            if (!empty($berita['gambar']) &&
                file_exists(FCPATH . 'uploads/berita/' . $berita['gambar'])) {

                unlink(FCPATH . 'uploads/berita/' . $berita['gambar']);
            }

            $this->beritaModel->delete($id);
        }

        return redirect()->to('/admin/berita')
                         ->with('success', 'Berita berhasil dihapus.');
    }


}