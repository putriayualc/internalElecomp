<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Simplified Dashboard with modern clean design -->
<div class="container-fluid py-4">
    <!-- Header Dashboard -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="fw-bold mb-1">Dashboard Admin</h2>
                            <p class="mb-0 opacity-75">Selamat datang kembali! Berikut ringkasan data hari ini</p>
                        </div>
                        <div class="bg-white bg-opacity-25 px-3 py-2 rounded-pill">
                            <span id="currentDate" class="fw-bold"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Kolom Piket Hari Ini - Dipertahankan dengan desain yang lebih modern -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-user-check text-primary me-2"></i>
                        Piket Hari Ini
                    </h5>
                </div>
                <div class="card-body">
                    <?php
                    $hari = date('l');
                    $piket = [];

                    switch ($hari) {
                        case 'Monday': $piket = ['Lita', 'Yusri', 'Kadafi']; break;
                        case 'Tuesday': $piket = ['Putri', 'Adam', 'Ardian']; break;
                        case 'Wednesday': $piket = ['Regita', 'Abdul', 'Gabriel']; break;
                        case 'Thursday': $piket = ['Asti', 'Lukman', 'Maul']; break;
                        case 'Friday': $piket = ['Icha', 'Yogi', 'Febri']; break;
                        case 'Saturday': $piket = ['Aulia', 'Firstia', 'Wildan', 'Ale']; break;
                        default: echo '<div class="alert alert-info">Hari Libur</div>';
                    }

                    if (!empty($piket)) {
                        echo '<div class="d-flex flex-wrap justify-content-around">';
                        foreach ($piket as $nama) {
                            echo '<div class="text-center mb-3 mx-2">';
                            echo '<div class="avatar bg-primary text-white mx-auto rounded-circle d-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">';
                            echo substr($nama, 0, 1);
                            echo '</div>';
                            echo '<h6 class="mb-0">' . $nama . '</h6>';
                            echo '</div>';
                        }
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Statistik utama dalam cards kecil - Dibuat lebih menarik -->
        <div class="col-md-8">
            <div class="row">
                <!-- Stats dalam card yang lebih menarik -->
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 bg-gradient-info text-white">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                    <i class="fas fa-server"></i>
                                </div>
                                <div>
                                    <p class="mb-0 small">Hosting Aktif</p>
                                    <h3 class="mb-0 fw-bold">12</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 bg-gradient-warning text-dark">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div>
                                    <p class="mb-0 small">Total SOP</p>
                                    <h3 class="mb-0 fw-bold">7</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 bg-gradient-success text-white">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                                <div>
                                    <p class="mb-0 small">Total Artikel</p>
                                    <h3 class="mb-0 fw-bold">22</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100 bg-gradient-purple text-white">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                    <i class="fas fa-blog"></i>
                                </div>
                                <div>
                                    <p class="mb-0 small">Total Blog</p>
                                    <h3 class="mb-0 fw-bold">18</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Siswa Magang dengan visualisasi yang lebih menarik -->
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 pt-4">
                            <h5 class="fw-bold mb-0">
                                <i class="fas fa-users text-success me-2"></i>
                                Data Siswa Magang
                            </h5>
                        </div>
                        <div class="card-body">
                            <canvas id="siswaChart" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sosial Media stats dan Recent Activities -->
    <div class="row">
        <!-- Kolom Akun Sosial Media -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-hashtag me-2" style="color: #6366f1;"></i>
                            Akun Sosial Media
                        </h5>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">
                            <i class="fas fa-cog me-1"></i> Kelola
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Social Media Cards -->
                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-sm bg-gradient-light">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                            style="background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); width: 50px; height: 50px;">
                                            <i class="fab fa-instagram text-white fs-4"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-0">Instagram</h5>
                                            <p class="text-success mb-0">
                                                <i class="fas fa-arrow-up"></i> 31K Followers
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-sm bg-gradient-light">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                            style="background-color:#1877f2; width: 50px; height: 50px;">
                                            <i class="fab fa-facebook-f text-white fs-4"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-0">Facebook</h5>
                                            <p class="text-success mb-0">
                                                <i class="fas fa-arrow-up"></i> 15K Likes
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-sm bg-gradient-light">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                            style="background-color:#000000; width: 50px; height: 50px;">
                                            <i class="fab fa-tiktok text-white fs-4"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-0">TikTok</h5>
                                            <p class="text-warning mb-0">
                                                <i class="fas fa-minus"></i> 18K Followers
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="card border-0 shadow-sm bg-gradient-light">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                            style="background-color:#ff0000; width: 50px; height: 50px;">
                                            <i class="fab fa-youtube text-white fs-4"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-0">YouTube</h5>
                                            <p class="text-success mb-0">
                                                <i class="fas fa-arrow-up"></i> 8K Subscribers
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-tasks text-danger me-2"></i>
                            Aktivitas Terbaru
                        </h5>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">
                            <i class="fas fa-list me-1"></i> Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold">SOP Diperbarui</p>
                                    <p class="text-muted small mb-0">2 jam lalu</p>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold">Siswa Magang Baru</p>
                                    <p class="text-muted small mb-0">1 hari lalu</p>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold">Artikel Baru</p>
                                    <p class="text-muted small mb-0">2 hari lalu</p>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                    <i class="fas fa-server"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold">Server Diperbarui</p>
                                    <p class="text-muted small mb-0">3 hari lalu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Konten Upload Chart -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-upload text-purple me-2" style="color: #a855f7;"></i>
                            Konten Upload
                        </h5>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-primary active" onclick="updateContentChart('weekly')">Mingguan</button>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="updateContentChart('monthly')">Bulanan</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="contentUploadChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
    // Set current date
    document.addEventListener('DOMContentLoaded', function() {
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const today = new Date();
        document.getElementById('currentDate').innerText = today.toLocaleDateString('id-ID', options);
        
        // Initialize all charts
        initAllCharts();
    });

    // Chart Options Global
    Chart.defaults.font.family = "'Poppins', 'Helvetica', 'Arial', sans-serif";
    Chart.defaults.color = '#555';
    
    // Initialize all charts
    function initAllCharts() {
        // Siswa Magang Chart
        const siswaCtx = document.getElementById('siswaChart').getContext('2d');
        new Chart(siswaCtx, {
            type: 'bar',
            data: {
                labels: ['SMK', 'SMA', 'Universitas'],
                datasets: [{
                    label: 'Laki-laki',
                    data: [8, 4, 3],
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderRadius: 8,
                    barThickness: 30
                }, {
                    label: 'Perempuan',
                    data: [6, 2, 2],
                    backgroundColor: 'rgba(236, 72, 153, 0.7)',
                    borderRadius: 8,
                    barThickness: 30
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    }
                }
            }
        });

        // Init Content Upload Chart with weekly data by default
        initContentUploadChart();
    }
    
    // Content Upload Chart Data
    let contentUploadChart;
    const contentUploadChartCtx = document.getElementById('contentUploadChart').getContext('2d');
    
    // Weekly content upload data
    const contentWeeklyData = {
        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
        datasets: [
            {
                label: 'Instagram',
                data: [2, 1, 3, 2, 4, 1, 0],
                backgroundColor: 'rgba(219, 39, 119, 0.7)',
                borderRadius: 8,
                barThickness: 15
            },
            {
                label: 'Facebook',
                data: [1, 2, 1, 1, 2, 0, 0],
                backgroundColor: 'rgba(59, 130, 246, 0.7)',
                borderRadius: 8,
                barThickness: 15
            },
            {
                label: 'TikTok',
                data: [0, 1, 2, 1, 3, 2, 0],
                backgroundColor: 'rgba(0, 0, 0, 0.7)',
                borderRadius: 8,
                barThickness: 15
            },
            {
                label: 'YouTube',
                data: [0, 0, 1, 0, 0, 1, 0],
                backgroundColor: 'rgba(239, 68, 68, 0.7)',
                borderRadius: 8,
                barThickness: 15
            }
        ]
    };
    
    // Monthly content upload data
    const contentMonthlyData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'],
        datasets: [
            {
                label: 'Instagram',
                data: [28, 32, 36, 42, 46],
                backgroundColor: 'rgba(219, 39, 119, 0.7)',
                borderRadius: 8,
                barThickness: 25
            },
            {
                label: 'Facebook',
                data: [18, 22, 20, 24, 26],
                backgroundColor: 'rgba(59, 130, 246, 0.7)',
                borderRadius: 8,
                barThickness: 25
            },
            {
                label: 'TikTok',
                data: [12, 18, 24, 28, 32],
                backgroundColor: 'rgba(0, 0, 0, 0.7)',
                borderRadius: 8,
                barThickness: 25
            },
            {
                label: 'YouTube',
                data: [5, 6, 8, 8, 10],
                backgroundColor: 'rgba(239, 68, 68, 0.7)',
                borderRadius: 8,
                barThickness: 25
            }
        ]
    };
    
    // Create initial content upload chart
    function initContentUploadChart() {
        contentUploadChart = new Chart(contentUploadChartCtx, {
            type: 'bar',
            data: contentWeeklyData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
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
    }

    // Function to update content chart based on selection
    function updateContentChart(period) {
        // Destroy the previous chart
        if (contentUploadChart) contentUploadChart.destroy();
        
        // Display the selected chart
        contentUploadChart = new Chart(contentUploadChartCtx, {
            type: 'bar',
            data: period === 'weekly' ? contentWeeklyData : contentMonthlyData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
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
    }
</script>

<style>
    /* Custom styles untuk dashboard */
    body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
    }
    
    .card {
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(45deg, #3b82f6, #60a5fa);
    }
    
    .bg-gradient-info {
        background: linear-gradient(45deg, #0ea5e9, #38bdf8);
    }
    
    .bg-gradient-success {
        background: linear-gradient(45deg, #10b981, #34d399);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(45deg, #f59e0b, #fbbf24);
    }
    
    .bg-gradient-purple {
        background: linear-gradient(45deg, #8b5cf6, #a78bfa);
    }
    
    .bg-gradient-light {
        background: linear-gradient(45deg, #f9fafb, #f3f4f6);
    }
    
    .rounded-pill {
        border-radius: 50rem !important;
    }
    
    .shadow-sm {
        box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
    }
    
    .list-group-item {
        transition: background-color 0.3s;
    }
    
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
    
    .btn-outline-primary {
        border-color: #3b82f6;
        color: #3b82f6;
    }
    
    .btn-outline-primary:hover {
        background-color: #3b82f6;
        color: white;
    }
    
    .btn-primary {
        background-color: #3b82f6;
        border-color: #3b82f6;
    }
</style>

<?= $this->endSection(); ?>