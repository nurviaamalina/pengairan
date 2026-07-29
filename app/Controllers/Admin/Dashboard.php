<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KorsdaModel;
use App\Models\WilayahKerjaModel;
use App\Models\BeritaModel;
use App\Models\KegiatanModel;

class Dashboard extends BaseController
{
    protected $korsdaModel;
    protected $wilayahModel;
    protected $beritaModel;
    protected $kegiatanModel;

    public function __construct()
    {
        $this->korsdaModel  = new KorsdaModel();
        $this->wilayahModel = new WilayahKerjaModel();
        $this->beritaModel   = new BeritaModel();
        $this->kegiatanModel = new KegiatanModel();
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
                
                 
            'berita' => $this->beritaModel
                ->orderBy('created_at', 'DESC')
                ->findAll(3),

        
            'kegiatan' => $this->kegiatanModel
                ->orderBy('tanggal', 'DESC')
                ->findAll(3),
        ];

        return view('admin/dashboard', $data);
    }
}