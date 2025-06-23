<?= $this->extend('layout/template'); ?>
<?= $this->section('css') ?>
<style>
    /* ====================================================== */
    /* == BAGIAN 1: STYLE DASAR (DARI CONTOH PROFILE ANDA) == */
    /* ====================================================== */

    .profile-wrapper {
        min-height: 100vh;
        padding: 2rem 0;
    }

    .profile-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .profile-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        /* For Safari */
        border-radius: 24px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: visible;
    }

    .profile-header {
        background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
        padding: 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: repeating-linear-gradient(45deg,
                transparent,
                transparent 2px,
                rgba(255, 255, 255, 0.05) 2px,
                rgba(255, 255, 255, 0.05) 4px);
        animation: slide 20s linear infinite;
    }

    @keyframes slide {
        0% {
            transform: translate(-50%, -50%) rotate(0deg);
        }

        100% {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }

    .profile-title {
        color: white;
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        position: relative;
        z-index: 2;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .profile-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1rem;
        margin-top: 0.5rem;
        position: relative;
        z-index: 2;
    }

    .profile-content {
        display: flex;
        min-height: 600px;
    }

    .profile-left {
        flex: 0 0 350px;
        background: linear-gradient(135deg, #f8f9ff 0%, #eef6fc 100%);
        padding: 2.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        border-right: 1px solid rgba(33, 150, 243, 0.1);
    }

    .profile-right {
        flex: 1;
        background: white;
        padding: 2.5rem;
        overflow-x: auto;
    }

    .profile-avatar-section {
        text-align: center;
    }

    .profile-avatar-container {
        position: relative;
        display: inline-block;
        margin-bottom: 1.5rem;
    }

    .profile-avatar {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        border: 6px solid #2196F3;
        box-shadow: 0 20px 40px rgba(33, 150, 243, 0.3);
        transition: all 0.3s ease;
        object-fit: cover;
    }

    .profile-avatar:hover {
        transform: scale(1.05);
        box-shadow: 0 25px 50px rgba(33, 150, 243, 0.4);
    }

    .avatar-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1976D2;
        margin-bottom: 0.25rem;
        text-align: center;
    }

    .avatar-role {
        font-size: 1rem;
        color: #666;
        margin-bottom: 1rem;
        text-align: center;
    }

    .profile-stats {
        width: 100%;
    }

    .stat-item {
        background: rgba(255, 255, 255, 0.8);
        border-radius: 16px;
        padding: 1.2rem;
        /* Dikecilkan sedikit */
        margin-bottom: 1rem;
        text-align: center;
        border: 1px solid rgba(33, 150, 243, 0.1);
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        background: rgba(255, 255, 255, 1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        font-size: 2rem;
        color: #2196F3;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 0.25rem;
    }

    .stat-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1976D2;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #E3F2FD;
    }

    /* =================================================== */
    /* == BAGIAN 2: STYLE TAMBAHAN UNTUK HALAMAN NILAI  == */
    /* =================================================== */

    /* Progress Bar Magang */
    .progress-section {
        width: 100%;
        padding: 0.5rem;
    }

    .progress-text {
        display: flex;
        justify-content: space-between;
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .progress-bar-container {
        width: 100%;
        background-color: #e0e0e0;
        border-radius: 30px;
        height: 12px;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        border-radius: 30px;
        background: linear-gradient(135deg,
                #2196F3 0%,
                #1976D2 100%);
        transition: width 0.5s ease-in-out;
    }

    /* Judul kecil di sidebar */
    .section-title-left {
        font-size: 1.1rem;
        font-weight: 600;
        color: #666;
        text-align: center;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }

    /* Kartu Nilai Akhir */
    .final-grade-card {
        width: 100%;
        background: linear-gradient(135deg, #f8f9ff 0%, #eef6fc 100%);
        border: 1px solid rgba(33, 150, 243, 0.1);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        align-items: stretch;
        /* agar anak elemen bisa lebarnya penuh */
        overflow: visible;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;

    }

    .table-responsive {
        width: 100%;
        background: linear-gradient(135deg, #f8f9ff 0%, #eef6fc 100%);
        border: 1px solid rgba(33, 150, 243, 0.1);
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        align-items: stretch;
        /* agar anak elemen bisa lebarnya penuh */
        overflow: visible;
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }


    /* Status jika nilai belum muncul */
    .status-berjalan {
        text-align: center;
        color: #555;
    }

    .status-icon {
        font-size: 2.5rem;
        color: #1976D2;
        margin-bottom: 1rem;
    }

    .status-berjalan h4 {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    /* Tampilan jika nilai sudah muncul */
    .rincian-akhir {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
        width: 100%;
    }

    .komponen {
        background: #fff;
        padding: 0.8rem;
        /* Padding diperkecil */
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .komponen span {
        display: block;
        color: #666;
        font-size: 0.85em;
        /* Sedikit perkecilan font di dalam komponen */
    }

    .komponen strong {
        font-size: 1.8em;
        /* Sedikit perkecilan font nilai di dalam komponen */
        color: #2196F3;
        font-weight: 700;
    }

    .skor-final {
        text-align: center;
        border-top: 1px solid rgba(33, 150, 243, 0.2);
        padding-top: 1.5rem;
        margin-bottom: 1rem;
        /* Menambahkan sedikit margin bawah sebelum tombol */
    }

    .label-final {
        font-size: 1em;
        color: #666;
        display: block;
    }

    .angka-final-a {
        font-size: 3.5em;
        font-weight: 700;
        color:rgb(25, 210, 93);
        line-height: 1.1;
    }
    .angka-final-b {
        font-size: 3.5em;
        font-weight: 700;
        color:rgb(210, 204, 25);
        line-height: 1.1;
    }
    .angka-final-c {
        font-size: 3.5em;
        font-weight: 700;
        color:rgb(210, 25, 25);
        line-height: 1.1;
    }

    .predikat-final-a {
        display: block;
        font-size: 1.4em;
        font-weight: 600;
        color: #4CAF50;
    }

    .predikat-final-b {
        display: block;
        font-size: 1.4em;
        font-weight: 600;
        color:rgb(175, 168, 76);
    }
    
    .predikat-final-c {
        display: block;
        font-size: 1.4em;
        font-weight: 600;
        color:rgb(175, 76, 76);
    }

    /* Tombol Download */
    .final-grade-card .btn-download-sertif {
        display: inline-block;
        background: linear-gradient(135deg,
                #4CAF50 0%,
                #388e3c 100%) !important;
        /* TAMBAHKAN !important */
        color: white !important;
        /* Pastikan warna teks juga tetap putih */
        padding: 0.8rem 2rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        margin-top: 1.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(76, 175, 80, 0.3);
        border: none;
        /* Hapus border jika ada dari template */
    }

    .btn-download-sertif:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(76, 175, 80, 0.4);
    }

    .btn-download-sertif .fa-solid {
        margin-right: 0.5rem;
    }

    /* Tabel Rincian Nilai */
    .table-container {
        overflow-x: auto;
    }

    .rincian-harian-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.95rem;
    }

    .rincian-harian-table th,
    .rincian-harian-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e3f2fd;
    }

    .rincian-harian-table thead tr {
        background-color: #e3f2fd;
    }

    .rincian-harian-table th {
        font-weight: 600;
        color: #1976D2;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .rincian-harian-table tbody tr:hover {
        background-color: #f8f9ff;
    }

    .rincian-harian-table td.nilai-positif {
        font-weight: 700;
        color: #4CAF50;
    }

    .rincian-harian-table td:first-child {
        font-weight: 600;
        color: #333;
    }


    /* =================================================== */
    /* == BAGIAN 3: MEDIA QUERIES (DARI CONTOH PROFILE) == */
    /* =================================================== */
    @media (max-width: 992px) {
        .profile-content {
            flex-direction: column;
        }

        .profile-left {
            flex: none;
            border-right: none;
            border-bottom: 1px solid rgba(33, 150, 243, 0.1);
            padding: 2rem;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
        }
    }

    @media (max-width: 768px) {
        .profile-wrapper {
            padding: 1rem 0;
        }

        .profile-card {
            border-radius: 16px;
        }

        .profile-left,
        .profile-right {
            padding: 1.5rem;
        }

        .profile-title {
            font-size: 1.5rem;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
        }
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>

<div class="profile-wrapper">
    <div class="profile-container">
        <div class="profile-card">

            <header class="profile-header">
                <h1 class="profile-title">Laporan Nilai Magang</h1>
                <p class="profile-subtitle">Detail Kinerja dan Pencapaian Selama Periode Magang</p>
            </header>

            <div class="profile-content">
                <aside class="profile-left">
                    <div class="profile-avatar-section">
                        <div class="profile-avatar-container">
                            <img src="<?= base_url('assets/img/user/' . $siswa['foto']) ?>" alt="Foto Profil Siswa" class="profile-avatar">
                        </div>
                        <h2 class="avatar-name"><?= $siswa['nama'] ?></h2>
                        <p class="avatar-role"><?= $siswa['asal_instansi'] . ' - ' . $siswa['jurusan'] ?></p>
                    </div>

                    <div class="profile-stats">

                        <div class="stat-item">
                            <div class="stat-label">Periode Magang</div>
                            <div class="stat-value"><?= date('j M Y', strtotime($siswa['tgl_masuk'])) . ' - ' . date('j M Y', strtotime($siswa['tgl_keluar'])); ?></div>
                        </div>

                        <?php
                        $tanggalMasuk = new DateTime($siswa['tgl_masuk']);
                        $tanggalKeluar = new DateTime($siswa['tgl_keluar']);
                        $tanggalHariIni = new DateTime();

                        if ($tanggalHariIni > $tanggalKeluar) {
                            $tanggalHariIni = $tanggalKeluar;
                        }

                        $progressPersen = round(($hariBerjalan / max($total_hari, 1)) * 100);
                        ?>
                        <div class="stat-item">
                            <div class="stat-label">Progress</div>
                            <div class="progress-section">
                                <div class="progress-text">
                                    <span><?= $hariBerjalan ?> / <?= $total_hari ?> Hari</span>
                                    <span><?= $progressPersen ?>%</span>
                                </div>
                                <div class="progress-bar-container">
                                    <div class="progress-bar" style="width: <?= $progressPersen ?>%"></div>
                                </div>
                            </div>
                        </div>



                        <h3 class="section-title-left">Akumulasi Nilai Sementara</h3>
                        <div class="stat-item">
                            <i class="stat-icon fa-solid fa-calendar-check"></i>
                            <div class="stat-label">Total Kehadiran</div>
                            <div class="stat-value"><?= $akumulasi['jumlah_masuk'] ?></div>
                        </div>
                        <div class="stat-item">
                            <i class="stat-icon fa-solid fa-laptop-code"></i>
                            <div class="stat-label">Nilai Magang</div>
                            <div class="stat-value"><?= $akumulasi['rata_nilai_magang'] ?></div>
                        </div>
                        <div class="stat-item">
                            <i class="stat-icon fa-solid fa-gears"></i>
                            <div class="stat-label">Nilai Operasional</div>
                            <div class="stat-value"><?= $akumulasi['rata_nilai_operasional'] ?></div>
                        </div>
                    </div>
                </aside>

                <main class="profile-right">
                    <section>
                        <h3 class="section-title">Hasil Akhir</h3>
                        <div class="final-grade-card">

                            <?php if ($nilai_akhir === null): ?>
                                <div class="status-berjalan">
                                    <i class="status-icon fa-solid fa-hourglass-half"></i>
                                    <h4>Nilai Akhir Belum Tersedia</h4>
                                    <p>
                                        Nilai akhir ditampilkan pada hari terakhir magang.
                                        Terus pantau akumulasi nilai sementara Anda!
                                    </p>
                                </div>
                            <?php else: ?>
                                <div class="rincian-akhir">
                                    <div class="komponen">
                                        <span>Nilai Absensi</span>
                                        <strong><?= number_format($nilai_akhir['nilai_absensi'], 2) ?></strong>
                                    </div>
                                    <div class="komponen">
                                        <span>Akumulasi Nilai Magang</span>
                                        <strong><?= number_format($nilai_akhir['nilai_magang'], 2) ?></strong>
                                    </div>
                                    <div class="komponen">
                                        <span>Akumulasi Nilai Operasional</span>
                                        <strong><?= number_format($nilai_akhir['nilai_operasional'], 2) ?></strong>
                                    </div>
                                    <div class="komponen">
                                        <span>Akumulasi Nilai Artikel</span>
                                        <strong><?= number_format($nilai_akhir['nilai_artikel'], 2) ?></strong>
                                    </div>
                                </div>
                                <?php
                                $total = $nilai_akhir['total_nilai'];

                                if ($total >= 86) {
                                    $predikat = 'A (Sangat Baik)';
                                    $class = 'a';
                                } elseif ($total >= 71) {
                                    $predikat = 'B (Baik)';
                                    $class = 'b';
                                } else {
                                    $predikat = 'C (Cukup)';
                                    $class = 'c';
                                }
                                ?>
                                <div class="skor-final">
                                    <span class="label-final">SKOR AKHIR</span>
                                    <span class="angka-final-<?= $class ?>"><?= number_format($nilai_akhir['total_nilai'], 2) ?></span>                                    
                                    <span class="predikat-final-<?= $class ?>"><?= $predikat ?></span>
                                </div>
                                <!-- <a
                                    href="/path/to/sertifikat.pdf"
                                    download
                                    class="btn-download-sertif">
                                    <i class="fa-solid fa-award"></i> Download Sertifikat
                                </a> -->
                            <?php endif; ?>

                        </div>
                    </section>


                    <section style="margin-top: 2.5rem;">
                        <h3 class="section-title">Rincian Nilai Harian</h3>
                        <div class="datatable-wrapper">
                            <div class="table-responsive">
                                <div class="table-container table-responsive-wrapper">
                                    <table id="tabel-nilai-harian" class="rincian-harian-table table" style="width:100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="text-center border-end" style="min-width: 80px;">
                                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                                        <span class="fw-semibold">Tanggal</span>
                                                    </div>
                                                </th>
                                                <th class="text-center border-end" style="min-width: 150px;">
                                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                                        <span class="fw-semibold">Laporan Tugas</span>
                                                    </div>
                                                </th>
                                                <th class="text-center border-end" style="min-width: 70px;">
                                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                                        <span class="fw-semibold">Nilai Magang</span>
                                                    </div>
                                                </th>
                                                <th class="text-center border-end" style="min-width: 70px;">
                                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                                        <span class="fw-semibold">Nilai Operasional</span>
                                                    </div>
                                                </th>
                                                <th class="text-center border-end" style="min-width: 150px;">
                                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                                        <span class="fw-semibold">Feedback</span>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <?php foreach ($nilai_harian as $i => $nh): ?>
                                            <tr>
                                                <td class="text-center border-end">
                                                    <span class="text-truncate d-inline-block" style="max-width: 100px;"
                                                        title="<?= esc($nh['tgl_absen']); ?>">
                                                        <?= date('d M Y', strtotime($nh['tgl_absen'])); ?>
                                                    </span>
                                                </td>
                                                <td class="text-center border-end">
                                                    <span class="d-inline-block" style="max-width: 150px;"
                                                        title="<?= esc($nh['laporan_tugas']); ?>">
                                                        <?= esc($nh['laporan_tugas']); ?>
                                                    </span>
                                                </td>
                                                <td class="text-center border-end">
                                                    <span class="text-truncate d-inline-block" style="max-width: 150px;"
                                                        title="<?= esc($nh['nilai_magang']); ?>">
                                                        <?= esc($nh['nilai_magang']); ?>
                                                    </span>
                                                </td>
                                                <td class="text-center border-end">
                                                    <span class="text-truncate d-inline-block" style="max-width: 150px;"
                                                        title="<?= esc($nh['nilai_operasional']); ?>">
                                                        <?= esc($nh['nilai_operasional']); ?>
                                                    </span>
                                                </td>
                                                <td class="text-center border-end">
                                                    <span class="text-truncate d-inline-block" style="max-width: 150px;"
                                                        title="<?= esc($nh['feedback']); ?>">
                                                        <?= esc($nh['feedback']); ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </section>
                </main>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var table = $('#tabel-nilai-harian').DataTable({
            responsive: true,
            pageLength: 6,
            lengthMenu: [
                [6, 10, 25, 50, -1],
                [6, 10, 25, 50, "Semua"]
            ],
            language: {
                decimal: "",
                emptyTable: "Tidak ada data yang tersedia",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 - 0 dari 0 data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                lengthMenu: "Tampilkan _MENU_ data",
                loadingRecords: "Memuat...",
                processing: "Memproses...",
                search: "Cari:",
                searchPlaceholder: "Ketik untuk mencari...",
                zeroRecords: "Tidak ada data yang cocok",
                paginate: {
                    first: "❮❮",
                    last: "❯❯",
                    next: "❯",
                    previous: "❮"
                }
            },
            // DOM harus menyertakan 'l' dan 'f' agar bisa dipindahkan
            dom: '<"dt-temp-toolbar"l>rt<"row g-3 mt-2 pt-2"' +
                '<"col-md-5 d-flex align-items-center"i>' +
                '<"col-md-7 d-flex justify-content-md-end"p>>',
            columnDefs: [{
                orderable: false,
                searchable: false,
                targets: 0
            }],
            order: [
                [0, 'desc']
            ],
            autoWidth: false,
            stateSave: true,

            initComplete: function() {
                // Tambahkan styling bootstrap
                $('.dataTables_length select').addClass('form-select form-select-sm me-2');
                $('.dataTables_filter input').addClass('form-control form-control-sm').attr('placeholder', 'Ketik untuk mencari...');
                $('.dataTables_length').addClass('d-flex align-items-center');
                $('.dataTables_filter').addClass('d-flex align-items-center justify-content-end');
                $('.dataTables_filter label').addClass('d-flex align-items-center mb-0');

                // Pindahkan kontrol ke tempat custom
                $('#siswaTable_length').appendTo('#custom-length');
                $('#siswaTable_filter').appendTo('#custom-search');

                // FIX tampilan "Tampilkan 10 data"
                $('.dataTables_length label').addClass('d-flex align-items-center gap-2 mb-0');
            },

            drawCallback: function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });
    });
</script>
<?= $this->endSection(); ?>