<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KegiatanKorsdaAdminModel;
use App\Models\KorsdaModel;
use App\Models\FotoKegiatanKorsdaModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class KegiatanKorsda extends BaseController
{
    protected $kegiatanKorsdaAdminModel;
    protected $korsdaModel;
    protected $fotoKegiatanKorsdaModel;

    public function __construct()
    {
        $this->kegiatanKorsdaAdminModel =
            new KegiatanKorsdaAdminModel();

        $this->korsdaModel =
            new KorsdaModel();

        $this->fotoKegiatanKorsdaModel =
            new FotoKegiatanKorsdaModel();
    }


    /* =========================================================
       INDEX
    ========================================================= */

    public function index()
    {
        $data['kegiatan'] =
            $this->kegiatanKorsdaAdminModel
                ->select(
                    'kegiatankorsda.*, 
                     korsda.nama_wilayah,
                     kecamatan.nama_kecamatan'
                )
                ->join(
                    'korsda',
                    'korsda.id = kegiatankorsda.korsda_id',
                    'left'
                )
                ->join(
                    'kecamatan',
                    'kecamatan.id = korsda.kecamatan_id',
                    'left'
                )
                ->orderBy(
                    'kegiatankorsda.tanggal',
                    'DESC'
                )
                ->findAll();

        return view(
            'admin/korsda/kegiatan_korsda/index',
            $data
        );
    }


    /* =========================================================
       CREATE
    ========================================================= */

    public function create()
    {
        $korsda =
            $this->korsdaModel
                ->select('id, nama_wilayah')
                ->orderBy(
                    'nama_wilayah',
                    'ASC'
                )
                ->findAll();

        return view(
            'admin/korsda/kegiatan_korsda/create',
            [
                'title'  => 'Tambah Kegiatan KORSDA',
                'korsda' => $korsda,
            ]
        );
    }


    /* =========================================================
       STORE
       Tambah manual
    ========================================================= */

    public function store()
    {
        $korsdaId =
            $this->request->getPost('korsda_id');

        $judul =
            trim(
                (string)
                $this->request->getPost('judul')
            );

        $tanggal =
            $this->request->getPost('tanggal');

        $isi =
            $this->request->getPost('isi');


        if (empty($korsdaId)) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'KORSDA wajib dipilih.'
                );
        }


        if (!$this->korsdaModel->find($korsdaId)) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Data KORSDA tidak ditemukan.'
                );
        }


        if ($judul === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Judul kegiatan wajib diisi.'
                );
        }


        if (empty($tanggal)) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Tanggal kegiatan wajib diisi.'
                );
        }


        if (empty($isi)) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Isi kegiatan wajib diisi.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GAMBAR UTAMA
        |--------------------------------------------------------------------------
        */

        $gambar =
            $this->request->getFile('gambar');


        if (
            !$gambar ||
            !$gambar->isValid() ||
            $gambar->getError() === UPLOAD_ERR_NO_FILE
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Gambar utama wajib dipilih.'
                );
        }


        if (
            !$this->isAllowedImage(
                $gambar->getExtension()
            )
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Format gambar harus JPG, JPEG, PNG, atau WEBP.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | FOLDER THUMBNAIL
        |--------------------------------------------------------------------------
        */

        $folderThumbnail =
            FCPATH .
            'uploads/Kegiatan/thumbnail/';


        $this->buatFolder(
            $folderThumbnail
        );


        $namaGambar =
            $gambar->getRandomName();


        $gambar->move(
            $folderThumbnail,
            $namaGambar
        );


        /*
        |--------------------------------------------------------------------------
        | CEK HASIL UPLOAD
        |--------------------------------------------------------------------------
        */

        $pathGambar =
            $folderThumbnail .
            $namaGambar;


        if (!file_exists($pathGambar)) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Gambar utama gagal disimpan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATABASE
        |--------------------------------------------------------------------------
        */

        try {

            $this->kegiatanKorsdaAdminModel
                ->insert([
                    'korsda_id' => $korsdaId,
                    'judul'     => $judul,
                    'tanggal'   => $tanggal,
                    'isi'       => $isi,
                    'gambar'    => $namaGambar,
                ]);

        } catch (\Throwable $e) {

            if (file_exists($pathGambar)) {
                @unlink($pathGambar);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Data gagal disimpan: ' .
                    $e->getMessage()
                );
        }


        $kegiatanId =
            $this->kegiatanKorsdaAdminModel
                ->getInsertID();


        /*
        |--------------------------------------------------------------------------
        | DOKUMENTASI
        |--------------------------------------------------------------------------
        */

        $this->simpanDokumentasi(
            $kegiatanId
        );


        return redirect()
            ->to(
                base_url(
                    'admin/korsda/kegiatan'
                )
            )
            ->with(
                'success',
                'Data kegiatan berhasil ditambahkan.'
            );
    }


    /* =========================================================
       EDIT
    ========================================================= */

    public function edit($id)
    {
        $kegiatan =
            $this->kegiatanKorsdaAdminModel
                ->find($id);


        if (!$kegiatan) {
            throw
                \CodeIgniter\Exceptions\PageNotFoundException
                ::forPageNotFound(
                    'Data kegiatan tidak ditemukan.'
                );
        }


        $korsda =
            $this->korsdaModel
                ->select('id, nama_wilayah')
                ->orderBy(
                    'nama_wilayah',
                    'ASC'
                )
                ->findAll();


        $foto =
            $this->fotoKegiatanKorsdaModel
                ->getFotoByKegiatan($id);


        return view(
            'admin/korsda/kegiatan_korsda/edit',
            [
                'title'    => 'Edit Kegiatan KORSDA',
                'kegiatan' => $kegiatan,
                'korsda'   => $korsda,
                'foto'     => $foto,
            ]
        );
    }


    /* =========================================================
       UPDATE
    ========================================================= */

    public function update($id)
    {
        $kegiatan =
            $this->kegiatanKorsdaAdminModel
                ->find($id);


        if (!$kegiatan) {
            throw
                \CodeIgniter\Exceptions\PageNotFoundException
                ::forPageNotFound(
                    'Data kegiatan tidak ditemukan.'
                );
        }


        $korsdaId =
            $this->request->getPost('korsda_id');

        $judul =
            trim(
                (string)
                $this->request->getPost('judul')
            );

        $tanggal =
            $this->request->getPost('tanggal');

        $isi =
            $this->request->getPost('isi');


        if (empty($korsdaId)) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'KORSDA wajib dipilih.'
                );
        }


        if (!$this->korsdaModel->find($korsdaId)) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Data KORSDA tidak ditemukan.'
                );
        }


        if ($judul === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Judul kegiatan wajib diisi.'
                );
        }


        if (empty($tanggal)) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Tanggal kegiatan wajib diisi.'
                );
        }


        if (empty($isi)) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Isi kegiatan wajib diisi.'
                );
        }


        $data = [
            'korsda_id' => $korsdaId,
            'judul'     => $judul,
            'tanggal'   => $tanggal,
            'isi'       => $isi,
        ];


        /*
        |--------------------------------------------------------------------------
        | GANTI THUMBNAIL
        |--------------------------------------------------------------------------
        */

        $gambar =
            $this->request->getFile('gambar');


        if (
            $gambar &&
            $gambar->isValid() &&
            !$gambar->hasMoved() &&
            $gambar->getError() !== UPLOAD_ERR_NO_FILE
        ) {

            if (
                !$this->isAllowedImage(
                    $gambar->getExtension()
                )
            ) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Format gambar harus JPG, JPEG, PNG, atau WEBP.'
                    );
            }


            $folderThumbnail =
                FCPATH .
                'uploads/Kegiatan/thumbnail/';


            $this->buatFolder(
                $folderThumbnail
            );


            $namaGambar =
                $gambar->getRandomName();


            $gambar->move(
                $folderThumbnail,
                $namaGambar
            );


            $pathBaru =
                $folderThumbnail .
                $namaGambar;


            if (!file_exists($pathBaru)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Gambar baru gagal disimpan.'
                    );
            }


            /*
            | Hapus gambar lama
            */

            $this->hapusGambarUtama(
                $kegiatan['gambar'] ?? null
            );


            $data['gambar'] =
                $namaGambar;
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE DATABASE
        |--------------------------------------------------------------------------
        */

        $this->kegiatanKorsdaAdminModel
            ->update(
                $id,
                $data
            );


        /*
        |--------------------------------------------------------------------------
        | TAMBAH DOKUMENTASI BARU
        |--------------------------------------------------------------------------
        */

        $this->simpanDokumentasi(
            $id
        );


        return redirect()
            ->to(
                base_url(
                    'admin/korsda/kegiatan'
                )
            )
            ->with(
                'success',
                'Data kegiatan berhasil diubah.'
            );
    }


    /* =========================================================
       DELETE SATU FOTO DOKUMENTASI
    ========================================================= */

    public function deleteFoto($id)
    {
        $foto =
            $this->fotoKegiatanKorsdaModel
                ->find($id);


        if (!$foto) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Foto dokumentasi tidak ditemukan.'
                );
        }


        if (!empty($foto['foto'])) {

            $paths = [

                FCPATH .
                'uploads/Kegiatan/dokumentasi_korsda/' .
                $foto['foto'],

                FCPATH .
                'uploads/kegiatan/dokumentasi_korsda/' .
                $foto['foto'],
            ];


            foreach ($paths as $path) {

                if (file_exists($path)) {
                    @unlink($path);
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS HANYA SATU FOTO
        |--------------------------------------------------------------------------
        */

        $this->fotoKegiatanKorsdaModel
            ->delete($id);


        return redirect()
            ->back()
            ->with(
                'success',
                'Foto dokumentasi berhasil dihapus.'
            );
    }


    /* =========================================================
       DELETE KEGIATAN
    ========================================================= */

    public function delete($id)
    {
        $kegiatan =
            $this->kegiatanKorsdaAdminModel
                ->find($id);


        if (!$kegiatan) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data kegiatan tidak ditemukan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS THUMBNAIL
        |--------------------------------------------------------------------------
        */

        $this->hapusGambarUtama(
            $kegiatan['gambar'] ?? null
        );


        /*
        |--------------------------------------------------------------------------
        | AMBIL DOKUMENTASI
        |--------------------------------------------------------------------------
        */

        $foto =
            $this->fotoKegiatanKorsdaModel
                ->getFotoByKegiatan($id);


        /*
        |--------------------------------------------------------------------------
        | HAPUS FILE DOKUMENTASI
        |--------------------------------------------------------------------------
        */

        foreach ($foto as $item) {

            if (
                empty($item['foto'])
            ) {
                continue;
            }


            $paths = [

                FCPATH .
                'uploads/Kegiatan/dokumentasi_korsda/' .
                $item['foto'],

                FCPATH .
                'uploads/kegiatan/dokumentasi_korsda/' .
                $item['foto'],
            ];


            foreach ($paths as $path) {

                if (file_exists($path)) {
                    @unlink($path);
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS RECORD DOKUMENTASI
        |--------------------------------------------------------------------------
        */

        $this->fotoKegiatanKorsdaModel
            ->deleteByKegiatan($id);


        /*
        |--------------------------------------------------------------------------
        | HAPUS KEGIATAN
        |--------------------------------------------------------------------------
        */

        $this->kegiatanKorsdaAdminModel
            ->delete($id);


        return redirect()
            ->to(
                base_url(
                    'admin/korsda/kegiatan'
                )
            )
            ->with(
                'success',
                'Kegiatan dan seluruh dokumentasi berhasil dihapus.'
            );
    }


    /* =========================================================
       FORM IMPORT
    ========================================================= */

    public function import()
    {
        $korsda =
            $this->korsdaModel
                ->select('id, nama_wilayah')
                ->orderBy(
                    'nama_wilayah',
                    'ASC'
                )
                ->findAll();


        return view(
            'admin/korsda/kegiatan_korsda/import',
            [
                'title'  => 'Import Kegiatan KORSDA',
                'korsda' => $korsda,
            ]
        );
    }


    /* =========================================================
       IMPORT EXCEL + ZIP
    ========================================================= */

    public function importProcess()
    {
        /*
        |--------------------------------------------------------------------------
        | KORSDA
        |--------------------------------------------------------------------------
        */

        $korsdaId =
            $this->request->getPost(
                'korsda_id'
            );


        if (empty($korsdaId)) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'KORSDA wajib dipilih.'
                );
        }


        if (!$this->korsdaModel->find($korsdaId)) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Data KORSDA tidak ditemukan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | EXCEL
        |--------------------------------------------------------------------------
        */

        $excel =
            $this->request->getFile(
                'excel'
            );


        if (
            !$excel ||
            !$excel->isValid()
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'File Excel wajib dipilih.'
                );
        }


        $excelExtension =
            strtolower(
                $excel->getClientExtension()
            );


        if (
            !in_array(
                $excelExtension,
                ['xlsx', 'xls'],
                true
            )
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'File Excel harus .xlsx atau .xls.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | ZIP
        |--------------------------------------------------------------------------
        */

        $zip =
            $this->request->getFile(
                'zip'
            );


        if (
            !$zip ||
            !$zip->isValid()
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'File ZIP dokumentasi wajib dipilih.'
                );
        }


        if (
            strtolower(
                $zip->getClientExtension()
            ) !== 'zip'
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'File dokumentasi harus berformat ZIP.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | BACA EXCEL
        |--------------------------------------------------------------------------
        */

        try {

            $spreadsheet =
                IOFactory::load(
                    $excel->getTempName()
                );


            $sheet =
                $spreadsheet
                    ->getActiveSheet();


            $rows =
                $sheet->toArray(
                    null,
                    true,
                    true,
                    true
                );

        } catch (\Throwable $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Excel gagal dibaca: ' .
                    $e->getMessage()
                );
        }


        /*
        |--------------------------------------------------------------------------
        | TEMP
        |--------------------------------------------------------------------------
        */

        $tempRoot =
            WRITEPATH .
            'uploads/import_kegiatan_korsda/';


        $this->buatFolder(
            $tempRoot
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN ZIP
        |--------------------------------------------------------------------------
        */

        $zipName =
            $zip->getRandomName();


        $zipPath =
            $tempRoot .
            $zipName;


        $zip->move(
            $tempRoot,
            $zipName
        );


        /*
        |--------------------------------------------------------------------------
        | OPEN ZIP
        |--------------------------------------------------------------------------
        */

        $zipArchive =
            new \ZipArchive();


        if (
            $zipArchive->open(
                $zipPath
            ) !== true
        ) {

            @unlink($zipPath);

            return redirect()
                ->back()
                ->with(
                    'error',
                    'ZIP tidak dapat dibuka.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | EXTRACT
        |--------------------------------------------------------------------------
        */

        $extractFolder =
            $tempRoot .
            pathinfo(
                $zipName,
                PATHINFO_FILENAME
            ) .
            DIRECTORY_SEPARATOR;


        $this->buatFolder(
            $extractFolder
        );


        if (
            !$zipArchive->extractTo(
                $extractFolder
            )
        ) {

            $zipArchive->close();

            @unlink($zipPath);

            $this->hapusFolderImport(
                $extractFolder
            );

            return redirect()
                ->back()
                ->with(
                    'error',
                    'ZIP gagal diekstrak.'
                );
        }


        $zipArchive->close();


        /*
        |--------------------------------------------------------------------------
        | CARI FOLDER KEGIATAN
        |--------------------------------------------------------------------------
        */

        $kegiatanRoot =
            $this->cariFolderBernama(
                $extractFolder,
                'Kegiatan'
            );


        if (!$kegiatanRoot) {

            @unlink($zipPath);

            $this->hapusFolderImport(
                $extractFolder
            );

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Folder "Kegiatan" tidak ditemukan di ZIP.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | FOLDER TUJUAN
        |--------------------------------------------------------------------------
        */

        $thumbnailPath =
            FCPATH .
            'uploads/Kegiatan/thumbnail/';


        $dokumentasiPath =
            FCPATH .
            'uploads/Kegiatan/dokumentasi_korsda/';


        $this->buatFolder(
            $thumbnailPath
        );


        $this->buatFolder(
            $dokumentasiPath
        );


        /*
        |--------------------------------------------------------------------------
        | COUNTER
        |--------------------------------------------------------------------------
        */

        $berhasil = 0;

        $gagal = 0;

        $pesanGagal = [];


        /*
        |--------------------------------------------------------------------------
        | BATAS UKURAN
        |--------------------------------------------------------------------------
        */

        $minSize =
            10 * 1024;

        $maxSize =
            300 * 1024;


        /*
        |--------------------------------------------------------------------------
        | LOOP EXCEL
        |--------------------------------------------------------------------------
        */

        foreach (
            $rows as $rowNumber => $row
        ) {

            /*
            | Lewati header
            */

            if ($rowNumber == 1) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | KOLOM EXCEL
            |--------------------------------------------------------------------------
            |
            | A = Kode
            | B = Judul
            | C = Tanggal
            | D = Thumbnail
            |
            */

            $kode =
                trim(
                    (string)
                    ($row['A'] ?? '')
                );


            $judul =
                trim(
                    (string)
                    ($row['B'] ?? '')
                );


            $tanggal =
                $this->formatTanggalImport(
                    $row['C'] ?? ''
                );


            $thumbnail =
                trim(
                    (string)
                    ($row['D'] ?? '')
                );


            /*
            |--------------------------------------------------------------------------
            | BARIS KOSONG
            |--------------------------------------------------------------------------
            */

            if (
                $kode === '' &&
                $judul === '' &&
                !$tanggal &&
                $thumbnail === ''
            ) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | VALIDASI
            |--------------------------------------------------------------------------
            */

            if ($kode === '') {

                $gagal++;

                $pesanGagal[] =
                    "Baris {$rowNumber}: Kode kegiatan kosong.";

                continue;
            }


            if ($judul === '') {

                $gagal++;

                $pesanGagal[] =
                    "Baris {$rowNumber}: Judul kegiatan kosong.";

                continue;
            }


            if (!$tanggal) {

                $gagal++;

                $pesanGagal[] =
                    "Baris {$rowNumber}: Tanggal tidak valid.";

                continue;
            }


            if ($thumbnail === '') {

                $gagal++;

                $pesanGagal[] =
                    "Baris {$rowNumber}: Nama thumbnail kosong.";

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | CARI FOLDER KG
            |--------------------------------------------------------------------------
            */

            $folderKegiatan =
                $this->cariFolderBernama(
                    $kegiatanRoot,
                    $kode
                );


            if (!$folderKegiatan) {

                $gagal++;

                $pesanGagal[] =
                    "Baris {$rowNumber}: Folder '{$kode}' tidak ditemukan.";

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | CARI THUMBNAIL
            |--------------------------------------------------------------------------
            */

            $thumbnailFile =
                $this->cariFileImport(
                    $folderKegiatan,
                    $thumbnail
                );


            if (!$thumbnailFile) {

                $gagal++;

                $pesanGagal[] =
                    "Baris {$rowNumber}: Thumbnail '{$thumbnail}' tidak ditemukan di folder {$kode}.";

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | FORMAT THUMBNAIL
            |--------------------------------------------------------------------------
            */

            if (
                !$this->isAllowedImage(
                    pathinfo(
                        $thumbnailFile,
                        PATHINFO_EXTENSION
                    )
                )
            ) {

                $gagal++;

                $pesanGagal[] =
                    "Baris {$rowNumber}: '{$thumbnail}' bukan file gambar.";

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | UKURAN THUMBNAIL
            |--------------------------------------------------------------------------
            */

            $ukuranThumbnail =
                filesize(
                    $thumbnailFile
                );


            if (
                $ukuranThumbnail < $minSize ||
                $ukuranThumbnail > $maxSize
            ) {

                $ukuranKB =
                    round(
                        $ukuranThumbnail / 1024,
                        1
                    );


                $gagal++;

                $pesanGagal[] =
                    "Baris {$rowNumber}: Thumbnail '{$thumbnail}' berukuran {$ukuranKB} KB. Batas 10-300 KB.";

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | BUAT NAMA FILE BARU
            |--------------------------------------------------------------------------
            */

            $namaThumbnail =
                $this->buatNamaFileImport(
                    $thumbnailFile
                );


            $tujuanThumbnail =
                $thumbnailPath .
                $namaThumbnail;


            /*
            |--------------------------------------------------------------------------
            | COPY THUMBNAIL
            |--------------------------------------------------------------------------
            */

            $copyThumbnail =
                copy(
                    $thumbnailFile,
                    $tujuanThumbnail
                );


            if (!$copyThumbnail) {

                $gagal++;

                $pesanGagal[] =
                    "Baris {$rowNumber}: Thumbnail gagal disalin ke folder thumbnail.";

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | VERIFIKASI FILE HASIL COPY
            |--------------------------------------------------------------------------
            */

            if (
                !file_exists(
                    $tujuanThumbnail
                )
            ) {

                $gagal++;

                $pesanGagal[] =
                    "Baris {$rowNumber}: Thumbnail tidak ditemukan setelah proses copy.";

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | INSERT DATABASE
            |--------------------------------------------------------------------------
            */

            try {

                $insert =
                    $this->kegiatanKorsdaAdminModel
                        ->insert([
                            'korsda_id' =>
                                $korsdaId,

                            'judul' =>
                                $judul,

                            'tanggal' =>
                                $tanggal,

                            'isi' =>
                                '',

                            'gambar' =>
                                $namaThumbnail,
                        ]);


                if (!$insert) {

                    throw new \Exception(
                        'Insert kegiatan gagal.'
                    );
                }


                $kegiatanId =
                    $this->kegiatanKorsdaAdminModel
                        ->getInsertID();

            } catch (\Throwable $e) {

                /*
                | Jangan meninggalkan file
                | kalau database gagal.
                */

                if (
                    file_exists(
                        $tujuanThumbnail
                    )
                ) {

                    @unlink(
                        $tujuanThumbnail
                    );
                }


                $gagal++;

                $pesanGagal[] =
                    "Baris {$rowNumber}: Gagal menyimpan database: " .
                    $e->getMessage();

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | AMBIL SEMUA FOTO
            |--------------------------------------------------------------------------
            */

            $semuaFoto =
                $this->ambilFileGambar(
                    $folderKegiatan
                );


            /*
            |--------------------------------------------------------------------------
            | SIMPAN DOKUMENTASI
            |--------------------------------------------------------------------------
            */

            foreach (
                $semuaFoto as $fileFoto
            ) {

                /*
                | Thumbnail jangan masuk
                | sebagai dokumentasi.
                */

                if (
                    $this->namaFileSama(
                        $fileFoto,
                        $thumbnailFile
                    )
                ) {
                    continue;
                }


                /*
                |--------------------------------------------------------------------------
                | UKURAN
                |--------------------------------------------------------------------------
                */

                $ukuranFoto =
                    filesize(
                        $fileFoto
                    );


                if (
                    $ukuranFoto < $minSize ||
                    $ukuranFoto > $maxSize
                ) {
                    continue;
                }


                /*
                |--------------------------------------------------------------------------
                | NAMA BARU
                |--------------------------------------------------------------------------
                */

                $namaFoto =
                    $this->buatNamaFileImport(
                        $fileFoto
                    );


                $tujuanFoto =
                    $dokumentasiPath .
                    $namaFoto;


                /*
                |--------------------------------------------------------------------------
                | COPY
                |--------------------------------------------------------------------------
                */

                if (
                    !copy(
                        $fileFoto,
                        $tujuanFoto
                    )
                ) {
                    continue;
                }


                /*
                |--------------------------------------------------------------------------
                | VERIFIKASI
                |--------------------------------------------------------------------------
                */

                if (
                    !file_exists(
                        $tujuanFoto
                    )
                ) {
                    continue;
                }


                /*
                |--------------------------------------------------------------------------
                | DATABASE DOKUMENTASI
                |--------------------------------------------------------------------------
                */

                $this->fotoKegiatanKorsdaModel
                    ->insert([
                        'kegiatan_korsda_id' =>
                            $kegiatanId,

                        'foto' =>
                            $namaFoto,

                        'created_at' =>
                            date(
                                'Y-m-d H:i:s'
                            ),
                    ]);
            }


            $berhasil++;
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS TEMPORARY
        |--------------------------------------------------------------------------
        */

        @unlink(
            $zipPath
        );


        $this->hapusFolderImport(
            $extractFolder
        );


        /*
        |--------------------------------------------------------------------------
        | HASIL
        |--------------------------------------------------------------------------
        */

        $pesan =
            "Import selesai. " .
            "Berhasil: {$berhasil}, " .
            "Gagal: {$gagal}.";


        if (
            !empty($pesanGagal)
        ) {

            $pesan .=
                "\n\nDetail error:\n";


            $pesan .=
                implode(
                    "\n",
                    array_slice(
                        $pesanGagal,
                        0,
                        30
                    )
                );
        }


        if ($berhasil > 0) {

            return redirect()
                ->to(
                    base_url(
                        'admin/korsda/kegiatan'
                    )
                )
                ->with(
                    'success',
                    $pesan
                );
        }


        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                $pesan
            );
    }


    /* =========================================================
       SIMPAN DOKUMENTASI MANUAL
    ========================================================= */

    private function simpanDokumentasi(
        $kegiatanId
    ) {
        $dokumentasi =
            $this->request
                ->getFileMultiple(
                    'dokumentasi'
                );


        if (
            empty($dokumentasi)
        ) {
            return;
        }


        $folder =
            FCPATH .
            'uploads/Kegiatan/dokumentasi_korsda/';


        $this->buatFolder(
            $folder
        );


        foreach (
            $dokumentasi as $foto
        ) {

            if (
                !$foto ||
                $foto->getError()
                === UPLOAD_ERR_NO_FILE
            ) {
                continue;
            }


            if (
                !$foto->isValid() ||
                $foto->hasMoved()
            ) {
                continue;
            }


            if (
                !$this->isAllowedImage(
                    $foto->getExtension()
                )
            ) {
                continue;
            }


            $namaFoto =
                $foto->getRandomName();


            $foto->move(
                $folder,
                $namaFoto
            );


            $path =
                $folder .
                $namaFoto;


            if (
                !file_exists($path)
            ) {
                continue;
            }


            $this->fotoKegiatanKorsdaModel
                ->insert([
                    'kegiatan_korsda_id' =>
                        $kegiatanId,

                    'foto' =>
                        $namaFoto,

                    'created_at' =>
                        date(
                            'Y-m-d H:i:s'
                        ),
                ]);
        }
    }


    /* =========================================================
       HAPUS THUMBNAIL
    ========================================================= */

    private function hapusGambarUtama(
        $namaFile
    ) {
        if (
            empty($namaFile)
        ) {
            return;
        }


        $paths = [

            FCPATH .
            'uploads/Kegiatan/thumbnail/' .
            $namaFile,

            FCPATH .
            'uploads/kegiatan/thumbnail/' .
            $namaFile,

            FCPATH .
            'uploads/Kegiatan/' .
            $namaFile,

            FCPATH .
            'uploads/kegiatan/' .
            $namaFile,
        ];


        foreach ($paths as $path) {

            if (
                file_exists($path)
            ) {
                @unlink($path);
            }
        }
    }


    /* =========================================================
       CEK FORMAT GAMBAR
    ========================================================= */

    private function isAllowedImage(
        $extension
    ) {
        return in_array(
            strtolower(
                $extension
            ),
            [
                'jpg',
                'jpeg',
                'png',
                'webp',
            ],
            true
        );
    }


    /* =========================================================
       BUAT FOLDER
    ========================================================= */

    private function buatFolder(
        $folder
    ) {
        if (
            !is_dir($folder)
        ) {

            mkdir(
                $folder,
                0777,
                true
            );
        }
    }


    /* =========================================================
       FORMAT TANGGAL EXCEL
    ========================================================= */

    private function formatTanggalImport(
        $tanggal
    ) {
        /*
        |--------------------------------------------------------------------------
        | EXCEL SERIAL
        |--------------------------------------------------------------------------
        */

        if (
            is_numeric($tanggal)
        ) {

            try {

                $date =
                    \PhpOffice\PhpSpreadsheet\Shared\Date
                    ::excelToDateTimeObject(
                        $tanggal
                    );


                return $date->format(
                    'Y-m-d'
                );

            } catch (\Throwable $e) {

                return false;
            }
        }


        $tanggal =
            trim(
                (string)
                $tanggal
            );


        if (
            $tanggal === ''
        ) {
            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | YYYY-MM-DD
        |--------------------------------------------------------------------------
        */

        $date =
            \DateTime::createFromFormat(
                'Y-m-d',
                $tanggal
            );


        if (
            $date &&
            $date->format('Y-m-d')
            ===
            $tanggal
        ) {

            return $tanggal;
        }


        /*
        |--------------------------------------------------------------------------
        | DD/MM/YYYY
        |--------------------------------------------------------------------------
        */

        $date =
            \DateTime::createFromFormat(
                'd/m/Y',
                $tanggal
            );


        if ($date) {

            return $date->format(
                'Y-m-d'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DD-MM-YYYY
        |--------------------------------------------------------------------------
        */

        $date =
            \DateTime::createFromFormat(
                'd-m-Y',
                $tanggal
            );


        if ($date) {

            return $date->format(
                'Y-m-d'
            );
        }


        return false;
    }


    /* =========================================================
       CARI FOLDER
    ========================================================= */

    private function cariFolderBernama(
        $root,
        $namaFolder
    ) {
        if (
            !is_dir($root)
        ) {
            return false;
        }


        $basename =
            basename(
                rtrim(
                    $root,
                    DIRECTORY_SEPARATOR
                )
            );


        if (
            strtolower($basename)
            ===
            strtolower($namaFolder)
        ) {

            return rtrim(
                $root,
                DIRECTORY_SEPARATOR
            ) .
            DIRECTORY_SEPARATOR;
        }


        $items =
            scandir($root);


        foreach (
            $items as $item
        ) {

            if (
                $item === '.' ||
                $item === '..'
            ) {
                continue;
            }


            $path =
                $root .
                DIRECTORY_SEPARATOR .
                $item;


            if (
                !is_dir($path)
            ) {
                continue;
            }


            if (
                strtolower($item)
                ===
                strtolower($namaFolder)
            ) {

                return rtrim(
                    $path,
                    DIRECTORY_SEPARATOR
                ) .
                DIRECTORY_SEPARATOR;
            }


            $hasil =
                $this->cariFolderBernama(
                    $path,
                    $namaFolder
                );


            if ($hasil) {
                return $hasil;
            }
        }


        return false;
    }


    /* =========================================================
       CARI FILE
    ========================================================= */

    private function cariFileImport(
        $folder,
        $namaFile
    ) {
        if (
            !is_dir($folder)
        ) {
            return false;
        }


        $namaNormal =
            $this->normalisasiNamaFile(
                $namaFile
            );


        try {

            $iterator =
                new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator(
                        $folder,
                        \FilesystemIterator::SKIP_DOTS
                    )
                );

        } catch (\Throwable $e) {

            return false;
        }


        foreach (
            $iterator as $file
        ) {

            if (
                !$file->isFile()
            ) {
                continue;
            }


            $namaAsli =
                $file->getFilename();


            /*
            |--------------------------------------------------------------------------
            | EXACT
            |--------------------------------------------------------------------------
            */

            if (
                strtolower($namaAsli)
                ===
                strtolower($namaFile)
            ) {

                return $file->getPathname();
            }


            /*
            |--------------------------------------------------------------------------
            | NORMALISASI
            |--------------------------------------------------------------------------
            */

            if (
                $this->normalisasiNamaFile(
                    $namaAsli
                )
                ===
                $namaNormal
            ) {

                return $file->getPathname();
            }
        }


        return false;
    }


    /* =========================================================
       NORMALISASI NAMA FILE
    ========================================================= */

    private function normalisasiNamaFile(
        $nama
    ) {
        $nama =
            strtolower(
                trim(
                    basename(
                        $nama
                    )
                )
            );


        return str_replace(
            [
                ' ',
                '_',
                '-',
            ],
            '',
            $nama
        );
    }


    /* =========================================================
       BANDINGKAN FILE
    ========================================================= */

    private function namaFileSama(
        $file1,
        $file2
    ) {
        return
            $this->normalisasiNamaFile(
                basename($file1)
            )
            ===
            $this->normalisasiNamaFile(
                basename($file2)
            );
    }


    /* =========================================================
       AMBIL SEMUA GAMBAR
    ========================================================= */

    private function ambilFileGambar(
        $folder
    ) {
        $hasil = [];


        if (
            !is_dir($folder)
        ) {
            return $hasil;
        }


        try {

            $iterator =
                new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator(
                        $folder,
                        \FilesystemIterator::SKIP_DOTS
                    )
                );

        } catch (\Throwable $e) {

            return $hasil;
        }


        foreach (
            $iterator as $file
        ) {

            if (
                !$file->isFile()
            ) {
                continue;
            }


            $path =
                $file->getPathname();


            if (
                $this->isAllowedImage(
                    pathinfo(
                        $path,
                        PATHINFO_EXTENSION
                    )
                )
            ) {

                $hasil[] =
                    $path;
            }
        }


        return $hasil;
    }


    /* =========================================================
       NAMA FILE IMPORT
    ========================================================= */

    private function buatNamaFileImport(
        $file
    ) {
        $extension =
            strtolower(
                pathinfo(
                    $file,
                    PATHINFO_EXTENSION
                )
            );


        return
            'korsda_' .
            uniqid(
                '',
                true
            ) .
            '.' .
            $extension;
    }


    /* =========================================================
       HAPUS TEMPORARY
    ========================================================= */

    private function hapusFolderImport(
        $folder
    ) {
        if (
            !is_dir($folder)
        ) {
            return;
        }


        $items =
            scandir($folder);


        foreach (
            $items as $item
        ) {

            if (
                $item === '.' ||
                $item === '..'
            ) {
                continue;
            }


            $path =
                $folder .
                DIRECTORY_SEPARATOR .
                $item;


            if (
                is_dir($path)
            ) {

                $this->hapusFolderImport(
                    $path
                );

            } else {

                @unlink($path);
            }
        }


        @rmdir($folder);
    }
}