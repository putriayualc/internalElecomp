<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AbsenModel;
use App\Models\NilaiAkhirModel;
use App\Models\SiswaModel;
use App\Models\NilaiMagangModel;
use App\Models\NilaiOperasionalModel;
use CodeIgniter\HTTP\ResponseInterface;

class NilaiAkhirController extends BaseController
{
    protected $absenModel;
    protected $nilaiAkhirModel;
    protected $siswaModel;

    public function __construct()
    {
        $this->absenModel = new AbsenModel();
        $this->nilaiAkhirModel = new NilaiAkhirModel();
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {
        $data = [
            'allNilai' => $this->nilaiAkhirModel->getAllNilai(),
        ];
        return view('pages/nilai_akhir/index', $data);
    }

    public function hitung($id_siswa)
    {
        $result = $this->calculateAndSave($id_siswa);

        if (!$result) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Data tidak ditemukan']);
        }

        return $this->response->setJSON([
            'success' => true
        ]);
    }

    public function hitung_semua()
    {
        $siswaList = $this->siswaModel->findAll();

        foreach ($siswaList as $siswa) {
            $this->calculateAndSave($siswa['id_siswa']);
        }

        return $this->response->setJSON(['success' => true]);
    }

    private function calculateAndSave(int $id_siswa): ?array
    {
        $nilai = $this->nilaiAkhirModel->where('id_siswa', $id_siswa)->first();
        if (!$nilai) return null;

        $siswa = $this->siswaModel->find($id_siswa);
        if (!$siswa || !$siswa['tgl_masuk'] || !$siswa['tgl_keluar']) return null;

        $tglMasuk = strtotime($siswa['tgl_masuk']);
        $tglKeluar = strtotime($siswa['tgl_keluar']);
        $totalHariMagang = ($tglKeluar - $tglMasuk) / (60 * 60 * 24) + 1;

        // Absensi
        $jumlahHadir = $this->absenModel
            ->where('id_user', $siswa['id_user'])
            ->where('status', 'Masuk')
            ->countAllResults();

        $nilaiAbsensi = 100 - ((($totalHariMagang - $jumlahHadir) * 2) / max($totalHariMagang, 1)) * 100;
        $nilaiAbsensi = max(0, min(100, $nilaiAbsensi));

        // Nilai Magang Harian
        $nilaiMagang = $this->absenModel
            ->where('id_user', $siswa['id_user'])
            ->selectAvg('nilai_magang')
            ->first()['nilai_magang'] ?? 0;

        // Nilai Operasional Harian
        $nilaiOperasional = $this->absenModel
            ->where('id_user', $siswa['id_user'])
            ->selectAvg('nilai_operasional')
            ->first()['nilai_operasional'] ?? 0;

        // Total Nilai
        $total = ($nilaiAbsensi + $nilaiMagang + $nilaiOperasional) / 3;

        $this->nilaiAkhirModel->update($nilai['id_nilai_akhir'], [
            'nilai_absensi' => $nilaiAbsensi,
            'nilai_magang' => $nilaiMagang,
            'nilai_operasional' => $nilaiOperasional,
            'total_nilai' => $total,
            'updated_at' =>  date('Y-m-d H:i:s')
        ]);

        return [
            'nilai_absensi' => $nilaiAbsensi,
            'nilai_magang' => $nilaiMagang,
            'nilai_operasional' => $nilaiOperasional,
            'total_nilai' => $total
        ];
    }
}
