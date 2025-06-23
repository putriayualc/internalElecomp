<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Exception;
use App\Models\ProspekModel;
use App\Models\DetailProspekModel;

class ProspekController extends BaseController
{
    protected $prospekModel;
    protected $detailProspekModel;

    public function __construct()
    {
        $this->prospekModel = new ProspekModel();
        $this->detailProspekModel = new DetailProspekModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Prospek',
            'prospek' => $this->prospekModel->getAllProspekWithSummary()
        ];

        return view('pages/prospek/index', $data);
    }

    public function store()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $rules = [
                'judul' => [
                    'rules' => 'required|min_length[3]|max_length[255]',
                    'errors' => [
                        'required' => 'Judul prospek harus diisi',
                        'min_length' => 'Judul prospek minimal 3 karakter',
                        'max_length' => 'Judul prospek maksimal 255 karakter'
                    ]
                ],
                'sumber_data' => [
                    'rules' => 'required|min_length[3]|max_length[255]',
                    'errors' => [
                        'required' => 'Sumber data harus diisi',
                        'min_length' => 'Sumber data minimal 3 karakter',
                        'max_length' => 'Sumber data maksimal 255 karakter'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                return $this->response->setJSON([
                    'success' => false,
                    'errors' => $validation->getErrors(),
                    'message' => 'Data tidak valid'
                ]);
            }

            $data = [
                'judul' => $this->request->getPost('judul'),
                'sumber_data' => $this->request->getPost('sumber_data')
            ];

            try {
                if ($this->prospekModel->insert($data)) {
                    return $this->response->setJSON([
                        'success' => true,
                        'message' => 'Prospek berhasil ditambahkan!'
                    ]);
                } else {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Gagal menyimpan data ke database'
                    ]);
                }
            } catch (\Exception $e) {
                log_message('error', 'Error saving prospek: ' . $e->getMessage());
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Terjadi kesalahan pada server: ' . $e->getMessage()
                ]);
            }
        }

        return redirect()->to('prospek')->with('error', 'Invalid request method');
    }

    public function edit($id)
    {
        if ($this->request->isAJAX()) {
            $prospek = $this->prospekModel->find($id);

            if (!$prospek) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Prospek tidak ditemukan'
                ]);
            }

            return $this->response->setJSON([
                'success' => true,
                'data' => $prospek
            ]);
        }

        return redirect()->to('prospek');
    }

    public function update($id)
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $rules = [
                'judul' => [
                    'rules' => 'required|min_length[3]|max_length[255]',
                    'errors' => [
                        'required' => 'Judul prospek harus diisi',
                        'min_length' => 'Judul prospek minimal 3 karakter',
                        'max_length' => 'Judul prospek maksimal 255 karakter'
                    ]
                ],
                'sumber_data' => [
                    'rules' => 'required|min_length[3]|max_length[255]',
                    'errors' => [
                        'required' => 'Sumber data harus diisi',
                        'min_length' => 'Sumber data minimal 3 karakter',
                        'max_length' => 'Sumber data maksimal 255 karakter'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                return $this->response->setJSON([
                    'success' => false,
                    'errors' => $validation->getErrors(),
                    'message' => 'Data tidak valid'
                ]);
            }

            $data = [
                'judul' => $this->request->getPost('judul'),
                'sumber_data' => $this->request->getPost('sumber_data')
            ];

            try {
                if ($this->prospekModel->update($id, $data)) {
                    return $this->response->setJSON([
                        'success' => true,
                        'message' => 'Prospek berhasil diperbarui!'
                    ]);
                } else {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Gagal memperbarui data'
                    ]);
                }
            } catch (\Exception $e) {
                log_message('error', 'Error updating prospek: ' . $e->getMessage());
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Terjadi kesalahan pada server: ' . $e->getMessage()
                ]);
            }
        }

        return redirect()->to('prospek');
    }

    public function delete($id = null)
    {
        // Pastikan request method adalah POST atau DELETE
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(404);
        }

        try {
            if (!$id) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'ID prospek tidak valid'
                ]);
            }

            // Cek apakah prospek exists
            $prospek = $this->prospekModel->find($id);
            if (!$prospek) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Prospek tidak ditemukan'
                ]);
            }

            // Hapus data prospek
            $result = $this->prospekModel->delete($id);

            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Prospek berhasil dihapus'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus prospek'
                ]);
            }
        } catch (Exception $e) {
            log_message('error', 'Error deleting prospek: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    // Detail prospek (menampilkan daftar perusahaan)
    public function detail($id_prospek)
    {
        $prospek = $this->prospekModel->find($id_prospek);
        if (!$prospek) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Prospek tidak ditemukan');
        }

        // Pastikan selalu mengembalikan array, bahkan jika kosong
        $detail_prospek = $this->detailProspekModel->getDetailByProspekId($id_prospek) ?? [];

        $data = [
            'title' => 'Detail Prospek - ' . $prospek['judul'],
            'prospek' => $prospek,
            'detail_prospek' => $detail_prospek
        ];

        return view('pages/prospek/detail', $data);
    }
}
