<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KorsdaModel;
use App\Models\ProfilKorsdaModel;
use App\Models\WilayahKerjaModel;
use App\Models\GisKorsdaModel;
use App\Models\KegiatanKorsdaModel;
use App\Models\KecamatanModel;
class DashboardKorsda extends BaseController
{
    protected $korsda;

    public function __construct()
    {
        $this->korsda = new KorsdaModel();
        $this->ProfilKorsdaModel = new ProfilKorsdaModel();
        $this->WilayahKerjaModel = new WilayahKerjaModel();
        $this->GisKorsdaModel = new GisKorsdaModel();
        $this->KegiatanKorsdaModel = new KegiatanKorsdaModel();
        $this->kecamatan = new KecamatanModel();
    }

    public function index()
{
    $data = [
        'title' => 'Dashboard KORSDA',

        'jumlahKorsda'   => $this->korsda->countAll(),
        'jumlahProfil'   => $this->ProfilKorsdaModel->countAllResults(),
        'jumlahWilayah'  => $this->WilayahKerjaModel->countAllResults(),
        'jumlahGis'      => $this->GisKorsdaModel->countAllResults(),
        'jumlahKegiatan' => $this->KegiatanKorsdaModel->countAllResults(),
        'jumlahKecamatan' => $this->kecamatan->countAll(),

        'korsdaTerbaru' => $this->korsda
            ->select('korsda.*, kecamatan.nama_kecamatan')
            ->join('kecamatan', 'kecamatan.id = korsda.kecamatan_id')
            ->orderBy('korsda.id', 'DESC')
            ->findAll(5),
    ];

    return view('admin/korsda/dashboard', $data);
}
    }
