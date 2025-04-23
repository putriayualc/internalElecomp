<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSop extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_sop' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'judul_sop' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'detail_sop' => [
                'type'       => 'TEXT',
            ],
        ]);

        $this->forge->addKey('id_sop', true);
        $this->forge->createTable('tb_sop');
    }

    public function down()
    {
        $this->forge->dropTable('tb_sop');
    }
}
