<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $table            = 'pengaduan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama',
        'email',
        'nomor_telepon',
        'kategori',
        'judul',
        'deskripsi',
        'tracking_code',
        'status',
        'created_at',
        'updated_at',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getAll(): array
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    public function getPengaduanById(int $id): ?array
    {
        return $this->asArray()->find($id);
    }

    public function insertPengaduan(array $data): int
    {
        $this->protect(false);
        $insertId = $this->insert($data);
        $this->protect(true);

        return (int) $insertId;
    }

    public function updatePengaduan(int $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function deletePengaduan(int $id): bool
    {
        return $this->delete($id);
    }
}
