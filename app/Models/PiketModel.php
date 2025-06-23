<?php

namespace App\Models;

use CodeIgniter\Model;

class PiketModel extends Model
{
    protected $table            = 'tb_piket';
    protected $primaryKey       = 'id_piket';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_hari', 'id_siswa'];

    public function getPiketWithJoin()
{
    return $this->select('tb_hari.hari, tb_users.id_user, tb_users.username, tb_siswa.status') // tambahkan tb_siswa.status
        ->join('tb_hari', 'tb_hari.id_hari = tb_piket.id_hari')
        ->join('tb_siswa', 'tb_siswa.id_siswa = tb_piket.id_siswa')
        ->join('tb_users', 'tb_users.id_user = tb_siswa.id_user')
        ->orderBy('tb_hari.id_hari')
        ->findAll();
}



    public function getPiketWithTugas()
    {
        return $this->db->table('tb_piket p')
            ->select('p.id_piket as jadwal_id, h.hari as nama_hari, s.username, 
                    tp.id_tugas_piket as tugas_id, tp.nama_tugas, tp.bobot')
            ->join('tb_hari h', 'h.id_hari = p.id_hari')
            ->join('tb_users s', 's.id_user = p.id_siswa')
            ->join('tugas_jadwal tj', 'tj.id_piket = p.id_piket')
            ->join('tb_tugas_piket tp', 'tp.id_tugas_piket = tj.id_tugas_piket')
            ->orderBy('h.hari', 'ASC')
            ->orderBy('tp.bobot', 'DESC')
            ->get()->getResultArray();
    }

    public function getAllTugas()
    {
        return $this->db->table('tb_tugas_piket')
            ->orderBy('bobot', 'DESC')
            ->get()->getResultArray();
    }

    // Ambil daftar piket per hari dan hari itu dengan jumlah maksimal anggota
    public function getPiketByHari($hari, $limit)
{
    return $this->db->table('tb_piket p')
        ->select('p.id_piket, s.id_siswa, s.nama, u.id_user, u.username')
        ->join('tb_siswa s', 's.id_siswa = p.id_siswa')
        ->join('tb_users u', 'u.id_user = s.id_user') // relasi user ke siswa
        ->join('tb_hari h', 'h.id_hari = p.id_hari')
        ->where('h.hari', $hari)
        ->limit($limit)
        ->get()
        ->getResultArray();
}


    public function getAllTugasOrderByBobot()
{
    return $this->db->table('tb_tugas_piket')
        ->orderBy('bobot', 'DESC')
        ->get()
        ->getResultArray();
}

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
}
