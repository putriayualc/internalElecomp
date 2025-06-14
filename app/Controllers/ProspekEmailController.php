<?php

namespace App\Controllers;

use App\Models\ProspekModel;
use App\Models\ProspekEmailModel;
use App\Models\DetailProspekModel;

class ProspekEmailController extends BaseController
{
    protected $prospekModel;
    protected $prospekEmailModel;
    protected $detailProspekModel;

    public function __construct()
    {
        $this->prospekModel = new ProspekModel();
        $this->prospekEmailModel = new ProspekEmailModel();
        $this->detailProspekModel = new DetailProspekModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Prospek Email',
            'prospek_email' => $this->prospekModel->getProspekWithEmail(),
            'available_prospek' => $this->prospekModel->getAvailableProspekForEmail()
        ];

        return view('pages/email/index', $data);
    }

    // AJAX: Mendapatkan detail perusahaan dari prospek
    public function getProspekDetails($id_prospek)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        // --- PERUBAHAN ---
        // Mengambil semua perusahaan dari prospek yang memiliki email valid.
        // Ini memungkinkan perusahaan yang sama untuk di-email kembali.
        $companies = $this->detailProspekModel
            ->where('id_prospek', $id_prospek)
            ->where('email IS NOT NULL')
            ->where('email !=', '')
            ->findAll();

        return $this->response->setJSON([
            'success' => true,
            'details' => $companies
        ]);
    }

    // Method untuk menyimpan dari Halaman Index
    public function store()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        $selectedCompanies = $this->request->getPost('selected_companies');
        $pesan = $this->request->getPost('pesan');
        $status = $this->request->getPost('status');
        $keterangan = $this->request->getPost('keterangan');

        if (empty($selectedCompanies) || strlen($pesan) < 10) {
            return $this->response->setJSON(['success' => false, 'message' => 'Pilih minimal satu perusahaan dan pesan minimal 10 karakter']);
        }

        try {
            $dataToInsert = [];
            $currentDate = date('Y-m-d H:i:s');

            foreach ($selectedCompanies as $companyId) {
                $company = $this->detailProspekModel->find($companyId);
                if ($company) {
                    $dataToInsert[] = [
                        'id_detail_prospek' => $companyId,
                        'nama_perusahaan' => $company['nama_perusahaan'],
                        'pesan' => $pesan,
                        'tanggal' => $currentDate,
                        'status' => $status,
                        'keterangan' => $keterangan
                    ];
                }
            }

            if (!empty($dataToInsert)) {
                $this->prospekEmailModel->insertBatch($dataToInsert);
                return $this->response->setJSON(['success' => true, 'message' => 'Email prospek berhasil disimpan']);
            }

            return $this->response->setJSON(['success' => false, 'message' => 'Tidak ada data yang disimpan']);
        } catch (\Exception $e) {
            log_message('error', 'Error saving email prospek: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function detail($id_prospek)
    {
        $prospek = $this->prospekModel->find($id_prospek);
        if (!$prospek) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Prospek tidak ditemukan');
        }

        $email_history = $this->prospekEmailModel->getEmailByProspekId($id_prospek) ?? [];

        $data = [
            'title' => 'Detail Email Prospek - ' . $prospek['judul'],
            'prospek' => $prospek,
            'email_history' => $email_history
        ];

        return view('pages/email/detail', $data);
    }

    public function update()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        $id = $this->request->getPost('id_prospek_email');
        $data = [
            'pesan' => $this->request->getPost('pesan'),
            'status' => $this->request->getPost('status'),
            'keterangan' => $this->request->getPost('keterangan')
        ];

        try {
            if ($this->prospekEmailModel->update($id, $data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Email berhasil diperbarui']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui email']);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error updating email: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
    
    public function delete($id_prospek)
    {
        if (!$this->request->is('post')) {
            return $this->response->setStatusCode(405)->setJSON(['success' => false, 'message' => 'Method Not Allowed']);
        }

        try {
            $this->prospekEmailModel->whereIn('id_detail_prospek', function ($builder) use ($id_prospek) {
                $builder->select('id_detail_prospek')->from('tb_detail_prospek')->where('id_prospek', $id_prospek);
            })->delete();

            return $this->response->setJSON(['success' => true, 'message' => 'Prospek email berhasil dihapus beserta semua riwayatnya']);
        } catch (\Exception $e) {
            log_message('error', 'Error deleting email prospek: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Gagal menghapus prospek email: ' . $e->getMessage()]);
        }
    }

    // --- PERUBAHAN ---
    // Method untuk menyimpan email baru dari halaman detail (sekarang mendukung multiple/batch)
    public function storeEmail()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        // Validasi input
        $selectedCompanies = $this->request->getPost('selected_companies');
        $pesan = $this->request->getPost('pesan');
        $status = $this->request->getPost('status');
        $keterangan = $this->request->getPost('keterangan');

        if (empty($selectedCompanies) || !is_array($selectedCompanies)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Pilih minimal satu perusahaan.']);
        }
        if (empty($pesan) || strlen($pesan) < 10) {
            return $this->response->setJSON(['success' => false, 'message' => 'Pesan email minimal 10 karakter.']);
        }

        try {
            $dataToInsert = [];
            $currentDate = date('Y-m-d H:i:s');

            foreach ($selectedCompanies as $companyId) {
                $company = $this->detailProspekModel->find($companyId);
                if ($company) {
                    $dataToInsert[] = [
                        'id_detail_prospek' => $companyId,
                        'nama_perusahaan' => $company['nama_perusahaan'],
                        'pesan' => $pesan,
                        'tanggal' => $currentDate,
                        'status' => $status,
                        'keterangan' => $keterangan ?? null
                    ];
                }
            }

            if (!empty($dataToInsert)) {
                $this->prospekEmailModel->insertBatch($dataToInsert);
                return $this->response->setJSON(['success' => true, 'message' => 'Email berhasil disimpan untuk ' . count($dataToInsert) . ' perusahaan']);
            }

            return $this->response->setJSON(['success' => false, 'message' => 'Tidak ada data valid yang bisa disimpan.']);
        } catch (\Exception $e) {
            log_message('error', 'Error storing email from detail: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // Method untuk mengupdate email (khusus dari halaman detail)
    public function updateEmail($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        $validation = \Config\Services::validation();
        $rules = [
            'pesan' => 'required|min_length[10]',
            'status' => 'required|in_list[terkirim,pending,gagal]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors(), 'message' => 'Validasi gagal']);
        }

        try {
            $email = $this->prospekEmailModel->find($id);
            if (!$email) {
                return $this->response->setJSON(['success' => false, 'message' => 'Email tidak ditemukan']);
            }
            $data = [
                'pesan' => $this->request->getPost('pesan'),
                'status' => $this->request->getPost('status'),
                'keterangan' => $this->request->getPost('keterangan') ?? null
            ];
            if ($this->prospekEmailModel->update($id, $data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Email berhasil diperbarui']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui email']);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error updating email: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Terjadi kesalahan server: ' . $e->getMessage()]);
        }
    }
    
    // Method untuk menghapus email (khusus dari halaman detail)
    public function deleteEmail($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        try {
            $email = $this->prospekEmailModel->find($id);
            if (!$email) {
                return $this->response->setJSON(['success' => false, 'message' => 'Email tidak ditemukan']);
            }
            if ($this->prospekEmailModel->delete($id)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Email berhasil dihapus']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus email']);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error deleting email: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Terjadi kesalahan server: ' . $e->getMessage()]);
        }
    }
}