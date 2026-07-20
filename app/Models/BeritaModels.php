<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModels extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'judul',
        'slug',
        'isi',
        'gambar',
        'tanggal'
    ];
}