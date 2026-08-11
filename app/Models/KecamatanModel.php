<?php

namespace App\Models;

use CodeIgniter\Model;

class KecamatanModel extends Model
{
    protected $table            = 'kecamatan';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';

    protected $allowedFields = [
        'nama_kecamatan'
    ];

    protected $useTimestamps = false;
}