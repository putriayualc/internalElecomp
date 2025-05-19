<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $role = session()->get('role');

        // Kalau tidak ada argumen role yang diperbolehkan, atau role user tidak termasuk
        if (!$arguments || !in_array($role, $arguments)) {
            return redirect()->to('/unauthorized')->with('error', 'Akses ditolak.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // if (session()->role == 'admin'){
        //     return redirect()->to(site_url('/'));
        // }
    }
}