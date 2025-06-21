<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AbsenModel;
use App\Models\LiburModel;
use App\Models\SiswaModel;
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
            $absen = $absens->search('Masuk');
        }

        foreach ($absen as $key) {
            $status = $key['status'];
        }
        $tanggalHariIni = Time::today()->toDateString();


        $data = [
            'absen' => $absen,
            'statusTerpilih' => $status,
            'tanggalHariIni' => $tanggalHariIni,
        ];

        return view('pages/absen/index', $data);
    }

    public function terima($id_absen)
    {
        $absens = new AbsenModel();

        $absen = $absens->where('id_absen', $id_absen)->first();

        $data = [
            'persetujuan' => 'Terima'
        ];

        $absens->update($id_absen, $data);

        return redirect()->back();
    }

    public function tolak($id_absen)
    {
        $absens = new AbsenModel();

        $absen = $absens->where('id_absen', $id_absen)->first();

        $data = [
            'persetujuan' => 'Tolak'
        ];

        $absens->update($id_absen, $data);

        return redirect()->back();
    }

    public function reset($id_absen)
    {
        $absens = new AbsenModel();

        $absen = $absens->where('id_absen', $id_absen)->first();

        $data = [
            'persetujuan' => 'Pending'
        ];

        $absens->update($id_absen, $data);

        return redirect()->back();
    }





    public function user()
    {
        $this->cekAbsenBolos();
        $users = new UsersModel();
        $absens = new AbsenModel();
        $id_user = session()->get('id_user');

        $hariIni = date('Y-m-d');
        $mulai = $hariIni . ' 08:00:00';
        $selesai = $hariIni . ' 18:00:00';
        $waktuSekarang = date('Y-m-d H:i:s');

        $mengisiKegiatan = $hariIni . ' 18:00:00';

        $sudahAbsen = $absens
            ->where('id_user', $id_user)
            ->where("DATE(tanggal_waktu)", $hariIni)
            // ->where('tanggal_waktu' , $hariIni)
            // ->where('tanggal_waktu <=' , $selesai)
            ->first();

        $hariKe = date('w'); // 0 = Minggu

        $liburModel = new LiburModel();
        $liburTanggal = $liburModel->select('tgl_libur')->findAll();
        $daftarLibur = array_map(fn($row) => date('Y-m-d', strtotime($row['tgl_libur'])), $liburTanggal);

        // Cek apakah absen hari ini ditutup
        $absenDitutup = ($hariKe == 0) || in_array($hariIni, $daftarLibur);

        $user = [
            'user' => $users->where('id_user', $id_user)->first(),
            'sudahAbsen' => $sudahAbsen,
            'mulai' => $mulai,
            'selesai' => $selesai,
            'waktuSekarang' => $waktuSekarang,

            'mengisiKegiatan' => $mengisiKegiatan,
            'absenDitutup' => $absenDitutup
        ];
        return view('pages/absen/user', $user);
    }

    public function masuk($id_user)
    {
        $this->hapusFotoLama();
        $users = new UsersModel();
        $absens = new AbsenModel();

        $fileFoto = $this->request->getFile('bukti_foto');
        $namaFile = $fileFoto->getRandomName();
        $fileFoto->move('assets/img/absensi', $namaFile);

        $hariIni = date('Y-m-d');
        // Ubah jadi objek waktu
        $mulai = Time::parse($hariIni . ' 07:45:00');
        $selesai = Time::parse($hariIni . ' 08:15:00');

        $waktuAbsen = Time::now();

        // dd($mulai, $selesai);

        if ($waktuAbsen >= $mulai && $waktuAbsen <= $selesai) {
            $data = [
                'id_user' => $id_user,
                'bukti_foto' => $namaFile,
                'tanggal_waktu' => date('Y-m-d H:i:s'),
                // 'keterangan' => $this->request->getVar('keterangan'),
                'keterangan' => '--',
                'status' => 'Masuk',
                'persetujuan' => 'Pending'
            ];
        } else {
            $data = [
                'id_user' => $id_user,
                'bukti_foto' => $namaFile,
                'tanggal_waktu' => date('Y-m-d H:i:s'),
                'keterangan' => '--',
                // 'keterangan' => $this->request->getVar('keterangan'),
                'status' => 'Bolos ',
                'persetujuan' => 'Pending'
            ];
        }

        $absens->insert($data);

        return redirect()->back();
    }

    public function ijin($id_user)
    {
        $this->hapusFotoLama();
        $users = new UsersModel();
        $absens = new AbsenModel();

        $fileFoto = $this->request->getFile('bukti_foto');
        $namaFile = $fileFoto->getRandomName();
        $fileFoto->move('assets/img/absensi', $namaFile);

        $hariIni = date('Y-m-d');
        // Ubah jadi objek waktu
        $mulai = Time::parse($hariIni . ' 07:45:00');
        $selesai = Time::parse($hariIni . ' 08:15:00');

        $waktuAbsen = Time::now();

        // dd($mulai, $selesai);

        if ($waktuAbsen >= $mulai && $waktuAbsen <= $selesai) {
            $data = [
                'id_user' => $id_user,
                'bukti_foto' => $namaFile,
                'tanggal_waktu' => date('Y-m-d H:i:s'),
                'keterangan' => $this->request->getVar('keterangan'),
                'status' => 'Ijin',
                'persetujuan' => 'Pending'
            ];
        } else {
            $data = [
                'id_user' => $id_user,
                'bukti_foto' => $namaFile,
                'tanggal_waktu' => date('Y-m-d H:i:s'),
                'keterangan' => $this->request->getVar('keterangan'),
                'status' => 'Bolos',
                'persetujuan' => 'Pending'
            ];
        }

        $absens->insert($data);

        return redirect()->back();
    }

    public function sakit($id_user)
    {
        $this->hapusFotoLama();
        $users = new UsersModel();
        $absens = new AbsenModel();

        $fileFoto = $this->request->getFile('bukti_foto');
        $namaFile = $fileFoto->getRandomName();
        $fileFoto->move('assets/img/absensi', $namaFile);

        $hariIni = date('Y-m-d');
        // Ubah jadi objek waktu
        $mulai = Time::parse($hariIni . ' 07:45:00');
        $selesai = Time::parse($hariIni . ' 08:15:00');

        $waktuAbsen = Time::now();

        // dd($mulai, $selesai);

        if ($waktuAbsen >= $mulai && $waktuAbsen <= $selesai) {
            $data = [
                'id_user' => $id_user,
                'bukti_foto' => $namaFile,
                'tanggal_waktu' => date('Y-m-d H:i:s'),
                'keterangan' => $this->request->getVar('keterangan'),
                'status' => 'Sakit',
                'persetujuan' => 'Pending'
            ];
        } else {
            $data = [
                'id_user' => $id_user,
                'bukti_foto' => $namaFile,
                'tanggal_waktu' => date('Y-m-d H:i:s'),
                'keterangan' => $this->request->getVar('keterangan'),
                'status' => 'Bolos',
                'persetujuan' => 'Pending'
            ];
        }

        $absens->insert($data);

        return redirect()->back();
    }


    private function hapusFotoLama()
    {
        $absen = new AbsenModel();
        $batasWaktu = date('Y-m-d H:i:s', strtotime('-7 days'));
        $dataLama = $absen->where('tanggal_waktu <=', $batasWaktu)->findAll();
        // dd($batasWaktu, $dataLama);
        foreach ($dataLama as $data) {
            if ($data['bukti_foto']) {
                $filePath = FCPATH . 'assets/img/absensi/' . $data['bukti_foto'];
                if (file_exists($filePath)) {
                    unlink($filePath); // Hapus file jika ada
                }

                // Tetap update database meskipun file tidak ditemukan
                $absen->update($data['id_absen'], ['bukti_foto' => null]);
            }
        }
    }


    public function keterangan($id_absen)
    {
        $absens = new AbsenModel();

        $waktuSekarang = date('Y-m-d H:i:s');

        $data = [
            'keterangan' => $this->request->getVar('keteranganMasuk'),
            'waktu_pulang' => $waktuSekarang,
        ];

        $absens->update($id_absen, $data);
        return redirect()->back();
    }

    private function cekAbsenBolos()
    {
        $tanggalHariIni = date('Y-m-d');
        $waktuSekarang = date('H:i');

        // Lewati jika belum lewat jam 18:00
        if ($waktuSekarang <= '18:00') {
            return;
        }

        // Lewati jika hari Minggu
        if (date('w') == 0) {
            return;
        }

        // Lewati jika hari ini adalah libur nasional
        $liburModel = new LiburModel();
        if ($liburModel->where('tgl_libur', $tanggalHariIni)->countAllResults() > 0) {
            return;
        }

        $absenModel = new AbsenModel();
        $siswaModel = new SiswaModel();

        // Ambil semua siswa yang statusnya AKTIF dan bukan admin (id_user != 1)
        $siswaAktif = $siswaModel
            ->where('status', 'AKTIF')
            ->where('id_user !=', 1)
            ->findAll();

        foreach ($siswaAktif as $siswa) {
            $idUser = $siswa['id_user'];

            // Cek apakah user sudah absen hari ini
            $sudahAbsen = $absenModel
                ->where('id_user', $idUser)
                ->where('DATE(tanggal_waktu)', $tanggalHariIni)
                ->countAllResults();

            if ($sudahAbsen === 0) {
                $absenModel->insert([
                    'id_user'            => $idUser,
                    'bukti_foto'         => '-',
                    'tanggal_waktu'      => date('Y-m-d H:i:s'),
                    'status'             => 'bolos',
                    'keterangan'         => '-',
                    'persetujuan'        => 'Pending',
                    'nilai_magang'       => 0,
                    'nilai_operasional'  => 0,
                ]);
            }
        }
    }
}
