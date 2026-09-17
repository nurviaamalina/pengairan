<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilModel extends Model
{
    protected $table = 'profil_korsda';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'korsda_id',

        'struktur_organisasi',

    ];

    protected $useTimestamps = true;

    protected $useSoftDeletes = true;

    protected $deletedField = 'deleted_at';
}