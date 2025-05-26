<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
    <div class="row">
        <!-- Kolom Piket Hari Ini -->
        <div class="col-md-3 mb-4">
            <div class="card p-5 w-70" style="background-color: #fefce8; min-height: 325px;"> <!-- light yellow -->
                <div class="d-flex flex-column justify-content-between h-100">
                    <div>
                        <h5 class="fw-bold mb-2 text-center">Piket Hari Ini</h5>
                        <?php
                        $hari = date('l');
                        $piket = [];

                        switch ($hari) {
                            case 'Monday':
                                $piket = ['Lita', 'Yusri', 'Kadafi'];
                                break;
                            case 'Tuesday':
                                $piket = ['Putri', 'Adam', 'Ardian'];
                                break;
                            case 'Wednesday':
                                $piket = ['Regita', 'Abdul', 'Gabriel'];
                                break;
                            case 'Thursday':
                                $piket = ['Asti', 'Lukman', 'Maul'];
                                break;
                            case 'Friday':
                                $piket = ['Icha', 'Yogi', 'Febri'];
                                break;
                            case 'Saturday':
                                $piket = ['Aulia', 'Firstia', 'Wildan', 'Ale'];
                                break;
                            default:
                                echo '<p class="mb-0">Libur</p>';
                        }

                        if (!empty($piket)) {
                            echo '<div class="d-flex justify-content-center align-items-center h-100 w-100">';
                            echo '<ul class="list-unstyled text-center mb-0 mt-3">';
                            foreach ($piket as $nama) {
                                echo "<li class='mt-2 fs-5'>$nama</li>";
                            }
                            echo '</ul>';
                            echo '</div>';
                        }

                        ?>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                        style="background-color:#facc15; width: 40px; height: 40px; position: absolute; bottom: 15px; right: 15px;">
                        <i class="fas fa-broom text-white"></i>
                    </div>
                </div>
            </div>
        </div>


        <!-- Kolom lainnya (Hosting Aktif, Total SOP, dll.) -->
        <div class="col-md-9">
            <div class="row">
                <!-- Hosting Aktif -->
                <div class="col-md-4 mb-4">
                    <div class="card p-3" style="background-color: #f3e8ff;"> <!-- light purple -->
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="background-color:#a855f7; width: 40px; height: 40px;">
                                <i class="fas fa-server text-white"></i>
                            </div>
                        </div>
                        <h3 class="mt-3 mb-1 fw-bold">12</h3>
                        <p class="mb-0">Hosting Aktif</p>
                    </div>
                </div>

                <!-- Total SOP -->
                <div class="col-md-4 mb-4">
                    <div class="card p-3" style="background-color: #fff7ed;"> <!-- light orange -->
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="background-color:#fb923c; width: 40px; height: 40px;">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <h3 class="mt-3 mb-1 fw-bold">7</h3>
                        <p class="mb-0">Total SOP</p>
                    </div>
                </div>

                <!-- Total Artikel -->
                <div class="col-md-4 mb-4">
                    <div class="card p-3" style="background-color: #f0fdfa;"> <!-- light teal -->
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="background-color:#14b8a6; width: 40px; height: 40px;">
                                <i class="fas fa-newspaper text-white"></i>
                            </div>
                        </div>
                        <h3 class="mt-3 mb-1 fw-bold">22</h3>
                        <p class="mb-0">Total Artikel</p>
                    </div>
                </div>

                <!-- Total Blog -->
                <div class="col-md-4 mb-4">
                    <div class="card p-3" style="background-color: #e0f2fe;"> <!-- light blue -->
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="background-color:#0ea5e9; width: 40px; height: 40px;">
                                <i class="fas fa-blog text-white"></i>
                            </div>
                        </div>
                        <h3 class="mt-3 mb-1 fw-bold">18</h3>
                        <p class="mb-0">Total Blog</p>
                    </div>
                </div>

                <!-- Total Siswa Magang -->
                <div class="col-md-4 mb-4">
                    <div class="card p-3" style="background-color:#dcfce7;"> <!-- light purple -->
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="background-color:#22c55e; width: 40px; height: 40px;">
                                <i class="fas fa-user-graduate text-white"></i> <!-- Icon untuk siswa magang -->
                            </div>
                        </div>
                        <h3 class="mt-3 mb-1 fw-bold">10</h3> <!-- Ganti angka sesuai data -->
                        <p class="mb-0">Total Siswa Magang</p>
                    </div>
                </div>



            </div>
        </div>
            <!-- Prospek Chart -->
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Prospek</h5>
                    </div>
                    <div class="card-body">
                        <!-- Dropdown Pilihan -->
                        <select id="chartType" class="form-select mb-3" onchange="updateChartType()">
                            <option value="line">Email, WhatsApp</option>
                            <option value="pie">List Prospek</option>
                        </select>
                        <canvas id="prospekChart" width="300" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Line Chart Data (for Prospek List, Email, WhatsApp)
    let prospekLineChart;
    const prospekLineData = {
        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'],
        datasets: [{
                label: 'Kirim Email',
                data: [5, 8, 6, 9, 7],
                borderColor: '#6366f1',
                fill: false
            },
            {
                label: 'Kirim WhatsApp',
                data: [3, 4, 5, 6, 5],
                borderColor: '#f59e0b',
                fill: false
            }
        ]
    };

    // Pie Chart Data (for ECP, Promosi Beauty, Promosi Rendang)
    let prospekPieChart;
    const prospekPieData = {
        labels: ['ECP', 'Promosi Beauty', 'Promosi Rendang'],
        datasets: [{
            label: 'Jumlah Prospek',
            data: [5, 8, 12],
            backgroundColor: ['#10b981', '#6366f1', '#f59e0b']
        }]
    };

    // Initial chart (Line Chart by default)
    function initLineChart() {
        prospekLineChart = new Chart(document.getElementById('prospekChart'), {
            type: 'line',
            data: prospekLineData,
            options: {
                responsive: true,
            }
        });
    }

    // Function to update chart based on dropdown selection
    function updateChartType() {
        const chartType = document.getElementById('chartType').value;

        // Destroy the previous chart
        if (prospekLineChart) prospekLineChart.destroy();
        if (prospekPieChart) prospekPieChart.destroy();

        // Display the selected chart
        if (chartType === 'line') {
            initLineChart();
        } else if (chartType === 'pie') {
            prospekPieChart = new Chart(document.getElementById('prospekChart'), {
                type: 'pie',
                data: prospekPieData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top', // Optionally adjust legend position
                        }
                    }
                }
            });
        }
    }

    // Initialize with line chart by default
    window.onload = initLineChart;
</script>

<?= $this->endSection(); ?>