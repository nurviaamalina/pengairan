<?php

namespace App\Models;

use CodeIgniter\Model;

class KegiatanKorsdaModel extends Model
{
    protected $table = 'kegiatankorsda';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_korsda',
        'judul',
        'gambar',
        'tanggal'
    ];
}