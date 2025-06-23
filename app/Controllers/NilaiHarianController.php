<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AbsenModel;
use CodeIgniter\HTTP\ResponseInterface;

class NilaiHarianController extends BaseController
{
    protected $absenModel;

    public function __construct()
    {
        $this->absenModel = new AbsenModel();
    }

    public function index()
    {
        $data = [
            'allNilai' => $this->absenModel->getNilaiHarian()
        ];

        return view('pages/nilai_harian/index', $data);
    }

    public function autosave()
    {
        $id = $this->request->getPost('id_absen');
        $field = $this->request->getPost('field');
        $value = $this->request->getPost('value');

        if (!in_array($field, ['nilai_magang', 'nilai_operasional', 'feedback'])) {
            return $this->response->setStatusCode(400)->setJSON(['message' => 'Field tidak valid']);
        }

        $this->absenModel->update($id, [
            $field => $value,
            'updated_at' => date('Y-m-d')
        ]);

        return $this->response->setJSON(['message' => 'Berhasil disimpan']);
    }
}
