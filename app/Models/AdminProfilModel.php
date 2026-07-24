<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminProfilModel extends Model
{
    protected $table = 'profil_dinas';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'sejarah',
        'visi',
        'misi',
        'deskripsi_struktur',
        'struktur'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}