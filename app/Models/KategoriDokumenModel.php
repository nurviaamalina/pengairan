<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriDokumenModel extends Model
{
    protected $table            = 'kategori_dokumen';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'nama_kategori',
        'slug'
    ];

    protected $useTimestamps = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getKategori($id = false)
    {
        if ($id == false) {
            return $this->orderBy('nama_kategori', 'ASC')->findAll();
        }

        return $this->where('id', $id)->first();
    }

    public function getSlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }
}