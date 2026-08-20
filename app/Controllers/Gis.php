<?php

namespace App\Controllers;

use App\Models\WilayahKerjaModel;

class Gis extends BaseController
{
    protected $wilayahModel;

    public function __construct()
    {
        $this->wilayahModel = new WilayahKerjaModel();
    }

    public function index()
    {
        // =====================================================
        // DATA WILAYAH / GEOJSON
        // =====================================================

        $wilayah = $this->wilayahModel
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
            ->orderBy('kecamatan.nama_kecamatan', 'ASC')
            ->orderBy('korsda.nama_wilayah', 'ASC')
            ->findAll();


        // =====================================================
        // DATA KECAMATAN UNTUK FILTER
        // =====================================================

        $kecamatan = $this->wilayahModel
            ->select('
                kecamatan.id,
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
            ->where('kecamatan.id IS NOT NULL')
            ->groupBy([
                'kecamatan.id',
                'kecamatan.nama_kecamatan'
            ])
            ->orderBy('kecamatan.nama_kecamatan', 'ASC')
            ->findAll();


        // =====================================================
        // KIRIM KE VIEW
        // =====================================================

        $data = [
            'title'     => 'Infrastruktur Pengairan Banyuwangi',
            'wilayah'   => $wilayah,
            'kecamatan' => $kecamatan,
        ];

        return view('gis', $data);
    }
}