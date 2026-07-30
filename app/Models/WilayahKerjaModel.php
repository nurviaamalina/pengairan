<?php

namespace App\Models;

use CodeIgniter\Model;

class WilayahKerjaModel extends Model
{
    protected $table = 'wilayah_kerja';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'id_korsda',
        'nama_lokasi',
        'latitude',
        'longitude',
        'zoom',
        'keterangan'
    ];

    protected $useTimestamps = true;
}