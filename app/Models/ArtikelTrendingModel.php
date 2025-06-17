<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelTrendingModel extends Model
{
    protected $table = 'tb_artikel_trending';
    protected $primaryKey = 'id_artikel_trending';
    protected $allowedFields = ['id_siswa', 'link_trending', 'tanggal_penugasan', 'tanggal_upload'];
}
