<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AbsenModel;
use App\Models\LiburModel;
use App\Models\NilaiAkhirModel;
use App\Models\SiswaModel;
use CodeIgniter\HTTP\ResponseInterface;

class NilaiController extends BaseController
{
    public function index()
    {
        $id_user = session()->get('id_user');
        $siswaModel = new SiswaModel();
        $absenModel = new AbsenModel();
        $nilaiAkhirModel = new NilaiAkhirModel();
        $liburModel = new LiburModel();

        $siswa = $siswaModel->where('id_user', $id_user)->first();

        $akumulasi = $absenModel->getAkumulasiSementara($id_user);

        $tglMasuk = strtotime($siswa['tgl_masuk']);
        $tglKeluar = strtotime($siswa['tgl_keluar']);
        $hariIni = strtotime(date('Y-m-d'));

        // Ambil semua tanggal libur dari tb_libur
        $liburTanggal = $liburModel
            ->select('tgl_libur')
            ->findAll();

        $daftarLibur = array_map(function ($libur) {
            return date('Y-m-d', strtotime($libur['tgl_libur']));
        }, $liburTanggal);

        // Hitung total hari magang efektif (tidak termasuk Minggu dan libur nasional)
        $totalHariMagang = 0;
        for ($i = $tglMasuk; $i <= $tglKeluar; $i = strtotime('+1 day', $i)) {
            $tanggal = date('Y-m-d', $i);
            $hariKe = date('w', $i); // 0 = Minggu

            if ($hariKe != 0 && !in_array($tanggal, $daftarLibur)) {
                $totalHariMagang++;
            }
        }

        // Hari Berjalan (dari tgl_masuk s.d hari ini atau tgl_keluar, mana lebih dulu)
        $hariBerjalan = 0;
        $batasAkhir = min($hariIni, $tglKeluar);
        for ($i = $tglMasuk; $i <= $batasAkhir; $i = strtotime('+1 day', $i)) {
            $tanggal = date('Y-m-d', $i);
            $hariKe = date('w', $i);

            if ($hariKe != 0 && !in_array($tanggal, $daftarLibur)) {
                $hariBerjalan++;
            }
        }

        $nilai_akhir = null;

        if ($siswa['tgl_keluar'] <= date('Y-m-d')) {
            $nilai_akhir = $nilaiAkhirModel->where('id_siswa', $siswa['id_siswa'])->first();
        }

        $nilaiHarian = $absenModel->getNilaiHarianByUser($id_user);

        $data = [
            'siswa' => $siswa,
            'akumulasi' => $akumulasi,
            'nilai_akhir' => $nilai_akhir,
            'nilai_harian' => $nilaiHarian,
            'total_hari' => $totalHariMagang,
            'hariBerjalan' => $hariBerjalan
        ];

        // dd($data);
        return view('pages/nilai_user/index', $data);
    }
}
