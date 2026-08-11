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

    public function search()
{
    $keyword = trim($this->request->getGet('keyword'));

    if (empty($keyword)) {
        return redirect()->to('/');
    }

    switch (strtolower($keyword)) {

    // Menu utama
    case 'beranda':
    case 'home':
        return redirect()->to('/');

    case 'dokumen':
        return redirect()->to('/dokumen');

    case 'berita':
        return redirect()->to('/berita');

    case 'kontak':
        return redirect()->to('/kontak');

    // PROFIL
    case 'profil':
        return redirect()->to('/tentang-kami');

    case 'visi misi':
    case 'visi':
    case 'misi':
        return redirect()->to('/tentang-kami#visi-misi');

    case 'struktur':
    case 'struktur organisasi':
        return redirect()->to('/tentang-kami#struktur-organisasi');

    // INOVASI
    case 'sekardadu':
        return redirect()->to('/sekardadu');

    case 'mawasdiri':
        return redirect()->to('/https://mawasdiri.dingkoding.com/home');

    case 'warm':
    case 'warm system':
        return redirect()->to('/warm-system');

    // LAYANAN
    case 'pengaduan':
        return redirect()->to('/pengaduan');

    case 'korsda':
        return redirect()->to('/korsda');

    case 'live cctv':
    case 'cctv':
        return redirect()->to('/live-cctv');
}

    // ===== KATEGORI DOKUMEN =====
    $kategoriModel = new KategoriDokumenModel();

    $kategori = $kategoriModel
        ->like('nama_kategori', $keyword)
        ->first();

    if ($kategori) {
        return redirect()->to('/dokumen/detail/' . $kategori['id']);
    }

    // ===== DOKUMEN =====
    $dokumenModel = new DokumenModel();

    $dokumen = $dokumenModel
        ->like('judul', $keyword)
        ->first();

    if ($dokumen) {
        return redirect()->to('/dokumen/detail/' . $dokumen['kategori_id']);
    }

    // ===== BERITA =====
    $berita = $this->beritaModel
        ->like('judul', $keyword)
        ->first();

    if ($berita) {
        return redirect()->to('/berita/detail/' . $berita['slug']);
    }

    return redirect()->back()->with('error', 'Data tidak ditemukan.');
}
}