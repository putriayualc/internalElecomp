<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKonten extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_konten' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'caption' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'cover' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('id_konten', true);
        $this->forge->createTable('tb_konten');
    }

    public function down()
    {
        $this->forge->dropTable('tb_konten');
    }
}
