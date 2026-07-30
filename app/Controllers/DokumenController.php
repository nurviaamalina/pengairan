<?php

namespace App\Controllers;

use App\Models\KategoriDokumenModel;
use App\Models\DokumenModel;

class DokumenController extends BaseController
{
    protected $kategori;
    protected $dokumen;

    public function __construct()
    {
        $this->kategori = new KategoriDokumenModel();
        $this->dokumen = new DokumenModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dokumen Resmi',
            'kategori' => $this->kategori->findAll()
        ];

        return view('dokumen/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Dokumen',
            'kategori' => $this->kategori->find($id),
            'dokumen' => $this->dokumen
                ->where('kategori_id', $id)
                ->findAll()
        ];

        return view('dokumen/detail', $data);
    }

    public function download($id)
    {
        $file = $this->dokumen->find($id);

        return $this->response->download(
            FCPATH . 'uploads/dokumen/' . $file['file'],
            null
        );
    }
}