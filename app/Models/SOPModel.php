<?php

namespace App\Models;

use CodeIgniter\Model;

class SopModel extends Model
{
    protected $table = 'tb_sop';
    protected $primaryKey = 'id_sop';
    protected $allowedFields = ['judul_sop', 'detail_sop'];
}
