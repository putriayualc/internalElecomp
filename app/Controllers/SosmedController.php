<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BisnisModel;
use App\Models\SosmedModel;
use App\Models\UserSosmedModel;
use CodeIgniter\HTTP\ResponseInterface;

class SosmedController extends BaseController
{
    protected $sosmedModel;
    protected $bisnisModel;
    protected $userSosmedModel;

    public function __construct()
    {
        $this->sosmedModel = new SosmedModel();
        $this->bisnisModel = new BisnisModel();
        $this->userSosmedModel = new UserSosmedModel();
    }

    public function index($id_bisnis = null)
    {
        $allSosmed = $this->sosmedModel->getSosmedWithJumlahKonten();
        $allBisnis = $this->bisnisModel->findAll();
        $allUserSosmed = $this->userSosmedModel->findAll();

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

    public function tambah()
    {
        $allBisnis = $this->bisnisModel->findAll();
        $data = [
            'allBisnis' => $allBisnis,
        ];
        return view('pages/sosmed/tambah', $data);
    }

    public function simpan()
    {
        $data = $this->request->getPost();

        // Set field default tambahan
        $data['updated_at'] = date('Y-m-d');
        $data['status']     = 'aktif';

        // Validasi otomatis dari model
        if (!$this->sosmedModel->save($data)) {
            return redirect()->back()
                ->withInput()
                ->with('error', implode('<br>', $this->sosmedModel->errors()));
        }

        return redirect()->to(route_to('sosmed'))
            ->with('success', 'Akun sosial media berhasil ditambahkan.');
    }

    public function delete($id_sosmed)
    {
        $this->sosmedModel->delete($id_sosmed);
        return redirect()->to(route_to('sosmed'))->with('success', 'Data berhasil dihapus.');
    }
}
