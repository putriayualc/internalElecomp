<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BlogModel;
use App\Models\EmailModel;
use CodeIgniter\HTTP\ResponseInterface;

class BlogController extends BaseController
{
    public function index($id_email)
    {
        $blogModel = new BlogModel();
        $emailModel = new EmailModel();

        $allBlog = $blogModel->where('id_email', $id_email)->findAll();
        $email = $emailModel->where('id_email', $id_email)->first();


        $data = [
            'allBlog' => $allBlog,
            'email' => $email
        ];

        return view('pages/blog/index', $data);

    }
}
