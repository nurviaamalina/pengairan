<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KorsdaModel;
use App\Models\WilayahKerjaModel;

class Dashboard extends BaseController
{
    protected $korsdaModel;
    protected $wilayahModel;

    public function __construct()
    {
        $this->korsdaModel  = new KorsdaModel();
        $this->wilayahModel = new WilayahKerjaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin',

            'gis' => $this->wilayahModel
                ->select('wilayah_kerja.*, korsda.nama_kecamatan')
                ->join('korsda', 'korsda.id = wilayah_kerja.id_korsda')
                ->orderBy('korsda.nama_kecamatan', 'ASC')
                ->findAll(),

            'kecamatan' => $this->korsdaModel
                ->orderBy('nama_kecamatan', 'ASC')
                ->findAll(),
        ];

        return view('admin/dashboard', $data);
    }
}