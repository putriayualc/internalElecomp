<?php

namespace App\Models;

use CodeIgniter\Model;

class ProspekModel extends Model
{
    protected $table = 'tb_prospek';
    protected $primaryKey = 'id_prospek';
    protected $allowedFields = ['judul', 'sumber_data'];
    protected $useTimestamps = false;

    public function getAllProspekWithSummary()
    {
        return $this->db->query("
            SELECT 
                p.id_prospek,
                p.judul,
                p.sumber_data,
                COUNT(DISTINCT dp.id_detail_prospek) as total_perusahaan,
                COUNT(DISTINCT pe.id_prospek_email) as total_email_sent,
                COUNT(DISTINCT pw.id_prospek_whatsapp) as total_whatsapp_sent,
                CASE 
                    WHEN COUNT(DISTINCT pe.id_prospek_email) > 0 AND COUNT(DISTINCT pw.id_prospek_whatsapp) > 0 THEN 'Email & WA'
                    WHEN COUNT(DISTINCT pe.id_prospek_email) > 0 THEN 'Email Only'
                    WHEN COUNT(DISTINCT pw.id_prospek_whatsapp) > 0 THEN 'WA Only'
                    ELSE 'Belum Diproses'
                END as status_komunikasi
            FROM tb_prospek p
            LEFT JOIN tb_detail_prospek dp ON p.id_prospek = dp.id_prospek
            LEFT JOIN tb_prospek_email pe ON dp.id_detail_prospek = pe.id_detail_prospek
            LEFT JOIN tb_prospek_whatsapp pw ON dp.id_detail_prospek = pw.id_detail_prospek
            GROUP BY p.id_prospek, p.judul, p.sumber_data
            ORDER BY p.id_prospek DESC
        ")->getResultArray();
    }

    // Method untuk mendapatkan semua prospek (untuk menu List Prospek)
    public function getAllProspek()
    {
        return $this->db->query("
            SELECT p.*, COUNT(dp.id_detail_prospek) as total_perusahaan
            FROM tb_prospek p
            LEFT JOIN tb_detail_prospek dp ON p.id_prospek = dp.id_prospek
            GROUP BY p.id_prospek, p.judul, p.sumber_data
            ORDER BY p.judul ASC
        ")->getResultArray();
    }

    // Method untuk mendapatkan prospek yang sudah ada email (untuk ditampilkan di menu Prospek Email)
    public function getProspekWithEmail()
    {
        return $this->db->query("
            SELECT p.*, COUNT(DISTINCT pe.id_prospek_email) as total_email_sent,
                   COUNT(DISTINCT dp.id_detail_prospek) as total_perusahaan
            FROM tb_prospek p
            INNER JOIN tb_detail_prospek dp ON p.id_prospek = dp.id_prospek
            INNER JOIN tb_prospek_email pe ON dp.id_detail_prospek = pe.id_detail_prospek
            GROUP BY p.id_prospek, p.judul, p.sumber_data
            ORDER BY p.judul ASC
        ")->getResultArray();
    }

    public function getDetailProspek($id_prospek)
    {
        return $this->db->table('tb_detail_prospek')
            ->select('id_detail_prospek, nama_perusahaan, no_hp, email')
            ->where('id_prospek', $id_prospek)
            ->get()
            ->getResultArray();
    }

     public function getProspekWithWhatsapp()
    {
        return $this->db->query("
            SELECT
                p.id_prospek,
                p.judul,
                p.sumber_data,
                (SELECT COUNT(*) FROM tb_detail_prospek WHERE id_prospek = p.id_prospek) as total_perusahaan,
                COUNT(pw.id_prospek_whatsapp) as total_whatsapp_sent
            FROM
                tb_prospek p
            JOIN
                tb_detail_prospek dp ON p.id_prospek = dp.id_prospek
            JOIN
                tb_prospek_whatsapp pw ON dp.id_detail_prospek = pw.id_detail_prospek
            GROUP BY
                p.id_prospek, p.judul, p.sumber_data
            ORDER BY
                p.judul ASC
        ")->getResultArray();
    }

    /**
     * Mengambil daftar prospek yang tersedia untuk dikirimi WhatsApp.
     * "Tersedia" berarti prospek tersebut memiliki setidaknya satu perusahaan dengan No. HP yang valid.
     * Method ini menghasilkan 'total_perusahaan_dengan_hp' yang menyebabkan error.
     */
    public function getAvailableProspekForWhatsapp()
    {
        return $this->db->query("
            SELECT
                p.id_prospek,
                p.judul,
                p.sumber_data,
                (SELECT COUNT(dp.id_detail_prospek)
                 FROM tb_detail_prospek dp
                 WHERE dp.id_prospek = p.id_prospek AND dp.no_hp IS NOT NULL AND dp.no_hp != '') as total_perusahaan_dengan_hp
            FROM
                tb_prospek p
            WHERE
                EXISTS (
                    SELECT 1
                    FROM tb_detail_prospek dp
                    WHERE dp.id_prospek = p.id_prospek AND dp.no_hp IS NOT NULL AND dp.no_hp != ''
                )
            ORDER BY p.judul ASC
        ")->getResultArray();
    }


    // Method untuk mendapatkan prospek yang tersedia untuk dikirim email (belum ada yang dikirim email)
    public function getAvailableProspekForEmail()
    {
        return $this->db->query("
            SELECT p.*, COUNT(dp.id_detail_prospek) as total_perusahaan_dengan_email
            FROM tb_prospek p
            INNER JOIN tb_detail_prospek dp ON p.id_prospek = dp.id_prospek
            WHERE dp.email IS NOT NULL AND dp.email != ''
            AND NOT EXISTS (
                SELECT 1 FROM tb_prospek_email pe 
                WHERE pe.id_detail_prospek = dp.id_detail_prospek
            )
            GROUP BY p.id_prospek, p.judul, p.sumber_data
            HAVING COUNT(dp.id_detail_prospek) > 0
            ORDER BY p.judul ASC
        ")->getResultArray();
    }
}
