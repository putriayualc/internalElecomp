<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table            = 'tb_siswa';
    protected $primaryKey       = 'id_siswa';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama',
        'alamat',
        'jurusan',
        'asal_instansi',
        'no_telepon',
        'email',
        'jenis_kelamin',
        'foto',
        'tgl_masuk',
        'tgl_keluar',
        'status',
        'keterangan',
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

    public function updateStatus()
    {
        $today = date('Y-m-d');

        // 1. Update hanya yang status-nya tidak sesuai (hemat query)
        $this->builder()
            ->where('tgl_masuk >', $today)
            ->where('status !=', 'NonAktif')
            ->set(['status' => 'NonAktif'])
            ->update();

        $this->builder()
            ->where('tgl_masuk <=', $today)
            ->where('tgl_keluar >=', $today)
            ->where('status !=', 'Aktif')
            ->set(['status' => 'Aktif'])
            ->update();

        $this->builder()
            ->where('tgl_keluar <', $today)
            ->where('status !=', 'Selesai')
            ->set(['status' => 'Selesai'])
            ->update();
    }

    public function getEnumJenisKelamin()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SHOW COLUMNS FROM tb_siswa LIKE 'jenis_kelamin'");
        $row = $query->getRow();

        if (preg_match("/^enum\(\'(.*)\'\)$/", $row->Type, $matches)) {
            $enum = explode("','", $matches[1]);
            return $enum;
        }

        return [];
    }
}
