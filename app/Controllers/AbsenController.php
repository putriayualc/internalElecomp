<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AbsenModel;
use App\Models\UsersModel;
use CodeIgniter\I18n\Time;


class AbsenController extends BaseController
{
    public function index()
    {
        $absens = new AbsenModel();
        
        $hasil = $this->request->getPost('date');
        
        if ($hasil) {
            $absen = $absens->search($hasil);
        } else {
            // $absen = $absens
            //     ->select('tb_absen.*, tb_users.*')
            //     ->join('tb_users', 'tb_users.id_user = tb_absen.id_user')
            //     ->findAll();
            $absen = $absens->search('Masuk');
        }

        foreach($absen as $key) {
            $status = $key['status'];
        }

        foreach($absen as $key) {
            $waktuAbsen = Time::parse($key['tanggal_waktu']);
        }

        // Bandingkan tanggal
        $tanggalAbsen = $waktuAbsen->toDateString(); // "2025-05-17"
        $tanggalHariIni = Time::today()->toDateString(); // "2025-05-17"
        // dd($tanggalHariIni);

        $jam = (int) $waktuAbsen->format('H'); // menngambil jam user saat absen
        $menit = (int) $waktuAbsen->format('i'); // mengambil menit user saat absen
        // dd($jam, $menit);


        $data = [
            'absen' => $absen,
            'statusTerpilih' => $status,


            'waktuAbsen' => $waktuAbsen,
            'tanggalAbsen' => $tanggalAbsen,
            'tanggalHariIni' => $tanggalHariIni,
            'jam' => $jam,
            'menit' => $menit,

        ];

        return view('pages/absen/index', $data);
    }

    public function terima($id_absen){
        $absens = new AbsenModel();

        $absen = $absens->where('id_absen', $id_absen)->first();

        $data = [
            'persetujuan' => 'Terima'
        ];

        $absens->update($id_absen, $data);

        return redirect()->back();
    }

    public function tolak($id_absen){
        $absens = new AbsenModel();

        $absen = $absens->where('id_absen', $id_absen)->first();

        $data = [
            'persetujuan' => 'Tolak'
        ];

        $absens->update($id_absen, $data);

        return redirect()->back();
    }

    public function reset($id_absen){
        $absens = new AbsenModel();

        $absen = $absens->where('id_absen', $id_absen)->first();

        $data = [
            'persetujuan' => 'Pending'
        ];

        $absens->update($id_absen, $data);

        return redirect()->back();
    }
}
