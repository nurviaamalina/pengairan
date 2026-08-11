<?php

namespace App\Models;

use CodeIgniter\Model;

class KorsdaModel extends Model
{
    protected $table = 'korsda';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'kecamatan_id',
        'nama_wilayah',
        'nama',
        'jabatan',
        'nip',
        'email',
        'no_hp',
        'alamat',
        'foto',
        'status'
    ];

    protected $useTimestamps = true;

    public function getKorsda()
{
    return $this->select('korsda.*, kecamatan.nama_kecamatan')
                ->join('kecamatan', 'kecamatan.id = korsda.kecamatan_id')
                ->findAll();
}

public function getById($id)
{
    return $this->select('korsda.*, kecamatan.nama_kecamatan')
                ->join('kecamatan', 'kecamatan.id = korsda.kecamatan_id')
                ->where('korsda.id', $id)
                ->first();
}
}