<?php

namespace App\Models;

use CodeIgniter\Model;

class GisKorsdaModel extends Model
{
    protected $table = 'gis_korsda';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'nama',
        'kategori',
        'kecamatan',
        'latitude',
        'longitude',
        'deskripsi'
    ];
}