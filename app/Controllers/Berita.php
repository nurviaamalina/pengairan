<?php

namespace App\Controllers;
use App\Models\BeritaModel;

class Berita extends BaseController
{
    protected $beritaModel;

    public function __construct()
{
    $this->beritaModel = new BeritaModel();
}

   public function index()
{
    $data = [
        'title'  => 'Berita',
        'berita' => $this->beritaModel
                            ->orderBy('created_at', 'DESC')
                            ->findAll()
    ];

    return view('Berita/index', $data);
}
   public function detail($slug)
{
    // Ambil berita berdasarkan slug
    $berita = $this->beritaModel->getBeritaBySlug($slug);

    // Jika berita tidak ditemukan
    if (!$berita) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    // Tambah jumlah views
    $this->beritaModel->update($berita['id'], [
        'views' => $berita['views'] + 1
    ]);

    // Kirim data ke view
    $data = [
        'title'   => $berita['judul'],
        'berita'  => $berita
    ];

    return view('Berita/DetailBerita', $data);
}
    
    

}

