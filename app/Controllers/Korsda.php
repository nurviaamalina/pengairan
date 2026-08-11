<?php

namespace App\Controllers;

use App\Models\KecamatanModel;
use App\Models\KorsdaModel;
use App\Models\ProfilKorsdaModel;
use App\Models\KegiatanKorsdaModel;
use App\Models\WilayahKerjaModel;

class Korsda extends BaseController
{
    protected $kecamatanModel;
    protected $korsdaModel;
    protected $profilModel;
    protected $kegiatanModel;
    protected $wilayahModel;

    public function __construct()
    {
        $this->kecamatanModel = new KecamatanModel();
        $this->korsdaModel    = new KorsdaModel();
        $this->profilModel    = new ProfilKorsdaModel();
        $this->kegiatanModel  = new KegiatanKorsdaModel();
        $this->wilayahModel   = new WilayahKerjaModel();
    }


    /**
     * HALAMAN UTAMA KORSDA
     * /korsda
     *
     * Menampilkan seluruh data kecamatan
     */
    public function index()
    {
        $data = [
            'kecamatan' => $this->kecamatanModel
                ->orderBy('nama_kecamatan', 'ASC')
                ->findAll()
        ];

        return view('korsda', $data);
    }


    /**
     * PROFIL KORSDA
     * /korsda/profil/{id}
     *
     * ID yang digunakan adalah ID KORSDA
     */
    public function profil($id)
    {
        $data['korsda'] = $this->korsdaModel
            ->select('korsda.*, kecamatan.nama_kecamatan')
            ->join(
                'kecamatan',
                'kecamatan.id = korsda.kecamatan_id',
                'left'
            )
            ->where('korsda.id', $id)
            ->first();

        if (!$data['korsda']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data KORSDA tidak ditemukan.'
            );
        }

        $data['profil'] = $this->profilModel
            ->where('korsda_id', $id)
            ->first();

        return view('korsda/profil', $data);
    }


    /**
     * KEGIATAN KORSDA
     * /korsda/kegiatan/{id}
     */
    public function kegiatan($id)
    {
        $data['korsda'] = $this->korsdaModel
            ->select('korsda.*, kecamatan.nama_kecamatan')
            ->join(
                'kecamatan',
                'kecamatan.id = korsda.kecamatan_id',
                'left'
            )
            ->where('korsda.id', $id)
            ->first();

        if (!$data['korsda']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data KORSDA tidak ditemukan.'
            );
        }

        $data['kegiatan'] = $this->kegiatanModel
            ->where('korsda_id', $id)
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        return view('korsda/kegiatankorsda', $data);
    }


    /**
     * DETAIL KEGIATAN
     * /korsda/detail_kegiatan/{id}
     */
    public function detailKegiatan($id)
    {
        $data['kegiatan'] = $this->kegiatanModel->find($id);

        if (!$data['kegiatan']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data kegiatan tidak ditemukan.'
            );
        }

        return view('korsda/detail_kegiatan', $data);
    }


    /**
     * PETA WILAYAH KERJA
     * /korsda/peta/{id}
     */
    public function peta($id)
    {
        $data['korsda'] = $this->korsdaModel
            ->select('korsda.*, kecamatan.nama_kecamatan')
            ->join(
                'kecamatan',
                'kecamatan.id = korsda.kecamatan_id',
                'left'
            )
            ->where('korsda.id', $id)
            ->first();

        if (!$data['korsda']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data KORSDA tidak ditemukan.'
            );
        }

        $data['wilayah'] = $this->wilayahModel
            ->where('korsda_id', $id)
            ->findAll();

        return view('korsda/korsda_peta', $data);
    }


    /**
     * KORSDA BERDASARKAN KECAMATAN
     * /korsda/korsdawilayah/{id}
     *
     * ID = ID kecamatan
     */
    public function korsdawilayah($id)
    {
        $data['kecamatan'] = $this->kecamatanModel->find($id);

        if (!$data['kecamatan']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data kecamatan tidak ditemukan.'
            );
        }

        $data['korsda'] = $this->korsdaModel
            ->select('korsda.*, kecamatan.nama_kecamatan')
            ->join(
                'kecamatan',
                'kecamatan.id = korsda.kecamatan_id',
                'left'
            )
            ->where('korsda.kecamatan_id', $id)
            ->findAll();

        return view('korsda/korsdawilayah', $data);
    }
}