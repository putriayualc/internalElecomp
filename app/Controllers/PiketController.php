<?php

namespace App\Controllers;

use App\Models\PiketModel;
use App\Models\HariModel;
use App\Models\SiswaModel;
use App\Models\AbsenModel;

class PiketController extends BaseController
{
    public function index()
    {
        // Inisialisasi model
        $piketModel   = new PiketModel();
        $absenModel   = new AbsenModel();

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
            $siswa = $row['nama'];
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

        // dd($actualSiswaList, $daftarAbsen, $siswaHadir);

        // dd($piketData);

        // dd($taskAssignment);

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
                if (!empty($siswaHadir)) {
                    $penerima = $siswaHadir[0];
                    $taskAssignment[$hariIni][$penerima][] = $tugas['nama_tugas'] . " (pengganti $namaAbsen)";
                    $bobotPerSiswa[$hariIni][$penerima] += $tugas['bobot'];
                }
            }
        }

        // Distribusi sisa tugas ke siswa dengan bobot < 6
        $MAX_BOBOT_PER_SISWA = 6;
        $semuaTugasRotated = array_merge($tugasBobot4Rotated, $tugasBobot2Rotated);
        $semuaTugasYangSudahDiberikan = [];

        if (isset($taskAssignment[$hariIni])) {
            foreach ($taskAssignment[$hariIni] as $siswa => $listTugas) {
                foreach ($listTugas as $tugasString) {
                    $namaTugas = explode(" (", $tugasString)[0];
                    $taskObj   = array_filter($semuaTugasRotated, fn($t) => $t['nama_tugas'] === $namaTugas);
                    $taskObj   = reset($taskObj);
                    $bobot     = $taskObj['bobot'] ?? 0;
                    $semuaTugasYangSudahDiberikan[] = $namaTugas . '-' . $bobot;
                }
            }
        }


        foreach ($semuaTugasRotated as $tugas) {
            $idUnikTugas = $tugas['nama_tugas'] . '-' . $tugas['bobot'];

            if (!in_array($idUnikTugas, $semuaTugasYangSudahDiberikan)) {
                $siswaKekurangan = array_filter($siswaHadir, fn($s) => $bobotPerSiswa[$hariIni][$s] < $MAX_BOBOT_PER_SISWA);

                usort($siswaKekurangan, fn($a, $b) => $bobotPerSiswa[$hariIni][$a] <=> $bobotPerSiswa[$hariIni][$b]);

                if (!empty($siswaKekurangan)) {
                    $penerima = $siswaKekurangan[0];
                } elseif (!empty($siswaHadir)) {
                    $penerima = $siswaHadir[0];
                } else {
                    continue; // Lewati tugas ini, tidak ada penerima yang tersedia
                }

                $taskAssignment[$hariIni][$penerima][] = $tugas['nama_tugas'] . " (tugas sisa)";
                $bobotPerSiswa[$hariIni][$penerima] += $tugas['bobot'];
            }
        }

        // Pastikan tidak ada tugas untuk siswa absen
        foreach ($daftarAbsen as $namaAbsen) {
            unset($taskAssignment[$hariIni][$namaAbsen]);
        }



        return view('pages/piket/index', [
            'piketData' => $piketData,
            'taskAssignment' => $taskAssignment,
            'harusPiket' => $harusPiket,
            'tugasHariIni' => $tugasHariIni
        ]);
    }



    public function edit($hari)
    {
        $piketModel = new PiketModel();
        $hariModel = new HariModel();
        $siswaModel = new SiswaModel();

        $hariCapital = ucfirst(strtolower($hari));

        // Cari ID hari berdasarkan nama
        $hariRow = $hariModel->where('hari', $hariCapital)->first();

        if (!$hariRow) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Hari $hariCapital tidak ditemukan");
        }

        $idHari = $hariRow['id_hari'];

        // Ambil siswa yang piket di hari ini
        $piketRows = $piketModel->where('id_hari', $idHari)->findAll();

        $namaList = [];
        foreach ($piketRows as $piket) {
            $siswa = $siswaModel->find($piket['id_siswa']);
            if ($siswa) {
                $namaList[] = $siswa['nama'];
            }
        }

        $semuaNama = $siswaModel->findAll(); // Semua siswa dari database

        return view('pages/piket/edit', [
            'hari' => $hariCapital,
            'namaList' => $namaList,
            'semuaNama' => array_column($semuaNama, 'nama') // array hanya nama
        ]);
    }


    public function update()
    {
        $piketModel = new PiketModel();
        $hariModel = new HariModel();
        $siswaModel = new SiswaModel();

        $hari = $this->request->getPost('hari'); // e.g. "Senin"
        $namaArray = $this->request->getPost('nama'); // Array of names

        // Cari ID hari
        $hariRow = $hariModel->where('hari', $hari)->first();
        if (!$hariRow) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Hari $hari tidak ditemukan");
        }

        $idHari = $hariRow['id_hari'];

        // Hapus semua data piket untuk hari itu dulu
        $piketModel->where('id_hari', $idHari)->delete();

        // Masukkan data baru
        foreach ($namaArray as $nama) {
            $siswa = $siswaModel->where('nama', $nama)->first();
            if ($siswa) {
                $piketModel->insert([
                    'id_hari' => $idHari,
                    'id_siswa' => $siswa['id_siswa']
                ]);
            }
        }
        return redirect()->to(base_url('piket'));
    }
}
