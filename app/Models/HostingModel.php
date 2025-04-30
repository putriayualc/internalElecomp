<?php

namespace App\Models;

use CodeIgniter\Model;

class HostingModel extends Model
{
    protected $table            = 'tb_hosting';
    protected $primaryKey       = 'id_hosting';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['domain_utama', 'username_hosting', 'password_hosting'];

    //Join dengan tb_domains
    public function getAllWithAddon(){
        return $this->select('tb_hosting.*, GROUP_CONCAT(tb_domains.add_on_domain SEPARATOR ", ") as add_on_domain')
            ->join('tb_domains', 'tb_domains.id_hosting = tb_hosting.id_hosting', 'left')
            ->groupBy('tb_hosting.id_hosting')
            ->findAll();
    }

    // Untuk ambil 1 hosting + semua add on domains
public function getHostingWithAddons($id_hosting)
{
    return $this->db->table('tb_hosting')
        ->select('tb_hosting.*, tb_domains.id_domains, tb_domains.add_on_domain')
        ->join('tb_domains', 'tb_domains.id_hosting = tb_hosting.id_hosting', 'left')
        ->where('tb_hosting.id_hosting', $id_hosting)
        ->get()
        ->getResultArray(); // <-- array banyak baris: satu baris per domain
}

public function getAddonsByHostingId($hostingId)
{
    return $this->db->table('tb_domains')
        ->where('id_hosting', $hostingId) // Pastikan Anda menggunakan kolom yang tepat
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
