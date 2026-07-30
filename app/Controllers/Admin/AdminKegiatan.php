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