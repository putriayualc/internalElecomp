<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableArtikelInternal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_artikel_internal' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_bisnis' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'id_user' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'judul_artikel' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],            
            'tgl_upload' => [
                'type'       => 'DATETIME',
            ],
            'link' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'keyword' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('id_artikel_internal', true);
        $this->forge->addForeignKey('id_bisnis', 'tb_bisnis', 'id_bisnis', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_user', 'tb_users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_artikel_internal');
    }

    public function down()
    {
        $this->forge->dropTable('tb_artikel_internal');
    }
}
