<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AbsenSeeder extends Seeder
{
    public function run()
    {
        {
            $statuses = ['masuk', 'ijin', 'bolos', 'sakit'];
            $kegiatans = [
                'Menginput data',
                'Mengerjakan laporan',
                'Membuat desain',
                'Menghadiri meeting',
                'Menulis konten',
                'Mengelola database',
                'Menguji aplikasi',
                'Mengerjakan tugas dari atasan'
            ];

            for ($i = 1; $i <= 20; $i++) {
                $data = [
                    'id_user'       => rand(1, 5), // Anggap ada 5 user
                    'bukti_foto'    => 'user.png',
                    'tanggal_waktu' => date('Y-m-d H:i:s', strtotime("-$i days")),
                    'kegiatan'      => $kegiatans[array_rand($kegiatans)],
                    'status'        => $statuses[array_rand($statuses)],
                    'persetujuan'   => 'pending',
                ];

                $this->db->table('tb_absen')->insert($data);
            }
        }
    }
}
