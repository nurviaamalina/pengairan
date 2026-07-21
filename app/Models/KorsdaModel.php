<?php

namespace App\Models;

use CodeIgniter\Model;

class KorsdaModel extends Model
{
    protected $table            = 'korsda';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'kecamatan',
        'nama_koordinator',
        'no_hp',
        'alamat',
        'foto'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}