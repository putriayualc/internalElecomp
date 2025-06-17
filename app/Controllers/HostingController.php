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
        $hosting = $this->request->getPost('hosting');
        $tgl_exp_hosting = $this->request->getPost('tgl_exp_hosting');
        $domainUtama = $this->request->getPost('domain_utama');
        $tgl_exp_domain = $this->request->getPost('tgl_exp_domain');
        $usernameHosting = $this->request->getPost('username_hosting');
        $passwordHosting = $this->request->getPost('password_hosting');
        $addOnDomains = $this->request->getPost('add_on_domain');
        $tgl_exp_add_domain = $this->request->getPost('tgl_exp_add_domain');

        if (!$domainUtama || !$usernameHosting || !$passwordHosting) {
            return redirect()->back()->with('error', 'Semua kolom wajib diisi!');
        }

        $hostingModel = new HostingModel();
        $hostingModel->save([
            'hosting' => $hosting,
            'tgl_exp_hosting' => $tgl_exp_hosting,
            'tgl_exp_domain' => $tgl_exp_domain,
            'domain_utama' => $domainUtama,
            'username_hosting' => $usernameHosting,
            'password_hosting' => $passwordHosting,
        ]);

        $idHosting = $hostingModel->getInsertID();

        if (!empty($addOnDomains) && is_array($addOnDomains)) {
            foreach ($addOnDomains as $index => $domain) {
                if (!empty(trim($domain))) {
                    $expDate = isset($tgl_exp_add_domain[$index]) ? trim($tgl_exp_add_domain[$index]) : null;

                    $hostingModel->db->table('tb_domains')->insert([
                        'id_hosting' => $idHosting,
                        'add_on_domain' => trim($domain),
                        'tgl_exp_add_domain' => $expDate,
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
            'hosting' => $hostingData[0]['hosting'],
            'tgl_exp_hosting' => $hostingData[0]['tgl_exp_hosting'],
            'tgl_exp_domain' => $hostingData[0]['tgl_exp_domain'],
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
                    'tgl_exp_add_domain' => $row['tgl_exp_add_domain']
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
        // Ambil data dari form
        $hosting = $this->request->getPost('hosting');
        $tgl_exp_hosting = $this->request->getPost('tgl_exp_hosting');
        $tgl_exp_domain = $this->request->getPost('tgl_exp_domain');
        $domainUtama = $this->request->getPost('domain_utama');
        $usernameHosting = $this->request->getPost('username_hosting');
        $passwordHosting = $this->request->getPost('password_hosting');
        $addOnDomains = $this->request->getPost('add_on_domain');
        $tgl_exp_add_domain = $this->request->getPost('tgl_exp_add_domain');
        $domainIds = $this->request->getPost('domains_id');

        // Update data hosting utama
        $this->hostingModel->update($id, [
            'hosting'           => $hosting,
            'tgl_exp_hosting'   => $tgl_exp_hosting,
            'tgl_exp_domain'    => $tgl_exp_domain,
            'domain_utama'      => $domainUtama,
            'username_hosting'  => $usernameHosting,
            'password_hosting'  => $passwordHosting,
        ]);

        // Perbarui atau tambahkan add-on domain
        if (!empty($addOnDomains) && is_array($addOnDomains)) {
            foreach ($addOnDomains as $key => $domain) {
                $domain = trim($domain);
                $expDate = isset($tgl_exp_add_domain[$key]) ? trim($tgl_exp_add_domain[$key]) : null;

                if (!empty($domain)) {
                    if (isset($domainIds[$key]) && $domainIds[$key] != '0') {
                        // Update jika sudah ada
                        $this->hostingModel->db->table('tb_domains')->update([
                            'add_on_domain' => $domain,
                            'tgl_exp_add_domain' => $expDate,
                        ], [
                            'id_domains' => $domainIds[$key]
                        ]);
                    } else {
                        // Tambah jika baru
                        $this->hostingModel->db->table('tb_domains')->insert([
                            'id_hosting' => $id,
                            'add_on_domain' => $domain,
                            'tgl_exp_add_domain' => $expDate,
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
