<?php

namespace App\Models;

use CodeIgniter\Model;

class KontenModel extends Model
{
    protected $table            = 'tb_konten';
    protected $primaryKey       = 'id_konten';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'judul',
        'caption',
        'cover',
        'tgl_upload'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation Rules
    protected $validationRules = [
        'judul'   => 'required|min_length[3]|max_length[255]',
        'caption' => 'required',
        'cover'   => 'permit_empty',
        'tgl_upload' => 'required'
    ];

    protected $validationMessages = [
        'judul' => [
            'required'    => 'Judul konten wajib diisi.',
            'min_length'  => 'Judul konten minimal 3 karakter.',
            'max_length'  => 'Judul konten maksimal 255 karakter.'
        ],
        'caption' => [
            'required'    => 'Caption wajib diisi.',
        ],
        'tgl_upload' => [
            'required'    => 'Tanggal wajib diisi.',
        ],
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

    public function getKontenWithPlatforms($id_bisnis = null)
    {
        $builder = $this->db->table('tb_konten')
            ->select('
            tb_konten.id_konten,
            tb_konten.judul,
            tb_konten.caption,
            tb_konten.cover,
            tb_konten.tgl_upload,
            MIN(tb_bisnis.nama_bisnis) as nama_bisnis,
            GROUP_CONCAT(tb_sosmed.platform) as platforms,
            GROUP_CONCAT(tb_sosmed.username) as akun_platform,
            GROUP_CONCAT(tb_konten_sosmed.id_sosmed) as id_sosmed,
        ')
            ->join('tb_konten_sosmed', 'tb_konten_sosmed.id_konten = tb_konten.id_konten')
            ->join('tb_sosmed', 'tb_sosmed.id_sosmed = tb_konten_sosmed.id_sosmed')
            ->join('tb_bisnis', 'tb_sosmed.id_bisnis = tb_bisnis.id_bisnis');

        if ($id_bisnis) {
            $builder->where('tb_sosmed.id_bisnis', $id_bisnis);
        }

        return $builder->groupBy('tb_konten.id_konten')
            ->orderBy('tgl_upload', 'DESC')
            ->get()
            ->getResultArray();
    }
}
