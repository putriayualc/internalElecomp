<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;
use CodeIgniter\HTTP\ResponseInterface;

class ArtikelController extends BaseController
{
    public function index($id_email, $id_blog)
    {
        $artikelModel = new ArtikelModel();

        $allArtikel = $artikelModel->where('id_blog', $id_blog)->findAll();

        $data = [
            'allArtikel' => $allArtikel
        ];

        return view('pages/artikel/index', $data);

    }
}
