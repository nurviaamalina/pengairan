<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table = 'berita';

    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';

    protected $useSoftDeletes = false;

    protected $protectFields = true;

    protected $allowedFields = [
        'judul',
        'slug',
        'isi',
        'gambar',
        'publikator',
        'views'
    ];

    protected bool $allowEmptyInserts = false;

    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;

    protected $dateFormat = 'datetime';

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';
    
        // Ambil semua berita terbaru
    public function getBerita()
{
    return $this->orderBy('created_at', 'DESC')->findAll();
}

    // Ambil berita berdasarkan slug
    public function getBeritaBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    // Ambil 3 berita terbaru untuk landing page
    public function getBeritaTerbaru($limit = 4)
{
    return $this->orderBy('created_at', 'DESC')
                ->findAll($limit);
}
}
