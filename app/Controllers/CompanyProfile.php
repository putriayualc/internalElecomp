<?php

namespace App\Controllers;

use App\Models\CompanyProfileModel;
use App\Models\VoucherModel;

class CompanyProfile extends BaseController
{
    protected $model;
    protected $voucherModel;

    public function __construct()
    {
        $this->model = new CompanyProfileModel();
        $this->voucherModel = new VoucherModel();
    }

    public function index()
    {
        $data['title'] = 'Company Profile';
        $data['profiles'] = $this->model->getProfileWithVoucher();
        $data['vouchers'] = $this->voucherModel->where('jumlah_voucher >', 0)
                                             ->where('awal_voucher <=', date('Y-m-d'))
                                             ->where('akhir_voucher >=', date('Y-m-d'))
                                             ->findAll();
        return view('pages/company_profile/index', $data);
    }

    public function create()
    {
        $data['vouchers'] = $this->voucherModel->findAll();
        return view('pages/company_profile/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama_client' => 'required',
            'nama_usaha' => 'required',
            'no_hp_client' => 'required',
            'email_client' => 'required|valid_email',
            'kota_kab_client' => 'required',
            'alamat_web' => 'required'
        ];
        
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors()
            ]);
        }

        try {
            $data = $this->request->getPost();
            $data['harga_awal'] = 3000000;
            
            if (!empty($data['id_voucher'])) {
                $voucher = $this->voucherModel->find($data['id_voucher']);
                if ($voucher) {
                    // Cek apakah voucher masih tersedia
                    if ($voucher['jumlah_voucher'] <= 0) {
                        return $this->response->setJSON([
                            'status' => 'error',
                            'message' => 'Voucher sudah habis'
                        ]);
                    }

                    // Cek apakah voucher masih aktif
                    $today = date('Y-m-d');
                    if ($today < $voucher['awal_voucher'] || $today > $voucher['akhir_voucher']) {
                        return $this->response->setJSON([
                            'status' => 'error',
                            'message' => 'Voucher sudah tidak aktif'
                        ]);
                    }

                    $potongan = ($data['harga_awal'] * $voucher['total_diskon']) / 100;
                    $data['harga_akhir'] = $data['harga_awal'] - $potongan;
                    
                    // Kurangi jumlah voucher
                    $this->voucherModel->update($data['id_voucher'], [
                        'jumlah_voucher' => $voucher['jumlah_voucher'] - 1
                    ]);
                }
            } else {
                $data['harga_akhir'] = $data['harga_awal'];
            }
            
            $this->model->save($data);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        $data['profile'] = $this->model->find($id);
        $data['vouchers'] = $this->voucherModel->findAll();
        
        if (!$data['profile']) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
        return view('pages/company_profile/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'nama_client' => 'required',
            'nama_usaha' => 'required',
            'no_hp_client' => 'required',
            'email_client' => 'required|valid_email',
            'kota_kab_client' => 'required',
            'alamat_web' => 'required'
        ];
        
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors()
            ]);
        }

        try {
            $data = $this->request->getPost();
            $data['harga_awal'] = 3000000;
            
            if (!empty($data['id_voucher'])) {
                $voucher = $this->voucherModel->find($data['id_voucher']);
                if ($voucher) {
                    // Cek apakah voucher masih tersedia
                    if ($voucher['jumlah_voucher'] <= 0) {
                        return $this->response->setJSON([
                            'status' => 'error',
                            'message' => 'Voucher sudah habis'
                        ]);
                    }

                    // Cek apakah voucher masih aktif
                    $today = date('Y-m-d');
                    if ($today < $voucher['awal_voucher'] || $today > $voucher['akhir_voucher']) {
                        return $this->response->setJSON([
                            'status' => 'error',
                            'message' => 'Voucher sudah tidak aktif'
                        ]);
                    }

                    $potongan = ($data['harga_awal'] * $voucher['total_diskon']) / 100;
                    $data['harga_akhir'] = $data['harga_awal'] - $potongan;
                }
            } else {
                $data['harga_akhir'] = $data['harga_awal'];
            }
            
            $this->model->update($id, $data);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal mengupdate data: ' . $e->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $this->model->delete($id);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ]);
        }
    }

    public function get($id)
    {
        $profile = $this->model->getProfileWithVoucher($id);
        if (!$profile) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
        
        return $this->response->setJSON([
            'status' => true,
            'data' => $profile
        ]);
    }
}
