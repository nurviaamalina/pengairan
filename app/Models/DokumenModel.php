<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenModel extends Model
{
    protected $table            = 'dokumen';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'kategori_id',
        'judul',
        'tahun',
        'file'
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getDokumen($id = false)
    {
        if ($id == false) {

            return $this->select('dokumen.*, kategori_dokumen.nama_kategori, kategori_dokumen.slug')
                        ->join('kategori_dokumen', 'kategori_dokumen.id = dokumen.kategori_id')
                        ->orderBy('dokumen.id', 'DESC')
                        ->findAll();
        }

        return $this->select('dokumen.*, kategori_dokumen.nama_kategori, kategori_dokumen.slug')
                    ->join('kategori_dokumen', 'kategori_dokumen.id = dokumen.kategori_id')
                    ->where('dokumen.id', $id)
                    ->first();
    }

    public function getByKategori($kategoriId)
    {
        return $this->where('kategori_id', $kategoriId)
                    ->orderBy('tahun', 'DESC')
                    ->findAll();
    }
}