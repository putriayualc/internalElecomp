<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<title>Dashboard</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: #f8fafc;
        min-height: 100vh;
        padding: 20px;
    }

    .dashboard {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        gap: 20px;
        padding: 20px;
    }

    .header {
        background: rgba(108, 182, 242, 0.8);
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .header h1 {
        font-size: 1.875rem;
        font-weight: bold;
        color: rgb(44, 45, 47);
        margin-bottom: 8px;
    }

    .header p {
        color: rgb(87, 99, 116);
        font-size: 0.875rem;
    }

    .top-metrics {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        align-items: start;
    }

    .status-cards {
        display: flex;
        gap: 15px;
        justify-content: center;
        align-items: center;
        padding: 0px;
    }

    .status-card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 1;
        min-height: 170px;
    }

    .status-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .status-icon.success {
        background: #c6f6d5;
        color: #22543d;
    }

    .status-icon.warning {
        background: #fed7aa;
        color: #c05621;
    }

    .status-icon.danger {
        background: #fed7d7;
        color: #c53030;
    }

    .status-info h3 {
        font-size: 2rem;
        font-weight: 600;
        color: #1a202c;
        margin-bottom: 2px;
    }

    .status-info p {
        font-size: 0.75rem;
        color: #718096;
        text-transform: uppercase;
        font-weight: 500;
    }

    .status-label {
        display: inline-block;
        width: 130px;
        /* sesuaikan */
        font-weight: bold;
        margin-left: 25px;
    }


    .metric-card {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        text-align: center;
        height: fit-content;
    }

    .metric-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 8px;
    }

    .metric-label {
        color: #000;
        font-size: 0.999rem;
        margin-bottom: 4px;
    }

    .metric-change {
        font-size: 0.75rem;
        font-weight: 600;
    }

    .metric-change.positive {
        color: #38a169;
    }

    .metric-change.negative {
        color: #e53e3e;
    }

    .main-content {
        display: grid;
        grid-template-columns: 2fr;
        gap: 20px;
        align-items: start;
    }

    .chart-container {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        min-height: 400px;
        /* atur sesuai kebutuhan */
    }


    .chart-header {
        margin-bottom: 20px;
    }

    .chart-header h3 {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1a202c;
        margin-bottom: 4px;
    }

    .chart-header p {
        font-size: 0.75rem;
        color: #718096;
    }

    .date-selector {
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 8px 12px;
        font-size: 0.875rem;
        color: #4a5568;
        background: white;
        cursor: pointer;
    }

    .bottom-section {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 20px;
        align-items: start;
    }

    .bottom-section-b2 {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 20px;
        align-items: start;
        min-height: 200px;
    }

    .progress-circle {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 20px auto;
    }

    .progress-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a202c;
    }

    .legend {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-top: 20px;
    }

    .legend-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.875rem;
    }

    .legend-label {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 2px;
    }

    .prospects-list {
        max-height: 300px;
        overflow-y: auto;
    }

    .prospect-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid #e2e8f0;
    }

    .prospect-item:last-child {
        border-bottom: none;
    }

    .prospect-info h4 {
        color: #1a202c;
        font-weight: 600;
        font-size: 0.875rem;
        margin-bottom: 4px;
    }

    .prospect-info p {
        color: #718096;
        font-size: 0.75rem;
    }

    .prospect-actions {
        display: flex;
        gap: 6px;
    }

    .btn {
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-email {
        background: #3182ce;
        color: white;
    }

    .btn-whatsapp {
        background: #38a169;
        color: white;
    }

    .btn:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    .social-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .social-item:last-child {
        border-bottom: none;
    }

    .social-name {
        font-weight: 500;
        color: #1a202c;
        font-size: 0.875rem;
    }

    .social-status {
        display: inline-block;
        width: 14px;
        height: 14px;
        border-radius: 4px;
        margin-left: 8px;
    }

    .status-instagram {
        background-color: #e1306c;
    }

    .status-facebook {
        background-color: #1877f2;
    }

    .status-tiktok {
        background-color: #000000;
    }

    .status-linkedin {
        background-color: #0a56c0;
    }


    /* Enhanced Piket (Duty) list styling */
    .piket-list {
        max-height: 350px;
        overflow-y: auto;
    }

    .piket-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 18px;
        border-bottom: 1px solid #e2e8f0;
        transition: background-color 0.2s;
        gap: 12px;
    }

    .piket-item:hover {
        background-color: #f7fafc;
    }

    .piket-item:last-child {
        border-bottom: none;
    }

    .piket-info {
        flex: 1;
    }

    .piket-info h4 {
        color: #1a202c;
        font-weight: 600;
        font-size: 0.875rem;
        margin-bottom: 6px;
    }

    .piket-info .shift-time {
        color: #718096;
        font-size: 0.75rem;
        margin-bottom: 8px;
    }

    .piket-tasks {
        margin-top: 8px;
    }

    .task-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.75rem;
        color: #4a5568;
        margin-bottom: 4px;
    }

    .task-item:last-child {
        margin-bottom: 0;
    }

    .task-icon {
        width: 12px;
        height: 12px;
        background: #e2e8f0;
        border-radius: 2px;
        flex-shrink: 0;
    }

    .task-icon.completed {
        background: #c6f6d5;
    }

    .task-icon.in-progress {
        background: #fed7aa;
    }

    .piket-status {
        padding: 6px 12px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 500;
        text-align: center;
        min-width: 80px;
        white-space: nowrap;
    }

    .status-on-duty {
        background: #c6f6d5;
        color: #22543d;
    }

    .status-break {
        background: #fed7aa;
        color: #c05621;
    }

    .status-off-duty {
        background: #e2e8f0;
        color: #4a5568;
    }

    /* FIXED: Specific height constraints for each chart */

    /* Main blog chart - largest chart */
    .chart-container:nth-child(1) .chart-canvas {
        height: 220px !important;
        max-height: 220px !important;
    }

    /* Hosting chart - medium size */
    .chart-container:nth-child(2) .chart-canvas {
        height: 160px !important;
        max-height: 160px !important;
    }

    /* Intern chart - smallest in main section */
    .chart-container:nth-child(3) .chart-canvas {
        height: 140px !important;
        max-height: 140px !important;
    }

    /* Bottom section charts */
    .bottom-section .chart-container:nth-child(2) .chart-canvas {
        height: 120px !important;
        max-height: 120px !important;
    }

    /* Hosting chart legend styling */
    .hosting-legend {
        margin-top: 15px;
    }

    .hosting-legend div {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 0.875rem;
    }

    /* Chart canvas wrapper untuk memastikan height fixed */
    .chart-wrapper {
        position: relative;
        width: 100%;
    }

    .chart-canvas {
        display: block !important;
        width: 100% !important;
    }

    @media (max-width: 1200px) {

        .top-metrics,
        .main-content {
            grid-template-columns: 1fr;
        }

        .bottom-section {
            grid-template-columns: 1fr 1fr;
        }

        .status-cards {
            flex-direction: column;
        }

        /* Adjust chart heights for mobile */
        .chart-canvas {
            height: 180px !important;
            max-height: 180px !important;
        }
    }

    /* Tambahan di bagian paling bawah CSS-mu */

    @media (max-width: 768px) {

        .dashboard {
            padding: 10px;
        }

        .top-metrics,
        .main-content,
        .bottom-section,
        .bottom-section-b2 {
            grid-template-columns: 1fr !important;
        }

        .status-cards {
            flex-direction: column !important;
            gap: 12px;
        }

        .status-card {
            width: 100%;
        }

        .chart-container {
            padding: 16px;
            min-height: auto;
        }

        .chart-wrapper {
            height: auto;
        }

        .chart-canvas {
            height: 160px !important;
            max-height: 160px !important;
        }

        .hosting-legend div {
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
        }
    }
</style>


<body>
    <div class="dashboard">
        <div class="container-fluid py-3">
            <div class="rounded-3 shadow-sm mb-0"
                style="background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
                <div class="d-flex justify-content-between align-items-center p-4 text-white">
                    <div>
                        <h1 class="h1 fw-bold">
                            Selamat datang, <?= esc(session('username')) ?>
                        </h1>

                        <p class="text-white-70 small mb-0">Monitoring aktivitas dan progress operasional hari ini</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="top-metrics">
            <div class="metric-card">
                <div class="metric-number" style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <i class="fas fa-user-graduate fa-sm me-2" style="color: #3498db;"></i>
                    <?= esc($totalSiswaMagang) ?>
                </div>
                <div class="metric-label">Total Siswa Magang</div>
                <div style="font-size: 0.75rem; color: #718096;">Jumlah Siswa Magang aktif hingga hari ini</div>
            </div>

            <div class="metric-card">
                <div class="metric-number" style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <i class="fas fa-pen fa-sm me-2" style="color: #3498db;"></i>
                    <?= esc($totalBlog) ?>
                </div>
                <div class="metric-label">Total Blog</div>
                <div style="font-size: 0.75rem; color: #718096;">Jumlah Blog aktif hingga hari ini</div>
            </div>

            <div class="metric-card">
                <div class="metric-number" style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <i class="fas fa-envelope fa-sm me-2" style="color: #3498db;"></i>
                    <?= esc($totalEmail) ?>
                </div>
                <div class="metric-label">Total Email</div>
                <div style="font-size: 0.75rem; color: #718096;">Jumlah Email aktif hingga hari ini</div>
            </div>

            <div class="metric-card">
                <div class="metric-number" style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <i class="fas fa-newspaper fa-sm me-2" style="color: #3498db;"></i>
                    <?= esc($totalArtikel) ?>
                </div>
                <div class="metric-label">Total Artikel</div>
                <div style="font-size: 0.75rem; color: #718096;">Jumlah Artikel aktif hingga hari ini</div>
            </div>

            <div class="metric-card">
                <div class="metric-number" style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <i class="fas fa-book-open fa-sm me-2" style="color: #3498db;"></i>
                    <?= esc($totalSop) ?>
                </div>
                <div class="metric-label">Total SOP</div>
                <div style="font-size: 0.75rem; color: #718096;">Jumlah SOP aktif hingga hari ini</div>
            </div>

            <div class="metric-card">
                <div class="metric-number" style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <i class="fas fa-briefcase fa-sm me-2" style="color: #3498db;"></i>
                    <?= esc($totalBisnis) ?>
                </div>
                <div class="metric-label">Total Binis</div>
                <div style="font-size: 0.75rem; color: #718096;">Jumlah Bisnis aktif hingga hari ini</div>
            </div>
        </div>

        <div class="main-content">
            <div class="bottom-section-b2">
                <div class="chart-container">
                    <div class="chart-header">
                        <h3>Upload Konten</h3>
                        <p>Statistik blog yang sedang berjalan</p>

                        <form method="GET" action="">
                            <select name="bulan" class="date-selector" style="margin-top: 10px;" onchange="this.form.submit()">
                                <?php
                                $namaBulan = [
                                    '01' => 'Januari',
                                    '02' => 'Februari',
                                    '03' => 'Maret',
                                    '04' => 'April',
                                    '05' => 'Mei',
                                    '06' => 'Juni',
                                    '07' => 'Juli',
                                    '08' => 'Agustus',
                                    '09' => 'September',
                                    '10' => 'Oktober',
                                    '11' => 'November',
                                    '12' => 'Desember'
                                ];
                                foreach ($namaBulan as $key => $value) {
                                    $selected = ($key == $bulanAktif) ? 'selected' : '';
                                    echo "<option value='$key' $selected>$value</option>";
                                }
                                ?>
                            </select>

                            <select name="tahun" class="date-selector" style="margin-top: 10px;" onchange="this.form.submit()">
                                <?php
                                $tahunSekarang = date('Y');
                                for ($i = $tahunSekarang; $i >= $tahunSekarang - 5; $i--) {
                                    $selected = ($i == $tahunAktif) ? 'selected' : '';
                                    echo "<option value='$i' $selected>$i</option>";
                                }
                                ?>
                            </select>
                        </form>
                    </div>

                    <div class="chart-wrapper">
                        <canvas id="blogChart" class="chart-canvas"></canvas>
                    </div>
                </div>

                <div class="chart-container">
                    <div class="chart-header">
                        <h3>Hosting Aktif</h3>
                        <p>Statistik Hosting & Add-on</p>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="hostingChart" class="chart-canvas"></canvas>
                    </div>
                    <div class="hosting-legend mt-4">
                        <div>
                            <span>Hosting</span>
                            <span style="font-weight: 600;">
                                <?= esc($percentageHosting) ?>%
                            </span>
                        </div>
                        <div>
                            <span>Add-on Domain</span>
                            <span style="font-weight: 600;">
                                <?= esc($percentageAddon) ?>%
                            </span>
                        </div>
                    </div>
                </div>

                <div class="chart-container">
                    <div class="chart-header mb-4">
                        <h3>Statistik Absen</h3>
                        <p>Status kehadiran siswa</p>
                    </div>

                    <div class="chart-wrapper" style="height: 300px;">
                        <?php if (empty($absensiLabels)): ?>
                            <!-- Tampilan jika data kosong -->
                            <div style="text-align: center; padding: 40px;">
                                <img src="<?= base_url('assets/img/nodata.jpg') ?>"
                                    alt="Tidak ada data"
                                    style="max-width: 150px; opacity: 0.6; border-radius: 10px;">
                                <p style="margin-top: 15px; font-size: 16px; color: #666;">
                                    Belum ada data absen yang ditambahkan.
                                </p>
                            </div>
                        <?php else: ?>
                            <!-- Chart dan Legend jika data tersedia -->
                            <canvas id="internChart" class="chart-canvas" style="width: 100%; height: 100%;"></canvas>

                            <div class="hosting-legend mt-4" style="margin-top: 20px;">
                                <?php
                                $absenColors = ['#4DA3E2', '#38B2AC', '#F6AD55', '#FC8181'];
                                foreach ($absensiLabels as $index => $label):
                                ?>
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                                        <div style="display: flex; align-items: center;">
                                            <div style="width: 10px; height: 10px; background-color: <?= $absenColors[$index] ?? '#ccc' ?>; margin-right: 8px;"></div>
                                            <span><?= esc($label) ?></span>
                                        </div>
                                        <span style="font-weight: 600;">
                                            <?= esc($absensiPersen[$index]) ?>%
                                        </span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>


            </div>

            <div class="bottom-section">
                <div class="chart-container">
                    <div class="chart-header">
                        <h3>Sosial media</h3>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="socialChart" class="chart-canvas" width="150" height="150"></canvas>
                    </div>
                    <div class="legend">
                        <!-- Tambahan sosial media -->
                        <?php
                        $platformColors = [
                            'instagram' => '#E1306C',
                            'facebook'  => '#1877F2',
                            'tiktok'    => '#000000',
                            'linkedin'  => '#0A66C2',
                        ];
                        ?>
                        <?php foreach ($persenPerPlatform as $platform => $persen): ?>
                            <?php
                            $color = $platformColors[strtolower($platform)] ?? '#ccc';
                            ?>
                            <div class="legend-item">
                                <div class="legend-label">
                                    <div class="legend-color" style="background: <?= $color ?>;"></div>
                                    <span><?= ucfirst($platform) ?></span>
                                </div>
                                <span><?= $persen ?>%</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>


                <div class="chart-container">
                    <div class="chart-header">
                        <h3>Daftar Piket & Tugas</h3>
                        <p>Status piket dan tugas hari ini (<?= esc($hariIni) ?>)</p>
                    </div>
                    <div class="piket-list">
                        <?php
                        // Ambil daftar absen hari ini (username saja)
                        $daftarAbsenUsernames = array_map(fn($x) => $x['username'], $absenData[$hariIni] ?? []);
                        ?>

                        <?php if (!empty($taskToday) && is_array($taskToday)): ?>
                            <?php foreach ($taskToday as $nama => $tugas): ?>
                                <?php if (in_array($nama, $daftarAbsenUsernames)) continue; // Lewati siswa yang absen 
                                ?>

                                <div class="piket-item">
                                    <div class="piket-info">
                                        <h4><?= esc($nama) ?></h4>
                                        <p class="shift-time">08:00-16:00</p>
                                        <div class="piket-tasks">
                                            <?php foreach ($tugas as $tugasItem): ?>
                                                <div class="task-item">
                                                    <div class="task-icon"></div>
                                                    <span><?= esc($tugasItem) ?></span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="piket-status 
                        <?= (session()->get('username') == $nama)
                                    ? 'status-on-duty' : 'status-off-duty' ?>">
                                        <?= (session()->get('username') == $nama)
                                            ? 'Aktif' : 'Belum Mulai' ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Tidak ada jadwal piket untuk hari ini.</p>
                        <?php endif; ?>
                    </div>
                </div>


                <div class="chart-container">
                    <div class="chart-header">
                        <h3>Daftar Prospek</h3>
                        <p>List prospek, email, dan whatsapp</p>
                    </div>

                    <!-- Scrollable container -->
                    <div class="prospects-list" style="max-height: 400px; overflow-y: auto; padding-right: 10px;">
                        <?php if (empty($prospekList)): ?>
                            <div style="text-align: center; padding: 40px;">
                                <img src="<?= base_url('assets/img/nodata.jpg') ?>"
                                    alt="Tidak ada data"
                                    style="max-width: 150px; opacity: 0.6; border-radius: 10px;">
                                <p style="margin-top: 15px; font-size: 16px; color: #666;">
                                    Belum ada prospek yang ditambahkan.
                                </p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($prospekList as $prospek): ?>
                                <div class="prospect-item" style="border-bottom: 1px solid #eee; padding: 10px 0;">
                                    <div class="prospect-info">
                                        <h4><?= esc($prospek['nama_perusahaan']) ?>
                                            <span style="font-size: 0.8em; color: #777;">(<?= $prospek['sumber'] ?>)</span>
                                        </h4>
                                        <p><?= esc($prospek['keterangan']) ?></p>
                                        <small style="color: #999;">Ditambahkan <?= esc($prospek['waktu_lalu']) ?></small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div> <!-- end of .main-content -->
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // BLOG LINE CHART
            const kontenData = <?= json_encode($kontenPerMinggu) ?>;
            const blogCanvas = document.getElementById('blogChart');
            if (blogCanvas) {
                new Chart(blogCanvas.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
                        datasets: [{
                            label: 'Total Konten',
                            data: kontenData,
                            borderColor: '#4DA3E2',
                            backgroundColor: 'rgba(49, 130, 206, 0.2)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            // HOSTING BAR CHART
            const hostingLabels = <?= json_encode($hostingLabels); ?>;
            const dataAddon = <?= json_encode($dataAddon); ?>;
            const hostingCanvas = document.getElementById('hostingChart');
            if (hostingCanvas) {
                new Chart(hostingCanvas.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: hostingLabels,
                        datasets: [{
                            label: 'Add-on Domain',
                            data: dataAddon,
                            backgroundColor: '#4299e1',
                            borderRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            // DONUT CHART
            const donutLabels = <?= json_encode(array_keys($persenPerPlatform)) ?>;
            const donutData = <?= json_encode(array_values($persenPerPlatform)) ?>;
            const backgroundColors = {
                'instagram': '#E1306C',
                'facebook': '#1877F2',
                'tiktok': '#000000',
                'linkedin': '#0A66C2'
            };
            const socialCanvas = document.getElementById('socialChart');
            if (socialCanvas) {
                new Chart(socialCanvas.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: donutLabels,
                        datasets: [{
                            data: donutData,
                            backgroundColor: donutLabels.map(label => backgroundColors[label] || '#ccc')
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                display: false
                            }
                        }
                    }
                });
            }

            // ABSENSI BAR CHART
            <?php if (!empty($absensiLabels)) : ?>
                const absensiLabels = <?= json_encode($absensiLabels); ?>;
                const absensiData = <?= json_encode($absensiData); ?>;
                const absenCanvas = document.getElementById('internChart');
                if (absenCanvas) {
                    new Chart(absenCanvas.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: absensiLabels,
                            datasets: [{
                                label: 'Total Siswa',
                                data: absensiData,
                                backgroundColor: ['#4DA3E2', '#38B2AC', '#F6AD55', '#FC8181'],
                                borderColor: ['#4DA3E2', '#38B2AC', '#F6AD55', '#FC8181'],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });
                }
            <?php endif; ?>

            // ALERT PIKET
            <?php if (isset($harusPiket) && $harusPiket && !empty($tugasHariIni)) : ?>
                const tugasArray = <?= json_encode($tugasHariIni, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
                Swal.fire({
                    title: 'Pengingat Piket!',
                    icon: 'info',
                    html: tugasArray.length > 0 ?
                        'Hari ini giliran kamu piket!<br><br><strong>Tugas:</strong><br>' + tugasArray.map(t => _.escape(t)).join('<br>') : 'Hari ini kamu tidak ada tugas piket.',
                    confirmButtonText: 'Siap!'
                });
            <?php endif; ?>
        });
    </script>


</body>

<?= $this->endSection(); ?>