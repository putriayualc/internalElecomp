<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProspekController extends BaseController
{
    public function index()
    {
        return view('pages/prospek/index');
    }
    public function detail()
    {
        return view('pages/prospek/detail');
    }

    public function tambah()
    {
        return view('pages/prospek/tambah');
    }
}
