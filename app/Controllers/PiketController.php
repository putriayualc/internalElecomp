<?php

namespace App\Controllers;

use App\Models\PiketModel;
use App\Models\HariModel;
    use App\Models\SiswaModel;

class PiketController extends BaseController
{
    public function index()
    {
        $piketModel = new PiketModel();
        $results = $piketModel->getPiketWithJoin();

        $piketData = [];

        foreach ($results as $row) {
            $hari = $row['hari'];
            $siswa = $row['nama'];

            if (!isset($piketData[$hari])) {
                $piketData[$hari] = [];
            }

            $piketData[$hari][] = $siswa;
        }

        return view('pages/piket/index', [
            'piketData' => $piketData
        ]);
    }

    public function edit($hari)
    {
        $piketModel = new PiketModel();
        $hariModel = new HariModel();
        $siswaModel = new SiswaModel();

        $hariCapital = ucfirst(strtolower($hari));

        // Cari ID hari berdasarkan nama
        $hariRow = $hariModel->where('hari', $hariCapital)->first();

        if (!$hariRow) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Hari $hariCapital tidak ditemukan");
        }

        $idHari = $hariRow['id_hari'];

        // Ambil siswa yang piket di hari ini
        $piketRows = $piketModel->where('id_hari', $idHari)->findAll();

        $namaList = [];
        foreach ($piketRows as $piket) {
            $siswa = $siswaModel->find($piket['id_siswa']);
            if ($siswa) {
                $namaList[] = $siswa['nama'];
            }
        }

        $semuaNama = $siswaModel->findAll(); // Semua siswa dari database

        return view('pages/piket/edit', [
            'hari' => $hariCapital,
            'namaList' => $namaList,
            'semuaNama' => array_column($semuaNama, 'nama') // array hanya nama
        ]);
    }


    public function update()
    {
        $piketModel = new PiketModel();
        $hariModel = new HariModel();
        $siswaModel = new SiswaModel();

        $hari = $this->request->getPost('hari'); // e.g. "Senin"
        $namaArray = $this->request->getPost('nama'); // Array of names

        // Cari ID hari
        $hariRow = $hariModel->where('hari', $hari)->first();
        if (!$hariRow) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Hari $hari tidak ditemukan");
        }

        $idHari = $hariRow['id_hari'];

        // Hapus semua data piket untuk hari itu dulu
        $piketModel->where('id_hari', $idHari)->delete();

        // Masukkan data baru
        foreach ($namaArray as $nama) {
            $siswa = $siswaModel->where('nama', $nama)->first();
            if ($siswa) {
                $piketModel->insert([
                    'id_hari' => $idHari,
                    'id_siswa' => $siswa['id_siswa']
                ]);
            }
        }
        return redirect()->to(base_url('piket'));
    }
}
