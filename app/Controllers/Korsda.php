<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KorsdaModel;
use App\Models\ProfilKorsdaModel;
use App\Models\KegiatanKorsdaModel;

class Korsda extends BaseController
{
    public function index()
{
    $model = new KorsdaModel();

    $data = [
        'title'  => 'KORSDA',
        'korsda' => $model
            ->select('korsda.*, kecamatan.nama_kecamatan')
            ->join('kecamatan', 'kecamatan.id = korsda.kecamatan_id')
            ->where('korsda.status', 'Aktif')
            ->orderBy('kecamatan.nama_kecamatan', 'ASC')
            ->orderBy('korsda.nama', 'ASC')
            ->findAll(),
    ];

    return view('korsda', $data);
}

public function profil($id)
{
    $korsdaModel = new \App\Models\KorsdaModel();
    $profilModel = new \App\Models\ProfilKorsdaModel();

    $data['korsda'] = $korsdaModel->getById($id);

    if (!$data['korsda']) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $data['profil'] = $profilModel
        ->where('korsda_id', $id)
        ->first();

    return view('korsda/profil', $data);
}

public function kegiatan($id)
{
    $korsdaModel = new \App\Models\KorsdaModel();
    $kegiatanModel = new \App\Models\KegiatanKorsdaModel();

    $data['korsda'] = $korsdaModel
        ->select('korsda.*, kecamatan.nama_kecamatan')
        ->join('kecamatan', 'kecamatan.id = korsda.kecamatan_id')
        ->where('korsda.id', $id)
        ->first();

    $data['kegiatan'] = $kegiatanModel
        ->where('korsda_id', $id)
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

public function peta($id)
{
    $korsdaModel  = new \App\Models\KorsdaModel();
    $wilayahModel = new \App\Models\WilayahKerjaModel();

    $data['korsda'] = $korsdaModel
        ->select('korsda.*, kecamatan.nama_kecamatan')
        ->join('kecamatan', 'kecamatan.id = korsda.kecamatan_id')
        ->where('korsda.id', $id)
        ->first();

    $data['wilayah'] = $wilayahModel
        ->where('korsda_id', $id)
        ->findAll();

    return view('korsda/korsda_peta', $data);
}

public function korsdawilayah($id)
{
    $korsdaModel = new \App\Models\KorsdaModel();

    $data['korsda'] = $korsdaModel
    ->select('korsda.*, kecamatan.nama_kecamatan')
    ->join('kecamatan', 'kecamatan.id = korsda.kecamatan_id')
    ->where('korsda.kecamatan_id', $id)
    ->findAll();

    return view('korsda/korsdawilayah', $data);
}
}