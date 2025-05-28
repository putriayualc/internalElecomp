<?php

namespace App\Controllers;

use App\Models\PiketModel;

class Home extends BaseController
{
    // public function index(): string
    // {
    //     $piketModel = new PiketModel();

    //     $resultsJoin = $piketModel->getPiketWithJoin();
    //     $tasks = $piketModel->getAllTugasOrderByBobot();

    //     $piketData = [];
    //     $taskAssignment = [];

    //     $weekNumber = date('W');
    //     $hariMap = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu'];
    //     $hariIni = $hariMap[date('N')];

    //     $userLogin = session()->get('username');
    //     $harusPiket = false;
    //     $tugasHariIni = [];

    //     foreach ($resultsJoin as $row) {
    //         $hari = $row['hari'];
    //         $siswa = $row['nama'];

    //         if (!isset($piketData[$hari])) $piketData[$hari] = [];
    //         $piketData[$hari][] = $siswa;
    //     }

    //     $tugasBobot4 = array_values(array_filter($tasks, fn($t) => $t['bobot'] == 4));
    //     $tugasBobot2 = array_values(array_filter($tasks, fn($t) => $t['bobot'] == 2));

    //     $rotate = function (array $arr, int $steps): array {
    //         $count = count($arr);
    //         if ($count === 0) return $arr;
    //         $steps = $steps % $count;
    //         return array_merge(array_slice($arr, $steps), array_slice($arr, 0, $steps));
    //     };

    //     $tugasBobot4Rotated = $rotate($tugasBobot4, $weekNumber);
    //     $tugasBobot2Rotated = $rotate($tugasBobot2, $weekNumber);

    //     foreach ($piketData as $hari => $siswaList) {
    //         $expectedSiswa = ($hari === 'Sabtu') ? 4 : 3;
    //         $actualSiswaList = array_slice($siswaList, 0, $expectedSiswa);

    //         foreach ($actualSiswaList as $index => $siswa) {
    //             $tugasUntukSiswa = [];

    //             if ($index === 0 && count($tugasBobot4Rotated) > 0) {
    //                 $task = $tugasBobot4Rotated[$index % count($tugasBobot4Rotated)];
    //                 $tugasUntukSiswa[] = $task['nama_tugas'];
    //             } else {
    //                 $countTugas2 = count($tugasBobot2Rotated);
    //                 if ($countTugas2 >= 2) {
    //                     $pos1 = ($index * 2) % $countTugas2;
    //                     $pos2 = ($pos1 + 1) % $countTugas2;
    //                     $tugasUntukSiswa[] = $tugasBobot2Rotated[$pos1]['nama_tugas'];
    //                     $tugasUntukSiswa[] = $tugasBobot2Rotated[$pos2]['nama_tugas'];
    //                 }
    //             }

    //             if (!isset($taskAssignment[$hari])) $taskAssignment[$hari] = [];
    //             $taskAssignment[$hari][$siswa] = $tugasUntukSiswa;

    //             if ($hari === $hariIni && $siswa === $userLogin) {
    //                 $harusPiket = true;
    //                 $tugasHariIni = $tugasUntukSiswa;
    //             }
    //         }
    //     }

    //     return view('pages/dashboard/index', [
    //         'harusPiket' => $harusPiket,
    //         'tugasHariIni' => $tugasHariIni,
    //         'taskAssignment' => $taskAssignment[$hariIni]
    //     ]);
    // }


    public function index(): string
    {
        $piketModel = new PiketModel();

        $resultsJoin = $piketModel->getPiketWithJoin();
        $tasks = $piketModel->getAllTugasOrderByBobot();

        $piketData = [];
        $taskAssignment = [];

        $weekNumber = date('W');
        $hariMap = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu'];
        $hariIni = $hariMap[date('N')];

        $userLogin = session()->get('username');
        $harusPiket = false;
        $tugasHariIni = [];

        foreach ($resultsJoin as $row) {
            $hari = $row['hari'];
            $siswa = $row['nama'];

            if (!isset($piketData[$hari])) {
                $piketData[$hari] = [];
            }

            $piketData[$hari][] = $siswa;
        }

        $tugasBobot4 = array_values(array_filter($tasks, fn($t) => $t['bobot'] == 4));
        $tugasBobot2 = array_values(array_filter($tasks, fn($t) => $t['bobot'] == 2));

        $rotate = function (array $arr, int $steps): array {
            $count = count($arr);
            if ($count === 0) return $arr;
            $steps = $steps % $count;
            return array_merge(array_slice($arr, $steps), array_slice($arr, 0, $steps));
        };

        $tugasBobot4Rotated = $rotate($tugasBobot4, $weekNumber);
        $tugasBobot2Rotated = $rotate($tugasBobot2, $weekNumber);

        foreach ($piketData as $hari => $siswaList) {
            $expectedSiswa = ($hari === 'Sabtu') ? 4 : 3;
            $actualSiswaList = array_slice($siswaList, 0, $expectedSiswa);

            foreach ($actualSiswaList as $index => $siswa) {
                $tugasUntukSiswa = [];

                if ($index === 0 && count($tugasBobot4Rotated) > 0) {
                    $task = $tugasBobot4Rotated[$index % count($tugasBobot4Rotated)];
                    $tugasUntukSiswa[] = $task['nama_tugas'];
                } else {
                    $countTugas2 = count($tugasBobot2Rotated);
                    if ($countTugas2 >= 2) {
                        $pos1 = ($index * 2) % $countTugas2;
                        $pos2 = ($pos1 + 1) % $countTugas2;
                        $tugasUntukSiswa[] = $tugasBobot2Rotated[$pos1]['nama_tugas'];
                        $tugasUntukSiswa[] = $tugasBobot2Rotated[$pos2]['nama_tugas'];
                    }
                }

                if (!isset($taskAssignment[$hari])) {
                    $taskAssignment[$hari] = [];
                }

                $taskAssignment[$hari][$siswa] = $tugasUntukSiswa;

                if ($hari === $hariIni && $siswa === $userLogin) {
                    $harusPiket = true;
                    $tugasHariIni = $tugasUntukSiswa;
                }
            }
        }

        // Ambil hanya jadwal hari ini saja
        $taskToday = isset($taskAssignment[$hariIni]) && is_array($taskAssignment[$hariIni])
            ? $taskAssignment[$hariIni]
            : [];

        return view('pages/dashboard/index', [
            'harusPiket' => $harusPiket,
            'tugasHariIni' => $tugasHariIni,
            'taskToday' => $taskToday,
            'hariIni' => $hariIni
        ]);
    }
}


