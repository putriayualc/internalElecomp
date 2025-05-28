<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelInternalModel extends Model
{
    protected $table            = 'tb_artikel_internal';
    protected $primaryKey       = 'id_artikel_internal';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_bisnis',
        'id_user',
        'judul_artikel',
        'tgl_upload',
        'link',
        'keyword'
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

    public function getArtikelWithRelations()
    {
        return $this->db->table('tb_artikel_internal')
            ->select('tb_artikel_internal.*, tb_bisnis.nama_bisnis, tb_users.username')
            ->join('tb_bisnis', 'tb_bisnis.id_bisnis = tb_artikel_internal.id_bisnis')
            ->join('tb_users', 'tb_users.id_user = tb_artikel_internal.id_user')
            ->get()
            ->getResultArray();
    }
}
