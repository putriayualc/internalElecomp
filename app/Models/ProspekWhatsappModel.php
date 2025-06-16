<?php

namespace App\Models;

use CodeIgniter\Model;

class ProspekWhatsappModel extends Model
{
    protected $table = 'tb_prospek_whatsapp';
    protected $primaryKey = 'id_prospek_whatsapp';
    protected $allowedFields = [
        'id_detail_prospek',
        'nama_perusahaan',
        'pesan',
        'tanggal',
        'status',
        'keterangan'
    ];
    protected $useTimestamps = false;

    // Mendapatkan semua pesan WhatsApp berdasarkan prospek_id
    public function getWhatsappByProspekId($id_prospek)
    {
        return $this->db->query("
            SELECT 
                pw.id_prospek_whatsapp,
                pw.nama_perusahaan,
                pw.pesan,
                pw.tanggal,
                pw.status,
                pw.keterangan,
                dp.no_hp
            FROM tb_prospek_whatsapp pw
            INNER JOIN tb_detail_prospek dp ON pw.id_detail_prospek = dp.id_detail_prospek
            WHERE dp.id_prospek = ?
            ORDER BY pw.tanggal DESC
        ", [$id_prospek])->getResultArray();
    }

    // Method untuk mendapatkan riwayat WhatsApp berdasarkan prospek
    public function getWhatsappHistoryByProspek($id_prospek)
    {
        return $this->db->query("
            SELECT pw.*, dp.nama_perusahaan, dp.no_hp, p.judul as nama_prospek
            FROM tb_prospek_whatsapp pw
            INNER JOIN tb_detail_prospek dp ON pw.id_detail_prospek = dp.id_detail_prospek
            INNER JOIN tb_prospek p ON dp.id_prospek = p.id_prospek
            WHERE p.id_prospek = ?
            ORDER BY pw.tanggal DESC
        ", [$id_prospek])->getResultArray();
    }

    // Method untuk menyimpan beberapa pesan WhatsApp baru (batch)
    public function saveWhatsapps($data)
    {
        return $this->insertBatch($data);
    }

    // Method untuk menyimpan satu pesan WhatsApp
    public function saveWhatsapp($data)
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

    // Method untuk cek apakah perusahaan sudah dikirim WhatsApp
    public function isWhatsappSent($id_detail_prospek)
    {
        return $this->where('id_detail_prospek', $id_detail_prospek)->countAllResults() > 0;
    }

    // Method baru untuk mendapatkan perusahaan yang belum dikirim WhatsApp
    public function getCompaniesWithoutWhatsapp($id_prospek)
    {
        return $this->db->query("
            SELECT 
                dp.id_detail_prospek,
                dp.nama_perusahaan,
                dp.no_hp,
                dp.alamat
            FROM tb_detail_prospek dp
            LEFT JOIN tb_prospek_whatsapp pw ON dp.id_detail_prospek = pw.id_detail_prospek
            WHERE dp.id_prospek = ? 
            AND dp.no_hp IS NOT NULL 
            AND dp.no_hp != ''
            AND pw.id_prospek_whatsapp IS NULL
            ORDER BY dp.nama_perusahaan ASC
        ", [$id_prospek])->getResultArray();
    }
}