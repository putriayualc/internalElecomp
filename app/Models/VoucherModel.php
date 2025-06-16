<?php

namespace App\Models;

use CodeIgniter\Model;

class VoucherModel extends Model
{
    protected $table = 'tb_voucher';
    protected $primaryKey = 'id_voucher';
    protected $allowedFields = [
        'kode_voucher', 'total_diskon', 'jumlah_voucher', 
        'awal_voucher', 'akhir_voucher'
    ];

    protected $useTimestamps = false;

    public function getActiveVouchers()
    {
        return $this->where('jumlah_voucher >', 0)
                   ->where('awal_voucher <=', date('Y-m-d'))
                   ->where('akhir_voucher >=', date('Y-m-d'))
                   ->findAll();
    }
} 