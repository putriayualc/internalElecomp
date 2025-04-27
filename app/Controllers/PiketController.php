<?php

namespace App\Controllers;

class PiketController extends BaseController
{
    public function index()
    {
        $session = session();

        // Inisialisasi data dummy jika belum ada
        if (!$session->has('piket_data')) {
            $session->set('piket_data', [
                'Senin' => ['Ayu', 'Budi', 'Citra', 'Dewi', 'Eko', 'Fajar', 'Gina', 'Dito'],
                'Selasa' => ['Hani', 'Irfan', 'Joko', 'Kiki', 'Lina', 'Mira', 'Nina', 'Budi'],
                'Rabu' => ['Oscar', 'Putri', 'Qori', 'Rina', 'Siska', 'Tari', 'Udin', 'Vina'],
                'Kamis' => ['Oscar', 'Putri', 'Qori', 'Rina', 'Siska', 'Tari', 'Udin', 'Vina'],
                'Jumat' => ['Oscar', 'Putri', 'Qori', 'Rina', 'Siska', 'Tari', 'Udin', 'Vina'],
                'Sabtu' => ['Oscar', 'Putri', 'Qori', 'Rina', 'Siska', 'Tari', 'Udin', 'Vina'],
            ]);
        }

        $data = $session->get('piket_data');

        return view('pages/piket/index', [
            'piketData' => $data
        ]);
    }


    public function edit($hari)
    {
        $session = session();
        $hariCapital = ucfirst(strtolower($hari));

        $dataPiket = $session->get('piket_data');
        $namaList = $dataPiket[$hariCapital] ?? [];

        $semuaNama = ['Ayu', 'Budi', 'Citra', 'Dewi', 'Eko', 'Fajar', 'Gina', 'Dito', 'Hani', 'Irfan', 'Joko', 'Kiki', 'Lina', 'Mira', 'Nina', 'Oscar', 'Putri', 'Qori', 'Rina', 'Siska', 'Tari', 'Udin', 'Vina'];

        return view('pages/piket/edit', [
            'hari' => $hariCapital,
            'namaList' => $namaList,
            'semuaNama' => $semuaNama
        ]);
    }


    public function update()
    {
        $session = session();

        $hari = $this->request->getPost('hari');
        $namaArray = $this->request->getPost('nama'); // Ini bentuknya array dari semua baris yang ada

        $dataPiket = $session->get('piket_data');
        $dataPiket[$hari] = $namaArray; // Replace data untuk hari tersebut

        $session->set('piket_data', $dataPiket);

        return redirect()->to(base_url('piket/edit/' . strtolower($hari)));
    }


    // public function delete($hari, $nama)
    // {
    //     $session = session();
    //     $hariCapital = ucfirst(strtolower($hari));
    //     $nama = urldecode($nama);

    //     $dataPiket = $session->get('piket_data');

    //     if (isset($dataPiket[$hariCapital])) {
    //         $index = array_search($nama, $dataPiket[$hariCapital]);
    //         if ($index !== false) {
    //             unset($dataPiket[$hariCapital][$index]);
    //             $dataPiket[$hariCapital] = array_values($dataPiket[$hariCapital]); // Reset index
    //             $session->set('piket_data', $dataPiket);
    //         }
    //     }

    //     return redirect()->to(base_url('piket/edit/' . strtolower($hari)));
    // }
}
