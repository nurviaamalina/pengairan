<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\KegiatanModel;
use App\Models\WilayahKerjaModel;
use App\Models\KorsdaModel;
use App\Models\KecamatanModel;
use App\Models\InstagramModel;
use App\Models\KategoriDokumenModel;
use App\Models\DokumenModel;
use App\Models\KegiatanKorsdaAdminModel;

class Home extends BaseController
{
    protected $beritaModel;
    protected $wilayahModel;
    protected $korsdaModel;
    protected $kecamatanModel;

    protected $instagramModel;
    protected $dokumenModel;

    public function __construct()
    {
        $this->beritaModel    = new BeritaModel();
        $this->wilayahModel   = new WilayahKerjaModel();
        $this->korsdaModel    = new KorsdaModel();
        $this->kecamatanModel = new KecamatanModel();
        $this->instagramModel = new InstagramModel();
        $this->dokumenModel   = new DokumenModel();
    }

    public function index()
    {

        $kegiatanModel  = new KegiatanModel();


        $kegiatanModel = new KegiatanModel();

        $instagramModel = new InstagramModel();
        $kegiatanKorsdaModel = new KegiatanKorsdaAdminModel();

        $keyword = trim($this->request->getGet('q'));

        $data = [
            'keyword' => $keyword,

            // Berita
            'berita' => $this->beritaModel->getBeritaTerbaru(4),

            // Headline Kegiatan
            'headlineKegiatan' => $kegiatanModel->getHeadline(),

            // Tahun kegiatan
            'tahunKegiatan' => $kegiatanModel->getTahunHomepage(),

            'kegiatanKorsda' => $kegiatanKorsdaModel
        ->select('kegiatankorsda.*')
        ->join('korsda', 'korsda.id = kegiatankorsda.korsda_id', 'left')
        ->orderBy('kegiatankorsda.tanggal', 'DESC')
        ->findAll(4),
            // Data GIS
           'gis' => $this->wilayahModel
    ->select('
        wilayah.id,
        wilayah.korsda_id,
        wilayah.file_geojson,
        wilayah.keterangan,
        korsda.nama_wilayah,
        korsda.kecamatan_id,
        kecamatan.nama_kecamatan
    ')
    ->join(
        'korsda',
        'korsda.id = wilayah.korsda_id',
        'left'
    )
    ->join(
        'kecamatan',
        'kecamatan.id = korsda.kecamatan_id',
        'left'
    )
    ->where('wilayah.file_geojson IS NOT NULL')
    ->where('wilayah.file_geojson !=', '')
    ->orderBy(
        'kecamatan.nama_kecamatan',
        'ASC'
    )
    ->orderBy(
        'korsda.nama_wilayah',
        'ASC'
    )
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
        $keyword = trim($this->request->getGet('keyword') ?? $this->request->getGet('q') ?? '');

        if (empty($keyword)) {
            return redirect()->to(base_url('/'));
        }

        $keywordLower = strtolower($keyword);

        // =========================================================================
        // 1. PENCOCOKAN DENGAN MENU & RUTE SISTEM (Config/Routes.php)
        // =========================================================================
        switch ($keywordLower) {
            // Beranda
            case 'beranda':
            case 'home':
                return redirect()->to(base_url('/'));

            // Profil / Tentang Kami
            case 'profil':
            case 'profile':
            case 'tentang kami':
            case 'tentang-kami':
                return redirect()->to(base_url('tentang-kami'));

            case 'sejarah':
            case 'sejarah singkat':
                return redirect()->to(base_url('tentang-kami#sejarah-singkat'));

            case 'visi':
            case 'misi':
            case 'visi misi':
            case 'visi dan misi':
                return redirect()->to(base_url('tentang-kami#visi-misi'));

            case 'struktur':
            case 'struktur organisasi':
            case 'organisasi':
                return redirect()->to(base_url('tentang-kami#struktur-organisasi'));

            // Inovasi
            case 'sekardadu':
            case 'sekar dadu':
                return redirect()->to('https://sekardadu.dingkoding.com/home');

            case 'mawasdiri':
            case 'mawas diri':
                return redirect()->to('https://mawasdiri.dingkoding.com/home');

            case 'warm':
            case 'warm system':
            case 'warmsystem':
                return redirect()->to('https://pubwi.dingkoding.com/home');

            // Layanan
            case 'pengaduan':
            case 'lapor':
            case 'keluhan':
                return redirect()->to(base_url('pengaduan'));

            case 'lacak pengaduan':
            case 'track pengaduan':
            case 'lacak':
            case 'track':
            case 'tracking':
                return redirect()->to(base_url('pengaduan/track'));

            case 'korsda':
            case 'korwil':
            case 'wilayah kerja':
                return redirect()->to(base_url('korsda'));

            case 'live cctv':
            case 'cctv':
            case 'pantau sungai':
            case 'kamera':
                return redirect()->to('https://live.banyuwangikab.go.id/page/cctv?area=PANTAU%20SUNGAI');

            // Dokumen
            case 'dokumen':
            case 'dokumen resmi':
            case 'regulasi':
            case 'peraturan':
                return redirect()->to(base_url('dokumen'));

            // Berita
            case 'berita':
            case 'kabar':
            case 'artikel':
            case 'news':
                return redirect()->to(base_url('berita'));

            // Kegiatan
            case 'kegiatan':
            case 'agenda':
            case 'program':
                return redirect()->to(base_url('kegiatan'));

            // GIS
            case 'gis':
            case 'peta':
            case 'peta gis':
            case 'map':
            case 'maps':
                return redirect()->to(base_url('gis'));

            // Instagram
            case 'instagram':
            case 'sosmed':
            case 'media sosial':
                return redirect()->to(base_url('instagram'));

            // Kontak
            case 'kontak':
            case 'hubungi kami':
            case 'alamat':
            case 'telepon':
            case 'email':
                return redirect()->to(base_url('/#kontak'));

            // Login Admin
            case 'login':
            case 'admin':
            case 'masuk':
                return redirect()->to(base_url('login'));
        }

        // =========================================================================
        // 2. PENCARIAN DINAMIS DI DATABASE SESUAI RUTE YANG TERSEDIA
        // =========================================================================

        // A. Kategori Dokumen -> /dokumen/detail/(:num)
        $kategoriModel = new KategoriDokumenModel();
        $kategori = $kategoriModel
            ->like('nama_kategori', $keyword)
            ->first();

        if ($kategori) {
            return redirect()->to(base_url('dokumen/detail/' . $kategori['id']));
        }

        // B. Dokumen Spesifik -> /dokumen/detail/(:num)?keyword=...
        $dokumenModel = new DokumenModel();
        $dokumen = $dokumenModel
            ->like('judul', $keyword)
            ->first();

        if ($dokumen) {
            return redirect()->to(base_url('dokumen/detail/' . $dokumen['kategori_id'] . '?keyword=' . urlencode($keyword)));
        }

        // C. Berita -> /berita/(:segment)
        $berita = $this->beritaModel
            ->groupStart()
                ->like('judul', $keyword)
                ->orLike('isi', $keyword)
            ->groupEnd()
            ->first();

        if ($berita) {
            return redirect()->to(base_url('berita/' . $berita['slug']));
        }

        // D. Kegiatan -> /kegiatan/(:segment)
        $kegiatanModel = new \App\Models\KegiatanModel();
        $kegiatan = $kegiatanModel
            ->groupStart()
                ->like('judul', $keyword)
                ->orLike('deskripsi', $keyword)
            ->groupEnd()
            ->first();

        if ($kegiatan) {
            return redirect()->to(base_url('kegiatan/' . $kegiatan['slug']));
        }

        // E. Kecamatan (Korsda) -> /korsda/korsdawilayah/(:num)
        $kecamatanModel = new \App\Models\KecamatanModel();
        $kecamatan = $kecamatanModel
            ->like('nama_kecamatan', $keyword)
            ->first();

        if ($kecamatan) {
            return redirect()->to(base_url('korsda/korsdawilayah/' . $kecamatan['id']));
        }

        // F. Petugas Korsda / Wilayah Korsda -> /korsda/profil/(:num)
        $korsda = $this->korsdaModel
            ->groupStart()
                ->like('nama', $keyword)
                ->orLike('nama_wilayah', $keyword)
                ->orLike('jabatan', $keyword)
                ->orLike('alamat', $keyword)
            ->groupEnd()
            ->first();

        if ($korsda) {
            return redirect()->to(base_url('korsda/profil/' . $korsda['id']));
        }

        // =========================================================================
        // 3. JIKA TIDAK DITEMUKAN, KEMBALI KE BERANDA DENGAN NOTIFIKASI
        // =========================================================================
        return redirect()->to(base_url('/'))->with('error', 'Data tidak ditemukan untuk kata kunci: "' . esc($keyword) . '"');
    }
}