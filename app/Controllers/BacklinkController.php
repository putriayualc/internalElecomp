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
}
