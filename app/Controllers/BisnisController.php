<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BisnisModel;
use CodeIgniter\HTTP\ResponseInterface;

class BisnisController extends BaseController
{
    protected $bisnisModel;

    public function __construct()
    {
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
    public function simpan()
    {


        $nama_bisnis = $this->request->getVar('nama_bisnis');
        $website = $this->request->getVar('website');

        $data = [
            'nama_bisnis' => $nama_bisnis,
            'website' => $website,
        ];

        $this->bisnisModel->insert($data);

        session()->setFlashdata('success', 'Data berhasil disimpan');
        return redirect()->to(route_to('bisnis'));
    }
    public function update($id_bisnis = null)
    {
        if (!$id_bisnis) {
            return redirect()->back();
        }


        $nama_bisnis = $this->request->getVar('nama_bisnis');
        $website = $this->request->getVar('website');

        $bisnisData = $this->bisnisModel->find($id_bisnis);

        // Update data artikel
        $data = [
            'nama_bisnis' => $nama_bisnis,
            'website' => $website,

        ];

        $this->bisnisModel->update($id_bisnis, $data);
        session()->setFlashdata('edit_success', 'Data berhasil diperbarui');
        return redirect()->to(route_to('bisnis'));
    }

    public function delete($id_bisnis = false)
    {

        $this->bisnisModel->delete($id_bisnis);

        session()->setFlashdata('delete_success', 'Data berhasil dihapus');
        return redirect()->to(route_to('bisnis'));
    }
}
