<?php

namespace App\Controllers;

use App\Models\ArtikulasiModel;
use App\Models\SiswaModel;
use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class ArtikulasiController extends BaseController
{
    use ResponseTrait;

    protected $artikulasiModel;
    protected $siswaModel;

    public function __construct()
    {
        $this->artikulasiModel = new ArtikulasiModel();
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {
        $currentMonth = $this->request->getVar('month') ?? date('m');
        $currentYear = $this->request->getVar('year') ?? date('Y');
        $selectedDate = $this->request->getVar('tanggal'); // Tanggal yang dipilih dari kalender

        // --- LOGIKA UNTUK KALENDER SEDERHANA PHP ---
        $date = mktime(12, 0, 0, $currentMonth, 1, $currentYear);
        $daysInMonth = date("t", $date);
        $dayOfWeek = date("w", $date); // 0 for Sunday, 6 for Saturday
        $calendar = [];
        $row = [];

        // Isi hari-hari kosong di awal bulan
        for ($i = 0; $i < $dayOfWeek; $i++) {
            $row[] = '';
        }

        // Isi tanggal bulan ini
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $row[] = $day;
            if (($dayOfWeek + $day) % 7 == 0 || $day == $daysInMonth) {
                // Tambahkan baris (minggu) ke kalender
                $calendar[] = $row;
                $row = [];
            }
        }
        // --- AKHIR LOGIKA KALENDER ---

        // --- LOGIKA PENGAMBILAN DATA ARTIKULASI ---
        $artikels = [];
        if ($selectedDate) {
             // Jika tanggal dipilih, ambil data hanya untuk tanggal penugasan itu
             $artikels = $this->artikulasiModel
                              ->select('Tb_artikel_trending.*, Tb_siswa.nama as nama_siswa')
                              ->join('Tb_siswa', 'Tb_siswa.id_siswa = Tb_artikel_trending.id_siswa')
                              ->where('tanggal_penugasan', $selectedDate)
                              ->findAll();
        } else {
             // Jika tidak ada tanggal dipilih, mungkin tampilkan semua data atau data bulan ini
             // Untuk sederhana, kita bisa tampilkan semua data jika tidak ada filter tanggal
             $artikels = $this->artikulasiModel->getArtikelWithSiswa();
        }
        // --- AKHIR LOGIKA DATA ---


        $data = [
            'title' => 'Artikulasi',
            'artikels' => $artikels, // Data artikel yang sudah difilter
            'siswas' => $this->siswaModel->findAll(), // Untuk form Tambah (jika ada)
            'calendar' => $calendar, // Data untuk grid kalender
            'currentMonth' => (int)$currentMonth,
            'currentYear' => (int)$currentYear,
            'monthName' => date('F', $date), // Nama bulan
            'selectedDate' => $selectedDate // Tanggal yang sedang difilter
        ];

        return view('pages/artikulasi/index', $data);
    }

    public function getKalenderData()
    {
        $start = $this->request->getGet('start');
        $end = $this->request->getGet('end');

        $data = $this->artikulasiModel
                     ->select('Tb_artikel_trending.*, Tb_siswa.nama as nama_siswa')
                     ->join('Tb_siswa', 'Tb_siswa.id_siswa = Tb_artikel_trending.id_siswa')
                     ->where('tanggal_penugasan >=', $start)
                     ->where('tanggal_penugasan <=', $end)
                     ->findAll();

        $events = [];
        foreach ($data as $item) {
            $events[] = [
                'title' => $item['nama_siswa'],
                'start' => $item['tanggal_penugasan'],
                'url' => $item['link_trending'],
                'allDay' => true
            ];
        }

        return $this->respond($events);
    }

    public function getArtikelByDate()
    {
        $date = $this->request->getGet('date');
        $artikels = $this->artikulasiModel->getArtikelByDate($date);
        return $this->response->setJSON($artikels);
    }

    public function store()
    {
        $rules = [
            'id_siswa' => 'required|numeric',
            'link_trending' => 'required|valid_url',
            'tanggal_penugasan' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'id_siswa' => $this->request->getPost('id_siswa'),
            'link_trending' => $this->request->getPost('link_trending'),
            'tanggal_penugasan' => $this->request->getPost('tanggal_penugasan')
        ];

        if ($this->artikulasiModel->insert($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Artikel berhasil ditambahkan'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Gagal menambahkan artikel'
        ]);
    }

    public function update($id)
    {
        $rules = [
            'id_siswa' => 'required|numeric',
            'link_trending' => 'required|valid_url',
            'tanggal_penugasan' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'id_siswa' => $this->request->getPost('id_siswa'),
            'link_trending' => $this->request->getPost('link_trending'),
            'tanggal_penugasan' => $this->request->getPost('tanggal_penugasan')
        ];

        if ($this->artikulasiModel->update($id, $data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Artikel berhasil diperbarui'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Gagal memperbarui artikel'
        ]);
    }

    public function delete($id)
    {
        if ($this->artikulasiModel->delete($id)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Artikel berhasil dihapus'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Gagal menghapus artikel'
        ]);
    }

    public function filterByDate()
    {
        $tanggal = $this->request->getGet('tanggal'); // Ambil tanggal dari parameter GET

        if (empty($tanggal)) {
            return $this->response->setJSON([]); // Jika tanggal kosong, kembalikan array kosong
        }

        // Ambil data artikel berdasarkan tanggal penugasan
        $artikels = $this->artikulasiModel
                         ->select('Tb_artikel_trending.*, Tb_siswa.nama as nama_siswa')
                         ->join('Tb_siswa', 'Tb_siswa.id_siswa = Tb_artikel_trending.id_siswa')
                         ->where('tanggal_penugasan', $tanggal) // Filter berdasarkan tanggal spesifik
                         ->findAll();

        return $this->respond($artikels); // Kembalikan data dalam format JSON
    }

    // Method untuk memfilter berdasarkan Tanggal Upload (dipanggil via AJAX)
    public function filterByUploadDate()
    {
        $tanggal_upload = $this->request->getGet('tanggal_upload'); // Ambil tanggal dari parameter GET

        $query = $this->artikulasiModel
                     ->select('Tb_artikel_trending.*, Tb_siswa.nama as nama_siswa')
                     ->join('Tb_siswa', 'Tb_siswa.id_siswa = Tb_artikel_trending.id_siswa');

        // Jika tanggal_upload tidak kosong, tambahkan filter where
        if (!empty($tanggal_upload)) {
            $query->where('tanggal_upload >=', $tanggal_upload . ' 00:00:00')
                  ->where('tanggal_upload <=', $tanggal_upload . ' 23:59:59');
             // Atau jika kolom tanggal_upload hanya DATE, cukup:
             // $query->where('tanggal_upload', $tanggal_upload);
        }

        $artikels = $query->findAll(); // Jalankan query

        return $this->respond($artikels); // Kembalikan data dalam format JSON
    }
}
