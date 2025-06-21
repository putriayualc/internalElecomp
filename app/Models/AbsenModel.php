<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsenModel extends Model
{
    protected $table            = 'tb_absen';
    protected $primaryKey       = 'id_absen';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = [
        'id_user',
        'bukti_foto',
        'tanggal_waktu',
        'waktu_pulang',
        'kegiatan',
        'keterangan',
        'foto_suratDokter',
        'status',
        'persetujuan',
        'nilai_magang',
        'nilai_operasional',
        'feedback',
        'updated_at',
        'created_at'
    ];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;

    // protected array $casts = [];
    // protected array $castHandlers = [];

    // // Dates
    protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];




    public function search($hasil)
    {
        return $this->like('status', $hasil)->select('tb_absen.*, tb_users.*')
            ->join('tb_users', 'tb_users.id_user = tb_absen.id_user')
            ->findAll();
    }

    public function getStatistikAbsensi()
    {
        $tanggalHariIni = date('Y-m-d');

        return $this->select('status, COUNT(*) as total')
            ->where("DATE(tanggal_waktu)", $tanggalHariIni)
            ->groupBy('status')
            ->findAll();
    }

    public function getDataAbsen($tanggal = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('tb_absen.*, tb_users.id_user, tb_users.username');
        $builder->join('tb_users', 'tb_users.id_user = tb_absen.id_user');

        if ($tanggal !== null) {
            $builder->where('tb_absen.tanggal_waktu >=', $tanggal . ' 00:00:00');
            $builder->where('tb_absen.tanggal_waktu <=', $tanggal . ' 23:59:59');
        }

        $builder->whereIn('tb_absen.status', ['Izin', 'Sakit', 'Bolos']);

        return $builder->get()->getResultArray();
    }

    public function getNilaiHarian()
    {
        return $this->select('
            tb_absen.id_absen,
            tb_absen.tanggal_waktu AS tgl_absen,
            tb_absen.keterangan AS laporan_tugas,
            tb_absen.nilai_magang,
            tb_absen.nilai_operasional,
            tb_absen.feedback,
            tb_siswa.nama,
            tb_siswa.jurusan,
            tb_siswa.foto,
            tb_siswa.id_siswa
        ')
            ->join('tb_siswa', 'tb_siswa.id_user = tb_absen.id_user')
            ->orderBy('tb_absen.tanggal_waktu', 'DESC')
            ->findAll();
    }

    public function getNilaiHarianByUser($id_user)
    {
        return $this->select('
            tb_absen.tanggal_waktu AS tgl_absen,
            tb_absen.keterangan AS laporan_tugas,
            tb_absen.nilai_magang,
            tb_absen.nilai_operasional,
            tb_absen.feedback
        ')
            ->where('tb_absen.id_user', $id_user)
            ->orderBy('tb_absen.tanggal_waktu', 'ASC')
            ->asArray()
            ->findAll();
    }

    public function getAkumulasiSementara($id_user)
    {
        return $this->select('
            COUNT(*) AS jumlah_masuk,
            ROUND(AVG(nilai_magang), 1) AS rata_nilai_magang,
            ROUND(AVG(nilai_operasional), 1) AS rata_nilai_operasional
        ')
            ->where('id_user', $id_user)
            ->where('status', 'Masuk')
            ->first();
    }
}
