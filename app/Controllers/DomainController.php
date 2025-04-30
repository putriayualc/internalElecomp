<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HostingModel;
use CodeIgniter\HTTP\ResponseInterface;

class DomainController extends BaseController
{
    public function hapus($id_hosting, $id_domains)
    {
        // Memuat model Hosting
        $hostingModel = new HostingModel();

        // Mengecek apakah domain yang akan dihapus ada
        $domain = $hostingModel->db->table('tb_domains')->where('id_domains', $id_domains)->get()->getRowArray();

        if (!$domain) {
            return redirect()->to(route_to('hosting'))->with('error', 'Domain tidak ditemukan.');
        }

        // Menghapus data add-on domain berdasarkan ID
        $hostingModel->db->table('tb_domains')->where('id_domains', $id_domains)->delete();

        // Redirect ke halaman hosting dengan pesan sukses
        return redirect()->to(route_to('hosting'))->with('success', 'Add-On Domain berhasil dihapus');
    }
}

