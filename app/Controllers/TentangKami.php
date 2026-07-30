<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminProfilModel;

class TentangKami extends BaseController
{
    protected $AdminProfilModel;
    
    public function __construct()
    {
        $this->AdminProfilModel = new AdminProfilModel();
    }
    
    public function index()
    {
        // Ambil data profil dari database
        $profil = $this->AdminProfilModel->first();
        
        $data = [
            'profil' => $profil
        ];
        
        return view('TentangKami/index', $data);
    }
}