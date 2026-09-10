<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoKegiatanKorsdaModel extends Model
{
    protected $table         = 'foto_kegiatan_korsda';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = false;

    protected $allowedFields = [
        'kegiatan_korsda_id',
        'foto',
        'created_at',
    ];

    /**
     * Mengambil semua foto dokumentasi
     * berdasarkan ID kegiatan KORSDA.
     */
    public function getFotoByKegiatan($kegiatanKorsdaId)
    {
        return $this->where(
            'kegiatan_korsda_id',
            $kegiatanKorsdaId
        )
        ->orderBy('id', 'ASC')
        ->findAll();
    }

    /**
     * Mengambil satu foto berdasarkan ID foto.
     */
    public function getFoto($id)
    {
        return $this->where('id', $id)->first();
    }

    /**
     * Menghapus satu foto berdasarkan ID foto.
     */
    public function deleteFoto($id)
    {
        return $this->delete($id);
    }

    /**
     * Menghapus seluruh record foto
     * berdasarkan ID kegiatan KORSDA.
     */
    public function deleteByKegiatan($kegiatanKorsdaId)
    {
        return $this->where(
            'kegiatan_korsda_id',
            $kegiatanKorsdaId
        )->delete();
    }
}