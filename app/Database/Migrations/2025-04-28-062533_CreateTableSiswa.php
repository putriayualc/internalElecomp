<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_siswa' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'jurusan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'asal_instansi' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'no_telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'jenis_kelamin' => [
                'type'       => 'ENUM',
                'constraint' => ['l', 'p'],
                'default'    => 'p',
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'tgl_masuk' => [
                'type'       => 'DATE',
            ],
            'tgl_keluar' => [
                'type'       => 'DATE',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Aktif', 'Selesai'],
                'default'    => 'Aktif',
            ],

        ]);

        $this->forge->addKey('id_siswa', true);
        $this->forge->createTable('tb_siswa');
    }

    public function down()
    {
        $this->forge->dropTable('tb_siswa');
    }
}
