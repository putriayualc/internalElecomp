<?php

namespace App\Models;

use CodeIgniter\Model;

class KontenSosmedModel extends Model
{
    protected $table            = 'tb_konten_sosmed';
    protected $primaryKey       = 'id_konten_sosmed';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_sosmed',
        'id_konten',
        'tgl_upload'
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

    // Ambil id_sosmed dan id_bisnis yang terhubung dengan konten tertentu
    public function getSosmedByKonten($id_konten)
    {
        return $this->db->table('tb_konten_sosmed')
            ->select('tb_konten_sosmed.id_sosmed, tb_sosmed.id_bisnis')
            ->join('tb_sosmed', 'tb_sosmed.id_sosmed = tb_konten_sosmed.id_sosmed')
            ->where('tb_konten_sosmed.id_konten', $id_konten)
            ->get()
            ->getResultArray();
    }

    // Hapus relasi sosmed
    public function deleteSosmedRelation($id_konten)
    {
        return $this->db->table('tb_konten_sosmed')
            ->where('id_konten', $id_konten)
            ->delete();
    }

    // Tambah relasi sosmed
    public function insertSosmedRelation($id_konten, $id_sosmed)
    {
        return $this->db->table('tb_konten_sosmed')->insert([
            'id_konten' => $id_konten,
            'id_sosmed' => $id_sosmed
        ]);
    }
}
