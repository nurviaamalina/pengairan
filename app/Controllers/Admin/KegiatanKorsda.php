<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KegiatanKorsdaAdminModel;
use App\Models\KorsdaModel;

class KegiatanKorsda extends BaseController
{
    protected $kegiatan;
    protected $korsda;

    public function __construct()
    {
        $this->kegiatan = new KegiatanKorsdaAdminModel();
        $this->korsda   = new KorsdaModel();
    }

   public function index()
{
    $data['kegiatan'] = $this->kegiatan
        ->select('kegiatankorsda.*, kecamatan.nama_kecamatan')
        ->join(
            'korsda',
            'korsda.id = kegiatankorsda.korsda_id'
        )
        ->join(
            'kecamatan',
            'kecamatan.id = korsda.kecamatan_id'
        )
        ->orderBy('tanggal', 'DESC')
        ->findAll();

    return view(
        'admin/korsda/kegiatan_korsda/index',
        $data
    );
}

    public function create()
    {
        $data['korsda'] = $this->korsda
            ->select('korsda.*, kecamatan.nama_kecamatan')
            ->join(
                'kecamatan',
                'kecamatan.id = korsda.kecamatan_id'
            )
            ->orderBy(
                'kecamatan.nama_kecamatan',
                'ASC'
            )
            ->findAll();

        return view(
            'admin/korsda/kegiatan_korsda/create',
            $data
        );
    }

    public function store()
{
    $korsdaId = $this->request->getPost('korsda_id');

    $gambar = $this->request->getFile('gambar');

    $namaGambar = null;

    if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
        $namaGambar = $gambar->getRandomName();
        $gambar->move('uploads/kegiatan', $namaGambar);
    }

    $this->kegiatan->save([
        'korsda_id' => $korsdaId,
        'judul'     => $this->request->getPost('judul'),
        'tanggal'   => $this->request->getPost('tanggal'),
        'isi'       => $this->request->getPost('isi'),
        'gambar'    => $namaGambar
    ]);

    return redirect()
        ->to('/admin/korsda/kegiatan')
        ->with('success', 'Data berhasil ditambahkan');
}
    public function edit($id)
    {
        $data['kegiatan'] = $this->kegiatan->find($id);

        $data['korsda'] = $this->korsda
            ->select('korsda.*, kecamatan.nama_kecamatan')
            ->join(
                'kecamatan',
                'kecamatan.id = korsda.kecamatan_id'
            )
            ->orderBy(
                'kecamatan.nama_kecamatan',
                'ASC'
            )
            ->findAll();

        return view(
            'admin/korsda/kegiatan_korsda/edit',
            $data
        );
    }

    public function update($id)
    {
        $data = [
            'korsda_id' => $this->request->getPost('korsda_id'),
            'judul'     => $this->request->getPost('judul'),
            'tanggal'   => $this->request->getPost('tanggal'),
            'isi'       => $this->request->getPost('isi'),
        ];

        $gambar = $this->request->getFile('gambar');

        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {

            $lama = $this->kegiatan->find($id);

            if (
                !empty($lama['gambar']) &&
                file_exists(
                    'uploads/kegiatan/' . $lama['gambar']
                )
            ) {
                unlink(
                    'uploads/kegiatan/' . $lama['gambar']
                );
            }

            $nama = $gambar->getRandomName();

            $gambar->move(
                'uploads/kegiatan',
                $nama
            );

            $data['gambar'] = $nama;
        }

        $this->kegiatan->update($id, $data);

        return redirect()
            ->to('/admin/korsda/kegiatan')
            ->with(
                'success',
                'Data berhasil diubah'
            );
    }

    public function delete($id)
    {
        $data = $this->kegiatan->find($id);

        if (
            $data &&
            !empty($data['gambar']) &&
            file_exists(
                'uploads/kegiatan/' . $data['gambar']
            )
        ) {
            unlink(
                'uploads/kegiatan/' . $data['gambar']
            );
        }

        $this->kegiatan->delete($id);

        return redirect()
            ->to('/admin/korsda/kegiatan')
            ->with(
                'success',
                'Data berhasil dihapus'
            );
    }
}