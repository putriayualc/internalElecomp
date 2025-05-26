<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailModel extends Model
{
    protected $table            = 'tb_email';
    protected $primaryKey       = 'id_email';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'email',
        'password',
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
    protected $validationRules = [
        'id_email' => 'permit_empty',
        'email'    => 'required|valid_email',
        'password' => 'required|min_length[4]',
        'id_user'  => 'required|is_natural_no_zero',
    ];

    // Pesan error kustom
    protected $validationMessages = [
        'email' => [
            'required'    => 'Email tidak boleh kosong',
            'valid_email' => 'Format email tidak valid',
        ],
        'password' => [
            'required'    => 'Password tidak boleh kosong',
            'min_length'  => 'Password minimal 4 karakter'
        ],
        'id_user' => [
            'required'           => 'User wajib diisi',
            'is_natural_no_zero' => 'User tidak valid'
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

    // Method untuk mengambil email, username, dan nama
    public function getEmailUserWithNama($id_user = null)
    {
        $builder = $this->db->table('tb_email')
            ->select('tb_email.id_email, tb_email.email, tb_email.password, tb_users.id_user, COALESCE(tb_siswa.nama, tb_users.username) AS nama_user')
            ->join('tb_users', 'tb_users.id_user = tb_email.id_user', 'left')
            ->join('tb_siswa', 'tb_siswa.id_user = tb_users.id_user', 'left')
            ->orderBy('tb_email.id_email', 'ASC');

        if ($id_user !== null) {
            $builder->where('tb_email.id_user', $id_user);
        }

        return $builder->get()->getResultArray();
    }

    public function getOneEmailUserWithNama($id_email)
    {
        return $this->db->table('tb_email')
            ->select('tb_email.id_email, tb_email.email, tb_email.password, tb_users.id_user, COALESCE(tb_siswa.nama, tb_users.username) AS nama_user')
            ->join('tb_users', 'tb_users.id_user = tb_email.id_user', 'left')
            ->join('tb_siswa', 'tb_siswa.id_user = tb_users.id_user', 'left')
            ->where('tb_email.id_email', $id_email)
            ->get()
            ->getRowArray();
    }
}
