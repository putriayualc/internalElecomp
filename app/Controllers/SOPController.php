<?php

namespace App\Controllers;

use App\Models\SopModel;

class SopController extends BaseController
{
    protected $sopModel;

    public function __construct()
    {
        $this->sopModel = new SopModel();
    }

    // Tampilkan halaman daftar SOP
    public function index()
    {
        $data = [
            'allSop' => $this->sopModel->findAll()
        ];

        return view('pages/sop/index', $data); // pastikan ada view sop/index.php
    }

    // Form tambah SOP
    public function tambah()
    {
        return view('pages/sop/tambah');
    }

    // Simpan data SOP baru
    public function simpan()
    {
        $this->sopModel->save([
            'judul_sop'  => $this->request->getPost('judul_sop'),
            'detail_sop' => $this->request->getPost('detail_sop'),
        ]);

        return redirect()->to('sop')->with('success', 'Data SOP berhasil ditambahkan.');
    }

    // Form edit SOP
    public function edit($id)
    {
        $data = [
            'sop' => $this->sopModel->find($id)
        ];

        return view('pages/sop/edit', $data);
    }

    // Update data SOP
    public function update($id)
    {
        $this->sopModel->update($id, [
            'judul_sop'  => $this->request->getPost('judul_sop'),
            'detail_sop' => $this->request->getPost('detail_sop'),
        ]);

        return redirect()->to('sop')->with('success', 'Data SOP berhasil diperbarui.');
    }

    // Hapus SOP
    public function delete($id)
    {
        $this->sopModel->delete($id);
        return redirect()->to('sop')->with('success', 'Data SOP berhasil dihapus.');
    }

    // Detail SOP (opsional)
    public function detail($id)
    {
        $data = [
            'sop' => $this->sopModel->find($id)
        ];

        return view('pages/sop/detail', $data);
    }
}
