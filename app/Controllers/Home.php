<?php

namespace App\Controllers;

use App\Models\BeritaModel;

class Home extends BaseController
{
    protected $beritaModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
    }

   public function index()
{
    $data = [
        'berita' => $this->beritaModel->getBeritaTerbaru(4)
    ];

    return view('home', $data);
}
}