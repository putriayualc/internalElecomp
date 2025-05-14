<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class WhatsappController extends BaseController
{
    public function index()
    {
        return view('pages/whatsapp/index');
    }

    public function detail()
    {
        return view('pages/whatsapp/detail');
    }
}