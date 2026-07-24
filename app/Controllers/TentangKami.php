<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TentangKami extends BaseController
{
    public function index()
    {
        return view('TentangKami/index');
    }
}
