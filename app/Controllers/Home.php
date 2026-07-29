<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\KegiatanModel;
use App\Models\WilayahKerjaModel;
use App\Models\KorsdaModel;
use App\Models\InstagramModel;

class Home extends BaseController
{
    protected $beritaModel;
    protected $wilayahModel;
    protected $korsdaModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
        $this->wilayahModel = new WilayahKerjaModel();
        $this->korsdaModel = new KorsdaModel();
    }

    public function index()
    {
        $kegiatanModel = new KegiatanModel();
        $instagramModel = new InstagramModel();

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

            'instagram' => $instagramModel
                ->orderBy('tanggal_post', 'DESC')
                ->findAll(3),
        ];

        return view('home', $data);
    }
}