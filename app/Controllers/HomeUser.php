<?php

namespace App\Controllers;

use App\Models\SiswaModel;

class HomeUser extends BaseController
{
    public function index(): string
    {
        if (!session()->get('status_siswa_checked')) {
            $siswaModel = new SiswaModel();
            $siswaModel->updateStatus();
            session()->set('status_siswa_checked', true); // Cegah dipanggil lagi selama sesi
        }
        return view('pages/dashboard/user');
    }
}
