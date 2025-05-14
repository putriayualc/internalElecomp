<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableBisnis extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bisnis' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_bisnis' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'website' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('id_bisnis', true);
        $this->forge->createTable('tb_bisnis');
    }

    public function down()
    {
        $this->forge->dropTable('tb_bisnis');
    }
}
