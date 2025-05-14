<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableHari extends Migration
{
    public function up()
    {
         $this->forge->addField([
            'id_hari' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'hari' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('id_hari', true);
        $this->forge->createTable('tb_hari');
    }

    public function down()
    {
        $this->forge->dropTable('tb_hari');
    }
}
