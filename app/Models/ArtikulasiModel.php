<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikulasiModel extends Model
{
    protected $table = 'Tb_artikel_trending';
    protected $primaryKey = 'id_artikel_trending';
    protected $allowedFields = ['id_siswa', 'link_trending', 'tanggal_penugasan', 'tanggal_upload'];
    protected $useTimestamps = true;
    protected $createdField = 'tanggal_upload';
    protected $updatedField = 'tanggal_upload';

    public function getArtikelWithSiswa()
    {
        return $this->select('Tb_artikel_trending.*, Tb_siswa.nama as nama_siswa')
                    ->join('Tb_siswa', 'Tb_siswa.id_siswa = Tb_artikel_trending.id_siswa')
                    ->findAll();
    }

    public function getArtikelByDate($date)
    {
        return $this->select('Tb_artikel_trending.*, Tb_siswa.nama as nama_siswa')
                    ->join('Tb_siswa', 'Tb_siswa.id_siswa = Tb_artikel_trending.id_siswa')
                    ->where('tanggal_penugasan', $date)
                    ->findAll();
    }
}
