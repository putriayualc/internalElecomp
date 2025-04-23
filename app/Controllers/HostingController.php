<?php

namespace App\Controllers;

use App\Models\HostingModel;
use App\Models\DomainModel;

class HostingController extends BaseController
{
    protected $hostingModel;
    protected $domainsModel;

    public function __construct()
    {
        $this->hostingModel = new HostingModel();
        $this->domainsModel = new DomainModel();
    }

    public function index()
    {
        // Mengambil data hosting dan add on domain
        $allHosting = $this->hostingModel->getAllWithAddon();

        // Mengirim data ke view
        return view('pages/hosting/index', [
            'allHosting' => $allHosting
        ]);
    }

    public function tambah()
    {
        return view('pages/hosting/tambah');
    }

    public function simpan()
    {
        // Ambil data dari form
        $domainUtama = $this->request->getPost('domain_utama');
        $usernameHosting = $this->request->getPost('username_hosting');
        $passwordHosting = $this->request->getPost('password_hosting');
        $addOnDomain = $this->request->getPost('add_on_domain');

        // Validasi data jika perlu
        if (!$domainUtama || !$usernameHosting || !$passwordHosting) {
            return redirect()->back()->with('error', 'Semua kolom wajib diisi!');
        }

        // Simpan data ke database
        $hostingModel = new HostingModel();
        $hostingModel->save([
            'domain_utama' => $domainUtama,
            'username_hosting' => $usernameHosting,
            'password_hosting' => $passwordHosting,
        ]);

        // Simpan add_on_domain jika ada
        if (!empty($addOnDomain)) {
            $idHosting = $hostingModel->getInsertID(); // Mendapatkan id_hosting yang baru saja disimpan
            $domains = explode(',', $addOnDomain); // Pisahkan add_on_domain dengan koma

            foreach ($domains as $domain) {
                $hostingModel->db->table('tb_domains')->insert([
                    'id_hosting' => $idHosting,
                    'add_on_domain' => trim($domain),
                ]);
            }
        }

        return redirect()->to('hosting')->with('success', 'Hosting berhasil ditambahkan');
    }
}
