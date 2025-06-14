<?php

namespace App\Models;

use CodeIgniter\Model;

class ProspekEmailModel extends Model
{
    protected $table = 'tb_prospek_email';
    protected $primaryKey = 'id_prospek_email';
    protected $allowedFields = [
        'id_detail_prospek',
        'nama_perusahaan',
        'pesan',
        'tanggal',
        'status',
        'keterangan'
    ];
    protected $useTimestamps = false;

    // Mendapatkan semua email berdasarkan prospek_id
    public function getEmailByProspekId($id_prospek)
    {
        return $this->db->query("
            SELECT 
                pe.id_prospek_email,
                pe.nama_perusahaan,
                pe.pesan,
                pe.tanggal,
                pe.status,
                pe.keterangan,
                dp.email,
                dp.no_hp
            FROM tb_prospek_email pe
            INNER JOIN tb_detail_prospek dp ON pe.id_detail_prospek = dp.id_detail_prospek
            WHERE dp.id_prospek = ?
            ORDER BY pe.tanggal DESC
        ", [$id_prospek])->getResultArray();
    }

    // Method untuk mendapatkan riwayat email berdasarkan prospek
    public function getEmailHistoryByProspek($id_prospek)
    {
        return $this->db->query("
            SELECT pe.*, dp.nama_perusahaan, dp.email, p.judul as nama_prospek
            FROM tb_prospek_email pe
            INNER JOIN tb_detail_prospek dp ON pe.id_detail_prospek = dp.id_detail_prospek
            INNER JOIN tb_prospek p ON dp.id_prospek = p.id_prospek
            WHERE p.id_prospek = ?
            ORDER BY pe.tanggal DESC
        ", [$id_prospek])->getResultArray();
    }

    // Method untuk menyimpan email baru
    public function saveEmails($data)
    {
        return $this->insertBatch($data);
    }

    // Method untuk menyimpan satu email
    public function saveEmail($data)
    {
        // Set default tanggal jika tidak ada
        if (!isset($data['tanggal']) || empty($data['tanggal'])) {
            $data['tanggal'] = date('Y-m-d H:i:s');
        }

        // Set default status jika tidak ada
        if (!isset($data['status']) || empty($data['status'])) {
            $data['status'] = 'terkirim';
        }

        return $this->insert($data);
    }

    // Method untuk cek apakah perusahaan sudah dikirim email
    public function isEmailSent($id_detail_prospek)
    {
        return $this->where('id_detail_prospek', $id_detail_prospek)->countAllResults() > 0;
    }

    // Tambahkan method baru untuk mendapatkan perusahaan yang belum dikirim email
    public function getCompaniesWithoutEmail($id_prospek)
    {
        return $this->db->query("
        SELECT 
            dp.id_detail_prospek,
            dp.nama_perusahaan,
            dp.email,
            dp.no_hp,
            dp.alamat
        FROM tb_detail_prospek dp
        LEFT JOIN tb_prospek_email pe ON dp.id_detail_prospek = pe.id_detail_prospek
        WHERE dp.id_prospek = ? 
        AND dp.email IS NOT NULL 
        AND dp.email != ''
        AND pe.id_prospek_email IS NULL
        ORDER BY dp.nama_perusahaan ASC
    ", [$id_prospek])->getResultArray();
    }
}
