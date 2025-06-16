<?php namespace App\Models;

use CodeIgniter\Model;

class CompanyProfileModel extends Model
{
    protected $table = 'tb_compro_client';
    protected $primaryKey = 'id_compro';
    protected $allowedFields = [
        'alamat_web', 'nama_client', 'nama_usaha', 'no_hp_client', 
        'email_client', 'kota_kab_client', 'harga_awal', 'id_voucher', 'harga_akhir'
    ];

    protected $useTimestamps = false;

    public function getProfileWithVoucher($id = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('tb_compro_client.*, tb_voucher.kode_voucher, tb_voucher.total_diskon as potongan');
        $builder->join('tb_voucher', 'tb_voucher.id_voucher = tb_compro_client.id_voucher', 'left');
        
        if ($id !== null) {
            $builder->where('tb_compro_client.id_compro', $id);
            return $builder->get()->getRowArray();
        }
        
        return $builder->get()->getResultArray();
    }
}
