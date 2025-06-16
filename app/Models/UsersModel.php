<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'tb_users';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'username',
        'password',
        'role'
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
    protected $validationRules = [
        'username' => 'required|min_length[4]|max_length[20]|is_unique[tb_users.username]',
        'password' => 'required|min_length[4]',
        'role'     => 'required|in_list[admin,user]'
    ];

    protected $validationMessages = [
        'username' => [
            'required'   => 'Username wajib diisi.',
            'min_length' => 'Username minimal 4 karakter.',
            'max_length' => 'Username maksimal 20 karakter.',
            'is_unique'  => 'Username sudah digunakan.'
        ],
        'password' => [
            'required'   => 'Password wajib diisi.',
            'min_length' => 'Password minimal 4 karakter.'
        ],
        'role' => [
            'required' => 'Role wajib dipilih.',
            'in_list'  => 'Role hanya boleh berisi admin atau user.'
        ]
    ];
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

    public function getUsersWithNamaSiswa()
    {
        return $this->db->table('tb_users')
            ->select('tb_users.id_user, tb_users.username, tb_siswa.nama')
            ->join('tb_siswa', 'tb_siswa.id_user = tb_users.id_user')
            ->orderBy('tb_users.id_user', 'ASC') // urutkan berdasarkan id_user
            ->get()
            ->getResultArray();
    }
}
