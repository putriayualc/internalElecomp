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

    public function proses_tambah($id_email)
    {
        $blogModel = new BlogModel();

        // Validasi input
        $validation = \Config\Services::validation();
        $rules = [
            'domain_blog' => 'required|min_length[3]|max_length[255]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors())
                ->with('openModal', 'tambahBlogModal'); // nama ID modal
        }        

        // Simpan ke database
        $blogModel->save([
            'id_email'    => $id_email,
            'domain_blog' => $this->request->getPost('domain_blog')
        ]);

        return redirect()->to(route_to('backlink'))->with('success', 'Blog berhasil ditambahkan!');
    }
}
