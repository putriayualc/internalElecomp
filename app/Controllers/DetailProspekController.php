<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DetailProspekModel;
use App\Models\ProspekModel;

class DetailProspekController extends BaseController
{
    protected $detailProspekModel;
    protected $prospekModel;

    public function __construct()
    {
        $this->detailProspekModel = new DetailProspekModel();
        $this->prospekModel = new ProspekModel();
    }

    // Method untuk menampilkan halaman detail prospek
    public function index($id_prospek)
    {
        // Ambil data prospek
        $prospek = $this->prospekModel->find($id_prospek);
        if (!$prospek) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Prospek tidak ditemukan');
        }

        // Ambil detail perusahaan dalam prospek
        $detail_prospek = $this->detailProspekModel->getDetailByProspekId($id_prospek);

        $data = [
            'title' => 'Detail Prospek: ' . $prospek['judul'],
            'prospek' => $prospek,
            'detail_prospek' => $detail_prospek
        ];

        return view('prospek/detail', $data);
    }

    // Method untuk mengambil detail prospek berdasarkan ID prospek (untuk AJAX)
    public function getByProspek($id_prospek)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Invalid request method'
            ]);
        }

        try {
            $detail_prospek = $this->detailProspekModel->where('id_prospek', $id_prospek)->findAll();
            
            return $this->response->setJSON($detail_prospek);
        } catch (\Exception $e) {
            log_message('error', 'Error getting detail prospek: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan server'
            ]);
        }
    }

    public function store($id_prospek)
    {
        log_message('debug', 'Data received: ' . print_r($this->request->getPost(), true));
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Validasi input
        $validation = \Config\Services::validation();
        $rules = [
            'nama_perusahaan' => 'required|min_length[2]|max_length[255]',
            'email' => 'permit_empty|valid_email',
            'alamat' => 'permit_empty',
            'no_hp' => 'permit_empty|min_length[10]|max_length[15]',
            'no_telepon' => 'permit_empty|min_length[7]|max_length[15]',
            'website' => 'permit_empty|valid_url',
            'tanggal' => 'permit_empty|valid_date',
            'keterangan_lainnya' => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors(),
                'message' => 'Validasi gagal'
            ]);
        }

        try {
            $data = [
                'id_prospek' => $id_prospek,
                'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
                'alamat' => $this->request->getPost('alamat') ?? '',
                'email' => $this->request->getPost('email') ?? '',
                'no_hp' => $this->request->getPost('no_hp') ?? '',
                'no_telepon' => $this->request->getPost('no_telepon') ?? '',
                'website' => $this->request->getPost('website') ?? '',
                'tanggal' => $this->request->getPost('tanggal') ?? date('Y-m-d'),
                'keterangan_lainnya' => $this->request->getPost('keterangan_lainnya') ?? ''
            ];

            $saved = $this->detailProspekModel->insert($data);

            if (!$saved) {
                throw new \RuntimeException('Gagal menyimpan data');
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Data berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error in store: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function update($id)
    {
        // Cek apakah request adalah AJAX
        if (!$this->request->isAJAX()) {
            return redirect()->back()->with('error', 'Method not allowed');
        }

        $validation = \Config\Services::validation();

        $rules = [
            'nama_perusahaan' => [
                'rules' => 'required|min_length[2]|max_length[255]',
                'errors' => [
                    'required' => 'Nama perusahaan harus diisi',
                    'min_length' => 'Nama perusahaan minimal 2 karakter',
                    'max_length' => 'Nama perusahaan maksimal 255 karakter'
                ]
            ],
            'email' => [
                'rules' => 'permit_empty|valid_email',
                'errors' => [
                    'valid_email' => 'Format email tidak valid'
                ]
            ],
            'website' => [
                'rules' => 'permit_empty|valid_url',
                'errors' => [
                    'valid_url' => 'Format website tidak valid'
                ]
            ],
            'no_hp' => [
                'rules' => 'permit_empty|min_length[10]|max_length[15]',
                'errors' => [
                    'min_length' => 'No HP minimal 10 digit',
                    'max_length' => 'No HP maksimal 15 digit'
                ]
            ],
            'no_telepon' => [
                'rules' => 'permit_empty|min_length[7]|max_length[15]',
                'errors' => [
                    'min_length' => 'No Telepon minimal 7 digit',
                    'max_length' => 'No Telepon maksimal 15 digit'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $validation->getErrors()
            ]);
        }

        $detail = $this->detailProspekModel->find($id);
        if (!$detail) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data perusahaan tidak ditemukan'
            ]);
        }

        $data = [
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'alamat' => $this->request->getPost('alamat') ?: '',
            'no_hp' => $this->request->getPost('no_hp') ?: '',
            'no_telepon' => $this->request->getPost('no_telepon') ?: '',
            'email' => $this->request->getPost('email') ?: '',
            'website' => $this->request->getPost('website') ?: '',
            'tanggal' => $this->request->getPost('tanggal') ?: date('Y-m-d'),
            'keterangan_lainnya' => $this->request->getPost('keterangan_lainnya') ?: ''
        ];

        try {
            $result = $this->detailProspekModel->update($id, $data);
            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Data perusahaan berhasil diperbarui!'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal memperbarui data perusahaan'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error updating detail prospek: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server: ' . $e->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        // Cek apakah request adalah AJAX
        if (!$this->request->isAJAX()) {
            return redirect()->back()->with('error', 'Method not allowed');
        }

        $detail = $this->detailProspekModel->find($id);

        if (!$detail) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data perusahaan tidak ditemukan'
            ]);
        }

        try {
            $result = $this->detailProspekModel->delete($id);
            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Data perusahaan berhasil dihapus!'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus data perusahaan'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error deleting detail prospek: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server: ' . $e->getMessage()
            ]);
        }
    }

    public function getDetail($id)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->to('prospek');
        }

        $detail = $this->detailProspekModel->find($id);

        if (!$detail) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data perusahaan tidak ditemukan'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $detail
        ]);
    }
}