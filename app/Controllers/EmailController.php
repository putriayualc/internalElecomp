<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class EmailController extends BaseController
{
    public function index()
    {
        return view('pages/email/index');
    }

    public function detail()
    {
        return view('pages/email/detail');
    }
}
