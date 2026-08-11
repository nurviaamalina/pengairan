<?php

namespace App\Controllers;

use App\Models\KecamatanModel;

class Kecamatan extends BaseController
{
    public function index()
    {
        $kecamatanModel = new KecamatanModel();

        $data['kecamatan'] = $kecamatanModel
            ->orderBy('nama_kecamatan', 'ASC')
            ->findAll();

        return view('korsda', $data);
    }
}