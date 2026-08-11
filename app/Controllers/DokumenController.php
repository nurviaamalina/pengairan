<?php

namespace App\Controllers;

use App\Models\KategoriDokumenModel;
use App\Models\DokumenModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class DokumenController extends BaseController
{
    protected $kategori;
    protected $dokumen;

    public function __construct()
    {
        $this->kategori = new KategoriDokumenModel();
        $this->dokumen  = new DokumenModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $kategoriDipilih = $this->request->getGet('kategori');
        $tahunDipilih = $this->request->getGet('tahun');

        // Semua kategori untuk dropdown
        $allKategori = $this->kategori->findAll();

        // Query dokumen
        $builder = $this->dokumen;

        if (!empty($keyword)) {
            $builder->like('judul', $keyword);
        }

        if (!empty($kategoriDipilih)) {
            $builder->where('kategori_id', $kategoriDipilih);
        }

        if (!empty($tahunDipilih)) {
            $builder->where('tahun', $tahunDipilih);
        }

        $dokumen = $builder->findAll();

        // Card kategori
        if ($keyword || $kategoriDipilih || $tahunDipilih) {

            $ids = array_unique(array_column($dokumen, 'kategori_id'));

            $kategoriCard = [];

            foreach ($ids as $id) {

                $kat = $this->kategori->find($id);

                if ($kat) {
                    $kategoriCard[] = $kat;
                }
            }

        } else {

            $kategoriCard = $allKategori;

        }

        $tahunList = $this->dokumen
            ->select('tahun')
            ->distinct()
            ->orderBy('tahun', 'DESC')
            ->findAll();

        return view('dokumen/index', [
            'title' => 'Dokumen Resmi',

            // card
            'kategoriCard' => $kategoriCard,

            // dropdown
            'allKategori' => $allKategori,

            'tahunList' => $tahunList,

            'keyword' => $keyword,
            'kategoriDipilih' => $kategoriDipilih,
            'tahunDipilih' => $tahunDipilih
        ]);
    }

    public function detail($id)
{
    $keyword = $this->request->getGet('keyword');
    $kategoriDipilih = $this->request->getGet('kategori');
    $tahunDipilih = $this->request->getGet('tahun');

    // Jika memilih kategori lain, gunakan kategori tersebut
    if (!empty($kategoriDipilih)) {
        $id = $kategoriDipilih;
    }

    $kategori = $this->kategori->find($id);

    if (!$kategori) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $builder = $this->dokumen->where('kategori_id', $id);

    if (!empty($keyword)) {
        $builder->like('judul', $keyword);
    }

    if (!empty($tahunDipilih)) {
        $builder->where('tahun', $tahunDipilih);
    }

    $data = [
        'title' => 'Detail Dokumen',
        'kategori' => $kategori,
        'dokumen' => $builder->findAll(),

        // dropdown kategori
        'allKategori' => $this->kategori->findAll(),

        // dropdown tahun
        'tahunList' => $this->dokumen
            ->select('tahun')
            ->distinct()
            ->orderBy('tahun', 'DESC')
            ->findAll(),

        'keyword' => $keyword,
        'kategoriDipilih' => $id,
        'tahunDipilih' => $tahunDipilih
    ];

    return view('dokumen/detail', $data);
}

    public function download($id)
    {
        $file = $this->dokumen->find($id);

        if (!$file) {
            throw PageNotFoundException::forPageNotFound();
        }

        $path = FCPATH . 'uploads/dokumen/' . $file['file'];

        if (!file_exists($path)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return $this->response->download($path, null);
    }
}