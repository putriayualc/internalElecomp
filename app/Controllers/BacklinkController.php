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

    public function delete($id_email)
    {
        $email = $this->emailModel->find($id_email);

        if ($email) {
            // Hapus data dari database
            $this->emailModel->delete($id_email);

            session()->setFlashdata('success', 'Data berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Data tidak ditemukan');
        }

        return redirect()->to(route_to('backlink'));
    }
}
