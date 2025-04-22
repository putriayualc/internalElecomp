<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableBlog extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_blog' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_email' => [
                'type'          => 'INT',
                'unsigned'      => true,
            ],
            'domain_blog' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('id_blog', true);
        $this->forge->addForeignKey('id_email', 'tb_email', 'id_email', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tb_blog');
    }

    public function down()
    {
        $this->forge->dropTable('tb_blog');
    }
}
