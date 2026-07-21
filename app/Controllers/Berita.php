<?php

namespace App\Controllers;

use App\Models\BeritaModel;

class Berita extends BaseController
{
    public function index()
    {
        return view('Berita/index');
    }

    public function detail()
    {
        return view('Berita/DetailBerita');
    }
}

