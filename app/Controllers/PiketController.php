<?php

namespace App\Controllers;

class PiketController extends BaseController
{
    public function index()
    {
        // Data dummy
        $data = [
            'Senin' => ['Ayu', 'Budi', 'Citra', 'Dewi', 'Eko', 'Fajar', 'Gina', 'Dito'],
            'Selasa' => ['Hani', 'Irfan', 'Joko', 'Kiki', 'Lina', 'Mira', 'Nina', 'Budi'],
            'Rabu' => ['Oscar', 'Putri', 'Qori', 'Rina', 'Siska', 'Tari', 'Udin', 'Vina'],
            'Kamis' => ['Oscar', 'Putri', 'Qori', 'Rina', 'Siska', 'Tari', 'Udin', 'Vina'],
            'Jumat' => ['Oscar', 'Putri', 'Qori', 'Rina', 'Siska', 'Tari', 'Udin', 'Vina'],
            'Sabtu' => ['Oscar', 'Putri', 'Qori', 'Rina', 'Siska', 'Tari', 'Udin', 'Vina'],
        ];

        // Jika ada update dari flashdata, kita simulasi tambahkan nama
        $editHari = session()->getFlashdata('editHari');
        $editNama = session()->getFlashdata('editNama');

        if ($editHari && $editNama) {
            $data[$editHari][] = $editNama;
        }

        return view('pages/piket/index', ['piketData' => $data]);
    }

    public function update()
    {
        $hari = $this->request->getPost('hari');
        $nama = $this->request->getPost('nama');

        // Simpan data ke flashdata sementara (karena data dummy)
        session()->setFlashdata('editHari', $hari);
        session()->setFlashdata('editNama', $nama);

        // Redirect kembali ke halaman piket
        return redirect()->to('/piket');
    }

    public function edit($hari)
    {
        return view('pages/piket/edit', ['hari' => $hari]);
    }
}
