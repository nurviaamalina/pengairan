<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\KegiatanModel;
use App\Models\WilayahKerjaModel;
use App\Models\KorsdaModel;

class Home extends BaseController
{
    protected $beritaModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
        $this->wilayahModel = new WilayahKerjaModel();
        $this->korsdaModel = new KorsdaModel();
    }

   public function index()
{
      $kegiatanModel = new KegiatanModel();
    
    $data = [
        'berita' => $this->beritaModel->getBeritaTerbaru(4),
        'headlineKegiatan' => $kegiatanModel->getHeadline(),
        'tahunKegiatan' => $kegiatanModel->getTahunHomepage(),

    'gis' => $this->wilayahModel
                ->select('wilayah_kerja.*, korsda.nama_kecamatan')
                ->join('korsda', 'korsda.id = wilayah_kerja.id_korsda')
                ->orderBy('korsda.nama_kecamatan', 'ASC')
                ->findAll(),

            'kecamatan' => $this->korsdaModel
                ->orderBy('nama_kecamatan', 'ASC')
                ->findAll(),
    ];

    return view('home', $data);
}
}