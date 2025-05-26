<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Data dummy user
        $data = [
            [
                'id_user'  => 1,
                'username' => 'admin',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'role'     => 'admin'
            ],
            [
                'id_user'  => 2,
                'username' => 'user',
                'password' => password_hash('user', PASSWORD_DEFAULT),
                'role'     => 'user'
            ],
            [
                'id_user'  => 3,
                'username' => 'angelina232',
                'password' => password_hash('elecomp123', PASSWORD_DEFAULT),
                'role'     => 'user'
            ],
            [
                'id_user'  => 4,
                'username' => 'chris212',
                'password' => password_hash('elecomp123', PASSWORD_DEFAULT),
                'role'     => 'user'
            ],
            [
                'id_user'  => 5,
                'username' => 'emma345',
                'password' => password_hash('elecomp123', PASSWORD_DEFAULT),
                'role'     => 'user'
            ],

        ];

        // Insert ke tabel users
        $this->db->table('tb_users')->insertBatch($data);
    }
}
