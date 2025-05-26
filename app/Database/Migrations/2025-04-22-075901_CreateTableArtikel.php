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
            'tgl_upload' => [
                'type'       => 'DATE',
            ],
            'link' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'link_to' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'link_type' => [
                'type'       => 'ENUM',
                'constraint' => ['img', 'video', 'naked_url', 'text'],
                'default'    => 'text',
                'null'       => true,
            ],
            'keywords' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'anchor_text' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'indexed' => [
                'type'       => 'ENUM',
                'constraint' => ['sudah', 'belum'],
                'default'    => 'belum'
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
