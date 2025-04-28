<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BlogModel;
use App\Models\EmailModel;
use CodeIgniter\HTTP\ResponseInterface;

class BacklinkController extends BaseController
{
    protected $emailModel;
    protected $blogModel;

    public function __construct()
    {
        $this->emailModel = new EmailModel();
        $this->blogModel  = new BlogModel();
    }

    public function index()
    {
        $allEmail = $this->emailModel->findAll();

        // Ambil semua blog dan hitung jumlah artikel per blog
        $allBlogs = $this->blogModel->getAllBlogWithCountArticle();

        $data = [
            'allEmail' => $allEmail,
            'allBlogs' => $allBlogs
        ];

        // dd($data);

        return view('pages/backlink/index', $data);
    }
    public function tambah()
    {
        $emailModel = new EmailModel();

        $allEmail = $emailModel->findAll();

        $data = [
            'allEmail' => $allEmail,
        ];

        // dd($data);

        return view('pages/backlink/tambah', $data);
    }
    public function proses_tambah()
    {

        // Ambil input dari form
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $domains = $this->request->getPost('domain_blog');

        // Validasi dasar
        if (empty($email) || empty($password)) {
            return redirect()->back()->withInput()->with('error', 'Email dan password harus diisi.');
        }

        // Simpan data email ke database
        $emailData = [
            'email' => $email,
            'password' => $password,
        ];

        $this->emailModel->insert($emailData);
        $id_email = $this->emailModel->insertID(); // Dapatkan ID email yang baru disimpan

        // Simpan setiap domain blog yang diinput
        if ($domains && is_array($domains)) {
            foreach ($domains as $domain) {
                if (!empty(trim($domain))) {
                    $this->blogModel->insert([
                        'id_email' => $id_email,
                        'domain_blog' => $domain
                    ]);
                }
            }
        }

        // Redirect kembali dengan flashdata sukses
        return redirect()->to(route_to('backlink'))->with('success', 'Email dan domain berhasil ditambahkan.');
    }

    public function edit($id_email)
    {
        $email = $this->emailModel->find($id_email);
        $blogs = $this->blogModel->where('id_email', $id_email)->find();

        $data = [
            'email' => $email,
            'blogs' => $blogs
        ];
        // dd($data);

        return view('pages/backlink/edit', $data);
    }

    public function update($id_email)
    {
        $validation = \Config\Services::validation();

        $data = $this->request->getPost();

        // dd($data);
        if (!$this->validate([
            'email' => 'required|valid_email',
            'password' => 'required',
        ])) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        // Update email utama
        $this->emailModel->update($id_email, [
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        // Update domain blogs
        $domainBlogs = $data['domain_blog'] ?? [];
        $domainIds = $data['domain_id'] ?? [];

        foreach ($domainBlogs as $index => $domainBlog) {
            $domainId = isset($domainIds[$index]) ? $domainIds[$index] : 0;

            if ($domainId != 0) {
                // Kalau domain_id ada (artinya domain lama), update
                $this->blogModel->update($domainId, [
                    'domain_blog' => $domainBlog,
                ]);
            } else {
                // Kalau domain_id = 0 (domain baru), insert baru
                if (!empty($domainBlog)) { // Hanya kalau domain diisi
                    $this->blogModel->insert([
                        'id_email' => $id_email,
                        'domain_blog' => $domainBlog,
                    ]);
                }
            }
        }

        return redirect()->to(route_to('backlink'))->with('success', 'Email dan Blog berhasil diperbarui!');
    }

    public function delete($id = false)
    {
        $emailModel = new EmailModel();
        $allEmail = $emailModel->find($id);
        // dd($allEmail);
        $emailModel->delete($id);

        return redirect()->to(route_to('backlink'));
    }
}
