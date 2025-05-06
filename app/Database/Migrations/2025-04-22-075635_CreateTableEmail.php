<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableEmail extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_email' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'id_user' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
        ]);

        $this->forge->addKey('id_email', true);
        $this->forge->addForeignKey('id_user', 'tb_users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_email');
    }

    public function down()
    {
        $this->forge->dropTable('tb_email');
    }
}
