<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableAbsen extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_absen' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'bukti_foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'tanggal_waktu' => [
                'type' => 'DATETIME',
            ],
            'waktu_pulang' => [
                'type'     => 'DATETIME',
                'null'     => true,
            ],
            'keterangan' => [
                'type' => 'TEXT',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Masuk', 'Ijin', 'Sakit', 'Bolos'],
            ],
            'persetujuan' => [
                'type'       => 'ENUM',
                'constraint' => ['Terima', 'Tolak', 'Pending'],
            ],
            'created_at' => [
                'type' => 'DATE',
            ],
            'updated_at' => [
                'type' => 'DATE',
            ],
        ]);

        $this->forge->addKey('id_absen', true);
        $this->forge->createTable('tb_absen');
    }

    public function down()
    {
        $this->forge->dropTable('tb_absen');
    }
}
