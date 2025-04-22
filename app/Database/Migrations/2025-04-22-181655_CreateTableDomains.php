<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableDomains extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_domains' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_hosting' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'add_on_domain' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('id_domains', true);
        $this->forge->addForeignKey('id_hosting', 'tb_hosting', 'id_hosting', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_domains');
    }

    public function down()
    {
        $this->forge->dropTable('tb_domains');
    }
}
