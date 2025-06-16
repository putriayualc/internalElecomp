<?php

namespace App\Controllers;

use App\Models\ProspekModel;
use App\Models\ProspekWhatsappModel;
use App\Models\DetailProspekModel; // Ditambahkan

class ProspekWhatsappController extends BaseController
{
    protected $prospekModel;
    protected $prospekWhatsappModel;
    protected $detailProspekModel; // Ditambahkan

    public function __construct()
    {
        $this->prospekModel = new ProspekModel();
        $this->prospekWhatsappModel = new ProspekWhatsappModel();
        $this->detailProspekModel = new DetailProspekModel(); // Ditambahkan
    }

    public function index()
    {
        $data = [
            'title' => 'Prospek WhatsApp',
            // Menyesuaikan dengan logika email controller
            'prospek_whatsapp' => $this->prospekModel->getProspekWithWhatsapp(), 
            'available_prospek' => $this->prospekModel->getAvailableProspekForWhatsapp() // Asumsi method ini ada di ProspekModel
        ];

        return view('pages/whatsapp/index', $data);
    }

    // AJAX: Mendapatkan detail perusahaan dari prospek yang memiliki No. HP
    public function getProspekDetails($id_prospek)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        // Mengambil semua perusahaan dari prospek yang memiliki no_hp valid.
        $companies = $this->detailProspekModel
            ->where('id_prospek', $id_prospek)
            ->where('no_hp IS NOT NULL')
            ->where('no_hp !=', '')
            ->findAll();

        return $this->response->setJSON([
            'success' => true,
            'details' => $companies
        ]);
    }

    // Method untuk menyimpan dari Halaman Index (Batch)
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
                $this->prospekWhatsappModel->insertBatch($dataToInsert);
                return $this->response->setJSON(['success' => true, 'message' => 'Prospek WhatsApp berhasil disimpan']);
            }

            return $this->response->setJSON(['success' => false, 'message' => 'Tidak ada data yang disimpan']);
        } catch (\Exception $e) {
            log_message('error', 'Error saving WhatsApp prospek: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function detail($id_prospek)
    {
        $prospek = $this->prospekModel->find($id_prospek);
        if (!$prospek) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Prospek tidak ditemukan');
        }

        $whatsapp_history = $this->prospekWhatsappModel->getWhatsappByProspekId($id_prospek) ?? [];

        $data = [
            'title' => 'Detail WhatsApp Prospek - ' . $prospek['judul'],
            'prospek' => $prospek,
            'whatsapp_history' => $whatsapp_history
        ];

        return view('pages/whatsapp/detail', $data);
    }
    
    public function delete($id_prospek)
    {
        if (!$this->request->is('post')) {
            return $this->response->setStatusCode(405)->setJSON(['success' => false, 'message' => 'Method Not Allowed']);
        }

        try {
            $this->prospekWhatsappModel->whereIn('id_detail_prospek', function ($builder) use ($id_prospek) {
                $builder->select('id_detail_prospek')->from('tb_detail_prospek')->where('id_prospek', $id_prospek);
            })->delete();

            return $this->response->setJSON(['success' => true, 'message' => 'Prospek WhatsApp berhasil dihapus beserta semua riwayatnya']);
        } catch (\Exception $e) {
            log_message('error', 'Error deleting WhatsApp prospek: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Gagal menghapus prospek WhatsApp: ' . $e->getMessage()]);
        }
    }

    // Method untuk menyimpan WhatsApp baru dari halaman detail (mendukung multiple/batch)
    public function storeWhatsapp()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        $selectedCompanies = $this->request->getPost('selected_companies');
        $pesan = $this->request->getPost('pesan');
        $status = $this->request->getPost('status');
        $keterangan = $this->request->getPost('keterangan');

        if (empty($selectedCompanies) || !is_array($selectedCompanies)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Pilih minimal satu perusahaan.']);
        }
        if (empty($pesan) || strlen($pesan) < 10) {
            return $this->response->setJSON(['success' => false, 'message' => 'Pesan WhatsApp minimal 10 karakter.']);
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
                $this->prospekWhatsappModel->insertBatch($dataToInsert);
                return $this->response->setJSON(['success' => true, 'message' => 'Pesan WhatsApp berhasil disimpan untuk ' . count($dataToInsert) . ' perusahaan']);
            }

            return $this->response->setJSON(['success' => false, 'message' => 'Tidak ada data valid yang bisa disimpan.']);
        } catch (\Exception $e) {
            log_message('error', 'Error storing WhatsApp from detail: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // Method untuk mengupdate pesan WhatsApp (khusus dari halaman detail)
    public function updateWhatsapp($id)
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
            $whatsapp = $this->prospekWhatsappModel->find($id);
            if (!$whatsapp) {
                return $this->response->setJSON(['success' => false, 'message' => 'Pesan WhatsApp tidak ditemukan']);
            }
            $data = [
                'pesan' => $this->request->getPost('pesan'),
                'status' => $this->request->getPost('status'),
                'keterangan' => $this->request->getPost('keterangan') ?? null
            ];
            if ($this->prospekWhatsappModel->update($id, $data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Pesan WhatsApp berhasil diperbarui']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui pesan WhatsApp']);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error updating WhatsApp: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Terjadi kesalahan server: ' . $e->getMessage()]);
        }
    }
    
    // Method untuk menghapus pesan WhatsApp (khusus dari halaman detail)
    public function deleteWhatsapp($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        try {
            $whatsapp = $this->prospekWhatsappModel->find($id);
            if (!$whatsapp) {
                return $this->response->setJSON(['success' => false, 'message' => 'Pesan WhatsApp tidak ditemukan']);
            }
            if ($this->prospekWhatsappModel->delete($id)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Pesan WhatsApp berhasil dihapus']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus pesan WhatsApp']);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error deleting WhatsApp: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Terjadi kesalahan server: ' . $e->getMessage()]);
        }
    }
}