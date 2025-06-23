<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiAkhirModel extends Model
{
    protected $table            = 'tb_nilai_akhir';
    protected $primaryKey       = 'id_nilai_akhir';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_siswa',
        'nilai_absensi',
        'nilai_magang',
        'nilai_operasional',
        'nilai_artikel',
        'total_nilai',
        'updated_at'
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

    public function getAllNilai()
    {
        return $this->select('
            tb_siswa.nama,
            tb_siswa.jurusan,
            tb_siswa.foto,
            tb_siswa.tgl_keluar,
            tb_siswa.status,
            tb_siswa.id_siswa,
            tb_nilai_akhir.nilai_artikel,
            tb_nilai_akhir.nilai_absensi,
            tb_nilai_akhir.nilai_magang,
            tb_nilai_akhir.nilai_operasional,
            tb_nilai_akhir.total_nilai,
            tb_nilai_akhir.updated_at
        ')
            ->join('tb_siswa', 'tb_siswa.id_siswa = tb_nilai_akhir.id_siswa')
            ->orderBy('tb_nilai_akhir.updated_at', 'DESC')
            ->findAll();
    }
}
