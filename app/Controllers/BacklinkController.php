<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BacklinkController extends BaseController
{
    public function index(): string
    {
        return view('pages/backlink/index');
    }
}
