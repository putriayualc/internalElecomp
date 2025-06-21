<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AbsenModel;
use App\Models\ArtikelTrendingModel;
use App\Models\LiburModel;
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
    protected $artikelModel;
    protected $liburModel;

    public function __construct()
    {
        $this->absenModel = new AbsenModel();
        $this->nilaiAkhirModel = new NilaiAkhirModel();
        $this->siswaModel = new SiswaModel();
        $this->artikelModel = new ArtikelTrendingModel();
        $this->liburModel = new LiburModel();
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

        // Ambil data hasil terbaru dari model
        $nilai = $this->nilaiAkhirModel->where('id_siswa', $id_siswa)->first();

        if (!$nilai) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Data nilai tidak ditemukan']);
        }

        return $this->response->setJSON([
            'success' => true,
            'nilai_absensi'     => $nilai['nilai_absensi'],
            'nilai_magang'      => $nilai['nilai_magang'],
            'nilai_operasional' => $nilai['nilai_operasional'],
            'nilai_artikel'     => $nilai['nilai_artikel'],
            'total_nilai'       => $nilai['total_nilai'],
            'updated_at'        => date('d M Y H:i', strtotime($nilai['updated_at'])),
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
        if (!$nilai) {
            $insertData = [
                'id_siswa'          => $id_siswa,
                'nilai_absensi'     => 0,
                'nilai_magang'      => 0,
                'nilai_operasional' => 0,
                'nilai_artikel'     => 0,
                'total_nilai'       => 0,
                'updated_at'        => date('Y-m-d H:i:s')
            ];

            if (!$this->nilaiAkhirModel->insert($insertData)) {
                // Jika insert gagal, bisa log error atau return null
                return null;
            }

            // Ambil lagi setelah insert
            $nilai = $this->nilaiAkhirModel->where('id_siswa', $id_siswa)->first();
        };

        $siswa = $this->siswaModel->find($id_siswa);
        if (!$siswa || !$siswa['tgl_masuk'] || !$siswa['tgl_keluar']) return null;

        $tglMasuk = strtotime($siswa['tgl_masuk']);
        $tglKeluar = strtotime($siswa['tgl_keluar']);

        // Ambil semua tanggal libur dari tb_libur
        $liburTanggal = $this->liburModel
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

        // Hitung jumlah kehadiran
        $jumlahHadir = $this->absenModel
            ->where('id_user', $siswa['id_user'])
            ->where('status', 'Masuk')
            ->countAllResults();

        // Hitung nilai absensi
        $nilaiAbsensi = 100 - ((($totalHariMagang - $jumlahHadir) * 2) / max($totalHariMagang, 1)) * 100;
        $nilaiAbsensi = max(0, min(100, $nilaiAbsensi));

        // Artikel
        $totalHariMagangFull = ($tglKeluar - $tglMasuk) / (60 * 60 * 24) + 1;
        $jumlahArtikel = $this->artikelModel
            ->where('id_siswa', $siswa['id_siswa'])
            ->countAllResults();

        $nilaiArtikel = ($jumlahArtikel / $totalHariMagangFull) * 100;
        $nilaiArtikel = max(0, min(100, $nilaiArtikel));

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
        $total = ($nilaiAbsensi + $nilaiMagang + $nilaiOperasional + $nilaiArtikel) / 4;

        $this->nilaiAkhirModel->update($nilai['id_nilai_akhir'], [
            'nilai_absensi' => $nilaiAbsensi,
            'nilai_magang' => $nilaiMagang,
            'nilai_operasional' => $nilaiOperasional,
            'nilai_artikel' => $nilaiArtikel,
            'total_nilai' => $total,
            'updated_at' =>  date('Y-m-d H:i:s')
        ]);

        return [
            'nilai_absensi' => $nilaiAbsensi,
            'nilai_artikel' => $nilaiArtikel,
            'nilai_magang' => $nilaiMagang,
            'nilai_operasional' => $nilaiOperasional,
            'total_nilai' => $total
        ];
    }
}
