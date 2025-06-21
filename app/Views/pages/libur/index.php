<?= $this->extend('layout/template'); ?>

<?= $this->Section('css'); ?>
<style>
    /* ... (CSS Lengkap seperti sebelumnya) ... */
    .calendar-container {
        padding: 10px;
    }

    .calendar {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
        text-align: center;
    }

    .calendar-header {
        font-weight: bold;
        font-size: 0.9em;
        padding-bottom: 10px;
        color: #6c757d;
    }

    .calendar-day {
        padding: 8px 5px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        font-size: 0.9em;
    }

    .calendar-day.empty {
        background-color: #f8f9fa;
        cursor: default;
    }

    .calendar-day:not(.empty):hover {
        background-color: #e9ecef;
        border-color: #adb5bd;
    }

    .calendar-day.selected {
        background-color: #0d6efd;
        color: white;
        border-color: #0a58ca;
        font-weight: bold;
        transform: scale(1.05);
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
    }

    .grid-header {
        text-align: center;
        font-weight: bold;
        padding: 10px;
        background-color: #d1d5db;
        border-radius: 5px;
    }

    .day-cell {
        border: 1px solid #e9ecef;
        border-radius: 5px;
        min-height: 120px;
        padding: 8px;
        background-color: #fff;
        transition: box-shadow 0.2s;
        display: flex;
        flex-direction: column;
    }

    .day-cell:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }

    .day-cell .day-number {
        font-weight: bold;
        font-size: 1.1em;
        color: #6c757d;
        margin-bottom: 8px;
    }

    .day-cell.is-today .day-number {
        color: #fff;
        background-color: #0d6efd;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .day-cell.is-holiday {
        background-color: #fdf2f2;
        border-color: #ffdde0;
    }

    .holiday-item {
        background-color: #dc3545;
        color: white;
        padding: 5px 8px;
        border-radius: 5px;
        font-size: 0.8em;
        margin-top: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        line-height: 1.4;
    }

    .holiday-actions {
        white-space: nowrap;
    }

    .holiday-actions a,
    .holiday-actions button {
        color: white;
        opacity: 0.7;
        margin-left: 5px;
        text-decoration: none;
        background: none;
        border: none;
        padding: 0;
    }

    .holiday-actions a:hover,
    .holiday-actions button:hover {
        opacity: 1;
    }

    /* Elemen ini disembunyikan di desktop */
    .mobile-day-name {
        display: none;
    }

    /* =============================================== */
    /* CSS UNTUK TAMPILAN RESPONSIVE DI HP */
    /* =============================================== */
    @media (max-width: 767px) {

        /* Sembunyikan header hari (Minggu, Senin, dst) di mobile */
        .grid-header {
            display: none;
        }

        /* Ubah grid kalender menjadi tumpukan vertikal */
        .calendar-grid {
            display: block;
        }

        .day-cell {
            min-height: auto;
            margin-bottom: 8px;
            flex-direction: row;
            align-items: center;
            padding: 10px;
            gap: 10px;
        }

        .day-cell .day-number {
            margin-bottom: 0;
            flex-shrink: 0;
        }

        /* Tampilkan nama hari yang tadinya disembunyikan */
        .mobile-day-name {
            display: block;
            font-weight: bold;
            color: #333;
            width: 75px;
            flex-shrink: 0;
            font-size: 0.9em;
        }

        .holiday-list {
            display: flex;
            flex-direction: column;
            width: 100%;
            gap: 5px;
        }

        .holiday-item {
            font-size: 0.85em;
            margin-top: 0;
        }
    }
</style>
<?= $this->endSection(); ?>


<?= $this->Section('content'); ?>
<?php
$namaBulan = date('F', mktime(0, 0, 0, $currentMonth, 10));
$prevMonth = $currentMonth == 1 ? 12 : $currentMonth - 1;
$prevYear = $currentMonth == 1 ? $currentYear - 1 : $currentYear;
$nextMonth = $currentMonth == 12 ? 1 : $currentMonth + 1;
$nextYear = $currentMonth == 12 ? $currentYear + 1 : $currentYear;

// Konversi nama hari ke Bahasa Indonesia
$daysOfWeek = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
?>

<div class="container-fluid py-3">
    <div class="rounded-3 shadow-sm mb-4"
        style="background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="d-flex justify-content-between align-items-center p-4 text-white">
            <div>
                <h1 class="h1 fw-bold">Kalender Hari Libur</h1>
                <p class="text-white-70 small mb-0">Kelola Data Hari Libur</p>
            </div>

            <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-light px-4 py-2 fs-6 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#tambahLiburModal">
                    <i class="fas fa-plus-circle"></i>
                    <span class="d-none d-sm-inline">Tambah Libur</span>
                </button>
            </div>

        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <a href="?month=<?= $prevMonth ?>&year=<?= $prevYear ?>" class="btn btn-outline-secondary">
                <i class="bi bi-chevron-left"></i>
                <span class="d-none d-sm-inline"> Sebelumnya</span> </a>
            <h2 class="fw-bold mb-0 h4 text-primary text-center"><?= $namaBulan . ' ' . $currentYear ?></h2>
            <a href="?month=<?= $nextMonth ?>&year=<?= $nextYear ?>" class="btn btn-outline-secondary">
                <span class="d-none d-sm-inline">Berikutnya </span> <i class="bi bi-chevron-right"></i>
            </a>
        </div>
    </div>

    <div class="calendar-grid">
        <div class="grid-header">Minggu</div>
        <div class="grid-header">Senin</div>
        <div class="grid-header">Selasa</div>
        <div class="grid-header">Rabu</div>
        <div class="grid-header">Kamis</div>
        <div class="grid-header">Jumat</div>
        <div class="grid-header">Sabtu</div>
        <?php
        $daysInMonth = date('t', mktime(0, 0, 0, $currentMonth, 1, $currentYear));
        $firstDayOfMonth = date('w', mktime(0, 0, 0, $currentMonth, 1, $currentYear));
        for ($i = 0; $i < $firstDayOfMonth; $i++) {
            echo '<div class="day-cell bg-light"></div>';
        }
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $isToday = (date('Y-m-d') == "{$currentYear}-" . str_pad($currentMonth, 2, '0', STR_PAD_LEFT) . "-" . str_pad($day, 2, '0', STR_PAD_LEFT));
            $isHoliday = isset($holidaysByDay[$day]);
            $cellClass = 'day-cell' . ($isToday ? ' is-today' : '') . ($isHoliday ? ' is-holiday' : '');
            $dayName = date('l', mktime(0, 0, 0, $currentMonth, $day, $currentYear));

            echo "<div class='{$cellClass}'>";
            echo "<span class='mobile-day-name'>" . ($daysOfWeek[$dayName] ?? $dayName) . "</span>"; // Menampilkan nama hari di mobile
            echo "<div class='day-number'>{$day}</div>";
            echo "<div class='holiday-list'>";
            if ($isHoliday) {
                foreach ($holidaysByDay[$day] as $holiday) {
                    $id = $holiday['id_libur'];
                    $tanggal = $holiday['tgl_libur'];
                    $keterangan = esc($holiday['keterangan'], 'html');
                    echo "<div class='holiday-item'><span>" . $keterangan . "</span><div class='holiday-actions'>";
                    echo "<button type='button' title='Edit' data-bs-toggle='modal' data-bs-target='#editLiburModal' data-bs-id='{$id}' data-bs-tanggal='{$tanggal}' data-bs-keterangan='{$keterangan}'><i class='bi bi-pencil-square'></i></button>";
                    echo "<button type='button' title='Hapus' data-bs-toggle='modal' data-bs-target='#modalHapus' data-bs-url='" . base_url('libur/delete/' . $id) . "'><i class='bi bi-trash'></i></button>";
                    echo "</div></div>";
                }
            }
            echo "</div></div>";
        }
        ?>
    </div>
</div>

<script>
    // =================================================================================
    // PENDEKATAN JAVASCRIPT BARU - LEBIH SEDERHANA DAN AMAN
    // =================================================================================
    document.addEventListener('DOMContentLoaded', function() {

        // --- LOGIKA UNTUK MODAL TAMBAH (MEMBUAT KALENDER) ---
        const tambahModalEl = document.getElementById('tambahLiburModal');
        if (tambahModalEl) {
            const bulanSelect = document.getElementById('bulan');
            const tahunSelect = document.getElementById('tahun');
            const calendarContainer = document.getElementById('calendar-container');
            const selectedDatesInput = document.getElementById('selected_dates');
            let selectedDates = [];

            // Fungsi untuk menggambar kalender
            const drawCalendar = (year, month) => {
                calendarContainer.innerHTML = '';
                const daysInMonth = new Date(year, month, 0).getDate();
                const firstDayOfMonth = new Date(year, month - 1, 1).getDay();
                const calendar = document.createElement('div');
                calendar.className = 'calendar';
                const dayHeaders = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];

                dayHeaders.forEach(header => {
                    const headerEl = document.createElement('div');
                    headerEl.className = 'calendar-header';
                    headerEl.textContent = header;
                    calendar.appendChild(headerEl);
                });

                for (let i = 0; i < firstDayOfMonth; i++) {
                    const emptyCell = document.createElement('div');
                    emptyCell.className = 'calendar-day empty';
                    calendar.appendChild(emptyCell);
                }

                for (let day = 1; day <= daysInMonth; day++) {
                    const dateCell = document.createElement('div');
                    const dateStr = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    dateCell.className = 'calendar-day';
                    dateCell.textContent = day;
                    dateCell.dataset.date = dateStr;

                    if (selectedDates.includes(dateStr)) {
                        dateCell.classList.add('selected');
                    }

                    dateCell.addEventListener('click', () => {
                        dateCell.classList.toggle('selected');
                        const date = dateCell.dataset.date;
                        if (dateCell.classList.contains('selected')) {
                            if (!selectedDates.includes(date)) selectedDates.push(date);
                        } else {
                            selectedDates = selectedDates.filter(d => d !== date);
                        }
                        const finalDates = selectedDates.filter(d => d);
                        selectedDatesInput.value = finalDates.join(',');
                    });
                    calendar.appendChild(dateCell);
                }
                calendarContainer.appendChild(calendar);
            };

            // Listener saat modal TAMBAH akan ditampilkan
            tambahModalEl.addEventListener('show.bs.modal', function() {
                document.getElementById('formTambahLibur').reset();
                selectedDates = [];
                selectedDatesInput.value = '';
                drawCalendar(tahunSelect.value, bulanSelect.value);
            });

            // Listener untuk select bulan & tahun
            bulanSelect.addEventListener('change', () => drawCalendar(tahunSelect.value, bulanSelect.value));
            tahunSelect.addEventListener('change', () => drawCalendar(tahunSelect.value, bulanSelect.value));
        }


        // --- LOGIKA UNTUK MODAL EDIT (MENGISI DATA) ---
        const editModalEl = document.getElementById('editLiburModal');
        if (editModalEl) {
            editModalEl.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-bs-id');
                const tanggal = button.getAttribute('data-bs-tanggal');
                const keterangan = button.getAttribute('data-bs-keterangan');

                const form = document.getElementById('formEditLibur');
                form.action = `<?= base_url('libur/update') ?>/${id}`;
                editModalEl.querySelector('#tanggal_edit').value = tanggal;
                editModalEl.querySelector('#keterangan_edit').value = keterangan;
            });
        }

        // --- LOGIKA UNTUK MODAL HAPUS (MENGATUR URL ACTION) ---
        const hapusModalEl = document.getElementById('modalHapus');
        if (hapusModalEl) {
            hapusModalEl.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const url = button.getAttribute('data-bs-url');
                const form = document.getElementById('formHapus');
                form.action = url;
            });
        }
    });
</script>
<?= $this->endSection(); ?>