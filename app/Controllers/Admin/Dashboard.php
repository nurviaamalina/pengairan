<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KorsdaModel;
use App\Models\KecamatanModel;
use App\Models\WilayahKerjaModel;
use App\Models\BeritaModel;
use App\Models\KegiatanModel;

class Dashboard extends BaseController
{
    protected $korsdaModel;
    protected $kecamatanModel;
    protected $wilayahModel;
    protected $beritaModel;
    protected $kegiatanModel;

    public function __construct()
    {
        $this->korsdaModel     = new KorsdaModel();
        $this->kecamatanModel  = new KecamatanModel();
        $this->wilayahModel    = new WilayahKerjaModel();
        $this->beritaModel     = new BeritaModel();
        $this->kegiatanModel   = new KegiatanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin',

            // Data GIS
            'gis' => $this->wilayahModel
                ->select('wilayah.*, kecamatan.nama_kecamatan')
                ->join('korsda', 'korsda.id = wilayah.korsda_id')
                ->join('kecamatan', 'kecamatan.id = korsda.kecamatan_id')
                ->orderBy('kecamatan.nama_kecamatan', 'ASC')
                ->findAll(),

            // Data Kecamatan
            'kecamatan' => $this->kecamatanModel
                ->orderBy('nama_kecamatan', 'ASC')
                ->findAll(),

            // Data Korsda
            'korsda' => $this->korsdaModel
                ->orderBy('nama', 'ASC')
                ->findAll(),

            // Berita terbaru
            'berita' => $this->beritaModel
                ->orderBy('created_at', 'DESC')
                ->findAll(3),

            // Kegiatan terbaru
            'kegiatan' => $this->kegiatanModel
                ->orderBy('tanggal', 'DESC')
                ->findAll(3),

            // Statistik
            'jumlahKecamatan' => $this->kecamatanModel->countAllResults(),
            'jumlahKorsda'    => $this->korsdaModel->countAllResults(),
            'jumlahWilayah'   => $this->wilayahModel->countAllResults(),
            'jumlahBerita'    => $this->beritaModel->countAllResults(),
            'jumlahKegiatan'  => $this->kegiatanModel->countAllResults(),
        ];

        return view('admin/dashboard', $data);
    }
}