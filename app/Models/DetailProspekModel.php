<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailProspekModel extends Model
{
    protected $table = 'tb_detail_prospek';
    protected $primaryKey = 'id_detail_prospek';
    protected $allowedFields = [
        'id_prospek',
        'nama_perusahaan',
        'alamat',
        'no_hp',
        'no_telepon',
        'email',
        'website',
        'keterangan_lainnya',
        'tanggal'
    ];

    // Override insert untuk logging
    public function insert($data = null, bool $returnID = true)
    {
        try {
            if (!isset($data['id_prospek'])) {
                throw new \RuntimeException('id_prospek harus diisi');
            }

            return parent::insert($data, $returnID);
        } catch (\Exception $e) {
            log_message('error', 'Gagal insert detail prospek: ' . $e->getMessage());
            return false;
        }
    }

    protected $useTimestamps = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    // Validation rules
    protected $validationRules = [
        'id_prospek' => 'required|integer',
        'nama_perusahaan' => 'required|min_length[2]|max_length[255]',
        'email' => 'permit_empty|valid_email',
        'website' => 'permit_empty|valid_url',
        'no_hp' => 'permit_empty|min_length[10]|max_length[15]',
        'no_telepon' => 'permit_empty|min_length[7]|max_length[15]'
    ];

    protected $validationMessages = [
        'id_prospek' => [
            'required' => 'ID Prospek harus ada',
            'integer' => 'ID Prospek harus berupa angka'
        ],
        'nama_perusahaan' => [
            'required' => 'Nama perusahaan harus diisi',
            'min_length' => 'Nama perusahaan minimal 2 karakter',
            'max_length' => 'Nama perusahaan maksimal 255 karakter'
        ],
        'email' => [
            'valid_email' => 'Format email tidak valid'
        ],
        'website' => [
            'valid_url' => 'Format website tidak valid'
        ],
        'no_hp' => [
            'min_length' => 'No HP minimal 10 digit',
            'max_length' => 'No HP maksimal 15 digit'
        ],
        'no_telepon' => [
            'min_length' => 'No Telepon minimal 7 digit',
            'max_length' => 'No Telepon maksimal 15 digit'
        ]
    ];

    // Mendapatkan detail perusahaan dalam prospek tertentu dengan join yang lebih simple
    public function getDetailByProspekId($id_prospek)
    {
        try {
            $builder = $this->db->table($this->table);
            $builder->select('
                id_detail_prospek,
                nama_perusahaan,
                alamat,
                no_hp,
                no_telepon,
                email,
                website,
                keterangan_lainnya,
                tanggal,
                "Belum" as status_email,
                "Belum" as status_wa,
                NULL as tanggal_email,
                NULL as tanggal_wa
            ');
            $builder->where('id_prospek', $id_prospek);
            $builder->orderBy('nama_perusahaan', 'ASC');

            $result = $builder->get()->getResultArray();

            // Jika ada tabel email dan whatsapp, update status secara terpisah
            foreach ($result as $key => $row) {
                // Check email status
                $emailBuilder = $this->db->table('tb_prospek_email');
                $emailBuilder->where('id_detail_prospek', $row['id_detail_prospek']);
                $emailData = $emailBuilder->get()->getRowArray();

                if ($emailData) {
                    $result[$key]['status_email'] = 'Sudah';
                    $result[$key]['tanggal_email'] = $emailData['tanggal'] ?? null;
                }

                // Check whatsapp status
                $waBuilder = $this->db->table('tb_prospek_whatsapp');
                $waBuilder->where('id_detail_prospek', $row['id_detail_prospek']);
                $waData = $waBuilder->get()->getRowArray();

                if ($waData) {
                    $result[$key]['status_wa'] = 'Sudah';
                    $result[$key]['tanggal_wa'] = $waData['tanggal'] ?? null;
                }
            }

            return $result;
        } catch (\Exception $e) {
            log_message('error', 'Error in getDetailByProspekId: ' . $e->getMessage());
            return [];
        }
    }

    // Override insert method untuk menambahkan error handling
    // public function insert($data = null, bool $returnID = true)
    // {
    //     try {
    //         // Pastikan data yang required ada
    //         if (!isset($data['tanggal']) || empty($data['tanggal'])) {
    //             $data['tanggal'] = date('Y-m-d');
    //         }

    //         // Set default values untuk field yang boleh kosong
    //         $defaultFields = ['alamat', 'no_hp', 'no_telepon', 'email', 'website', 'keterangan_lainnya'];
    //         foreach ($defaultFields as $field) {
    //             if (!isset($data[$field])) {
    //                 $data[$field] = '';
    //             }
    //         }

    //         return parent::insert($data, $returnID);
    //     } catch (\Exception $e) {
    //         log_message('error', 'Error inserting detail prospek: ' . $e->getMessage());
    //         throw $e;
    //     }
    // }

    // Override update method untuk menambahkan error handling
    public function update($id = null, $data = null): bool
    {
        try {
            // Set default values untuk field yang boleh kosong
            $defaultFields = ['alamat', 'no_hp', 'no_telepon', 'email', 'website', 'keterangan_lainnya'];
            foreach ($defaultFields as $field) {
                if (!isset($data[$field])) {
                    $data[$field] = '';
                }
            }

            return parent::update($id, $data);
        } catch (\Exception $e) {
            log_message('error', 'Error updating detail prospek: ' . $e->getMessage());
            throw $e;
        }
    }

    // Method untuk mendapatkan statistik prospek
    public function getProspekStats($id_prospek)
    {
        try {
            $builder = $this->db->table($this->table);
            $builder->selectCount('id_detail_prospek', 'total_perusahaan');
            $builder->where('id_prospek', $id_prospek);
            $result = $builder->get()->getRowArray();

            // Hitung email yang sudah dikirim
            $emailBuilder = $this->db->table('tb_prospek_email pe');
            $emailBuilder->join($this->table . ' dp', 'pe.id_detail_prospek = dp.id_detail_prospek');
            $emailBuilder->selectCount('pe.id_prospek_email', 'total_email_sent');
            $emailBuilder->where('dp.id_prospek', $id_prospek);
            $emailResult = $emailBuilder->get()->getRowArray();

            // Hitung whatsapp yang sudah dikirim
            $waBuilder = $this->db->table('tb_prospek_whatsapp pw');
            $waBuilder->join($this->table . ' dp', 'pw.id_detail_prospek = dp.id_detail_prospek');
            $waBuilder->selectCount('pw.id_prospek_whatsapp', 'total_wa_sent');
            $waBuilder->where('dp.id_prospek', $id_prospek);
            $waResult = $waBuilder->get()->getRowArray();

            return [
                'total_perusahaan' => $result['total_perusahaan'] ?? 0,
                'total_email_sent' => $emailResult['total_email_sent'] ?? 0,
                'total_wa_sent' => $waResult['total_wa_sent'] ?? 0
            ];
        } catch (\Exception $e) {
            log_message('error', 'Error in getProspekStats: ' . $e->getMessage());
            return [
                'total_perusahaan' => 0,
                'total_email_sent' => 0,
                'total_wa_sent' => 0
            ];
        }
    }

    // Method untuk mendapatkan perusahaan yang memiliki email dan belum dikirim email
    public function getCompaniesWithEmail($id_prospek)
    {
        return $this->db->query("
            SELECT 
                dp.id_detail_prospek,
                dp.nama_perusahaan,
                dp.email,
                dp.no_hp,
                dp.alamat,
                CASE WHEN pe.id_prospek_email IS NOT NULL THEN 1 ELSE 0 END as sudah_email
            FROM tb_detail_prospek dp
            LEFT JOIN tb_prospek_email pe ON dp.id_detail_prospek = pe.id_detail_prospek
            WHERE dp.id_prospek = ? 
            AND dp.email IS NOT NULL 
            AND dp.email != ''
            ORDER BY dp.nama_perusahaan ASC
        ", [$id_prospek])->getResultArray();
    }

    // Method untuk mendapatkan semua perusahaan dalam prospek (untuk List Prospek)
    public function getCompaniesByProspek($id_prospek)
    {
        return $this->where('id_prospek', $id_prospek)
                   ->orderBy('nama_perusahaan', 'ASC')
                   ->findAll();
    }
}
