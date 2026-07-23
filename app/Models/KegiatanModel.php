<?php

namespace App\Models;

use CodeIgniter\Model;

class KegiatanModel extends Model
{
    protected $table            = 'kegiatan';

    protected $primaryKey       = 'id';

    protected $returnType       = 'array';

    protected $useAutoIncrement = true;

    protected $useTimestamps    = true;

    protected $allowedFields = [
        'judul',
        'slug',
        'deskripsi',
        'thumbnail',
        'tanggal',
        'tahun'
    ];

        public function getHeadline()
{
    return $this->orderBy('tanggal', 'DESC')
                ->first();
}

public function getTahun()
{
    $tahun = $this->select('tahun')
                  ->distinct()
                  ->orderBy('tahun', 'DESC')
                  ->findAll();

    $hasil = [];

    foreach ($tahun as $row) {

        $kegiatan = $this->where('tahun', $row['tahun'])
                         ->orderBy('tanggal', 'DESC')
                         ->first();

        if ($kegiatan) {
            $hasil[] = $kegiatan;
        }

    }

    return $hasil;
}

public function getByTahun($tahun)
{
    return $this->where('tahun', $tahun)
                ->orderBy('tanggal', 'DESC')
                ->findAll();
}

public function getBySlug($slug)
{
    return $this->where('slug', $slug)
                ->first();
}

public function getTahunHomepage()
{
    return $this->getTahun();
}
}