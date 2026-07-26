<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InstagramModel;

class Instagram extends BaseController
{
    protected $instagramModel;

    public function __construct()
    {
        $this->instagramModel = new InstagramModel();
    }

    public function index()
    {
        $data = [

            'title' => 'Instagram',

            'instagram' => $this->instagramModel
                ->orderBy('tanggal_post', 'DESC')
                ->paginate(12),

            'pager' => $this->instagramModel->pager

        ];

        return view('instagram/index', $data);
    }
}