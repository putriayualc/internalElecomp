<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BisnisModel;
use CodeIgniter\HTTP\ResponseInterface;

class BisnisController extends BaseController
{
    protected $bisnisModel;

    public function __construct() {
        $this->bisnisModel = new BisnisModel();
    }
    public function index()
    {
        $allBisnis = $this->bisnisModel->getBisnisWithJumlahSosmed();
        
        $data = [
            'allBisnis' => $allBisnis,
        ];

        return view('pages/bisnis/index', $data);
    }
}
