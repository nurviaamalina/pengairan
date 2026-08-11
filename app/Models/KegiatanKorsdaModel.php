<?php

namespace App\Models;

use CodeIgniter\Model;

class KegiatanKorsdaModel extends Model
{
    protected $table = 'kegiatankorsda';

    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'korsda_id',
        'judul',
        'gambar',
        'tanggal'
    ];
}