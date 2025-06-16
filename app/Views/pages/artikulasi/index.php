<?= $this->extend('layout/template'); ?>

<?= $this->section('styles'); ?>
    <!-- CSS Kustom untuk Kalender Sederhana dan Tabel -->
    <style>
        /* Style untuk Kalender Sederhana PHP */
        .simple-calendar {
            max-width: 300px;
            margin-bottom: 20px;
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            font-family: Arial, sans-serif;
        }
        .simple-calendar table {
            width: 100%;
            border-collapse: collapse;
        }
        .simple-calendar th {
            text-align: center;
            padding: 8px 0;
            background-color: #f8f9fa;
            font-size: 0.9em;
        }
        .simple-calendar td {
            text-align: center;
            padding: 5px;
            border: 1px solid #eee;
            font-size: 0.9em;
        }
        .simple-calendar td a {
            display: block;
            text-decoration: none;
            color: #333;
            padding: 5px;
            border-radius: 4px;
        }
         .simple-calendar td a:hover {
             background-color: #e9ecef;
         }
         .simple-calendar td a.selected {
             background-color: #007bff;
             color: white;
         }
         .simple-calendar .today a {
             background-color: #fff3cd; /* Warna hari ini */
         }

         .calendar-header {
             display: flex;
             justify-content: space-between;
             align-items: center;
             margin-bottom: 10px;
             font-size: 1.1em;
             font-weight: bold;
         }
         .calendar-header a {
             text-decoration: none;
             color: #333;
             padding: 5px;
         }

        /* Style untuk Tabel Data */
        .app-card-body .table th,
        .app-card-body .table td {
            vertical-align: middle;
        }
        .app-card-body .table td a {
            word-break: break-all;
        }
    </style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Dashboard Artikulasi Trending</h1>
                </div>
                 <!-- Tombol Tambah Artikel (jika masih diperlukan) -->
                 <!-- ... kode tombol tambah ... -->
            </div>

            <!-- Kalender Sederhana PHP -->
            <div class="simple-calendar">
                 <div class="calendar-header">
                     <?php
                     $prevMonth = $currentMonth - 1;
                     $prevYear = $currentYear;
                     if ($prevMonth < 1) {
                         $prevMonth = 12;
                         $prevYear--;
                     }
                     $nextMonth = $currentMonth + 1;
                     $nextYear = $currentYear;
                     if ($nextMonth > 12) {
                         $nextMonth = 1;
                         $nextYear++;
                     }
                     ?>
                     <a href="?month=<?= $prevMonth ?>&year=<?= $prevYear ?>">&lt;</a>
                     <span><?= esc($monthName) ?> <?= esc($currentYear) ?></span>
                     <a href="?month=<?= $nextMonth ?>&year=<?= $nextYear ?>">&gt;</a>
                 </div>
                 <table>
                     <thead>
                         <tr>
                             <th>Min</th><th>Sen</th><th>Sel</th><th>Rab</th><th>Kam</th><th>Jum</th><th>Sab</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                         $today = date('Y-m-d');
                         $selectedDateFormatted = $selectedDate; // Biarkan format YYYY-MM-DD

                         foreach ($calendar as $week) : ?>
                             <tr>
                                 <?php foreach ($week as $day) :
                                     $dateFormatted = '';
                                     $isToday = false;
                                     $isSelected = false;
                                     $cellClass = '';

                                     if ($day != '') {
                                         $dateFormatted = sprintf('%04d-%02d-%02d', $currentYear, $currentMonth, $day);
                                         $isToday = ($dateFormatted == $today);
                                         $isSelected = ($dateFormatted == $selectedDateFormatted);
                                         $cellClass = $isToday ? 'today' : '';
                                     }
                                 ?>
                                     <td class="<?= $cellClass ?>">
                                         <?php if ($day != '') : ?>
                                             <a href="?month=<?= $currentMonth ?>&year=<?= $currentYear ?>&tanggal=<?= $dateFormatted ?>"
                                                class="<?= $isSelected ? 'selected' : '' ?>">
                                                 <?= esc($day) ?>
                                             </a>
                                         <?php endif; ?>
                                     </td>
                                 <?php endforeach; ?>
                             </tr>
                         <?php endforeach; ?>
                     </tbody>
                 </table>
                 <?php if ($selectedDate) : ?>
                     <div class="text-center mt-2">
                         <a href="?month=<?= $currentMonth ?>&year=<?= $currentYear ?>">Reset Filter Tanggal</a>
                     </div>
                 <?php endif; ?>
            </div>
            <!-- End Kalender Sederhana PHP -->

             <!-- Pesan atau informasi filter -->
            <div id="filter-info" class="alert alert-info" role="alert">
                <?php if ($selectedDate) : ?>
                    Menampilkan data untuk tanggal penugasan: <strong><?= esc($selectedDate) ?></strong>
                <?php else : ?>
                    Menampilkan semua data artikulasi trending.
                <?php endif; ?>
            </div>


            <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-body p-4">
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
                                    <th class="cell">No</th>
                                    <th class="cell">Nama Siswa</th>
                                    <th class="cell">Link Trending</th>
                                    <th class="cell">Tanggal Penugasan</th>
                                    <th class="cell">Tanggal Upload</th>
                                </tr>
                            </thead>
                            <tbody id="artikel-table-body">
                                <?php
                                // Data dari controller sudah difilter berdasarkan $selectedDate jika ada
                                if (isset($artikels) && is_array($artikels) && !empty($artikels)) :
                                    $no = 1;
                                    foreach ($artikels as $artikel) :
                                ?>
                                        <tr>
                                            <td class="cell"><?= $no++; ?></td>
                                            <td class="cell"><?= esc($artikel['nama_siswa']); ?></td>
                                            <td class="cell">
                                                <a href="<?= esc($artikel['link_trending']); ?>" target="_blank">
                                                    <?= esc($artikel['link_trending']); ?>
                                                </a>
                                            </td>
                                            <td class="cell"><?= esc($artikel['tanggal_penugasan']); ?></td>
                                            <td class="cell"><?= esc(date('Y-m-d H:i:s', strtotime($artikel['tanggal_upload']))); ?></td>
                                        </tr>
                                    <?php
                                    endforeach;
                                else :
                                    ?>
                                    <tr>
                                        <td colspan="5" class="cell text-center">
                                            <?php if ($selectedDate) : ?>
                                                Tidak ada data artikulasi untuk tanggal penugasan <?= esc($selectedDate) ?>.
                                            <?php else : ?>
                                                Belum ada data artikulasi trending.
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Artikel (jika masih diperlukan) -->
<!-- ... kode modal ... -->


<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
    <!-- TIDAK ADA LIBRARY KALENDER DI SINI -->
    <!-- Jika ada script lain yang Anda butuhkan, bisa ditambahkan -->
<?= $this->endSection(); ?>