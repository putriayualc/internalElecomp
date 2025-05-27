<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArtikelInternalModel;
use App\Models\BisnisModel;
use App\Models\UsersModel;

class ArtikelInternalController extends BaseController
{
    protected $artikelModel;
    protected $bisnisModel;
    protected $usersModel;

    public function __construct()
    {
        $this->artikelModel = new ArtikelInternalModel();
        $this->bisnisModel = new BisnisModel();
        $this->usersModel  = new UsersModel();
    }

    public function index()
    {
        $data = [
            'allBisnis'  => $this->bisnisModel->findAll(),
            'allUsers'   => $this->usersModel->findAll(),
            'allArtikel' => $this->artikelModel->getArtikelWithRelations(),

        ];

        return view('pages/artikel_internal/index', $data);
    }

    public function tambah()
    {
        $data = [
            'allBisnis' => $this->bisnisModel->findAll(),
            'allUsers'  => $this->usersModel->findAll(),
        ];

        return view('pages/artikel_internal/tambah', $data);
    }

    public function simpan()
    {
        $postData = $this->request->getPost();

        $this->artikelModel->insert([
            'id_bisnis'     => $postData['id_bisnis'],
            'id_user'       => $postData['id_user'],
            'judul_artikel' => $postData['judul_artikel'],
            'tgl_upload'    => $postData['tgl_upload'],
            'link'          => $postData['link'],
            'keyword'       => $postData['keyword'],
        ]);

        return redirect()->to('/artikel_internal')->with('success', 'Artikel internal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $artikel = $this->artikelModel->find($id);

        if (!$artikel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Artikel tidak ditemukan');
        }

        $data = [
            'artikel'    => $artikel,
            'allBisnis'  => $this->bisnisModel->findAll(),
            'allUsers'   => $this->usersModel->findAll(),
        ];

        return view('pages/artikel_internal/edit', $data);
    }

    public function update($id)
    {
        $postData = $this->request->getPost();

        $this->artikelModel->update($id, [
            'id_bisnis'     => $postData['id_bisnis'],
            'id_user'       => $postData['id_user'],
            'judul_artikel' => $postData['judul_artikel'],
            'tgl_upload'    => $postData['tgl_upload'],
            'link'          => $postData['link'],
            'keyword'       => $postData['keyword'],
        ]);

        return redirect()->to('/artikel_internal')->with('success', 'Artikel internal berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->artikelModel->delete($id);
        return redirect()->to('/artikel_internal')->with('success', 'Artikel internal berhasil dihapus.');
    }
}
