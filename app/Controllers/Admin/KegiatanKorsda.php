<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KegiatanKorsdaAdminModel;
use App\Models\KorsdaModel;

class KegiatanKorsda extends BaseController
{
    protected $kegiatanKorsdaAdminModel;
    protected $korsdaModel;

    public function __construct()
    {
        $this->kegiatanKorsdaAdminModel = new KegiatanKorsdaAdminModel();
        $this->korsdaModel = new KorsdaModel();
    }


    /**
     * INDEX
     * Menampilkan semua kegiatan KORSDA
     */
    public function index()
    {
        $data['kegiatan'] = $this->kegiatanKorsdaAdminModel
            ->select('
                kegiatankorsda.*,
                korsda.nama_wilayah,
                kecamatan.nama_kecamatan
            ')
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
            ->orderBy('kegiatankorsda.tanggal', 'DESC')
            ->findAll();

        return view(
            'admin/korsda/kegiatan_korsda/index',
            $data
        );
    }


    /**
     * CREATE
     * Form tambah kegiatan
     */
    public function create()
{
    $korsda = $this->korsdaModel
        ->select('id, nama_wilayah')
        ->orderBy('nama_wilayah', 'ASC')
        ->findAll();

    $data = [
        'title'  => 'Tambah Kegiatan KORSDA',
        'korsda' => $korsda,
    ];

    return view(
        'admin/korsda/kegiatan_korsda/create',
        $data
    );
}


    /**
     * STORE
     * Simpan kegiatan baru
     */
    public function store()
    {
        $korsdaId = $this->request->getPost('korsda_id');

        // Pastikan KORSDA tersedia
        $korsda = $this->korsdaModel->find($korsdaId);

        if (!$korsda) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Data KORSDA tidak ditemukan.'
                );
        }


        // Upload gambar
        $gambar = $this->request->getFile('gambar');

        $namaGambar = null;

        if (
            $gambar &&
            $gambar->isValid() &&
            !$gambar->hasMoved()
        ) {

            $namaGambar = $gambar->getRandomName();

            $gambar->move(
                FCPATH . 'uploads/kegiatan',
                $namaGambar
            );
        }


        // Simpan
        $this->kegiatanKorsdaAdminModel->save([
            'korsda_id' => $korsdaId,
            'judul'     => $this->request->getPost('judul'),
            'tanggal'   => $this->request->getPost('tanggal'),
            'isi'       => $this->request->getPost('isi'),
            'gambar'    => $namaGambar,
        ]);


        return redirect()
            ->to(base_url('admin/korsda/kegiatan'))
            ->with(
                'success',
                'Data kegiatan berhasil ditambahkan.'
            );
    }


    /**
     * EDIT
     * Form edit kegiatan
     */
    public function edit($id)
{
    $kegiatan = $this->kegiatanKorsdaAdminModel
        ->find($id);

    if (!$kegiatan) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
            'Data kegiatan tidak ditemukan.'
        );
    }

    $korsda = $this->korsdaModel
        ->select('
            korsda.id,
            korsda.nama_wilayah
        ')
        ->orderBy('korsda.nama_wilayah', 'ASC')
        ->findAll();

    $data = [
        'title'    => 'Edit Kegiatan KORSDA',
        'kegiatan' => $kegiatan,
        'korsda'   => $korsda,
    ];

    return view(
        'admin/korsda/kegiatan_korsda/edit',
        $data
    );
}


    /**
     * UPDATE
     * Update kegiatan
     */
    public function update($id)
    {
        $kegiatan = $this->kegiatanKorsdaAdminModel
            ->find($id);

        if (!$kegiatan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data kegiatan tidak ditemukan.'
            );
        }


        $korsdaId = $this->request->getPost('korsda_id');

        // Pastikan KORSDA valid
        $korsda = $this->korsdaModel->find($korsdaId);

        if (!$korsda) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Data KORSDA tidak ditemukan.'
                );
        }


        $data = [
            'korsda_id' => $korsdaId,
            'judul'     => $this->request->getPost('judul'),
            'tanggal'   => $this->request->getPost('tanggal'),
            'isi'       => $this->request->getPost('isi'),
        ];


        // Upload gambar baru
        $gambar = $this->request->getFile('gambar');

        if (
            $gambar &&
            $gambar->isValid() &&
            !$gambar->hasMoved()
        ) {

            // Hapus gambar lama
            if (
                !empty($kegiatan['gambar']) &&
                file_exists(
                    FCPATH . 'uploads/kegiatan/' .
                    $kegiatan['gambar']
                )
            ) {

                unlink(
                    FCPATH . 'uploads/kegiatan/' .
                    $kegiatan['gambar']
                );
            }


            // Upload gambar baru
            $namaGambar = $gambar->getRandomName();

            $gambar->move(
                FCPATH . 'uploads/kegiatan',
                $namaGambar
            );

            $data['gambar'] = $namaGambar;
        }


        $this->kegiatanKorsdaAdminModel
            ->update($id, $data);


        return redirect()
            ->to(base_url('admin/korsda/kegiatan'))
            ->with(
                'success',
                'Data kegiatan berhasil diubah.'
            );
    }


    /**
     * DELETE
     * Hapus kegiatan
     */
    public function delete($id)
    {
        $kegiatan = $this->kegiatanKorsdaAdminModel
            ->find($id);

        if (!$kegiatan) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data kegiatan tidak ditemukan.'
                );
        }


        // Hapus gambar
        if (
            !empty($kegiatan['gambar']) &&
            file_exists(
                FCPATH . 'uploads/kegiatan/' .
                $kegiatan['gambar']
            )
        ) {

            unlink(
                FCPATH . 'uploads/kegiatan/' .
                $kegiatan['gambar']
            );
        }


        // Hapus data
        $this->kegiatanKorsdaAdminModel
            ->delete($id);


        return redirect()
            ->to(base_url('admin/korsda/kegiatan'))
            ->with(
                'success',
                'Data kegiatan berhasil dihapus.'
            );
    }
}