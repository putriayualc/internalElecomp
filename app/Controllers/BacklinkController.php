<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BlogModel;
use App\Models\EmailModel;
use App\Models\UsersModel;
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
        if (session()->get('role') === 'user') {
            $allEmail = $this->emailModel->getEmailUserWithNama(session()->get('id_user'));
            $allBlogs = $this->blogModel->getAllBlogWithCountArticle(session()->get('id_user'));

        } else {
            $allEmail = $this->emailModel->getEmailUserWithNama(); // Semua
            $allBlogs = $this->blogModel->getAllBlogWithCountArticle();

        }

        $data = [
            'allEmail' => $allEmail,
            'allBlogs' => $allBlogs
        ];

        return view('pages/backlink/index', $data);
    }
    public function tambah()
    {
        $userModel = new UsersModel();

        $allUsers = $userModel->getUsersWithNamaSiswa();

        $data = [
            'allUsers' => $allUsers
        ];

        return view('pages/backlink/tambah', $data);
    }
    public function proses_tambah()
    {

        // Ambil input dari form
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $domains = $this->request->getPost('domain_blog');
        if (session()->get('role') === 'admin'){
            $user = $this->request->getPost('id_user');
        }else{
            $user = session()->get('id_user');
        }
        
        // Simpan data email ke database
        $emailData = [
            'email' => $email,
            'password' => $password,
            'id_user'  => $user
        ];

        // Cek apakah validasi berhasil
        if (!$this->emailModel->validate($emailData)) {
            // Jika validasi gagal, kembalikan error ke form
            return redirect()->back()->withInput()->with('error', $this->emailModel->errors());
        } else {
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
        }

        // Redirect kembali dengan flashdata sukses
        return redirect()->to(route_to('backlink'))->with('success', 'Email dan domain berhasil ditambahkan.');
    }

    public function edit($id_email)
    {
        $email = $this->emailModel->getOneEmailUserWithNama($id_email);
        $blogs = $this->blogModel->where('id_email', $id_email)->find();

        $userModel = new UsersModel();
        $allUsers = $userModel->getUsersWithNamaSiswa();

        $data = [
            'email' => $email,
            'blogs' => $blogs,
            'allUsers' => $allUsers
        ];
        // dd($data);

        return view('pages/backlink/edit', $data);
    }

    public function update($id_email)
    {
        $data = $this->request->getPost();
        $data['id_email'] = $id_email;
        // dd($data);
        if (!$this->emailModel->validate($data)) {
            return redirect()->back()->withInput()->with('error', $this->emailModel->errors());
        };

        // Simpan data utama
        $this->emailModel->update($id_email, [
            'email'    => $data['email'],
            'password' => $data['password'],
            'id_user'  => $data['id_user'],
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
