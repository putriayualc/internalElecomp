<?php

namespace App\Controllers;

use App\Models\AbsenModel;
use App\Models\ArtikelModel;
use App\Models\BisnisModel;
use App\Models\DetailProspekModel;
use App\Models\HostingModel;
use App\Models\KontenModel;
use App\Models\PiketModel;
use App\Models\ProspekEmailModel;
use App\Models\ProspekWhatsappModel;
use App\Models\SiswaModel;
use App\Models\SopModel;
use App\Models\EmailModel;
use App\Models\BlogModel;
use App\Models\SosmedModel;

class Home extends BaseController
{
    public function index()
    {
        // Inisialisasi model
        $piketModel   = new PiketModel();
        $absenModel   = new AbsenModel();
        $artikelModel = new ArtikelModel();
        $emailModel   = new EmailModel();
        $blogModel    = new BlogModel();

        // Ambil data piket dan tugas
        $resultsJoin = $piketModel->getPiketWithJoin();
        $tasks       = $piketModel->getAllTugasOrderByBobot();

        // Inisialisasi variabel
        $piketData       = [];
        $taskAssignment  = [];
        $bobotPerSiswa   = [];
        $weekNumber      = date('W');
        $hariMap         = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
        $hariIni         = $hariMap[date('N')];
        $userLogin       = session()->get('username');
        $harusPiket      = false;
        $tugasHariIni    = [];

        // Ambil data absen hari ini
        $rawAbsen = $absenModel->getDataAbsen(date('Y-m-d'));
        $absenData = [];

        foreach ($rawAbsen as $item) {
            $hariInggris = date('l', strtotime($item['tanggal_waktu']));
            $mapHari = [
                'Monday'    => 'Senin',
                'Tuesday'   => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday'  => 'Kamis',
                'Friday'    => 'Jumat',
                'Saturday'  => 'Sabtu',
                'Sunday'  => 'Minggu'
            ];

            $hari = $mapHari[$hariInggris] ?? null;
            if ($hari) {
                $absenData[$hari][] = $item;
            }
        }

        // Pemetaan siswa piket berdasarkan status "aktif"
        foreach ($resultsJoin as $row) {
            if (strtolower($row['status']) !== 'aktif') continue;

            $hari  = $row['hari'];
            $siswa = $row['username'];
            $piketData[$hari][] = $siswa;
        }

        if ($hariIni == 'Minggu') {
    return; // atau redirect()->back() jika di controller
}


        // Filter tugas berdasarkan bobot
        $tugasBobot4 = array_values(array_filter($tasks, fn($t) => $t['bobot'] == 4));
        $tugasBobot2 = array_values(array_filter($tasks, fn($t) => $t['bobot'] == 2));

        // Fungsi rotasi array berdasarkan minggu keberapa
        $rotate = fn(array $arr, int $steps): array =>
        count($arr) ? array_merge(array_slice($arr, $steps % count($arr)), array_slice($arr, 0, $steps % count($arr))) : [];

        $tugasBobot4Rotated = $rotate($tugasBobot4, $weekNumber);
        $tugasBobot2Rotated = $rotate($tugasBobot2, $weekNumber);

        // Ambil siswa piket hari ini dan filter hanya yang hadir
        $actualSiswaList = $piketData[$hariIni] ?? [];
        $daftarAbsen     = isset($absenData[$hariIni]) ? array_map(fn($x) => $x['username'], $absenData[$hariIni]) : [];
        $siswaHadir      = array_values(array_filter($actualSiswaList, fn($s) => !in_array($s, $daftarAbsen)));

        // Inisialisasi bobot awal siswa hadir
        foreach ($siswaHadir as $s) {
            $bobotPerSiswa[$hariIni][$s] = 0;
        }

        // Acak urutan siswa hadir dengan seed minggu dan tahun
        $seed = intval(date('o')) * 100 + intval($weekNumber);
        mt_srand($seed);
        usort($siswaHadir, fn($a, $b) => mt_rand(-1, 1));
        mt_srand(); // reset seed ke default

        // Tentukan penanggung jawab utama (tugas bobot 4)
        $penanggungJawabIndex = $weekNumber % (count($siswaHadir) ?: 1);
        $assignedTasks = [];
        $indexHadir = 0;

        // Distribusi tugas ke siswa yang hadir
        foreach ($siswaHadir as $siswa) {
            $tugasUntukSiswa = [];

            if ($indexHadir === $penanggungJawabIndex && count($tugasBobot4Rotated) > 0) {
                foreach ($tugasBobot4Rotated as $task) {
                    if (!in_array($task['nama_tugas'], $assignedTasks)) {
                        $tugasUntukSiswa[] = $task['nama_tugas'];
                        $assignedTasks[] = $task['nama_tugas'];
                        $bobotPerSiswa[$hariIni][$siswa] += 4;
                        break;
                    }
                }
            } else {
                $tugas2Terpilih = [];
                foreach ($tugasBobot2Rotated as $task) {
                    if (!in_array($task['nama_tugas'], $assignedTasks)) {
                        $tugas2Terpilih[] = $task['nama_tugas'];
                        $assignedTasks[] = $task['nama_tugas'];
                        if (count($tugas2Terpilih) == 2) break;
                    }
                }

                foreach ($tugas2Terpilih as $tugas) {
                    $tugasUntukSiswa[] = $tugas;
                    $bobotPerSiswa[$hariIni][$siswa] += 2;
                }
            }

            $taskAssignment[$hariIni][$siswa] = $tugasUntukSiswa;

            if ($siswa === $userLogin) {
                $harusPiket   = true;
                $tugasHariIni = $tugasUntukSiswa;
            }

            $indexHadir++;
        }

        // Penanganan tugas pengganti untuk siswa yang absen
        foreach ($daftarAbsen as $namaAbsen) {
            $indexAbsen = array_search($namaAbsen, $actualSiswaList);
            if ($indexAbsen === false) continue;

            $tugasAbsen = [];

            if ($indexAbsen === $penanggungJawabIndex && count($tugasBobot4Rotated) > 0) {
                foreach ($tugasBobot4Rotated as $task) {
                    if (!in_array($task['nama_tugas'], $assignedTasks)) {
                        $tugasAbsen[] = ['nama_tugas' => $task['nama_tugas'], 'bobot' => 4];
                        $assignedTasks[] = $task['nama_tugas'];
                        break;
                    }
                }
            } else {
                $count = 0;
                foreach ($tugasBobot2Rotated as $task) {
                    if (!in_array($task['nama_tugas'], $assignedTasks)) {
                        $tugasAbsen[] = ['nama_tugas' => $task['nama_tugas'], 'bobot' => 2];
                        $assignedTasks[] = $task['nama_tugas'];
                        $count++;
                        if ($count == 2) break;
                    }
                }
            }

            foreach ($tugasAbsen as $tugas) {
                usort($siswaHadir, fn($a, $b) => $bobotPerSiswa[$hariIni][$a] <=> $bobotPerSiswa[$hariIni][$b]);
                $penerima = $siswaHadir[0];
                $taskAssignment[$hariIni][$penerima][] = $tugas['nama_tugas'] . " (pengganti $namaAbsen)";
                $bobotPerSiswa[$hariIni][$penerima] += $tugas['bobot'];
            }
        }

        // Distribusi sisa tugas ke siswa dengan bobot < 6
        $MAX_BOBOT_PER_SISWA = 6;
        $semuaTugasRotated = array_merge($tugasBobot4Rotated, $tugasBobot2Rotated);
        $semuaTugasYangSudahDiberikan = [];

        foreach ($taskAssignment[$hariIni] as $siswa => $listTugas) {
            foreach ($listTugas as $tugasString) {
                $namaTugas = explode(" (", $tugasString)[0];
                $taskObj   = array_filter($semuaTugasRotated, fn($t) => $t['nama_tugas'] === $namaTugas);
                $taskObj   = reset($taskObj);
                $bobot     = $taskObj['bobot'] ?? 0;
                $semuaTugasYangSudahDiberikan[] = $namaTugas . '-' . $bobot;
            }
        }

        foreach ($semuaTugasRotated as $tugas) {
            $idUnikTugas = $tugas['nama_tugas'] . '-' . $tugas['bobot'];

            if (!in_array($idUnikTugas, $semuaTugasYangSudahDiberikan)) {
                $siswaKekurangan = array_filter($siswaHadir, fn($s) => $bobotPerSiswa[$hariIni][$s] < $MAX_BOBOT_PER_SISWA);

                usort($siswaKekurangan, fn($a, $b) => $bobotPerSiswa[$hariIni][$a] <=> $bobotPerSiswa[$hariIni][$b]);

                $penerima = $siswaKekurangan[0] ?? $siswaHadir[0];
                $taskAssignment[$hariIni][$penerima][] = $tugas['nama_tugas'] . " (tugas sisa)";
                $bobotPerSiswa[$hariIni][$penerima] += $tugas['bobot'];
            }
        }

        // Pastikan tidak ada tugas untuk siswa absen
        foreach ($daftarAbsen as $namaAbsen) {
            unset($taskAssignment[$hariIni][$namaAbsen]);
        }

        // Kirim data akhir ke view
        $taskToday = $taskAssignment[$hariIni] ?? [];

        //---------------------------------------------------------------

        // Total siswa magang yang aktif
        $siswaMagangModel = new SiswaModel();
        $totalSiswaMagang = $siswaMagangModel->where('status', 'aktif')->countAllResults();

        //---------------------------------------------------------------

        // Total artikel
        $artikelModel = new ArtikelModel();
        $totalArtikel = $artikelModel->countAll();

        //---------------------------------------------------------------

        // Total SOP
        $sopModel = new SopModel();
        $totalSop = $sopModel->countAll();

        //---------------------------------------------------------------

        // Total Bisnis
        $bisnisModel = new BisnisModel();
        $totalBisnis = $bisnisModel->countAll();

        //---------------------------------------------------------------

        // Total Email
        $emailModel   = new EmailModel();
        $totalEmail   = $emailModel->countAll();

        //---------------------------------------------------------------

        // Total Blog
        $blogModel    = new BlogModel();
        $totalBlog    = $blogModel->countAll();

        //---------------------------------------------------------------

        // Chart Sosmed
        $sosmedModel = new SosmedModel();
        $jumlahPerPlatform = $sosmedModel->getJumlahPerPlatform();

        // Hitung total semua platform
        $totalSosmed = array_sum(array_column($jumlahPerPlatform, 'total'));

        // Hitung persentase per platform
        $persenPerPlatform = [];
        foreach ($jumlahPerPlatform as $item) {
            $platform = $item['platform'];
            $jumlah = $item['total'];
            $persen = $totalSosmed > 0 ? round(($jumlah / $totalSosmed) * 100, 2) : 0;
            $persenPerPlatform[$platform] = $persen;
        }

        //---------------------------------------------------------------

        //Chart Absen
        $absenModel = new AbsenModel();
        $jumlahSiswaAbsen = $absenModel->getStatistikAbsensi();

        $labelsAbsen = [];
        $dataAbsen = [];
        $persentaseAbsen = [];

        $totalAbsen = 0;

        // Hitung total absen
        foreach ($jumlahSiswaAbsen as $row) {
            $totalAbsen += (int) $row['total'];
        }

        // Proses data & hitung persentase
        foreach ($jumlahSiswaAbsen as $row) {
            $status = ucfirst($row['status']);
            $jumlah = (int) $row['total'];
            $persentase = $totalAbsen > 0 ? round(($jumlah / $totalAbsen) * 100, 1) : 0;

            $labelsAbsen[] = $status;
            $dataAbsen[] = $jumlah;
            $persentaseAbsen[] = $persentase; // dalam persen
        }

        //---------------------------------------------------------------

        // Chart Hosting
        $hostingModel = new HostingModel();
        $result = $hostingModel->getHostingWithAddonCount();

        $labelsHosting = [];
        $dataAddon = [];
        $dataHosting = [];

        foreach ($result as $row) {
            $labelsHosting[] = $row['domain_utama'];
            $dataAddon[] = (int) $row['total_addon'];
            $dataHosting[] = 1;
        }

        // Hitung persentase
        $totalHosting = array_sum($dataHosting);
        $totalAddon = array_sum($dataAddon);
        $total = $totalHosting + $totalAddon;

        $percentageHosting = $total > 0 ? round(($totalHosting / $total) * 100) : 0;
        $percentageAddon = $total > 0 ? round(($totalAddon / $total) * 100) : 0;

        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $kontenModel = new KontenModel();
        $kontenPerMinggu = [0, 0, 0, 0];

        $bulanAktif = $_GET['bulan'] ?? date('m');
        $tahunAktif = $_GET['tahun'] ?? date('Y');

        $awalBulan = "$tahunAktif-$bulanAktif-01";
        $akhirBulan = date('Y-m-t', strtotime($awalBulan));

        $konten = $kontenModel->where('tgl_upload >=', $awalBulan)
            ->where('tgl_upload <=', $akhirBulan)
            ->findAll();

        foreach ($konten as $item) {
            $tanggal = strtotime($item['tgl_upload']);
            $mingguKe = ceil(date('j', $tanggal) / 7);
            $mingguIndex = max(0, min($mingguKe - 1, 3));
            $kontenPerMinggu[$mingguIndex]++;
        }

        $detailModel = new DetailProspekModel();
        $emailModel = new ProspekEmailModel();
        $waModel = new ProspekWhatsappModel();

        $detail = $detailModel->findAll();
        $emails = $emailModel->findAll();
        $whatsapps = $waModel->findAll();

        $duaHariLalu = date('Y-m-d H:i:s', strtotime('-2 days'));

        $detailModel = new DetailProspekModel();
        $emailModel = new ProspekEmailModel();
        $waModel = new ProspekWhatsappModel();

        $detail = $detailModel->findAll();
        $emails = $emailModel->findAll();
        $whatsapps = $waModel->findAll();

        $duaHariLalu = date('Y-m-d H:i:s', strtotime('-2 days'));
        $merged = [];

        foreach ($detail as $d) {
            if ($d['tanggal'] >= $duaHariLalu) {
                $merged[] = [
                    'nama_perusahaan' => $d['nama_perusahaan'],
                    'keterangan' => $d['keterangan_lainnya'],
                    'tanggal' => $d['tanggal'],
                    'sumber' => 'Detail Prospek',
                    'waktu_lalu' => $this->waktuLalu($d['tanggal']),
                ];
            }
        }

        foreach ($emails as $e) {
            if ($e['tanggal'] >= $duaHariLalu) {
                $merged[] = [
                    'nama_perusahaan' => $e['nama_perusahaan'],
                    'keterangan' => $e['pesan'],
                    'tanggal' => $e['tanggal'],
                    'sumber' => 'Email',
                    'waktu_lalu' => $this->waktuLalu($e['tanggal']),
                ];
            }
        }

        foreach ($whatsapps as $w) {
            if ($w['tanggal'] >= $duaHariLalu) {
                $merged[] = [
                    'nama_perusahaan' => $w['nama_perusahaan'],
                    'keterangan' => $w['pesan'],
                    'tanggal' => $w['tanggal'],
                    'sumber' => 'WhatsApp',
                    'waktu_lalu' => $this->waktuLalu($w['tanggal']),
                ];
            }
        }

        // Urutkan berdasarkan waktu terbaru
        usort($merged, fn($a, $b) => strtotime($b['tanggal']) <=> strtotime($a['tanggal']));

        // Ambil hanya 20 terbaru
        $merged = array_slice($merged, 0, 20);

        $role = session()->get('role');

        // BUAT UPDATE STATUS SISWA
        if (!session()->get('status_siswa_checked')) {
            $siswaModel = new SiswaModel();
            $siswaModel->updateStatus();
            session()->set('status_siswa_checked', true); // Cegah dipanggil lagi selama sesi
        }

        if ($role === 'admin') {
            return view('pages/dashboard/index', [
                'taskToday' => $taskToday,
                'hariIni' => $hariIni,
                'harusPiket' => $harusPiket,
                'tugasHariIni' => $tugasHariIni,
                'absenData' => $absenData,
                'totalSiswaMagang' => $totalSiswaMagang,
                'totalArtikel' => $totalArtikel,
                'totalSop' => $totalSop,
                'totalBisnis' => $totalBisnis,
                'jumlahPerPlatform' => $jumlahPerPlatform,
                'jumlahSiswaAbsen' => $jumlahSiswaAbsen,
                'absensiLabels' => $labelsAbsen,
                'absensiData' => $dataAbsen,
                'absensiPersen' => $persentaseAbsen,
                'hostingLabels' => $labelsHosting,
                'dataAddon' => $dataAddon,
                'dataHosting' => $dataHosting,
                'percentageHosting' => $percentageHosting,
                'percentageAddon' => $percentageAddon,
                'totalEmail'   => $totalEmail,
                'totalBlog'    => $totalBlog,
                'bulanAktif'       => $bulan,
                'tahunAktif'       => $tahun,
                'kontenPerMinggu' => $kontenPerMinggu,
                'persenPerPlatform' => $persenPerPlatform,
                'prospekList' => $merged
            ]);
        } elseif ($role === 'user') {
            return view('pages/dashboard/user', [
                'taskToday' => $taskToday,
                'hariIni' => $hariIni,
                'harusPiket' => $harusPiket,
                'tugasHariIni' => $tugasHariIni,
                'totalSiswaMagang' => $totalSiswaMagang,
                'totalArtikel' => $totalArtikel,
                'totalSop' => $totalSop,
                'totalBisnis' => $totalBisnis,
                'totalEmail'   => $totalEmail,
                'totalBlog'    => $totalBlog,
                'hostingLabels' => $labelsHosting,
                'dataAddon' => $dataAddon,
                'dataHosting' => $dataHosting,
                'percentageHosting' => $percentageHosting,
                'percentageAddon' => $percentageAddon,
                'bulanAktif'       => $bulan,
                'tahunAktif'       => $tahun,
                'kontenPerMinggu' => $kontenPerMinggu,
                'persenPerPlatform' => $persenPerPlatform,
                'prospekList' => $merged
            ]);
        }
    }

    private function waktuLalu($datetime)
    {
        $timestamp = strtotime($datetime);
        $selisih = time() - $timestamp;

        if ($selisih < 60) return "$selisih detik yang lalu";
        elseif ($selisih < 3600) return floor($selisih / 60) . " menit yang lalu";
        elseif ($selisih < 86400) return floor($selisih / 3600) . " jam yang lalu";
        else return floor($selisih / 86400) . " hari yang lalu";
    }
}
