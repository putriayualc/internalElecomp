<?php

namespace App\Controllers;

use App\Models\ArtikelTrendingModel;

class ArtikelTrending extends BaseController
{
    protected $artikelModel;

    public function __construct()
    {
        $this->artikelModel = new ArtikelTrendingModel();
    }

    public function index()
    {
        $data['artikel'] = $this->artikelModel->findAll();
        return view('pages/artikel_trending/index', $data);
    }

    public function tambah()
    {
        return view('pages/artikel_trending/tambah');
    }

    public function simpan()
    {
  $artikelTrendingModel = new ArtikelTrendingModel();

        $data = [
            'id_siswa'          => session()->get('id_siswa'), // otomatis dari session
            'link_trending'     => $this->request->getPost('link_trending'),
            'tanggal_penugasan' => $this->request->getPost('tanggal_penugasan'),
            'tanggal_upload'    => date('Y-m-d H:i:s') // otomatis isi waktu upload
        ];
        $artikelTrendingModel->insert($data);
         return redirect()->to('/artikeltrending')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function hapus($id)
    {
        $this->artikelModel->delete($id);
        return redirect()->to('/artikeltrending');
    }
    
  
    }

