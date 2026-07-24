<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KorsdaModel;

class Korsda extends BaseController
{
    public function index()
    {
        $model = new KorsdaModel();

        $data = [
            'title'   => 'KORSDA',
            'korsda'  => $model->findAll(),
        ];

        return view('korsda', $data);
    }

public function profil($id)
{
    $korsdaModel = new \App\Models\KorsdaModel();
    $profilModel = new \App\Models\ProfilKorsdaModel();

    $data['korsda'] = $korsdaModel->find($id);

    $data['profil'] = $profilModel
        ->where('id_korsda', $id)
        ->first();

    return view('korsda/profil', $data);
}

public function kegiatan($id)
{
    $korsdaModel = new \App\Models\KorsdaModel();
    $kegiatanModel = new \App\Models\KegiatanKorsdaModel();

    $data['korsda'] = $korsdaModel->find($id);

    $data['kegiatan'] = $kegiatanModel
        ->where('id_korsda', $id)
        ->orderBy('tanggal', 'DESC')
        ->findAll();

    return view('korsda/kegiatankorsda', $data);
}

public function detailKegiatan($id)
{
    $kegiatanModel = new \App\Models\KegiatanKorsdaModel();

    $data['kegiatan'] = $kegiatanModel->find($id);

    if (!$data['kegiatan']) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return view('korsda/detail_kegiatan', $data);
}
}