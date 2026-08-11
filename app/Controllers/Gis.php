<?php

namespace App\Controllers;

use App\Models\WilayahKerjaModel;
use App\Models\KorsdaModel;
use App\Models\KecamatanModel;

class Gis extends BaseController
{
    public function index()
    {
        $wilayahModel = new WilayahKerjaModel();
        $korsdaModel  = new KorsdaModel();
        $kecamatanModel = new KecamatanModel();
        // Semua titik wilayah kerja beserta nama kecamatan
       $data['gis'] = $wilayahModel
    ->select('wilayah.*, kecamatan.nama_kecamatan')
    ->join('korsda', 'korsda.id = wilayah.korsda_id')
    ->join('kecamatan', 'kecamatan.id = korsda.kecamatan_id')
    ->orderBy('kecamatan.nama_kecamatan', 'ASC')
    ->findAll();
        // Data untuk dropdown filter
       $data['kecamatan'] = $kecamatanModel
    ->orderBy('nama_kecamatan', 'ASC')
    ->findAll();

        return view('gis', $data);
    }
}