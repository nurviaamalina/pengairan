<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KorsdaModel;

class DashboardKorsda extends BaseController
{
    protected $korsda;

    public function __construct()
    {
        $this->korsda = new KorsdaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard KORSDA',

            // sementara
            'jumlahKorsda' => $this->korsda->countAll(),
            'jumlahProfil' => 0,
            'jumlahWilayah' => 0,
            'jumlahGis' => 0,
            'jumlahKecamatan' => 25,

            'korsdaTerbaru' => $this->korsda
                ->orderBy('id','DESC')
                ->findAll(5),
        ];

        return view('admin/korsda/dashboard',$data);
    }
}