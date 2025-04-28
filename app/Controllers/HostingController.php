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
        $domainUtama = $this->request->getPost('domain_utama');
        $usernameHosting = $this->request->getPost('username_hosting');
        $passwordHosting = $this->request->getPost('password_hosting');
        $addOnDomains = $this->request->getPost('add_on_domain');

        if (!$domainUtama || !$usernameHosting || !$passwordHosting) {
            return redirect()->back()->with('error', 'Semua kolom wajib diisi!');
        }

        $hostingModel = new HostingModel();
        $hostingModel->save([
            'domain_utama' => $domainUtama,
            'username_hosting' => $usernameHosting,
            'password_hosting' => $passwordHosting,
        ]);

        $idHosting = $hostingModel->getInsertID();

        if (!empty($addOnDomains) && is_array($addOnDomains)) {
            foreach ($addOnDomains as $domain) {
                if (!empty(trim($domain))) {
                    $hostingModel->db->table('tb_domains')->insert([
                        'id_hosting' => $idHosting,
                        'add_on_domain' => trim($domain),
                    ]);
                }
            }
        }

        return redirect()->to('hosting')->with('success', 'Hosting berhasil ditambahkan');
    }

    public function delete($id)
    {
        $this->hostingModel->delete($id);
        return redirect()->to('hosting')->with('success', 'Data Hosting berhasil dihapus.');
    }

    public function edit($id)
    {
        $data = [
            'hosting' => $this->hostingModel->find($id)
        ];

        return view('pages/hosting/edit', $data);
    }

    // Update data SOP
    public function update($id)
{
    // Update data hosting utama
    $this->hostingModel->update($id, [
        'domain_utama'      => $this->request->getPost('domain_utama'),
        'username_hosting'  => $this->request->getPost('username_hosting'),
        'password_hosting'  => $this->request->getPost('password_hosting'),
    ]);

    // Ambil data add-on domain yang dikirim dari form
    $addOnDomains = $this->request->getPost('add_on_domain');

    // Hapus semua add-on domain lama untuk hosting ini
    // $this->hostingModel->db->table('tb_domains')->where('id_hosting', $id)->delete();

    // Tambahkan add-on domain baru (kalau ada)
    if (!empty($addOnDomains) && is_array($addOnDomains)) {
        foreach ($addOnDomains as $domain) {
            if (!empty(trim($domain))) {
                $this->hostingModel->db->table('tb_domains')->insert([
                    'id_hosting' => $id,
                    'add_on_domain' => trim($domain),
                ]);
            }
        }
    }

    return redirect()->to('hosting')->with('success', 'Data Hosting berhasil diperbarui.');
}


    // Detail SOP (opsional)
    public function detail($id)
    {
        $data = [
            'hosting' => $this->hostingModel->find($id)
        ];

        return view('pages/hosting/detail', $data);
    }


}
