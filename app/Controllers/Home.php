<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['berita'] = [
            [
                'gambar' => 'berita1.jpg',
                'tanggal' => '12 Juli 2024',
                'judul' => 'Dinas Pengairan Kabupaten Banyuwangi Perkuat Transformasi Digital Melalui Pengembangan Website Terintegrasi'
            ],
            [
                'gambar' => 'berita2.jpg',
                'tanggal' => '12 Juli 2024',
                'judul' => 'Dinas Pengairan Kabupaten Banyuwangi Perkuat Transformasi Digital Melalui Pengembangan Website Terintegrasi'
            ]
        ];

        return view('home', $data);
    }
}