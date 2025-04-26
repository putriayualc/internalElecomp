<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmailModel;
use CodeIgniter\HTTP\ResponseInterface;

class BacklinkController extends BaseController
{
    public function index()
    {
        $emailModel = new EmailModel();

        $allEmail = $emailModel->findAll();

        $data = [
            'allEmail' => $allEmail,
        ];

        // dd($data);

        return view('pages/backlink/index', $data);
    }
    public function tambah()
    {
        $emailModel = new EmailModel();

        $allEmail = $emailModel->findAll();

        $data = [
            'allEmail' => $allEmail,
        ];

        // dd($data);

        return view('pages/backlink/tambah', $data);
    }
    public function proses_tambah()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = [
            'email' => $email,
            'password' => $password
        ];
        $emailModel = new EmailModel();
        $emailModel->insert($data);

        return redirect()->to(route_to('backlink'));
    }
    public function edit($id_email)
    {
        $emailModel = new EmailModel();

        $allEmail = $emailModel->find($id_email);


        // dd($data);

        return view('pages/backlink/edit', ['allEmail' => $allEmail]);
    }
    public function proses_edit($id_email)
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = [
            'email' => $email,
            'password' => $password
        ];
        $emailModel = new EmailModel();
        $emailModel->update($id_email, $data);
        return redirect()->to(route_to('backlink'));
    }
    public function delete($id = false)
    {
        $emailModel = new EmailModel();
        $allEmail = $emailModel->find($id);
        // dd($allEmail);
        $emailModel->delete($id);

        return redirect()->to(route_to('backlink'));
    }
}
