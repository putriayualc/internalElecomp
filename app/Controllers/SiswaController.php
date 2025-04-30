<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class SiswaController extends BaseController
{
    protected $siswaModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {
        $allSiswa = $this->siswaModel->findAll();

        return view('pages/siswa/index', [
            'allSiswa' => $allSiswa
        ]);
    }
}
