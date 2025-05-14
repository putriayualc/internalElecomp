<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BisnisModel;
use App\Models\SosmedModel;
use CodeIgniter\HTTP\ResponseInterface;

class SosmedController extends BaseController
{
    protected $sosmedModel;
    protected $bisnisModel;

    public function __construct() {
        $this->sosmedModel = new SosmedModel();
        $this->bisnisModel = new BisnisModel();
    }

    public function index($id_bisnis = null)
    {
        $allSosmed = $this->sosmedModel->getSosmedWithJumlahKonten();
        $allBisnis = $this->bisnisModel->findAll();

        if (!empty($id_bisnis) && $id_bisnis) {
            $allSosmed = $this->sosmedModel->getSosmedWithJumlahKonten($id_bisnis);
        } else {
            $allSosmed = $this->sosmedModel->getSosmedWithJumlahKonten();
        }
        // dd($allBisnis);
        $data = [
            'allSosmed' => $allSosmed,
            'allBisnis' => $allBisnis,
            'id_bisnis' => $id_bisnis
        ];

        return view('pages/sosmed/index', $data);
    }
}
