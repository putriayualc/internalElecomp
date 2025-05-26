<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Dashboard dengan tampilan yang lebih menarik -->
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
        <!-- Kolom Piket Hari Ini (Didesain Ulang) -->
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm h-100 overflow-hidden">
                <div class="card-body p-0">
                    <div class="bg-warning bg-opacity-10 p-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold mb-0">
                                <i class="fas fa-user-check me-2 text-warning"></i>
                                Piket Hari Ini
                            </h5>
                            <span class="badge bg-warning text-dark">
                                <?= date('l') ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-4 text-center">
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
                                echo '<div class="alert alert-info">Hari Libur</div>';
                        }

                        if (!empty($piket)) {
                            echo '<div class="row justify-content-center">';
                            foreach ($piket as $nama) {
                                echo '<div class="col-6 mb-3">';
                                echo '<div class="card bg-light shadow-sm p-2">';
                                echo '<div class="avatar bg-warning text-dark mx-auto rounded-circle d-flex align-items-center justify-content-center mb-2" style="width: 45px; height: 45px;">';
                                echo substr($nama, 0, 1); // Initial letter
                                echo '</div>';
                                echo '<h6 class="mb-0 fw-bold">' . $nama . '</h6>';
                                echo '</div>';
                                echo '</div>';
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom statistik dengan desain yang lebih menarik -->
        <div class="col-md-9">
            <div class="row">
                <!-- Hosting Aktif -->
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                    style="background-color:#a855f7; width: 45px; height: 45px;">
                                    <i class="fas fa-server text-white"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-0 small">Hosting Aktif</p>
                                    <h3 class="mb-0 fw-bold">12</h3>
                                </div>
                            </div>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar bg-purple" role="progressbar" style="width: 75%; background-color: #a855f7;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total SOP -->
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                    style="background-color:#fb923c; width: 45px; height: 45px;">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-0 small">Total SOP</p>
                                    <h3 class="mb-0 fw-bold">7</h3>
                                </div>
                            </div>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 40%; background-color: #fb923c;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Artikel -->
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                    style="background-color:#14b8a6; width: 45px; height: 45px;">
                                    <i class="fas fa-newspaper text-white"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-0 small">Total Artikel</p>
                                    <h3 class="mb-0 fw-bold">22</h3>
                                </div>
                            </div>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 65%; background-color: #14b8a6;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Blog -->
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                    style="background-color:#0ea5e9; width: 45px; height: 45px;">
                                    <i class="fas fa-blog text-white"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-0 small">Total Blog</p>
                                    <h3 class="mb-0 fw-bold">18</h3>
                                </div>
                            </div>
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 55%; background-color: #0ea5e9;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row untuk grafik aktivitas -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 pt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold mb-0">
                                    <i class="fas fa-chart-line text-primary me-2"></i>
                                    Aktivitas Mingguan
                                </h5>
                                <!-- <div class="dropdown">
                                    <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Minggu Ini</a></li>
                                        <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                                        <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                                    </ul>
                                </div> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="activityChart" height="200"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-0 pt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold mb-0">
                                    <i class="fas fa-users text-success me-2"></i>
                                    Total Siswa Magang
                                </h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="genderBarChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BARIS BARU: Akun Sosial Media dan Konten Upload -->
    <div class="row mb-4">
        <!-- Kolom Akun Sosial Media -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-hashtag text-indigo me-2" style="color: #6366f1;"></i>
                            Akun Sosial Media
                        </h5>
                        <a href="#" class="btn btn-sm btn-outline-primary">Kelola</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Instagram -->
                        <div class="col-md-6 mb-3">
                            <div class="card bg-light border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                            style="background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); width: 45px; height: 45px;">
                                            <i class="fab fa-instagram text-white"></i>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0 small">Instagram</p>
                                            <div class="d-flex align-items-center">
                                                <h5 class="mb-0 fw-bold">8</h5>
                                                <span class="ms-2 badge bg-success">
                                                    <i class="fas fa-arrow-up me-1"></i>2
                                                </span>
                                            </div>
                                            <p class="text-muted small mb-0">31K Followers</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Facebook -->
                        <div class="col-md-6 mb-3">
                            <div class="card bg-light border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                            style="background-color:#1877f2; width: 45px; height: 45px;">
                                            <i class="fab fa-facebook-f text-white"></i>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0 small">Facebook</p>
                                            <div class="d-flex align-items-center">
                                                <h5 class="mb-0 fw-bold">5</h5>
                                                <span class="ms-2 badge bg-success">
                                                    <i class="fas fa-arrow-up me-1"></i>1
                                                </span>
                                            </div>
                                            <p class="text-muted small mb-0">15K Likes</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- TikTok -->
                        <div class="col-md-6 mb-3">
                            <div class="card bg-light border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                            style="background-color:#000000; width: 45px; height: 45px;">
                                            <i class="fab fa-tiktok text-white"></i>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0 small">TikTok</p>
                                            <div class="d-flex align-items-center">
                                                <h5 class="mb-0 fw-bold">3</h5>
                                                <span class="ms-2 badge bg-warning">
                                                    <i class="fas fa-minus me-1"></i>0
                                                </span>
                                            </div>
                                            <p class="text-muted small mb-0">18K Followers</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- YouTube -->
                        <div class="col-md-6 mb-3">
                            <div class="card bg-light border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                            style="background-color:#ff0000; width: 45px; height: 45px;">
                                            <i class="fab fa-youtube text-white"></i>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-0 small">YouTube</p>
                                            <div class="d-flex align-items-center">
                                                <h5 class="mb-0 fw-bold">2</h5>
                                                <span class="ms-2 badge bg-success">
                                                    <i class="fas fa-arrow-up me-1"></i>1
                                                </span>
                                            </div>
                                            <p class="text-muted small mb-0">8K Subscribers</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        <!-- Kolom Konten Upload -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-upload text-danger me-2"></i>
                            Konten Upload
                        </h5>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-primary active" onclick="updateContentChart('weekly')">Mingguan</button>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="updateContentChart('monthly')">Bulanan</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="contentUploadChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- BARIS BARU: Jumlah Bisnis -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-briefcase text-blue me-2" style="color: #0ea5e9;"></i>
                            Data Bisnis
                        </h5>
                        <a href="#" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Total Bisnis -->
                        <div class="col-md-3 mb-3">
                            <div class="card bg-primary text-white border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="mb-0 small opacity-75">Total Bisnis</p>
                                            <h3 class="mb-0 fw-bold">28</h3>
                                        </div>
                                        <div class="rounded-circle bg-white bg-opacity-25 p-3 d-flex align-items-center justify-content-center">
                                            <i class="fas fa-store fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Bisnis Aktif -->
                        <div class="col-md-3 mb-3">
                            <div class="card bg-success text-white border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="mb-0 small opacity-75">Bisnis Aktif</p>
                                            <h3 class="mb-0 fw-bold">24</h3>
                                        </div>
                                        <div class="rounded-circle bg-white bg-opacity-25 p-3 d-flex align-items-center justify-content-center">
                                            <i class="fas fa-check-circle fa-2x text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Bisnis Pending -->
                        <div class="col-md-3 mb-3">
                            <div class="card bg-warning text-dark border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="mb-0 small opacity-75">Bisnis Pending</p>
                                            <h3 class="mb-0 fw-bold">3</h3>
                                        </div>
                                        <div class="rounded-circle bg-white bg-opacity-25 p-3 d-flex align-items-center justify-content-center">
                                            <i class="fas fa-clock fa-2x text-dark"></i>
                                        </div>
                                    </div>
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
                    </div>
                    
                    <!-- Business Category Chart -->
                    <div class="row mt-3">
                        <div class="col-md-8">
                            <h6 class="fw-bold mb-3">Distribusi Kategori Bisnis</h6>
                            <canvas id="businessCategoryChart" height="200"></canvas>
                        </div>
                        <div class="col-md-4">
                            <h6 class="fw-bold mb-3">Top Bisnis</h6>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item p-3 border-0 bg-light mb-2 rounded">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px;">
                                                <i class="fas fa-store"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-bold">SakinahMart</p>
                                                <p class="text-muted small mb-0">Retail</p>
                                            </div>
                                        </div>
                                        <span class="badge bg-success">Aktif</span>
                                    </div>
                                </div>
                                <div class="list-group-item p-3 border-0 bg-light mb-2 rounded">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px;">
                                                <i class="fas fa-utensils"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-bold">Warung Berkah</p>
                                                <p class="text-muted small mb-0">Kuliner</p>
                                            </div>
                                        </div>
                                        <span class="badge bg-success">Aktif</span>
                                    </div>
                                </div>
                                <div class="list-group-item p-3 border-0 bg-light mb-2 rounded">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px;">
                                                <i class="fas fa-tshirt"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-bold">Hijab Collection</p>
                                                <p class="text-muted small mb-0">Fashion</p>
                                            </div>
                                        </div>
                                        <span class="badge bg-success">Aktif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Prospek Chart dengan tampilan yang lebih menarik -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-chart-pie text-warning me-2"></i>
                            Prospek
                        </h5>
                        <select id="chartType" class="form-select form-select-sm w-auto" onchange="updateChartType()">
                            <option value="line">Email & WhatsApp</option>
                            <option value="pie">List Prospek</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="prospekChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <!-- Tambahan: Recent Activities -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">
                            <i class="fas fa-tasks text-danger me-2"></i>
                            Aktivitas Terbaru
                        </h5>
                        <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px;">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold">SOP Diperbarui</p>
                                    <p class="text-muted small mb-0">SOP Penggunaan Aplikasi Manajemen</p>
                                </div>
                            </div>
                            <span class="text-muted small">2 jam lalu</span>
                        </div>
                        <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px;">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold">Siswa Magang Baru</p>
                                    <p class="text-muted small mb-0">3 siswa magang baru telah ditambahkan</p>
                                </div>
                            </div>
                            <span class="text-muted small">1 hari lalu</span>
                        </div>
                        <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px;">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold">Artikel Baru</p>
                                    <p class="text-muted small mb-0">Artikel "Tips SEO 2025" telah diterbitkan</p>
                                </div>
                            </div>
                            <span class="text-muted small">2 hari lalu</span>
                        </div>
                        <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px;">
                                    <i class="fas fa-server"></i>
                                </div>
                                <div>
                                    <p class="mb-0 fw-bold">Server Diperbarui</p>
                                    <p class="text-muted small mb-0">Server hosting telah diupgrade</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
    });

    // Chart Options Global
    Chart.defaults.font.family = "'Poppins', 'Helvetica', 'Arial', sans-serif";
    Chart.defaults.color = '#555';
    
    // Activity Chart
    const activityCtx = document.getElementById('activityChart').getContext('2d');
    const activityChart = new Chart(activityCtx, {
        type: 'line',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
            datasets: [{
                label: 'Aktivitas',
                data: [12, 19, 15, 17, 21, 18, 10],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
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

    // Bar Chart Data (improved)
    const genderBarChartCtx = document.getElementById('genderBarChart').getContext('2d');
    const genderBarChart = new Chart(genderBarChartCtx, {
        type: 'bar',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                label: 'Jumlah',
                data: [15, 10],
                backgroundColor: ['rgba(59, 130, 246, 0.7)', 'rgba(236, 72, 153, 0.7)'],
                borderColor: ['#3b82f6', '#ec4899'],
                borderWidth: 2,
                borderRadius: 5,
                barThickness: 40
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
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

    // Line Chart Data (for Prospek - Email, WhatsApp)
    let prospekChart;
    const prospekChartCtx = document.getElementById('prospekChart').getContext('2d');
    
    const prospekLineData = {
        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
        datasets: [{
                label: 'Kirim Email',
                data: [5, 8, 6, 9, 7, 9],
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                tension: 0.4,
                fill: true
            },
            {
                label: 'Kirim WhatsApp',
                data: [3, 4, 5, 6, 5, 8],
                borderColor: '#f59e0b',
                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                tension: 0.4,
                fill: true
            }
        ]
    };

    // Pie Chart Data (improved)
    const prospekPieData = {
        labels: ['ECP', 'Promosi Beauty', 'Promosi Rendang'],
        datasets: [{
            label: 'Jumlah Prospek',
            data: [5, 8, 12],
            backgroundColor: [
                'rgba(16, 185, 129, 0.7)',
                'rgba(99, 102, 241, 0.7)',
                'rgba(245, 158, 11, 0.7)'
            ],
            borderColor: [
                '#10b981',
                '#6366f1',
                '#f59e0b'
            ],
            borderWidth: 2,
            hoverOffset: 15
        }]
    };

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
                borderColor: '#db2777',
                borderWidth: 2,
                borderRadius: 5,
                barThickness: 12
            },
            {
                label: 'Facebook',
                data: [1, 2, 1, 1, 2, 0, 0],
                backgroundColor: 'rgba(59, 130, 246, 0.7)',
                borderColor: '#3b82f6',
                borderWidth: 2,
                borderRadius: 5,
                barThickness: 12
            },
            {
                label: 'TikTok',
                data: [0, 1, 2, 1, 3, 2, 0],
                backgroundColor: 'rgba(0, 0, 0, 0.7)',
                borderColor: '#000000',
                borderWidth: 2,
                borderRadius: 5,
                barThickness: 12
            },
            {
                label: 'YouTube',
                data: [0, 0, 1, 0, 0, 1, 0],
                backgroundColor: 'rgba(239, 68, 68, 0.7)',
                borderColor: '#ef4444',
                borderWidth: 2,
                borderRadius: 5,
                barThickness: 12
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
                borderColor: '#db2777',
                borderWidth: 2,
                borderRadius: 5,
                barThickness: 20
            },
            {
                label: 'Facebook',
                data: [18, 22, 20, 24, 26],
                backgroundColor: 'rgba(59, 130, 246, 0.7)',
                borderColor: '#3b82f6',
                borderWidth: 2,
                borderRadius: 5,
                barThickness: 20
            },
            {
                label: 'TikTok',
                data: [12, 18, 24, 28, 32],
                backgroundColor: 'rgba(0, 0, 0, 0.7)',
                borderColor: '#000000',
                borderWidth: 2,
                borderRadius: 5,
                barThickness: 20
            },
            {
                label: 'YouTube',
                data: [5, 6, 8, 8, 10],
                backgroundColor: 'rgba(239, 68, 68, 0.7)',
                borderColor: '#ef4444',
                borderWidth: 2,
                borderRadius: 5,
                barThickness: 20
            }
        ]
    };
    
    // Business Category Chart
    const businessCategoryCtx = document.getElementById('businessCategoryChart').getContext('2d');
    const businessCategoryChart = new Chart(businessCategoryCtx, {
        type: 'bar',
        data: {
            labels: ['Retail', 'Kuliner', 'Fashion', 'Teknologi', 'Jasa', 'Pendidikan'],
            datasets: [{
                label: 'Jumlah Bisnis',
                data: [8, 6, 5, 3, 4, 2],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.7)',
                    'rgba(245, 158, 11, 0.7)',
                    'rgba(236, 72, 153, 0.7)',
                    'rgba(16, 185, 129, 0.7)',
                    'rgba(139, 92, 246, 0.7)',
                    'rgba(248, 113, 113, 0.7)'
                ],
                borderColor: [
                    '#3b82f6',
                    '#f59e0b',
                    '#ec4899',
                    '#10b981',
                    '#8b5cf6',
                    '#f87171'
                ],
                borderWidth: 2,
                borderRadius: 5,
                barThickness: 30
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    grid: {
                        display: true,
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                y: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Initial chart creation
    function initLineChart() {
        prospekChart = new Chart(prospekChartCtx, {
            type: 'line',
            data: prospekLineData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
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
    
    // Create initial content upload chart
    function initContentUploadChart() {
        contentUploadChart = new Chart(contentUploadChartCtx, {
            type: 'bar',
            data: contentWeeklyData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Konten'
                        },
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
        if (period === 'weekly') {
            contentUploadChart = new Chart(contentUploadChartCtx, {
                type: 'bar',
                data: contentWeeklyData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Konten'
                            },
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
        } else if (period === 'monthly') {
            contentUploadChart = new Chart(contentUploadChartCtx, {
                type: 'bar',
                data: contentMonthlyData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Konten'
                            },
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
    }

    // Function to update chart based on dropdown selection
    function updateChartType() {
        const chartType = document.getElementById('chartType').value;

        // Destroy the previous chart
        if (prospekChart) prospekChart.destroy();

        // Display the selected chart
        if (chartType === 'line') {
            prospekChart = new Chart(prospekChartCtx, {
                type: 'line',
                data: prospekLineData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
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
        } else if (chartType === 'pie') {
            prospekChart = new Chart(prospekChartCtx, {
                type: 'pie',
                data: prospekPieData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }
    }

    // Initialize charts on load
    window.onload = function() {
        initLineChart();
        initContentUploadChart();
    };
</script>

<style>
    /* Custom styles untuk dashboard */
    body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
    }
    
    .card {
        border-radius: 10px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(45deg, #3b82f6, #60a5fa);
    }
    
    .avatar-sm {
        font-size: 14px;
        font-weight: bold;
    }
    
    .progress {
        border-radius: 10px;
        overflow: hidden;
    }
    
    /* Dark mode toggle */
    .dark-mode-toggle {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 999;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #333;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
</style>
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