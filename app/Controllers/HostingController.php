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
        // Get hosting data with add-on domains
        $hostingData = $this->hostingModel->getHostingWithAddons($id);
        $data['addon'] = $this->hostingModel->getAddonsByHostingId($id);

        if (empty($hostingData)) {
            return redirect()->to('hosting')->with('error', 'Hosting tidak ditemukan');
        }

        // Ambil data hosting utama dari baris pertama
        $hosting = [
            'id_hosting' => $hostingData[0]['id_hosting'],
            'domain_utama' => $hostingData[0]['domain_utama'],
            'username_hosting' => $hostingData[0]['username_hosting'],
            'password_hosting' => $hostingData[0]['password_hosting'],
        ];

        // Kumpulkan semua add-on domains
        $addons = [];
        foreach ($hostingData as $row) {
            if (!empty($row['add_on_domain'])) {
                $addons[] = [
                    'id_domains' => $row['id_domains'],
                    'id_hosting' => $row['id_hosting'],
                    'add_on_domain' => $row['add_on_domain'],
                ];
            }
        }

        $data = [
            'hosting' => $hosting,
            'addons' => $addons, // ← ini buat tampil di form
        ];

        return view('pages/hosting/edit', $data);
    }


    public function update($id)
    {
        // Update data hosting utama
        $this->hostingModel->update($id, [
            'domain_utama'      => $this->request->getPost('domain_utama'),
            'username_hosting'  => $this->request->getPost('username_hosting'),
            'password_hosting'  => $this->request->getPost('password_hosting'),
        ]);

        // Add-on Domains
        $addOnDomains = $this->request->getPost('add_on_domain');
        $domainIds = $this->request->getPost('domains_id');

        if (!empty($addOnDomains) && is_array($addOnDomains)) {
            foreach ($addOnDomains as $key => $domain) {
                $domain = trim($domain);
                if (!empty($domain)) {
                    if (isset($domainIds[$key]) && $domainIds[$key] != '0') {
                        // Update jika id_domains ada
                        $this->hostingModel->db->table('tb_domains')->update([
                            'add_on_domain' => $domain
                        ], [
                            'id_domains' => $domainIds[$key]
                        ]);
                    } else {
                        // Insert jika domain baru
                        $this->hostingModel->db->table('tb_domains')->insert([
                            'id_hosting' => $id,
                            'add_on_domain' => $domain,
                        ]);
                    }
                }
            }
        }

        return redirect()->to('hosting')->with('success', 'Data Hosting berhasil diperbarui.');
    }

   
    public function detail($id)
    {
        $data = [
            'hosting' => $this->hostingModel->find($id),
        ];

        $data['addon'] = $this->hostingModel->findAll($id);

        return view('pages/hosting/detail', $data);
    }
    
}
