<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SOPController extends BaseController
{
    public function index(): string
    {
        return view('pages/sop/index');
    }
}

