<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableArtikel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_artikel' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_blog' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'judul_artikel' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'deskripsi_artikel' => [
                'type'       => 'TEXT',
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'tgl_upload' => [
                'type'       => 'DATETIME',
            ],
            'jenis' => [
                'type'       => 'ENUM',
                'constraint' => ['artikel', 'backlink'],
                'default'    => 'artikel'
            ]
        ]);

        $this->forge->addKey('id_artikel', true);
        $this->forge->addForeignKey('id_blog', 'tb_blog', 'id_blog', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_artikel');
    }

    public function down()
    {
        $this->forge->dropTable('tb_artikel');
    }
}
