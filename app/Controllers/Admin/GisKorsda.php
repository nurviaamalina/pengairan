<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Models\GisModel;

class GisKorsda extends BaseController
{
    public function index()
    {
        $gisModel = new GisModel();

        $data['gis'] = $gisModel->findAll();

        return view('gis/index', $data);
    }
}