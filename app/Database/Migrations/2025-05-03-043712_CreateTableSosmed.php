<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSosmed extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_sosmed' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_bisnis' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'nama_akun' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'platform' => [
                'type'       => 'ENUM',
                'constraint' => ['instagram', 'tiktok', 'facebook', 'linkedin'],
                'null'       => true,
                'default'    => null,
            ],
        ]);

        $this->forge->addKey('id_sosmed', true);
        $this->forge->addForeignKey('id_bisnis', 'tb_bisnis', 'id_bisnis', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_sosmed');
    }

    public function down()
    {
        $this->forge->dropTable('tb_sosmed');
    }
}
