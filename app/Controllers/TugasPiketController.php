<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TugasPiketModel;

class TugasPiketController extends BaseController
{
    protected $tugasPiketModel;

    public function __construct()
    {
        $this->tugasPiketModel = new TugasPiketModel();
    }

    public function index()
    {
        $data = [
            'tugasPiket' => $this->tugasPiketModel->findAll()
        ];

        return view('pages/tugasPiket/index', $data); // pastikan ada view sop/index.php
    }

    public function tambah()
    {
        return view('pages/tugasPiket/tambah');
    }

    public function simpan()
    {
        $this->tugasPiketModel->save([
            'nama_tugas'  => $this->request->getPost('nama_tugas'),
            'bobot' => $this->request->getPost('bobot'),
        ]);

        return redirect()->to('tugasPiket')->with('success', 'Data Tugas Piket berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = [
            'tugasPiket' => $this->tugasPiketModel->find($id)
        ];

        return view('pages/tugasPiket/edit', $data);
    }

    public function update($id)
    {
        $this->tugasPiketModel->update($id, [
            'nama_tugas'  => $this->request->getPost('nama_tugas'),
            'bobot' => $this->request->getPost('bobot'),
        ]);

        return redirect()->to('tugasPiket')->with('success', 'Data Tugas Piket berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->tugasPiketModel->delete($id);
        return redirect()->to('tugasPiket')->with('success', 'Data Tugas Piket berhasil dihapus.');
    }

    public function detail($id)
    {
        $data = [
            'tugasPiket' => $this->tugasPiketModel->find($id)
        ];

        return view('pages/tugasPiket/detail', $data);
    }
}
