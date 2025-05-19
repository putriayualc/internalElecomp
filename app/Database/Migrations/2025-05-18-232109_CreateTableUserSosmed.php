<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableUserSosmed extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user_sosmed' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_sosmed' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'id_user' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
        ]);

        $this->forge->addKey('id_user_sosmed', true);
        $this->forge->addForeignKey('id_sosmed', 'tb_sosmed', 'id_sosmed', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_user', 'tb_users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_user_sosmed');
    }

    public function down()
    {
        $this->forge->dropTable('tb_user_sosmed');
    }
}
