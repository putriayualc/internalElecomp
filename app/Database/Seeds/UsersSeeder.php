<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Data dummy user
        $data = [
            // [
            //     'id_user'  => 1,
            //     'username' => 'admin',
            //     'password' => password_hash('admin', PASSWORD_DEFAULT),
            //     'role'     => 'admin'
            // ],
            // [
            //     'id_user'  => 2,
            //     'username' => 'user',
            //     'password' => password_hash('user', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            // [
            //     'id_user'  => 3,
            //     'username' => 'Maulita',
            //     'password' => password_hash('12345', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            // [
            //     'id_user'  => 4,
            //     'username' => 'Yusri',
            //     'password' => password_hash('12345', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            // [
            //     'id_user'  => 5,
            //     'username' => 'Kadafi',
            //     'password' => password_hash('12345', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            // [
            //     'id_user'  => 6,
            //     'username' => 'Putri',
            //     'password' => password_hash('12345', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            // [
            //     'id_user'  => 7,
            //     'username' => 'Ardian',
            //     'password' => password_hash('12345', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            // [
            //     'id_user'  => 8,
            //     'username' => 'Adam',
            //     'password' => password_hash('12345', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            // [
            //     'id_user'  => 9,
            //     'username' => 'Regita',
            //     'password' => password_hash('12345', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            // [
            //     'id_user'  => 10,
            //     'username' => 'Abdul',
            //     'password' => password_hash('12345', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            // [
            //     'id_user'  => 11,
            //     'username' => 'Gabriel',
            //     'password' => password_hash('12345', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            // [
            //     'id_user'  => 12,
            //     'username' => 'Asti',
            //     'password' => password_hash('12345', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            // [
            //     'id_user'  => 13,
            //     'username' => 'Lukman',
            //     'password' => password_hash('12345', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            // [
            //     'id_user'  => 14,
            //     'username' => 'Maulana',
            //     'password' => password_hash('12345', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            // [
            //     'id_user'  => 15,
            //     'username' => 'Icha',
            //     'password' => password_hash('12345', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            // [
            //     'id_user'  => 16,
            //     'username' => 'Yogi',
            //     'password' => password_hash('12345', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            // [
            //     'id_user'  => 17,
            //     'username' => 'Febri',
            //     'password' => password_hash('12345', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            // [
            //     'id_user'  => 18,
            //     'username' => 'Aulia',
            //     'password' => password_hash('12345', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            // [
            //     'id_user'  => 19,
            //     'username' => 'Wildan',
            //     'password' => password_hash('12345', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            // [
            //     'id_user'  => 20,
            //     'username' => 'Tia',
            //     'password' => password_hash('12345', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            // [
            //     'id_user'  => 21,
            //     'username' => 'Ale',
            //     'password' => password_hash('12345', PASSWORD_DEFAULT),
            //     'role'     => 'user'
            // ],
            [
                'id_user'  => 22,
                'username' => 'Nizhar',
                'password' => password_hash('12345', PASSWORD_DEFAULT),
                'role'     => 'user'
            ],

        ];

        // Insert ke tabel users
        $this->db->table('tb_users')->insertBatch($data);
    }
}
