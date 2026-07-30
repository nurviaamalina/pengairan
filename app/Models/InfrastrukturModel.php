<?php

namespace App\Models;

use CodeIgniter\Model;

class InfrastrukturModel extends Model
{
    protected $table = 'infrastruktur';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'id_korsda',
        'nama',
        'kategori',
        'latitude',
        'longitude',
        'keterangan'
    ];
}