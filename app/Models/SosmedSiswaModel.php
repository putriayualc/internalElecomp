<?php

namespace App\Models;

use CodeIgniter\Model;

class SosmedSiswaModel extends Model
{
    protected $table            = 'tb_sosmed_siswa';
    protected $primaryKey       = 'id_sosmed_siswa';
    protected $allowedFields    = ['id_siswa', 'platform', 'username_sosmed', 'link'];

    public function getEnumPlatform()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SHOW COLUMNS FROM {$this->table} LIKE 'platform'");
        $row = $query->getRow();

        if ($row) {
            preg_match("/^enum\((.*)\)$/", $row->Type, $matches);
            $enumStr = str_replace("'", "", $matches[1]);
            return explode(",", $enumStr);
        }

        return [];
    }
}
