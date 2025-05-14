<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BisnisModel;
use App\Models\KontenModel;
use App\Models\SosmedModel;
use CodeIgniter\HTTP\ResponseInterface;

class KontenController extends BaseController
{

    protected $sosmedModel;
    protected $bisnisModel;
    protected $kontenModel;

    public function __construct()
    {
        $this->sosmedModel = new SosmedModel();
        $this->bisnisModel = new BisnisModel();
        $this->kontenModel = new KontenModel();
    }

    public function index($id_bisnis = null)
    {
        $allBisnis = $this->bisnisModel->findAll();

        if (!empty($id_bisnis) && $id_bisnis) {
            $allKonten = $this->kontenModel->getKontenWithPlatforms($id_bisnis);
        } else {
            $allKonten = $this->kontenModel->getKontenWithPlatforms();
        }

        foreach ($allKonten as &$konten) {
            $konten['platforms'] = explode(',', $konten['platforms'] ?? '');
            $konten['akun_platform'] = explode(',', $konten['akun_platform'] ?? '');
        }

        // dd($allKonten);

        // dd($allBisnis);
        $data = [
            'allKonten' => $allKonten,
            'allBisnis' => $allBisnis,
            'id_bisnis' => $id_bisnis
        ];

        return view('pages/konten_sosmed/index', $data);
    }
}
