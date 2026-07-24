<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilModel extends Model
{
    protected $table = 'profil_korsda';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_korsda',
        'visi',
        'misi',
        'tugas',
        'struktur',
        'gambar'
    ];

    protected $useTimestamps = true;
}