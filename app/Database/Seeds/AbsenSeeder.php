<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AbsenSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_user'      => 1,
                'bukti_foto'   => 'foto1.jpg',
                'tanggal_waktu'=> '2025-05-26 07:45:00',
                'waktu_pulang' => '2025-05-26 16:00:00',
                'keterangan'   => 'Tepat waktu',
                'status'       => 'Masuk',
                'persetujuan'  => 'Terima',
                'created_at'   => '2025-05-26',
                'updated_at'   => '2025-05-26',
            ],
            [
                'id_user'      => 2,
                'bukti_foto'   => 'foto2.jpg',
                'tanggal_waktu'=> '2025-05-26 08:10:00',
                'waktu_pulang' => '2025-05-26 16:00:00',
                'keterangan'   => 'Datang terlambat',
                'status'       => 'Ijin',
                'persetujuan'  => 'Pending',
                'created_at'   => '2025-05-26',
                'updated_at'   => '2025-05-26',
            ],
            [
                'id_user'      => 3,
                'bukti_foto'   => 'foto3.jpg',
                'tanggal_waktu'=> '2025-05-26 00:00:00',
                'waktu_pulang' => null,
                'keterangan'   => 'Sakit dengan surat dokter',
                'status'       => 'Sakit',
                'persetujuan'  => 'Terima',
                'created_at'   => '2025-05-26',
                'updated_at'   => '2025-05-26',
            ],
            [
                'id_user'      => 4,
                'bukti_foto'   => 'foto4.jpg',
                'tanggal_waktu'=> '2025-05-26 00:00:00',
                'waktu_pulang' => null,
                'keterangan'   => 'Tidak hadir tanpa keterangan',
                'status'       => 'Bolos',
                'persetujuan'  => 'Tolak',
                'created_at'   => '2025-05-26',
                'updated_at'   => '2025-05-26',
            ],
        ];

        // Insert batch
        $this->db->table('tb_absen')->insertBatch($data);
    }
}
