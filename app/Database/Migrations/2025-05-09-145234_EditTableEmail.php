<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EditTableEmail extends Migration
{
    public function up()
    {
        // Tambah kolom id_user
        $fields = [
            'id_user' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ]
        ];
        $this->forge->addColumn('tb_email', $fields);

        // Tambah foreign key
        $this->forge->addForeignKey('id_user', 'tb_users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->processIndexes('tb_email'); // untuk menerapkan foreign key baru
    }

    public function down()
    {
        // Hapus foreign key dan kolom
        $this->forge->dropForeignKey('tb_email', 'tb_email_id_user_foreign');
        $this->forge->dropColumn('tb_email', 'id_user');
    }
}
