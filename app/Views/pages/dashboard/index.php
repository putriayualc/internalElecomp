<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<title>Dashboard Operasional</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
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
        background: rgba(66, 165, 245, 0.8);
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .header h1 {
        font-size: 1.875rem;
        font-weight: 600;
        color: rgb(44, 45, 47);
        margin-bottom: 8px;
    }

    .header p {
        color: rgb(87, 99, 116);
        font-size: 0.875rem;
    }

    .top-metrics {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
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
        color: #718096;
        font-size: 0.875rem;
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
        grid-template-columns: 2fr 1fr 1fr;
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
        grid-template-columns: 1fr 1fr 1fr 1fr;
        gap: 20px;
        align-items: start;
    }

    .progress-circle {
        position: relative;
        width: 120px;
        height: 120px;
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
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .status-active {
        background: #c6f6d5;
        color: #22543d;
    }

    .status-inactive {
        background: #fed7d7;
        color: #c53030;
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

    @media (max-width: 768px) {
        .dashboard {
            padding: 10px;
        }

        .bottom-section {
            grid-template-columns: 1fr;
        }

        .status-cards {
            flex-direction: column;
        }

        /* Smaller charts on mobile */
        .chart-canvas {
            height: 150px !important;
            max-height: 150px !important;
        }
    }
</style>


<body>
    <div class="dashboard">
        <div class="header">
            <h1>Dashboard User</h1>
            <p>Monitoring aktivitas dan progress operasional hari ini</p>
        </div>

        <div class="top-metrics">
            <div class="status-cards">
                <!-- Status Cards -->
                <div class="status-card">
                    <div class="status-icon success"><i class="fas fa-pen"></i></div>
                    <div class="status-info">
                        <h3>18</h3>
                        <p>Total Blog</p>
                    </div>
                </div>

                <div class="status-card">
                    <div class="status-icon warning"><i class="fas fa-server"></i></div>
                    <div class="status-info">
                        <div>
                            <h3>5</h3>
                        </div>
                        <p>Total Hosting</p>
                    </div>
                </div>

                <div class="status-card">
                    <div class="status-icon danger"><i class="fas fa-file-alt"></i></div>
                    <div class="status-info">
                        <h3>3</h3>
                        <p>Total SOP</p>
                    </div>
                </div>

            </div>

            <div class="metric-card">
                <div class="metric-number">16,247</div>
                <div class="metric-label">Total artikel</div>
                <div class="metric-change negative">-6.8%</div>
                <div style="font-size: 0.75rem; color: #718096;">Last 7 days</div>
            </div>

            <div class="metric-card">
                <div class="metric-number">356</div>
                <div class="metric-label">Total bisnis</div>
                <div class="metric-change positive">+26.5%</div>
                <div style="font-size: 0.75rem; color: #718096;">Last 7 days</div>
            </div>
        </div>

        <div class="main-content">
            <div class="chart-container">
                <div class="chart-header">
                    <h3>Total blog aktif</h3>
                    <p>Statistik blog yang sedang berjalan</p>
                    <select class="date-selector" style="margin-top: 10px;">
                        <option>Jan 1 - 31, 2025</option>
                    </select>
                </div>
                <div class="chart-wrapper">
                    <canvas id="blogChart" class="chart-canvas"></canvas>
                </div>
            </div>

            <div class="chart-container">
                <div class="chart-header">
                    <h3>Hosting aktif</h3>
                    <p>Last 7 days</p>
                </div>
                <div class="chart-wrapper">
                    <canvas id="hostingChart" class="chart-canvas"></canvas>
                </div>
                <div class="hosting-legend">
                    <div>
                        <span style="color: #4299e1;">■ Completed</span>
                        <span style="font-weight: 600;">52%</span>
                    </div>
                    <div>
                        <span style="color: #a0aec0;">■ Pending maintenance</span>
                        <span style="font-weight: 600;">48%</span>
                    </div>
                </div>
            </div>

            <div class="chart-container">
                <div class="chart-header">
                    <h3>Siswa magang</h3>
                    <p>Last 7 days</p>
                </div>
                <div class="chart-wrapper">
                    <canvas id="internChart" class="chart-canvas"></canvas>
                </div>
            </div>
        </div>

        <div class="bottom-section">
            <div class="chart-container">
                <div class="chart-header">
                    <h3>Upload konten</h3>
                    <p>Last 7 days</p>
                </div>
                <div class="progress-circle">
                    <canvas id="contentProgress" width="120" height="120"></canvas>
                    <div class="progress-text">72%</div>
                </div>
                <div class="legend">
                    <div class="legend-item">
                        <div class="legend-label">
                            <div class="legend-color" style="background: #4299e1;"></div>
                            <span>Artikel published</span>
                        </div>
                        <span>72%</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-label">
                            <div class="legend-color" style="background: #a0aec0;"></div>
                            <span>Draft content</span>
                        </div>
                        <span>18%</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-label">
                            <div class="legend-color" style="background: #3182ce;"></div>
                            <span>Scheduled posts</span>
                        </div>
                        <span>10%</span>
                    </div>
                </div>
            </div>

            <div class="chart-container">
                <div class="chart-header">
                    <h3>Sosial media vs blog</h3>
                    <p>Last 7 days</p>
                </div>
                <div class="chart-wrapper">
                    <canvas id="socialChart" class="chart-canvas"></canvas>
                </div>
                <div style="margin-top: 20px;">
                    <div class="social-item">
                        <span class="social-name">Instagram</span>
                        <span class="social-status status-active">Aktif</span>
                    </div>
                    <div class="social-item">
                        <span class="social-name">Facebook</span>
                        <span class="social-status status-active">Aktif</span>
                    </div>
                    <div class="social-item">
                        <span class="social-name">Twitter/X</span>
                        <span class="social-status status-inactive">Tidak Aktif</span>
                    </div>
                    <div class="social-item">
                        <span class="social-name">LinkedIn</span>
                        <span class="social-status status-active">Aktif</span>
                    </div>
                </div>
            </div>

            <div class="chart-container">
    <div class="chart-header">
        <h3>Daftar Piket & Tugas</h3>
        <p>Status piket dan tugas hari ini (<?= esc($hariIni) ?>)</p>
    </div>
    <div class="piket-list">
        <?php if (!empty($taskToday) && is_array($taskToday)): ?>
            <?php foreach ($taskToday as $nama => $tugas): ?>
                <div class="piket-item">
                    <div class="piket-info">
                        <h4><?= esc($nama) ?></h4>
                        <p class="shift-time"><?= esc($hariIni) ?> • 08:00-16:00</p>
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
                    <p>List prospek dan kontak</p>
                </div>
                <div class="prospects-list">
                    <div class="prospect-item">
                        <div class="prospect-info">
                            <h4>PT. Teknologi Maju</h4>
                            <p>Web development - Rp 50,000,000</p>
                        </div>
                        <div class="prospect-actions">
                            <button class="btn btn-email" onclick="sendEmail('pt-tekno@email.com')">Email</button>
                            <button class="btn btn-whatsapp" onclick="sendWhatsApp('081234567890')">WA</button>
                        </div>
                    </div>

                    <div class="prospect-item">
                        <div class="prospect-info">
                            <h4>CV. Solusi Digital</h4>
                            <p>Mobile app - Rp 35,000,000</p>
                        </div>
                        <div class="prospect-actions">
                            <button class="btn btn-email" onclick="sendEmail('solusi@email.com')">Email</button>
                            <button class="btn btn-whatsapp" onclick="sendWhatsApp('081234567891')">WA</button>
                        </div>
                    </div>

                    <div class="prospect-item">
                        <div class="prospect-info">
                            <h4>Toko Online Berkah</h4>
                            <p>E-commerce - Rp 25,000,000</p>
                        </div>
                        <div class="prospect-actions">
                            <button class="btn btn-email" onclick="sendEmail('berkah@email.com')">Email</button>
                            <button class="btn btn-whatsapp" onclick="sendWhatsApp('081234567892')">WA</button>
                        </div>
                    </div>

                    <div class="prospect-item">
                        <div class="prospect-info">
                            <h4>Startup EduTech</h4>
                            <p>LMS system - Rp 75,000,000</p>
                        </div>
                        <div class="prospect-actions">
                            <button class="btn btn-email" onclick="sendEmail('edutech@email.com')">Email</button>
                            <button class="btn btn-whatsapp" onclick="sendWhatsApp('081234567893')">WA</button>
                        </div>
                    </div>

                    <div class="prospect-item">
                        <div class="prospect-info">
                            <h4>Klinik Sehat Bersama</h4>
                            <p>Hospital system - Rp 45,000,000</p>
                        </div>
                        <div class="prospect-actions">
                            <button class="btn btn-email" onclick="sendEmail('klinik@email.com')">Email</button>
                            <button class="btn btn-whatsapp" onclick="sendWhatsApp('081234567894')">WA</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Blog Activity Chart (Main chart)
        const blogCtx = document.getElementById('blogChart').getContext('2d');
        new Chart(blogCtx, {
            type: 'line',
            data: {
                labels: ['01 Jan', '05 Jan', '10 Jan', '15 Jan', '20 Jan', '25 Jan', '30 Jan'],
                datasets: [{
                    data: [20, 35, 25, 45, 52, 38, 48],
                    borderColor: '#4299e1',
                    backgroundColor: 'rgba(66, 153, 225, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }, {
                    data: [15, 28, 20, 38, 42, 30, 35],
                    borderColor: '#a0aec0',
                    backgroundColor: 'transparent',
                    borderWidth: 2,
                    borderDash: [5, 5],
                    fill: false,
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
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Hosting Chart (Bar chart)
        const hostingCtx = document.getElementById('hostingChart').getContext('2d');
        new Chart(hostingCtx, {
            type: 'bar',
            data: {
                labels: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
                datasets: [{
                    data: [8, 12, 10, 15, 13, 11, 9],
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
                        beginAtZero: true,
                        display: false
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Intern Chart (Line chart)
        const internCtx = document.getElementById('internChart').getContext('2d');
        new Chart(internCtx, {
            type: 'line',
            data: {
                labels: ['01 Jan', '07 Jan', '14 Jan', '21 Jan', '28 Jan'],
                datasets: [{
                    data: [25, 28, 32, 35, 33],
                    borderColor: '#4299e1',
                    backgroundColor: 'transparent',
                    borderWidth: 3,
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
                        display: false
                    },
                    x: {
                        display: false
                    }
                }
            }
        });

        // Content Progress Circle
        const progressCtx = document.getElementById('contentProgress').getContext('2d');
        const progressValue = 72;

        // Draw progress circle
        progressCtx.lineWidth = 8;
        progressCtx.strokeStyle = '#e2e8f0';
        progressCtx.beginPath();
        progressCtx.arc(60, 60, 50, 0, 2 * Math.PI);
        progressCtx.stroke();

        progressCtx.strokeStyle = '#4299e1';
        progressCtx.beginPath();
        progressCtx.arc(60, 60, 50, -Math.PI / 2, (-Math.PI / 2) + (2 * Math.PI * progressValue / 100));
        progressCtx.stroke();

        // Social vs Blog Chart (Donut)
        const socialCtx = document.getElementById('socialChart').getContext('2d');
        new Chart(socialCtx, {
            type: 'doughnut',
            data: {
                labels: ['Sosial Media', 'Blog Posts'],
                datasets: [{
                    data: [30, 70],
                    backgroundColor: ['#4299e1', '#a0aec0'],
                    borderWidth: 0,
                    cutout: '70%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Contact functions
        function sendEmail(email) {
            window.open(`mailto:${email}`, '_blank');
        }

        function sendWhatsApp(phone) {
            window.open(`https://wa.me/${phone}`, '_blank');
        }
    </script>

    <!-- Konten dashboard -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <?php if (isset($harusPiket) && $harusPiket): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tugasArray = <?= json_encode($tugasHariIni, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;

                Swal.fire({
                    title: 'Pengingat Piket!',
                    icon: 'info',
                    html: tugasArray.length > 0 ?
                        `Hari ini giliran kamu piket!<br><br><strong>Tugas:</strong><br>` + tugasArray.map(t => _.escape(t)).join('<br>') : 'Hari ini kamu tidak ada tugas piket.',
                    confirmButtonText: 'Siap!'
                });
            });
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
    <?php endif; ?>

</body>

<?= $this->endSection(); ?>