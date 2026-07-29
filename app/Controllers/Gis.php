<?php

namespace App\Controllers;

use App\Models\WilayahKerjaModel;
use App\Models\KorsdaModel;

class Gis extends BaseController
{
    public function index()
    {
        $wilayahModel = new WilayahKerjaModel();
        $korsdaModel  = new KorsdaModel();

        // Semua titik wilayah kerja beserta nama kecamatan
        $data['gis'] = $wilayahModel
            ->select('wilayah_kerja.*, korsda.nama_kecamatan')
            ->join('korsda', 'korsda.id = wilayah_kerja.id_korsda')
            ->orderBy('korsda.nama_kecamatan', 'ASC')
            ->findAll();

        // Data untuk dropdown filter
        $data['kecamatan'] = $korsdaModel
            ->orderBy('nama_kecamatan', 'ASC')
            ->findAll();

        return view('gis', $data);
    }
}