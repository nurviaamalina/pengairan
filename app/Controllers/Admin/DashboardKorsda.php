<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KorsdaModel;
use App\Models\ProfilKorsdaModel;
use App\Models\WilayahKerjaModel;
use App\Models\GisKorsdaModel;
use App\Models\KegiatanKorsdaModel;


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
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard KORSDA',

            // sementara
            'jumlahKorsda'   => $this->korsda->countAll(),
            'jumlahProfil'   => $this->ProfilKorsdaModel->countAllResults(),
            'jumlahWilayah'  => $this->WilayahKerjaModel->countAllResults(),
            'jumlahGis'      => $this->GisKorsdaModel->countAllResults(),
            'jumlahKegiatan' => $this->KegiatanKorsdaModel->countAllResults(),

            'korsdaTerbaru' => $this->korsda
                ->orderBy('id','DESC')
                ->findAll(5),
        ];

        return view('admin/korsda/dashboard',$data);
    }
}