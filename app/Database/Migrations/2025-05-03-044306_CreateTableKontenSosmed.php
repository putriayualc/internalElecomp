<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKontenSosmed extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_konten_sosmed' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_sosmed' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'id_konten' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'id_user' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'tgl_upload' => [
                'type'       => 'date',
            ],
        ]);

        $this->forge->addKey('id_konten_sosmed', true);
        $this->forge->addForeignKey('id_sosmed', 'tb_sosmed', 'id_sosmed', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_konten', 'tb_konten', 'id_konten', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_user', 'tb_users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_konten_sosmed');
    }

    public function down()
    {
        $this->forge->dropTable('tb_konten_sosmed');
    }
}
