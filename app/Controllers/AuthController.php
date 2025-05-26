<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function index()
    {
        return view('pages/auth/index');
    }

    public function proses_login()
    {
        $username = $this->request->getPost('username');
        $pass = $this->request->getPost('password');

        // Validasi input
        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'username' => [
                'label'  => 'Username',
                'rules'  => 'required',
                'errors' => [
                    'required'  => '{field} tidak boleh kosong'
                ]
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required'  => '{field} tidak boleh kosong'
                ]
            ],
        ]);

        // Jika validasi gagal
        if (!$valid) {
            session()->setFlashdata('errMessages', $validation->getErrors());
            return redirect()->to(site_url('login'));
        }

        $userModel = new UsersModel();

        // Cek apakah username ada
        $user = $userModel->where('username', $username)->first();

        if ($user == null) {
            session()->setFlashdata('error', 'Username tidak terdaftar');
            return redirect()->to(site_url('login'));
        }

        // Verifikasi password
        if (password_verify($pass, $user['password'])) {
            // Set session setelah login sukses
            session()->set([
                'id_user' => $user['id_user'],
                'username' => $user['username'],
                'role' => $user['role'],
                'is_logged_in' => true
            ]);

            return redirect()->to(site_url('/'));
        } else {
            session()->setFlashdata('error', 'Password salah');
            return redirect()->to(site_url('login'));
        }
    }

    public function logout()
    {
        // Hapus session login
        session()->destroy();
        return redirect()->to(site_url('login'));
    }
}
