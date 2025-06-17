<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AbsenModel;
use App\Models\UsersModel;

class AbsenDashboardController extends BaseController
{
    public function index()
{
    $absensi = new AbsenModel();
    $users = new UsersModel();

    // Ambil semua user kecuali admin (id_user = 1)
    $user = $users
        ->where('tb_users.id_user !=', 1)
        ->findAll();

    $dataAbsenHariIni = $absensi
        ->select('tb_absen.*, tb_users.*')
        ->join('tb_users', 'tb_users.id_user = tb_absen.id_user')
        ->where('DATE(tanggal_waktu)', date('Y-m-d'))
        // ->where('persetujuan', 'Terima') // opsional
        ->findAll();

        // dd($dataAbsenHariIni);

    // Buat array default dengan nilai 0
    $statistik = [
        'Masuk' => 0,
        'Ijin' => 0,
        'Sakit' => 0,
        'Bolos' => 0
    ];
    
    foreach ($dataAbsenHariIni as $absen) {
        $status = $absen['status']; // atau $absen->status jika getResult()
        if (array_key_exists($status, $statistik)) {
            $statistik[$status]++;
        }
    }

    // dd($statistik);

    // Kirim ke view
    $data = [
        'user' => $user,
        'statistik' => $statistik
    ];

    return view('pages/absenDashboard/index', $data);
}




    public function grafikMingguan()
    {
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');
        $user = $this->request->getGet('user');
        $status = $this->request->getGet('status');

        // Hitung jumlah minggu di bulan dan tahun tersebut
        $firstDay = new \DateTime("$tahun-$bulan-01");
        $lastDay = clone $firstDay;
        $lastDay->modify('last day of this month');

        // Minggu pertama bulan (angka minggu dalam tahun)
        $weekFirst = (int)$firstDay->format("W");
        // Minggu terakhir bulan (angka minggu dalam tahun)
        $weekLast = (int)$lastDay->format("W");

        // Penyesuaian untuk minggu terakhir Desember (mungkin bernilai kecil seperti 1, karena tahun baru)
        if ($weekLast < $weekFirst) {
            // Contoh: jika Desember minggu ke 52 lalu minggu pertama tahun baru 1
            $weekLast += 52;
        }

        $totalMinggu = $weekLast - $weekFirst + 1;

        $db = \Config\Database::connect();
        $builder = $db->table('tb_absen');
        $builder->select("WEEK(tanggal_waktu, 1) AS minggu_ke, COUNT(*) as jumlah");
        $builder->where("MONTH(tanggal_waktu)", $bulan);
        $builder->where("YEAR(tanggal_waktu)", $tahun);
        $builder->where("id_user", $user);
        $builder->where("status", $status);
        $builder->where("persetujuan", "Terima");
        $builder->groupBy("minggu_ke");
        $builder->orderBy("minggu_ke");
        $query = $builder->get();

        $result = $query->getResult();

        $data = [];

        // Buat default minggu sesuai total minggu di bulan tsb
        for ($i = 0; $i < $totalMinggu; $i++) {
            $mingguKe = $weekFirst + $i;
            $label = "Minggu " . ($i + 1);
            $data[$label] = 0;
        }

        foreach ($result as $row) {
            // hitung indeks minggu relatif ke minggu pertama
            $index = $row->minggu_ke - $weekFirst;
            if ($index >= 0 && $index < $totalMinggu) {
                $label = "Minggu " . ($index + 1);
                $data[$label] = (int)$row->jumlah;
            }
        }

        return $this->response->setJSON($data);
    }


}
