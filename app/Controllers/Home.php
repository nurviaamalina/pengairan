<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\KegiatanModel;

class Home extends BaseController
{
    protected $beritaModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
    }

   public function index()
{
      $kegiatanModel = new KegiatanModel();
    
    $data = [
        'berita' => $this->beritaModel->getBeritaTerbaru(4),
        'headlineKegiatan' => $kegiatanModel->getHeadline(),
        'tahunKegiatan' => $kegiatanModel->getTahunHomepage(),
    ];

    return view('home', $data);
}
}