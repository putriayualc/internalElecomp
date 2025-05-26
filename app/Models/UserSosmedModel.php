<?php

namespace App\Models;

use CodeIgniter\Model;

class UserSosmedModel extends Model
{
    protected $table            = 'tb_user_sosmed';
    protected $primaryKey       = 'id_user_sosmed';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_sosmed',
        'id_user'
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

    public function getSosmedWithUserInfo()
    {
        return $this->db->table('tb_user_sosmed')
            ->select('
            tb_user_sosmed.id_sosmed,
            tb_user_sosmed.id_user,
            tb_siswa.nama,
            tb_siswa.foto
        ')
            ->join('tb_users', 'tb_users.id_user = tb_user_sosmed.id_user')
            ->join('tb_siswa', 'tb_siswa.id_user = tb_users.id_user ')
            ->get()
            ->getResultArray();
    }

    public function getSosmedIdsByUser($id_user)
    {
        $result = $this->select('id_sosmed')
            ->where('id_user', $id_user)
            ->get()
            ->getResultArray();

        return array_column($result, 'id_sosmed');
    }
}
