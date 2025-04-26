<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;
use App\Models\BlogModel;
use App\Models\EmailModel;
use CodeIgniter\HTTP\ResponseInterface;

class ArtikelController extends BaseController
{
    public function index($id_email, $id_blog)
    {
        $artikelModel = new ArtikelModel();
        $blogModel = new BlogModel();
        $emailModel = new EmailModel();

        $lastArtikel = $artikelModel
            ->where('id_blog', $id_blog)
            ->orderBy('id_artikel', 'DESC')
            ->first();

        $addText = 'Tambah Artikel <br>/ Backlink';
        if ($lastArtikel && $lastArtikel['jenis'] === 'backlink') {
            $addText = 'Tambah Artikel'; // Hanya boleh tambah artikel
        };

        $allArtikel = $artikelModel->where('id_blog', $id_blog)->findAll();

        $data = [
            'allArtikel' => $allArtikel,
            'blog' => $blogModel->find($id_blog),
            'addText' => $addText
        ];

        return view('pages/artikel/index', $data);
    }

    public function tambah($id_email, $id_blog)
    {
        $artikelModel = new ArtikelModel();
        // Ambil artikel terakhir dari blog ini
        $lastArtikel = $artikelModel
            ->where('id_blog', $id_blog)
            ->orderBy('id_artikel', 'DESC')
            ->first();

        // dd($lastArtikel);

        $allowedJenis = ['artikel', 'backlink'];
        if ($lastArtikel && $lastArtikel['jenis'] === 'backlink') {
            $allowedJenis = ['artikel']; // Hanya boleh tambah artikel
        }

        return view('pages/artikel/tambah', [
            'id_blog' => $id_blog,
            'id_email' => $id_email,
            'jenis' => $allowedJenis
        ]);
    }

    public function proses_tambah($id_email, $id_blog)
    {
        // Validasi form
        $validation = \Config\Services::validation();

        $validation->setRules([
            'judul_artikel' => 'required|alpha_numeric_space',
            'deskripsi_artikel' => 'required',
            'tanggal_upload' => 'required|valid_date',
            'jenis_artikel' => 'required|in_list[artikel,backlink]',
            'foto_artikel' => 'uploaded[foto_artikel]|is_image[foto_artikel]|mime_in[foto_artikel,image/jpg,image/jpeg,image/png]|max_dims[foto_artikel,572,572]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode('<br>', $validation->getErrors()));
        }

        // Ambil inputan
        $judul = $this->request->getPost('judul_artikel');
        $deskripsi = $this->request->getPost('deskripsi_artikel');
        $tanggal = $this->request->getPost('tanggal_upload');
        $jenis = $this->request->getPost('jenis_artikel');

        // Handle upload file
        $fileGambar = $this->request->getFile('foto_artikel');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('assets/img/artikel', $namaGambar);

        // Simpan ke database (asumsikan kamu sudah punya model ArtikelModel)
        $artikelModel = new ArtikelModel();
        $artikelModel->insert([
            'id_blog' => $id_blog,
            'judul_artikel' => $judul,
            'deskripsi_artikel' => $deskripsi,
            'tgl_upload' => $tanggal,
            'jenis' => $jenis,
            'foto' => $namaGambar
        ]);

        return redirect()->to(route_to('artikel', $id_email, $id_blog))->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit($id_email, $id_blog, $id_artikel)
    {
        $artikelModel = new ArtikelModel();
        $artikel = $artikelModel->find($id_artikel);

        if (!$artikel) {
            session()->setFlashdata('error', 'Artikel tidak ditemukan');
            return redirect()->to(route_to('artikel', $id_email, $id_blog));
        }

        return view('pages/artikel/edit', [
            'artikel' => $artikel,
            'id_email' => $id_email,
            'id_blog' => $id_blog
        ]);
    }

    public function update($id_email, $id_blog, $id_artikel)
    {
        $artikelModel = new ArtikelModel();
        $artikelLama = $artikelModel->find($id_artikel);

        if (!$artikelLama) {
            session()->setFlashdata('error', 'Artikel tidak ditemukan');
            return redirect()->to(route_to('artikel', $id_email, $id_blog));
        }

        // Validasi input
        $validationRules = [
            'judul_artikel' => 'required|alpha_numeric_space',
            'deskripsi_artikel' => 'required',
            'tanggal_upload' => 'required',
            'jenis' => 'required|in_list[artikel,backlink]',
            'foto_artikel' => 'is_image[foto_artikel]|mime_in[foto_artikel,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $data = [
            'judul_artikel' => $this->request->getPost('judul_artikel'),
            'deskripsi_artikel' => $this->request->getPost('deskripsi_artikel'),
            'tgl_upload' => $this->request->getPost('tanggal_upload'),
            'jenis' => $this->request->getPost('jenis')
        ];

        // Cek jika ada gambar baru
        $fileGambar = $this->request->getFile('foto_artikel');
        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            // Hapus gambar lama
            if (!empty($artikelLama['foto']) && file_exists(FCPATH . 'assets/img/artikel/' . $artikelLama['foto'])) {
                unlink(FCPATH . 'assets/img/artikel/' . $artikelLama['foto']);
            }

            $namaGambarBaru = $fileGambar->getRandomName();
            $fileGambar->move(FCPATH . 'assets/img/artikel/', $namaGambarBaru);
            $data['foto'] = $namaGambarBaru;
        }

        $artikelModel->update($id_artikel, $data);

        session()->setFlashdata('success', 'Artikel berhasil diperbarui!');
        return redirect()->to(route_to('artikel', $id_email, $id_blog));
    }


    public function delete($id_email, $id_blog, $id_artikel = false)
    {
        $artikelModel = new ArtikelModel();
        $artikel = $artikelModel->find($id_artikel);

        if ($artikel) {
            // Cek apakah kolom foto tidak kosong
            if (!empty($artikel['foto'])) {
                $filePath = FCPATH . 'assets/img/artikel/' . $artikel['foto'];

                // Cek apakah file benar-benar ada dan bisa dihapus
                if (file_exists($filePath) && is_file($filePath)) {
                    unlink($filePath); // Hapus file gambar dari server
                }
            }

            // Hapus data dari database
            $artikelModel->delete($id_artikel);

            session()->setFlashdata('success', 'Data berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Artikel tidak ditemukan');
        }

        return redirect()->to(route_to('artikel', $id_email, $id_blog));
    }
}
