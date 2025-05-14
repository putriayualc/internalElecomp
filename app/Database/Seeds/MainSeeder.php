<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
         // Panggil semua seeder lainnya
         $this->call('UsersSeeder');
         $this->call('SiswaSeeder');

    }
}
