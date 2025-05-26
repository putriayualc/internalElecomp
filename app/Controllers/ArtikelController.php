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
            ->orderBy('tgl_upload', 'DESC')
            ->first();

        $addText = 'Tambah Artikel <br>/ Backlink';
        if ($lastArtikel && $lastArtikel['jenis'] === 'backlink') {
            $addText = 'Tambah Artikel'; // Hanya boleh tambah artikel
        };

        $allArtikel = $artikelModel->where('id_blog', $id_blog)->orderBy('tgl_upload', 'DESC')->findAll();

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
        $artikelModel = new ArtikelModel();

        $data = $this->request->getPost();

        // Validasi otomatis dari model
        if (!$artikelModel->save($data)) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode('<br>', $artikelModel->errors()));
        }

        return redirect()->to(route_to('artikel', $id_email, $id_blog))
            ->with('success', 'Artikel berhasil ditambahkan.');
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

        $data = $this->request->getPost();

        // Validasi berdasarkan rules di Model
        if (!$artikelModel->validate($data)) {
            return redirect()->back()->withInput()->with('error', implode('<br>', $artikelModel->errors()));
        }

        // Update data artikel
        $artikelModel->update($id_artikel, $data);

        session()->setFlashdata('success', 'Artikel berhasil diperbarui!');
        return redirect()->to(route_to('artikel', $id_email, $id_blog));
    }

    public function delete($id_email, $id_blog, $id_artikel = false)
    {
        $artikelModel = new ArtikelModel();
        $artikel = $artikelModel->find($id_artikel);

        if ($artikel) {
            // Hapus data dari database
            $artikelModel->delete($id_artikel);

            session()->setFlashdata('success', 'Data berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Artikel tidak ditemukan');
        }

        return redirect()->to(route_to('artikel', $id_email, $id_blog));
    }
}
