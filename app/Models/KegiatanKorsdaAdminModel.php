<?php

namespace App\Models;

use CodeIgniter\Model;

class KegiatanKorsdaAdminModel extends Model
{
    protected $table = 'kegiatankorsda';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'id_korsda',
        'judul',
        'gambar',
        'tanggal',
        'isi'
    ];
}