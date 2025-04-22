<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableHosting extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_hosting' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'domain_utama' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
            ],
            'username_hosting' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ],
            'password_hosting' => [
                'type'         => 'VARCHAR',
                'constraint'   => 255 
            ]
        ]);
        $this->forge->addKey('id_hosting', true);
        $this->forge->createTable('tb_hosting');
    }

    public function down()
    {
        $this->forge->dropTable('tb_hosting');
    }
}
