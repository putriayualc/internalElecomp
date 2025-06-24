<?= $this->extend('layout/template'); ?>

<?= $this->Section('css'); ?>
<style>
    /* Icon Circle Style */
    .icon-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        font-size: 12px;
    }

    /* Status Badge Style */
    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-align: center;
        min-width: 60px;
    }

    /* Action Button Style */
    .action-btn {
        border: 1px solid #dee2e6;
        background: #f8f9fa;
        transition: all 0.2s ease;
    }

    .action-btn:hover {
        background: #e9ecef;
        border-color: #adb5bd;
    }

    /* Platform icons styling */
    .platform-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        margin-right: 8px;
        font-size: 1rem;
        color: white;
    }

    .icon-facebook {
        background: linear-gradient(45deg, #3b5998, #4c6bba);
        box-shadow: 0 2px 6px rgba(59, 89, 152, 0.3);
    }

    .icon-instagram {
        background: linear-gradient(45deg, #833ab4, #fd1d1d, #fcb045);
        box-shadow: 0 2px 6px rgba(219, 42, 123, 0.3);
    }

    .icon-linkedin {
        background: linear-gradient(45deg, #0077b5, #0e9bd8);
        box-shadow: 0 2px 6px rgba(0, 119, 181, 0.3);
    }

    .icon-tiktok {
        background: linear-gradient(45deg, #000000, #3d3d3d);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    .icon-default {
        background: linear-gradient(45deg, #6c757d, #868e96);
        box-shadow: 0 2px 6px rgba(108, 117, 125, 0.3);
    }

    .platform-label {
        display: flex;
        align-items: center;
    }

    .platform-name {
        font-weight: 600;
    }

    /* Avatar styling */
    .avatar-group {
        display: flex;
        align-items: center;
    }

    .avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        border: 2px solid #fff;
        object-fit: cover;
        margin-left: -6px;
        box-shadow: 0 0 0 1px #ccc;
        transition: transform 0.2s;
        cursor: pointer;
    }

    .avatar:first-child {
        margin-left: 0;
    }

    .avatar:hover {
        transform: scale(1.1);
        z-index: 2;
    }

    .avatar.more {
        background-color: #6c757d;
        color: #fff;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .avatar-wrapper {
        position: relative;
        display: inline-block;
    }

    .tooltip-text {
        visibility: hidden;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 4px 8px;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        transition: opacity 0.3s;
        white-space: nowrap;
        font-size: 11px;
    }

    .avatar-wrapper:hover .tooltip-text {
        visibility: visible;
        opacity: 1;
    }

    /* Hover badge styling */
    .hover-badge {
        background-color: rgba(54, 185, 204, 0.15) !important;
        color: #36b9cc !important;
        transition: all 0.3s ease;
        border: 1px solid rgba(54, 185, 204, 0.2);
        text-decoration: none;
        padding: 4px 8px;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .hover-badge:hover {
        background-color: #36b9cc !important;
        color: #fff !important;
    }

    /* DataTables styling overrides */
    table.dataTable thead th,
    table.dataTable thead td {
        border-bottom: 1px solid #ddd;
    }

    table.dataTable thead .sorting,
    table.dataTable thead .sorting_asc,
    table.dataTable thead .sorting_desc,
    table.dataTable thead .sorting_asc_disabled,
    table.dataTable thead .sorting_desc_disabled {
        background-image: none !important;
        cursor: default !important;
    }

    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:after {
        display: none !important;
    }

    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_desc:before {
        display: none !important;
    }

    #sosmedTable thead th {
        cursor: default !important;
    }

    #sosmedTable thead th:hover {
        background-color: inherit !important;
    }

    /* Filter section styling */
    .filter-section {
        background-color: white;
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
</style>
<?= $this->endSection('css'); ?>

<?= $this->Section('content'); ?>

<div class="container-fluid py-3">
    <!-- Header Section -->
    <div class="rounded-3 shadow-sm mb-4"
        style="background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1611224923853-80b023f02d71?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="d-flex justify-content-between align-items-center p-4 text-white">
            <div>
                <h1 class="h1 fw-bold">Kelola Media Sosial</h1>
                <p class="text-white-70 small mb-0">Tambah, edit, dan kelola akun media sosial perusahaan</p>
            </div>

            <div class="d-flex gap-2">
                <a href="<?= route_to('sosmed.tambah') ?>" class="btn btn-light text-info px-4 py-2 fs-6 d-flex align-items-center gap-2">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span class="d-none d-sm-inline">Tambah Media Sosial</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Notifikasi -->
    <?php if (session()->has('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= session('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i><?= session('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
</div>

<!-- Filter Section -->
<div class="filter-section mb-4">
    <form>
        <div class="row align-items-end">
            <div class="col-md-6">
                <label for="filterBisnis" class="form-label">
                    <i class="fas fa-filter me-2"></i>Filter berdasarkan Bisnis:
                </label>
                <select id="filterBisnis" class="form-select" onchange="location.href=this.value">
                    <option value="<?= route_to('sosmed') ?>" <?= empty($id_bisnis) ? 'selected' : '' ?>>-- Semua Bisnis --</option>
                    <?php foreach ($allBisnis as $b) : ?>
                        <option value="<?= route_to('sosmed.filter', $b['id_bisnis']) ?>" <?= (!empty($id_bisnis) && $id_bisnis == $b['id_bisnis']) ? 'selected' : '' ?>>
                            <?= $b['nama_bisnis']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
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

<!-- Main Content Card -->
<div class="card border-0 shadow-sm">
    <div class="card-body px-1">
        <div class="card-header bg-white">
            <div class="row align-items-start">
                <div class="col">
                    <!-- Custom Toolbar -->
                    <div class="row" id="custom-toolbar">
                        <div class="col-md-6 d-flex align-items-center" id="custom-length"></div>
                        <div class="col-md-6 d-flex justify-content-md-end justify-content-start mt-2 mt-md-0" id="custom-search"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTable Container -->
        <div class="datatable-wrapper">
            <div class="table-responsive">
                <div class="table-responsive-wrapper">
                    <table id="sosmedTable" class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center border-end" style="width: 60px;">
                                    <span class="fw-semibold">No</span>
                                </th>
                                <th class="text-center border-end" style="min-width: 180px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-primary bg-opacity-10 text-primary">
                                            <i class="fas fa-share-alt"></i>
                                        </span>
                                        <span class="fw-semibold">Platform</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-success bg-opacity-10 text-success">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <span class="fw-semibold">Username</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 120px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-warning bg-opacity-10 text-warning">
                                            <i class="fas fa-users"></i>
                                        </span>
                                        <span class="fw-semibold">User</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 120px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-info bg-opacity-10 text-info">
                                            <i class="fas fa-file-alt"></i>
                                        </span>
                                        <span class="fw-semibold">Total Konten</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-secondary bg-opacity-10 text-secondary">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                        <span class="fw-semibold">Terakhir Diupdate</span>
                                    </div>
                                </th>
                                <th class="text-center" style="width: 120px;">
                                    <span class="fw-semibold">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($allSosmed)): ?>
                                <?php foreach ($allSosmed as $index => $sosmed): ?>
                                    <tr>
                                        <td class="text-center border-end">
                                            <span class="text-muted fw-medium"><?= $index + 1 ?></span>
                                        </td>
                                        <td class="border-end">
                                            <div class="d-flex align-items-center py-2">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="platform-icon-wrapper">
                                                        <?php
                                                        $iconClass = 'fab fa-' . $sosmed['platform'];
                                                        $platformIconClass = 'platform-icon icon-' . $sosmed['platform'];
                                                        ?>
                                                        <div class="<?= $platformIconClass ?>">
                                                            <i class="<?= $iconClass ?>"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 min-width-0">
                                                    <div class="mb-1">
                                                        <span class="text-dark fw-semibold platform-name">
                                                            <?= ucfirst($sosmed['platform']); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center border-end">
                                            <span class="text-dark fw-medium">@<?= $sosmed['username']; ?></span>
                                        </td>
                                        <td class="text-center border-end">
                                            <div class="avatar-group d-flex align-items-center justify-content-center">
                                                <?php
                                                $maxAvatar = 3;
                                                $avatars = [];

                                                // Kumpulkan user yang sesuai dengan id_sosmed saat ini
                                                foreach ($allUserSosmed as $relasi) {
                                                    if ($relasi['id_sosmed'] == $sosmed['id_sosmed']) {
                                                        $avatars[] = [
                                                            'nama_user' => $relasi['nama'],
                                                            'foto' => $relasi['foto'],
                                                        ];
                                                    }
                                                }

                                                $totalUser = count($avatars);
                                                $displayed = array_slice($avatars, 0, $maxAvatar);
                                                ?>

                                                <?php foreach ($displayed as $user): ?>
                                                    <div class="avatar-wrapper me-1">
                                                        <img src="<?= base_url('assets/img/user/' . ($user['foto'] ?? 'default.jpg')); ?>"
                                                            class="avatar"
                                                            alt="<?= $user['nama_user'] ?>" />
                                                        <div class="tooltip-text"><?= $user['nama_user'] ?></div>
                                                    </div>
                                                <?php endforeach; ?>

                                                <?php if ($totalUser > $maxAvatar): ?>
                                                    <div class="avatar more"
                                                        title="<?= $totalUser - $maxAvatar ?> lainnya">
                                                        +<?= $totalUser - $maxAvatar ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td class="text-center border-end">
                                            <a href="<?= route_to('konten.filter', $sosmed['id_bisnis']) ?>?platform=<?= strtolower($sosmed['platform']) ?>" class="hover-badge">
                                                <i class="fas fa-file-alt me-1"></i>
                                                <?= isset($sosmed['jumlah_konten']) ? $sosmed['jumlah_konten'] : 0 ?>
                                            </a>
                                        </td>
                                        <td class="text-center border-end">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <i class="far fa-calendar-alt me-2 text-muted"></i>
                                                <span class="text-muted small"><?= date('d M Y', strtotime($sosmed['updated_at'])); ?></span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle action-btn"
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center text-primary"
                                                            href="<?= route_to('sosmed.edit', $sosmed['id_sosmed']) ?>">
                                                            <i class="fas fa-edit text-primary me-2"></i> <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center text-danger"
                                                            href="#" data-bs-toggle="modal" data-bs-target="#deleteSosmedModal<?= $sosmed['id_sosmed'] ?>">
                                                            <i class="fas fa-trash text-danger me-2"></i>
                                                            <span>Hapus</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-share-alt text-muted mb-3" style="font-size: 3rem;"></i>
                                            <h5 class="text-muted">Belum ada data media sosial</h5>
                                            <p class="text-muted mb-0">Tambahkan akun media sosial baru dengan mengklik tombol "Tambah Media Sosial"</p>
                                        </div>
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
    <div class="modal fade" id="deleteSosmedModal<?= $sosmed['id_sosmed'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $sosmed['id_sosmed'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-semibold" id="deleteModalLabel<?= $sosmed['id_sosmed'] ?>">
                        <i class="fas fa-exclamation-triangle me-2"></i> Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">Apakah Anda yakin ingin menghapus media sosial:</p>
                    <div class="d-flex align-items-center p-3 bg-light rounded mb-3">
                        <?php
                        $iconClass = '';
                        switch (strtolower($sosmed['platform'])) {
                            case 'facebook':
                                $iconClass = 'fab fa-facebook';
                                break;
                            case 'instagram':
                                $iconClass = 'fab fa-instagram'; // Dibuat konsisten menggunakan fab
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
                        <i class="<?= $iconClass ?> fa-2x me-3 text-primary"></i>
                        <div>
                            <strong><?= ucfirst($sosmed['platform']) ?></strong><br>
                            <span class="text-muted">@<?= $sosmed['username'] ?></span>
                        </div>
                    </div>
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <small>Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait!</small>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <a href="<?= route_to('sosmed.delete', $sosmed['id_sosmed']) ?>" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    $(document).ready(function() {
        var table = $('#sosmedTable').DataTable({
            responsive: false,
            pageLength: 10,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Semua"]
            ],
            language: {
                decimal: "",
                emptyTable: "Tidak ada data media sosial yang tersedia",
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
            dom: '<"dt-temp-toolbar"lf>rt<"row g-3 mt-2 pt-2 border-top"' +
                '<"col-md-5 d-flex align-items-center"i>' +
                '<"col-md-7 d-flex justify-content-md-end"p>>',
            columnDefs: [{
                    orderable: false,
                    searchable: false,
                    targets: 0 // Kolom "No"
                },
                {
                    orderable: false,
                    targets: -1 // Kolom "Aksi"
                }
            ],
            autoWidth: false,
            stateSave: true,

            order: [
                [5, 'desc']
            ], // Mengurutkan berdasarkan kolom ke-6 (Terakhir Diupdate) dari terbaru ke terlama

            initComplete: function() {
                // Tambahkan styling bootstrap
                $('.dataTables_length select').addClass('form-select form-select-sm me-2');
                $('.dataTables_filter input').addClass('form-control form-control-sm').attr('placeholder', 'Ketik untuk mencari...');
                $('.dataTables_length').addClass('d-flex align-items-center');
                $('.dataTables_filter').addClass('d-flex align-items-center justify-content-end');
                $('.dataTables_filter label').addClass('d-flex align-items-center mb-0');

                // Pindahkan kontrol ke tempat custom
                $('#sosmedTable_length').appendTo('#custom-length');
                $('#sosmedTable_filter').appendTo('#custom-search');

                // FIX tampilan "Tampilkan 10 data"
                $('.dataTables_length label').addClass('d-flex align-items-center gap-2 mb-0');
            },

            drawCallback: function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });

        // Penomoran otomatis yang tetap berurutan
        table.on('order.dt search.dt', function() {
            let i = 1;
            table.rows({
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, k) {
                cell.getElementsByTagName('td')[0].innerHTML = k + 1;
            });
        }).draw();

        // Auto hide alert after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });

    // Reset filters
    function resetFilters() {
        document.getElementById('filterBisnis').selectedIndex = 0;
        window.location.href = "<?= route_to('sosmed') ?>";
    }
</script>

<?= $this->endSection('content') ?>