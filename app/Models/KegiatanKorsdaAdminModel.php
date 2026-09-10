<?php

namespace App\Models;

use CodeIgniter\Model;

class KegiatanKorsdaAdminModel extends Model
{
    protected $table = 'kegiatankorsda';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'korsda_id',
        'judul',
        'gambar',
        'tanggal',
        'isi'
    ];
}