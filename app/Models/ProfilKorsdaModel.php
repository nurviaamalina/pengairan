<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilKorsdaModel extends Model
{
    protected $table = 'profil_korsda';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'struktur'
    ];

    protected $returnType = 'array';
}