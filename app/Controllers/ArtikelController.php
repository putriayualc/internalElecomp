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

        $allArtikel = $artikelModel->where('id_blog', $id_blog)->findAll();

        $data = [
            'allArtikel' => $allArtikel,
            'blog' => $blogModel->find($id_blog),
            'email' => $emailModel->find($id_email),
        ];

        return view('pages/artikel/index', $data);
    }

    public function tambah($id_email, $id_blog)
    {
        $blogModel = new BlogModel();

        $blog = $blogModel->find($id_blog);

        return view('pages/artikel/tambah', [
            'blog' => $blog
        ]);
    }

    public function proses_tambah($id_email, $id_blog)
    {
        // dd($id_email);

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
