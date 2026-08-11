<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\KegiatanModel;
use App\Models\KorsdaModel;
use App\Models\DokumenModel;
use App\Models\InstagramModel;

class Search extends BaseController
{
    public function index()
    {
        $keyword = trim($this->request->getGet('q'));

        $data = [
            'keyword' => $keyword,
            'berita' => [],
            'kegiatan' => [],
            'dokumen' => [],
            'korsda' => [],
            'instagram' => [],
        ];

        if ($keyword != '') {

            $data['berita'] = (new BeritaModel())
                ->like('judul', $keyword)
                ->orLike('isi', $keyword)
                ->findAll();

            $data['kegiatan'] = (new KegiatanModel())
                ->like('judul', $keyword)
                ->findAll();

            $data['dokumen'] = (new DokumenModel())
                ->like('judul', $keyword)
                ->orLike('deskripsi', $keyword)
                ->findAll();

            $data['korsda'] = (new KorsdaModel())
                ->like('nama_kecamatan', $keyword)
                ->orLike('nama', $keyword)
                ->findAll();

            $data['instagram'] = (new InstagramModel())
                ->like('caption', $keyword)
                ->findAll();
        }

        return view('search/index', $data);
    }
}