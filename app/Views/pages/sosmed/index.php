<?= $this->extend('layout/template'); ?>

<?= $this->Section('css'); ?>
<style>
    /* Main colors */
    :root {
        --primary-color: #4e73df;
        --primary-hover: #3a5fc8;
        --secondary-color: #f8f9fa;
        --success-color: #1cc88a;
        --danger-color: #e74a3b;
        --warning-color: #f6c23e;
        --info-color: #36b9cc;
    }

    /* Card styling */
    .app-card {
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    
    .app-card:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
    }
    
    .app-card-header {
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    
    .app-card-title {
        color: #4e73df;
        font-weight: 600;
        margin-bottom: 0;
    }

    /* Table styling */
    .table {
        font-size: 0.9rem;
    }
    
    .app-table-hover tbody tr {
        transition: all 0.2s ease;
    }
    
    .app-table-hover tbody tr:hover {
        background-color: rgba(78, 115, 223, 0.05);
        transform: translateY(-2px);
    }
    
    thead tr {
        background-color: #f8f9fc;
        border-bottom: 2px solid #e3e6f0;
    }
    
    thead th {
        font-weight: 600;
        color: #5a5c69;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    
    tbody td {
        vertical-align: middle !important;
        padding: 1rem 0.75rem;
        border-bottom: 1px solid #f3f3f3;
    }

    /* Buttons styling */
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-primary:hover {
        background-color: var(--primary-hover);
        border-color: var(--primary-hover);
    }
    
    .btn {
        border-radius: 6px;
        font-weight: 500;
        padding: 0.4rem 1rem;
        transition: all 0.2s ease;
    }
    
    .btn-sm {
        padding: 0.25rem 0.7rem;
        font-size: 0.8rem;
    }
    
    .action-btn-group {
        display: flex;
        gap: 6px;
    }
    
    .action-btn-group .btn {
        box-shadow: 0 2px 4px rgba(0,0,0,0.06);
    }
    
    .btn-info {
        background-color: var(--info-color);
        border-color: var(--info-color);
        color: white;
    }
    
    .btn-info:hover {
        background-color: #2da1b3;
        border-color: #2da1b3;
        color: white;
    }
    
    .btn-warning {
        background-color: var(--warning-color);
        border-color: var(--warning-color);
        color: #212529;
    }
    
    .btn-warning:hover {
        background-color: #e0ae2c;
        border-color: #e0ae2c;
    }
    
    .btn-danger {
        background-color: var(--danger-color);
        border-color: var(--danger-color);
    }
    
    .btn-danger:hover {
        background-color: #d32a1a;
        border-color: #d32a1a;
    }

    /* Badges styling */
    .badge {
        padding: 0.5rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 30px;
        letter-spacing: 0.3px;
    }
    
    .hover-badge {
        background-color: rgba(54, 185, 204, 0.15) !important;
        color: #36b9cc !important;
        transition: all 0.3s ease;
        border: 1px solid rgba(54, 185, 204, 0.2);
    }
    
    .hover-badge:hover {
        background-color: #36b9cc !important;
        color: #fff !important;
    }
    
    .status-active {
        background-color: rgba(28, 200, 138, 0.15) !important;
        color: #1cc88a !important;
        border: 1px solid rgba(28, 200, 138, 0.2);
    }
    
    .status-inactive {
        background-color: rgba(231, 74, 59, 0.15) !important;
        color: #e74a3b !important;
        border: 1px solid rgba(231, 74, 59, 0.2);
    }
    
    .status-pending {
        background-color: rgba(246, 194, 62, 0.15) !important;
        color: #f6c23e !important;
        border: 1px solid rgba(246, 194, 62, 0.2);
    }

    /* Platform icons styling */
    .platform-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border-radius: 10px;
        margin-right: 8px;
        font-size: 1.2rem;
        color: white;
    }
    
    .icon-fb {
        background: linear-gradient(45deg, #3b5998, #4c6bba);
        box-shadow: 0 3px 8px rgba(59, 89, 152, 0.3);
    }
    
    .icon-ig {
        background: linear-gradient(45deg, #833ab4, #fd1d1d, #fcb045);
        box-shadow: 0 3px 8px rgba(219, 42, 123, 0.3);
    }
    
    .icon-linkedin {
        background: linear-gradient(45deg, #0077b5, #0e9bd8);
        box-shadow: 0 3px 8px rgba(0, 119, 181, 0.3);
    }
    
    .icon-tiktok {
        background: linear-gradient(45deg, #000000, #3d3d3d);
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
    }
    
    .icon-default {
        background: linear-gradient(45deg, #6c757d, #868e96);
        box-shadow: 0 3px 8px rgba(108, 117, 125, 0.3);
    }

    /* Filter section styling */
    .filter-section {
        background-color: #f8f9fc;
        border-radius: 10px;
        padding: 15px 20px;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    }
    
    .form-select {
        border-radius: 6px;
        border-color: #e3e6f0;
        padding: 0.5rem 0.75rem;
        font-size: 0.9rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        transition: all 0.2s;
    }
    
    .form-select:focus {
        border-color: #bac8f3;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    
    .form-label {
        font-weight: 600;
        color: #5a5c69;
        margin-bottom: 0.4rem;
        font-size: 0.9rem;
    }

    /* Alert styling */
    .alert {
        border-radius: 10px;
        border: none;
    }
    
    .alert-success {
        background-color: rgba(28, 200, 138, 0.1);
        color: #1cc88a;
        border-left: 4px solid #1cc88a;
    }
    
    /* Modal styling */
    .modal-content {
        border-radius: 10px;
        border: none;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .modal-header.bg-danger {
        background: linear-gradient(45deg, #e74a3b, #f17a6e) !important;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    
    /* Page title section */
    .app-page-title {
        font-weight: 700;
        color: #4e73df;
        margin-bottom: 0.2rem;
    }
    
    /* Empty state styling */
    .empty-state {
        text-align: center;
        padding: 2.5rem 0;
        color: #6c757d;
    }
    
    .empty-state i {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #d1d3e2;
    }

    /* Animation for elements */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .app-card, .alert {
        animation: fadeInUp 0.4s ease-out;
    }
    
    /* Platform labels */
    .platform-label {
        display: flex;
        align-items: center;
    }
    
    .platform-name {
        font-weight: 600;
    }
    
    /* Count badge animation */
    .hover-badge {
        position: relative;
        overflow: hidden;
    }
    
    .hover-badge::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.2);
        transform: translateX(-100%);
        transition: transform 0.6s ease;
    }
    
    .hover-badge:hover::after {
        transform: translateX(100%);
    }
</style>
<?= $this->endSection('css'); ?>

<?= $this->Section('content'); ?>

<div class="app-content pt-4 p-md-4 p-lg-5">
    <div class="container-xl">
        <!-- Judul dan Tombol Tambah -->
        <div class="row g-4 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Kelola Media Sosial</h1>
                <p class="text-muted mt-2">Tambah, edit, dan kelola akun media sosial perusahaan</p>
            </div>
            <div class="col-auto">
                <div>
                    <a href="<?= route_to('sosmed.tambah') ?>" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Media Sosial
                    </a>
                </div>
            </div>
        </div>

        <!-- Notifikasi -->
        <?php if (session()->has('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-2"></i>
                    <div><?= session('success') ?></div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Filter Section -->
        <div class="filter-section mb-4">
            <form>
                <div class="row align-items-end">
                    <div class="col-md-6">
                        <label for="filterBisnis" class="form-label"><i class="fas fa-filter me-2"></i>Filter berdasarkan Bisnis:</label>
                        <select id="filterBisnis" class="form-select" onchange="location.href=this.value">
                            <option value="<?= route_to('sosmed') ?>" <?= empty($id_bisnis) ? 'selected' : '' ?>>-- Semua Bisnis --</option>
                            <?php foreach ($allBisnis as $b) : ?>
                                <option value="<?= route_to('sosmed.filter', $b['id_bisnis']) ?>" <?= (!empty($id_bisnis) && $id_bisnis == $b['id_bisnis']) ? 'selected' : '' ?>>
                                    <?= $b['nama_bisnis']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="ms-md-3">
                            <label for="statusFilter" class="form-label"><i class="fas fa-toggle-on me-2"></i>Status:</label>
                            <select id="statusFilter" class="form-select" onchange="filterByStatus(this.value)">
                                <option value="all" selected>Semua Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="tdk_aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 mt-3 mt-md-0">
                        <div class="d-grid">
                            <button type="button" class="btn btn-secondary" onclick="resetFilters()">
                                <i class="fas fa-sync-alt me-2"></i>Reset
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabel -->
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">
                            <i class="fas fa-share-alt me-2"></i>Daftar Media Sosial
                        </h4>
                    </div>
                    <div class="col-auto">
                        <div class="card-header-action">
                            <span class="badge bg-primary"><?= count($allSosmed) ?> Akun</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-card-body px-4 pb-4">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left" id="sosmedTable">
                        <thead>
                            <tr>
                                <th class="cell" width="5%">No</th>
                                <th class="cell" width="20%">Platform</th>
                                <th class="cell" width="20%">Username</th>
                                <th class="cell" width="10%">Total Konten</th>
                                <th class="cell" width="10%">Status</th>
                                <th class="cell" width="15%">Terakhir Diupdate</th>
                                <th class="cell" width="20%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $counter = 1; ?>
                            <?php foreach ($allSosmed as $sosmed) : ?>
                                <tr data-status="<?= strtolower($sosmed['status']) ?>">
                                    <td class="cell"><?= $counter++; ?></td>
                                    <td class="cell">
                                        <div class="platform-label">
                                            <?php
                                            $iconClass = '';
                                            $platformIconClass = '';
                                            switch (strtolower($sosmed['platform'])) {
                                                case 'fb':
                                                    $iconClass = 'fab fa-facebook';
                                                    $platformIconClass = 'icon-fb';
                                                    $platformName = 'Facebook';
                                                    break;
                                                case 'ig':
                                                    $iconClass = 'fab fa-instagram';
                                                    $platformIconClass = 'icon-ig';
                                                    $platformName = 'Instagram';
                                                    break;
                                                case 'linkedin':
                                                    $iconClass = 'fab fa-linkedin';
                                                    $platformIconClass = 'icon-linkedin';
                                                    $platformName = 'LinkedIn';
                                                    break;
                                                case 'tiktok':
                                                    $iconClass = 'fab fa-tiktok';
                                                    $platformIconClass = 'icon-tiktok';
                                                    $platformName = 'TikTok';
                                                    break;
                                                default:
                                                    $iconClass = 'fas fa-share-alt';
                                                    $platformIconClass = 'icon-default';
                                                    $platformName = $sosmed['platform'];
                                            }
                                            ?>
                                            <div class="platform-icon <?= $platformIconClass ?>">
                                                <i class="<?= $iconClass ?>"></i>
                                            </div>
                                            <span class="platform-name"><?= $platformName ?></span>
                                        </div>
                                    </td>
                                    <td class="cell">@<?= $sosmed['username']; ?></td>
                                    <td class="cell">
                                        <a href="#" class="badge text-decoration-none hover-badge">
                                            <i class="fas fa-file-alt me-1"></i>
                                            <?= isset($sosmed['jumlah_konten']) ? $sosmed['jumlah_konten'] : 0 ?>
                                        </a>
                                    </td>
                                    <td class="cell">
                                        <?php
                                        $statusClass = '';
                                        $statusIcon = '';
                                        switch (strtolower($sosmed['status'])) {
                                            case 'aktif':
                                                $statusClass = 'status-active';
                                                $statusIcon = 'fas fa-check-circle';
                                                break;
                                            case 'tidak aktif':
                                                $statusClass = 'status-inactive';
                                                $statusIcon = 'fas fa-times-circle';
                                                break;
                                            case 'pending':
                                                $statusClass = 'status-pending';
                                                $statusIcon = 'fas fa-clock';
                                                break;
                                            default:
                                                $statusClass = '';
                                                $statusIcon = 'fas fa-circle';
                                        }
                                        ?>
                                        <span class="badge <?= $statusClass ?>">
                                            <i class="<?= $statusIcon ?> me-1"></i>
                                            <?= $sosmed['status']; ?>
                                        </span>
                                    </td>
                                    <td class="cell">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        <?= date('d M Y', strtotime($sosmed['updated_at'])); ?>
                                    </td>
                                    <td class="cell">
                                        <div class="action-btn-group">
                                            <a href="<?= route_to('sosmed.detail', $sosmed['id_sosmed']) ?>" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?= route_to('sosmed.edit', $sosmed['id_sosmed']) ?>" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteSosmedModal<?= $sosmed['id_sosmed'] ?>" data-bs-toggle="tooltip" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <?php if (empty($allSosmed)) : ?>
                                <tr>
                                    <td colspan="7" class="empty-state">
                                        <i class="fas fa-share-alt mb-3"></i>
                                        <h5>Belum ada data media sosial</h5>
                                        <p>Tambahkan akun media sosial baru dengan mengklik tombol "Tambah Media Sosial"</p>
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

<!-- Modal Konfirmasi Hapus Media Sosial -->
<?php foreach ($allSosmed as $sosmed) : ?>
    <div class="modal fade" id="deleteSosmedModal<?= $sosmed['id_sosmed'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Konfirmasi Hapus Data
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="mb-0">Apakah Anda yakin ingin menghapus media sosial:</p>
                    <div class="d-flex align-items-center mt-3 p-3 bg-light rounded">
                        <?php
                        $iconClass = '';
                        switch (strtolower($sosmed['platform'])) {
                            case 'fb':
                                $iconClass = 'fab fa-facebook';
                                break;
                            case 'ig':
                                $iconClass = 'fab fa-instagram';
                                break;
                            case 'linkedin':
                                $iconClass = 'fab fa-linkedin';
                                break;
                            case 'tiktok':
                                $iconClass = 'fab fa-tiktok';
                                break;
                            default:
                                $iconClass = 'fas fa-share-alt';
                        }
                        ?>
                        <i class="<?= $iconClass ?> fa-2x me-3"></i>
                        <div>
                            <strong><?= $sosmed['platform'] ?></strong><br>
                            <span class="text-muted">@<?= $sosmed['username'] ?></span>
                        </div>
                    </div>
                    <div class="alert alert-warning mt-3 mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <a href="<?= route_to('sosmed.hapus', $sosmed['id_sosmed']) ?>" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Auto hide alert after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });

    // Filter by status
    function filterByStatus(status) {
        const rows = document.querySelectorAll('#sosmedTable tbody tr');
        rows.forEach(row => {
            if (status === 'all' || row.getAttribute('data-status') === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Reset filters
    function resetFilters() {
        document.getElementById('filterBisnis').selectedIndex = 0;
        document.getElementById('statusFilter').selectedIndex = 0;
        
        const rows = document.querySelectorAll('#sosmedTable tbody tr');
        rows.forEach(row => {
            row.style.display = '';
        });
        
        // Redirect to base URL
        window.location.href = "<?= route_to('sosmed') ?>";
    }
</script>

<?= $this->endSection('content') ?>