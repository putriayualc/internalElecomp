<?php

namespace App\Models;

use CodeIgniter\Model;

class SosmedModel extends Model
{
    protected $table            = 'tb_sosmed';
    protected $primaryKey       = 'id_sosmed';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_bisnis',
        'username',
        'platform',
        'updated_at',
        'status'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
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

    public function getSosmedWithJumlahKonten($id_bisnis = null)
    {
        $builder = $this->select('tb_sosmed.*, COUNT(tb_konten_sosmed.id_konten_sosmed) as jumlah_konten')
            ->join('tb_konten_sosmed', 'tb_konten_sosmed.id_sosmed = tb_sosmed.id_sosmed', 'left')
            ->groupBy('tb_sosmed.id_sosmed');

        if (!empty($id_bisnis)) {
            $builder->where('tb_sosmed.id_bisnis', $id_bisnis);
        }

        return $builder->findAll();
    }
}
