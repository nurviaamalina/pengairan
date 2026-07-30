<?php

namespace App\Models;

use CodeIgniter\Model;

class KorsdaModel extends Model
{
    protected $table = 'korsda';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'nama_kecamatan',
        'ketua',
        'alamat',
        'telepon',
        'deskripsi',
        'gambar'
    ];
}

