<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\KegiatanModel;
use App\Models\InstagramModel;  

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
           $instagramModel = new InstagramModel();  
    
    $data = [
        'berita' => $this->beritaModel->getBeritaTerbaru(4),
        'headlineKegiatan' => $kegiatanModel->getHeadline(),
        'tahunKegiatan' => $kegiatanModel->getTahunHomepage(),

            'instagram'         => $instagramModel
                                    ->orderBy('tanggal_post', 'DESC')
                                    ->findAll(3),
    ];


    return view('home', $data);
}
}