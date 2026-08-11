<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\KegiatanModel;
use App\Models\WilayahKerjaModel;
use App\Models\KorsdaModel;
use App\Models\KecamatanModel;
use App\Models\InstagramModel;

class Home extends BaseController
{
    protected $beritaModel;
    protected $wilayahModel;
    protected $korsdaModel;
    protected $kecamatanModel;

    public function __construct()
    {
        $this->beritaModel    = new BeritaModel();
        $this->wilayahModel   = new WilayahKerjaModel();
        $this->korsdaModel    = new KorsdaModel();
        $this->kecamatanModel = new KecamatanModel();
    }

    public function index()
    {

        $kegiatanModel  = new KegiatanModel();


        $kegiatanModel = new KegiatanModel();

        $instagramModel = new InstagramModel();

        $keyword = trim($this->request->getGet('q'));

        $data = [
            'keyword' => $keyword,

            // Berita
            'berita' => $this->beritaModel->getBeritaTerbaru(4),

            // Headline Kegiatan
            'headlineKegiatan' => $kegiatanModel->getHeadline(),

            // Tahun kegiatan
            'tahunKegiatan' => $kegiatanModel->getTahunHomepage(),

            // Data GIS
            'gis' => $this->wilayahModel
                ->select('wilayah.*, kecamatan.nama_kecamatan')
                ->join('korsda', 'korsda.id = wilayah.korsda_id')
                ->join('kecamatan', 'kecamatan.id = korsda.kecamatan_id')
                ->orderBy('kecamatan.nama_kecamatan', 'ASC')
                ->findAll(),

            // Dropdown Kecamatan
            'kecamatan' => $this->kecamatanModel
                ->orderBy('nama_kecamatan', 'ASC')
                ->findAll(),

            // Instagram
            'instagram' => $instagramModel
                ->orderBy('tanggal_post', 'DESC')
                ->findAll(3),

            // Hasil pencarian
            'searchBerita'     => [],
            'searchKegiatan'   => [],
            'searchKorsda'     => [],
            'searchInstagram'  => [],
        ];

        if (!empty($keyword)) {

            $data['searchBerita'] = $this->beritaModel
                ->groupStart()
                    ->like('judul', $keyword)
                    ->orLike('isi', $keyword)
                ->groupEnd()
                ->findAll();

            $data['searchKegiatan'] = $kegiatanModel
                ->like('judul', $keyword)
                ->findAll();

            $data['searchKorsda'] = $this->korsdaModel
                ->groupStart()
                    ->like('nama', $keyword)
                    ->orLike('jabatan', $keyword)
                    ->orLike('alamat', $keyword)
                    ->orLike('nip', $keyword)
                ->groupEnd()
                ->findAll();

            $data['searchInstagram'] = $instagramModel
                ->like('caption', $keyword)
                ->findAll();
        }

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