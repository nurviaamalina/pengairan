<?php

namespace App\Models;

use CodeIgniter\Model;

class WilayahKerjaModel extends Model
{
    protected $table      = 'wilayah';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'korsda_id',
        'file_peta',
        'file_geojson',
        'keterangan',
    ];

    protected $useTimestamps  = true;
    protected $useSoftDeletes = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField  = 'deleted_at';
}