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
        border-color: transparent;
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
        background-color: #f1f5f9; /* Warna lebih soft */
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

    /* Penanda hari ini */
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
    
    /* Sel kosong di awal bulan */
    .day-cell.empty-cell {
        background-color: #f8f9fa;
        border: 1px dashed #e0e0e0;
    }

    /* Penanda hari libur */
    .day-cell.is-holiday {
        background-color: #fdf2f2;
        border-color: #ffdde0;
    }

    .holiday-list {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .holiday-item {
        background-color: #dc3545;
        color: white;
        padding: 5px 8px;
        border-radius: 5px;
        font-size: 0.8em;
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
        cursor: pointer;
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
        .calendar-grid {
            display: block; /* Ubah grid kalender menjadi tumpukan vertikal */
        }

        .grid-header {
            display: none; /* Sembunyikan header hari (Minggu, Senin, dst) di mobile */
        }

        .day-cell, .day-cell.empty-cell {
            min-height: auto;
            margin-bottom: 8px;
            flex-direction: row;
            align-items: flex-start; /* Ubah alignment */
            padding: 10px;
            gap: 10px;
        }

        .day-cell .day-number {
            margin-bottom: 0;
            margin-top: 2px;
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
            width: 100%;
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
// --- PERSIAPAN DATA ---
// Mendapatkan data bulan dan tahun dari query string, atau default ke saat ini
// Diasumsikan variabel ini dikirim dari Controller: $currentMonth, $currentYear, $holidaysByDay
$currentMonth = $currentMonth ?? date('n');
$currentYear = $currentYear ?? date('Y');
$holidaysByDay = $holidaysByDay ?? [];

// Logika untuk navigasi bulan sebelumnya dan berikutnya
$namaBulan = date('F', mktime(0, 0, 0, $currentMonth, 1));
$prevMonth = ($currentMonth == 1) ? 12 : $currentMonth - 1;
$prevYear = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;
$nextMonth = ($currentMonth == 12) ? 1 : $currentMonth + 1;
$nextYear = ($currentMonth == 12) ? $currentYear + 1 : $currentYear;

// Konversi nama hari ke Bahasa Indonesia untuk tampilan mobile
$daysOfWeek = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
?>

<div class="container-fluid py-3">
    <div class="rounded-3 shadow-sm mb-4" style="background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="d-flex justify-content-between align-items-center p-4 text-white">
            <div>
                <h1 class="h2 fw-bold">Kalender Hari Libur</h1>
                <p class="text-white-70 small mb-0">Kelola Data Hari Libur Nasional dan Cuti Bersama</p>
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
                <span class="d-none d-sm-inline"> Sebelumnya</span>
            </a>
            <h2 class="fw-bold mb-0 h4 text-primary text-center"><?= $namaBulan . ' ' . $currentYear ?></h2>
            <a href="?month=<?= $nextMonth ?>&year=<?= $nextYear ?>" class="btn btn-outline-secondary">
                <span class="d-none d-sm-inline">Berikutnya </span>
                <i class="bi bi-chevron-right"></i>
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
        $firstDayOfMonth = date('w', mktime(0, 0, 0, $currentMonth, 1, $currentYear)); // 0 (Minggu) - 6 (Sabtu)

        // Buat sel kosong untuk hari sebelum tanggal 1
        for ($i = 0; $i < $firstDayOfMonth; $i++) {
            echo '<div class="day-cell empty-cell"></div>';
        }

        // Buat sel untuk setiap hari dalam sebulan
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $currentDateStr = "{$currentYear}-" . str_pad($currentMonth, 2, '0', STR_PAD_LEFT) . "-" . str_pad($day, 2, '0', STR_PAD_LEFT);
            $isToday = (date('Y-m-d') == $currentDateStr);
            $isHoliday = isset($holidaysByDay[$day]);
            $dayName = date('l', mktime(0, 0, 0, $currentMonth, $day, $currentYear));
            
            $cellClass = 'day-cell';
            if ($isToday) $cellClass .= ' is-today';
            if ($isHoliday) $cellClass .= ' is-holiday';

            echo "<div class='{$cellClass}'>";
            
            // Kolom kiri untuk info hari (Responsive)
            echo "<div class='d-flex flex-column align-items-center flex-shrink-0'>";
            echo "<span class='mobile-day-name'>" . ($daysOfWeek[$dayName] ?? $dayName) . "</span>"; // Tampil di mobile
            echo "<div class='day-number'>{$day}</div>";
            echo "</div>";

            // Kolom kanan untuk daftar libur
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
        
        // Buat sel kosong setelah hari terakhir
        $lastDayOfMonth = date('w', mktime(0, 0, 0, $currentMonth, $daysInMonth, $currentYear));
        for ($i = $lastDayOfMonth; $i < 6; $i++) {
            echo '<div class="day-cell empty-cell"></div>';
        }
        ?>
    </div>
</div>


<div class="modal fade" id="tambahLiburModal" tabindex="-1" aria-labelledby="tambahLiburModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="tambahLiburModalLabel">
                    <i class="fas fa-plus-circle me-1"></i>
                    Tambah Hari Libur Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formTambahLibur" action="<?= base_url('libur/simpan') // Ganti dengan URL action Anda ?>" method="post">
                <?= csrf_field() // Penting untuk keamanan ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan Libur</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="2" required placeholder="Contoh: Hari Raya Idul Fitri"></textarea>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col">
                            <label for="bulan" class="form-label">Bulan</label>
                            <select id="bulan" class="form-select">
                                <?php for ($m = 1; $m <= 12; $m++) : ?>
                                    <option value="<?= $m; ?>" <?= ($m == $currentMonth) ? 'selected' : ''; ?>>
                                        <?= date('F', mktime(0, 0, 0, $m, 1)); ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select id="tahun" class="form-select">
                                <?php for ($y = date('Y') - 2; $y <= date('Y') + 5; $y++) : ?>
                                    <option value="<?= $y; ?>" <?= ($y == $currentYear) ? 'selected' : ''; ?>><?= $y; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <label class="form-label">Pilih Tanggal (Bisa lebih dari satu)</label>
                    <div id="calendar-container" class="calendar-container border rounded-3 bg-light p-3">
                        </div>
                    <input type="hidden" name="selected_dates" id="selected_dates">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editLiburModal" tabindex="-1" aria-labelledby="editLiburModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="editLiburModalLabel">
                    <i class="fas fa-edit me-1"></i>
                    Edit Hari Libur
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditLibur" method="post">
                <?= csrf_field() // Penting untuk keamanan ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tanggal_edit" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal_edit" name="tanggal" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan_edit" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan_edit" name="keterangan" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalHapusLabel">
                    <i class="fas fa-trash me-1"></i>
                    Konfirmasi Penghapusan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data hari libur ini secara permanen? Tindakan ini tidak dapat diurungkan.</p>
            </div>
            <div class="modal-footer">
                <form id="formHapus" method="post" class="w-100 d-flex justify-content-end gap-2">
                    <?= csrf_field() // Penting untuk keamanan ?>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Menunggu seluruh konten halaman dimuat sebelum menjalankan skrip
    document.addEventListener('DOMContentLoaded', function() {

        // --- LOGIKA UNTUK MODAL TAMBAH (MEMBUAT KALENDER INTERAKTIF) ---
        const tambahModalEl = document.getElementById('tambahLiburModal');
        if (tambahModalEl) {
            const bulanSelect = document.getElementById('bulan');
            const tahunSelect = document.getElementById('tahun');
            const calendarContainer = document.getElementById('calendar-container');
            const selectedDatesInput = document.getElementById('selected_dates');
            let selectedDates = [];

            // Fungsi utama untuk menggambar kalender di dalam modal
            const drawCalendar = (year, month) => {
                calendarContainer.innerHTML = ''; // Kosongkan kontainer
                const daysInMonth = new Date(year, month, 0).getDate();
                const firstDayOfMonth = new Date(year, month - 1, 1).getDay(); // 0=Sunday, 1=Monday...
                const calendar = document.createElement('div');
                calendar.className = 'calendar';
                
                // Tambah header hari (Su, Mo, Tu, ..)
                const dayHeaders = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
                dayHeaders.forEach(header => {
                    const headerEl = document.createElement('div');
                    headerEl.className = 'calendar-header';
                    headerEl.textContent = header;
                    calendar.appendChild(headerEl);
                });

                // Tambah sel kosong di awal bulan
                for (let i = 0; i < firstDayOfMonth; i++) {
                    const emptyCell = document.createElement('div');
                    emptyCell.className = 'calendar-day empty';
                    calendar.appendChild(emptyCell);
                }

                // Tambah sel untuk setiap tanggal
                for (let day = 1; day <= daysInMonth; day++) {
                    const dateCell = document.createElement('div');
                    const dateStr = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    dateCell.className = 'calendar-day';
                    dateCell.textContent = day;
                    dateCell.dataset.date = dateStr;

                    // Tandai tanggal jika sudah dipilih sebelumnya
                    if (selectedDates.includes(dateStr)) {
                        dateCell.classList.add('selected');
                    }

                    // Event listener untuk memilih/batal memilih tanggal
                    dateCell.addEventListener('click', () => {
                        dateCell.classList.toggle('selected');
                        const date = dateCell.dataset.date;
                        if (dateCell.classList.contains('selected')) {
                            if (!selectedDates.includes(date)) selectedDates.push(date);
                        } else {
                            selectedDates = selectedDates.filter(d => d !== date);
                        }
                        // Update input tersembunyi dengan tanggal yang dipilih (dipisahkan koma)
                        selectedDatesInput.value = selectedDates.join(',');
                    });
                    calendar.appendChild(dateCell);
                }
                calendarContainer.appendChild(calendar);
            };

            // Event listener saat modal TAMBAH akan ditampilkan
            tambahModalEl.addEventListener('show.bs.modal', function() {
                document.getElementById('formTambahLibur').reset();
                selectedDates = []; // Reset pilihan tanggal
                selectedDatesInput.value = '';
                
                // Setel dropdown ke bulan & tahun saat ini di kalender utama
                bulanSelect.value = <?= $currentMonth ?>;
                tahunSelect.value = <?= $currentYear ?>;
                
                // Gambar kalender awal
                drawCalendar(tahunSelect.value, bulanSelect.value);
            });

            // Event listener untuk dropdown bulan & tahun untuk menggambar ulang kalender
            bulanSelect.addEventListener('change', () => drawCalendar(tahunSelect.value, bulanSelect.value));
            tahunSelect.addEventListener('change', () => drawCalendar(tahunSelect.value, bulanSelect.value));
        }


        // --- LOGIKA UNTUK MODAL EDIT (MENGISI DATA DARI TOMBOL) ---
        const editModalEl = document.getElementById('editLiburModal');
        if (editModalEl) {
            editModalEl.addEventListener('show.bs.modal', function(event) {
                // Tombol yang memicu modal
                const button = event.relatedTarget;
                
                // Ambil data dari atribut `data-bs-*`
                const id = button.getAttribute('data-bs-id');
                const tanggal = button.getAttribute('data-bs-tanggal');
                const keterangan = button.getAttribute('data-bs-keterangan');

                // Isi form di dalam modal
                const form = document.getElementById('formEditLibur');
                form.action = `<?= base_url('libur/update/') ?>${id}`; // Set action form
                editModalEl.querySelector('#tanggal_edit').value = tanggal;
                editModalEl.querySelector('#keterangan_edit').value = keterangan;
            });
        }

        // --- LOGIKA UNTUK MODAL HAPUS (MENGATUR URL ACTION FORM) ---
        const hapusModalEl = document.getElementById('modalHapus');
        if (hapusModalEl) {
            hapusModalEl.addEventListener('show.bs.modal', function(event) {
                // Tombol yang memicu modal
                const button = event.relatedTarget;
                
                // Ambil URL hapus dari atribut `data-bs-url`
                const url = button.getAttribute('data-bs-url');
                
                // Set action form hapus
                const form = document.getElementById('formHapus');
                form.action = url;
            });
        }
    });
</script>
<?= $this->endSection(); ?>