<?php

namespace App\Controllers;

class HomeUser extends BaseController
{
    public function index(): string
    {
        return view('pages/dashboard/user');
    }
}
