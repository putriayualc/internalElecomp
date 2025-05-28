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

        // Ambil daftar siswa piket per hari (join tabel)
        $resultsJoin = $piketModel->getPiketWithJoin();

        // Ambil daftar tugas urut berdasarkan bobot DESC
        $tasks = $piketModel->getAllTugasOrderByBobot();

        $piketData = [];
        $taskAssignment = []; // Simpan tugas tiap siswa per hari

        $weekNumber = date('W'); // Nomor minggu dalam setahun

        $hariMap = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];

        $hariIni = $hariMap[date('N')];

        $userLogin = session()->get('username');
        $harusPiket = false;
        $tugasHariIni = [];

        // Susun data piket tanpa tugas dulu
        foreach ($resultsJoin as $row) {
            $hari = $row['hari'];
            $siswa = $row['nama'];

            if (!isset($piketData[$hari])) {
                $piketData[$hari] = [];
            }

            $piketData[$hari][] = $siswa;
        }

        // Bagi tugas berdasarkan bobot
        $tugasBobot4 = array_values(array_filter($tasks, fn($t) => $t['bobot'] == 4));
        $tugasBobot2 = array_values(array_filter($tasks, fn($t) => $t['bobot'] == 2));

        // Fungsi bantu rotate array (geser)
        $rotate = function (array $arr, int $steps): array {
            $count = count($arr);
            if ($count === 0) return $arr;
            $steps = $steps % $count;
            return array_merge(array_slice($arr, $steps), array_slice($arr, 0, $steps));
        };

        // Geser tugas berdasarkan minggu berjalan (rotasi)
        $tugasBobot4Rotated = $rotate($tugasBobot4, $weekNumber);
        $tugasBobot2Rotated = $rotate($tugasBobot2, $weekNumber);

        // Assign tugas ke siswa per hari berdasarkan aturan dan minggu
        foreach ($piketData as $hari => $siswaList) {
            $expectedSiswa = ($hari === 'Sabtu') ? 4 : 3;
            $actualSiswaList = array_slice($siswaList, 0, $expectedSiswa);

            foreach ($actualSiswaList as $index => $siswa) {
                $tugasUntukSiswa = [];

                if ($index === 0 && count($tugasBobot4Rotated) > 0) {
                    // Anak pertama dapat 1 tugas bobot 4 sesuai rotasi
                    $task = $tugasBobot4Rotated[$index % count($tugasBobot4Rotated)];
                    $tugasUntukSiswa[] = $task['nama_tugas'];
                } else {
                    // Anak lain dapat 2 tugas bobot 2 yang berbeda sesuai rotasi
                    $countTugas2 = count($tugasBobot2Rotated);
                    if ($countTugas2 >= 2) {
                        $pos1 = ($index * 2) % $countTugas2;
                        $pos2 = ($pos1 + 1) % $countTugas2;
                        $tugasUntukSiswa[] = $tugasBobot2Rotated[$pos1]['nama_tugas'];
                        $tugasUntukSiswa[] = $tugasBobot2Rotated[$pos2]['nama_tugas'];
                    }
                }

                if (!isset($taskAssignment[$hari])) {
                    $taskAssignment[$hari] = [];
                }
                $taskAssignment[$hari][$siswa] = $tugasUntukSiswa;

                // Tandai tugas hari ini jika siswa adalah user login dan hari ini
                if ($hari === $hariIni && $siswa === $userLogin) {
                    $harusPiket = true;
                    $tugasHariIni = $tugasUntukSiswa;
                }
            }
        }

        return view('pages/piket/index', [
            'piketData' => $piketData,
            'taskAssignment' => $taskAssignment,
            'harusPiket' => $harusPiket,
            'tugasHariIni' => $tugasHariIni
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
