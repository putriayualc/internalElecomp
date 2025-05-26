<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableDetailKonten extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_detail_konten' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_konten' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'media' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'tipe_media' => [
                'type'       => 'ENUM',
                'constraint' => ['foto', 'video'],
                'default'    => 'foto',
            ],
        ]);

        $this->forge->addKey('id_detail_konten', true);
        $this->forge->addForeignKey('id_konten', 'tb_konten', 'id_konten', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_detail_konten');
    }

    public function down()
    {
        $this->forge->dropTable('tb_detail_konten');
    }
}
