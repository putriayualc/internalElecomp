<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_siswa'      => 1,
                'nama'          => 'Angelina Jolie',
                'alamat'        => 'Cengkareng',
                'jurusan'       => 'D4 TI',
                'asal_instansi' => 'Politeknik Negeri Malang',
                'no_telepon'    => '08232323232',
                'jenis_kelamin' => 'p',
                'foto'          => 'angelina.jpg',
                'tgl_masuk'     => date('Y-m-d'),
                'tgl_keluar'    => date('Y-m-d', strtotime('+60 days')),
                'status'        => 'Aktif',
                'id_user'       => 3
            ],
            [
                'id_siswa'      => 2,
                'nama'          => 'Chris Evans',
                'alamat'        => 'Bekasi',
                'jurusan'       => 'D3 SI',
                'asal_instansi' => 'Universitas Indonesia',
                'no_telepon'    => '081212121212',
                'jenis_kelamin' => 'l',
                'foto'          => 'chris.jpg',
                'tgl_masuk'     => date('Y-m-d'),
                'tgl_keluar'    => date('Y-m-d', strtotime('+60 days')),
                'status'        => 'Aktif',
                'id_user'       => 4
            ],
            [
                'id_siswa'      => 3,
                'nama'          => 'Emma Watson',
                'alamat'        => 'Malang',
                'jurusan'       => 'S1 Informatika',
                'asal_instansi' => 'Universitas Brawijaya',
                'no_telepon'    => '085678912345',
                'jenis_kelamin' => 'p',
                'foto'          => 'emma.jpg',
                'tgl_masuk'     => date('Y-m-d'),
                'tgl_keluar'    => date('Y-m-d', strtotime('+60 days')),
                'status'        => 'Aktif',
                'id_user'       => 5
            ]
        ];

        // Insert ke tabel tb_siswa
        $this->db->table('tb_siswa')->insertBatch($data);
    }
}