<?php

namespace App\Admin\Controllers;
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