<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePiket extends Migration
{
    public function up()
    {
         $this->forge->addField([
            'id_piket' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_hari' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'id_siswa' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
        ]);

        $this->forge->addKey('id_piket', true);
        $this->forge->addForeignKey('id_hari', 'tb_hari', 'id_hari', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_siswa', 'tb_siswa', 'id_siswa', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_piket');
    }

    public function down()
    {
        $this->forge->dropTable('tb_piket');
    }
}
