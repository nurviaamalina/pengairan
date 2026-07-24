<?php

namespace App\Controllers;

use App\Models\KegiatanModel;
use App\Models\FotoKegiatanModel;

class Kegiatan extends BaseController
{
    protected $kegiatanModel;
    protected $fotoModel;

    public function __construct()
    {
        $this->kegiatanModel = new KegiatanModel();
        $this->fotoModel = new FotoKegiatanModel();
    }

    public function index()
{
    $model = new \App\Models\KegiatanModel();

    $data = [
        'title' => 'Kegiatan',
        'headline' => $model->getHeadline(),
        'tahun' => $model->getTahun(),
    ];

    return view('Kegiatan/Index', $data);
}

   public function tahun($tahun)
{
    $data = [
        'title'     => 'Kegiatan Tahun '.$tahun,
        'tahun'     => $tahun,
        'kegiatan'  => $this->kegiatanModel->getByTahun($tahun),
    ];

    return view('kegiatan/tahun', $data);
}

    public function detail($slug)
    {
        $kegiatan = $this->kegiatanModel->getBySlug($slug);

        if (!$kegiatan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => $kegiatan['judul'],
            'kegiatan' => $kegiatan,
            'foto' => $this->fotoModel->getFotoByKegiatan($kegiatan['id']),
        ];

        return view('kegiatan/DetailKegiatan', $data);
    }
}