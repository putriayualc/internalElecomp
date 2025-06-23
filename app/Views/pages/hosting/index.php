<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid py-3">
    <div class="rounded-3 shadow-sm mb-4"
        style="background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="d-flex justify-content-between align-items-center p-4 text-white">
            <div>
                <h1 class="h1 fw-bold">Data Hosting</h1>
                <p class="text-white-70 small mb-0">Kelola data hosting dan domain</p>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-outline-light px-4 py-2 fs-6 d-flex align-items-center gap-2" onclick="exportData()">
                    <i class="bi bi-download"></i>
                    <span class="d-none d-sm-inline">Export Data</span>
                </button>

                <a href="<?= route_to('hosting.tambah') ?>" class="btn btn-light text-info px-4 py-2 fs-6 d-flex align-items-center gap-2">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span class="d-none d-sm-inline">Tambah Hosting</span>
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
                    <table id="hostingTable" class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center border-end" style="width: 60px;">
                                    <span class="fw-semibold">No</span>
                                </th>
                                <th class="text-center border-end" style="min-width: 180px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-primary bg-opacity-10 text-primary">
                                            <i class="fas fa-server"></i>
                                        </span>
                                        <span class="fw-semibold">Hosting</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 130px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-warning bg-opacity-10 text-warning">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                        <span class="fw-semibold">Exp Hosting</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 180px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-info bg-opacity-10 text-info">
                                            <i class="fas fa-globe"></i>
                                        </span>
                                        <span class="fw-semibold">Domain Utama</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 130px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-warning bg-opacity-10 text-warning">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                        <span class="fw-semibold">Exp Domain</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 120px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-success bg-opacity-10 text-success">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <span class="fw-semibold">Username</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 120px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-danger bg-opacity-10 text-danger">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <span class="fw-semibold">Password</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 160px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-secondary bg-opacity-10 text-secondary">
                                            <i class="fas fa-link"></i>
                                        </span>
                                        <span class="fw-semibold">Add-on Domains</span>
                                    </div>
                                </th>
                                <th class="text-center" style="width: 120px;">
                                    <span class="fw-semibold">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($allHosting)): ?>
                                <?php foreach ($allHosting as $index => $host) : ?>
                                    <tr>
                                        <td class="text-center border-end">
                                            <span class="text-muted fw-medium"><?= $index + 1 ?></span>
                                        </td>
                                        <td class="border-end">
                                            <div class="d-flex align-items-center py-2">
                                                <div class="flex-grow-1 min-width-0">
                                                    <div class="mb-1">
                                                        <a href="https://<?= esc($host['hosting']) ?>" target="_blank"
                                                            class="text-decoration-none text-dark fw-semibold user-name-link">
                                                            <?= esc($host['hosting']) ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center border-end">
                                            <span class="status-badge" style="background-color: #fff3cd; color: #856404; border: 1px solid #856404;">
                                                <?= esc($host['tgl_exp_hosting']) ?>
                                            </span>
                                        </td>
                                        <td class="border-end">
                                            <div class="d-flex align-items-center py-2">
                                                <div class="flex-grow-1 min-width-0">
                                                    <div class="mb-1">
                                                        <a href="https://<?= esc($host['domain_utama']) ?>" target="_blank"
                                                            class="text-decoration-none text-dark fw-semibold user-name-link">
                                                            <?= esc($host['domain_utama']) ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center border-end">
                                            <span class="status-badge" style="background-color: #fff3cd; color: #856404; border: 1px solid #856404;">
                                                <?= esc($host['tgl_exp_domain']) ?>
                                            </span>
                                        </td>
                                        <td class="text-center border-end">
                                            <span class="text-truncate d-inline-block fw-medium" style="max-width: 120px;"
                                                title="<?= esc($host['username_hosting']) ?>">
                                                <?= esc($host['username_hosting']) ?>
                                            </span>
                                        </td>
                                        <td class="text-center border-end">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <span class="password-mask text-muted">••••••••</span>
                                                <button class="btn btn-sm btn-outline-primary ms-2 toggle-password" data-password="<?= esc($host['password_hosting']) ?>" type="button">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="text-center border-end">
                                            <?php if (!empty($host['add_on_domain'])): ?>
                                                <button type="button" class="btn btn-sm btn-outline-info view-addon-domains"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#addonModal<?= $host['id_hosting'] ?>">
                                                    <i class="fas fa-external-link-alt me-1"></i> Lihat Add-on Domain
                                                    <span class="badge bg-secondary ms-1"><?= substr_count($host['add_on_domain'], ',') + 1 ?></span>
                                                </button>
                                            <?php else: ?>
                                                <span class="text-muted"><em>Tidak ada</em></span>
                                            <?php endif; ?>
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
                                                            href="<?= route_to('hosting.edit', $host['id_hosting']) ?>">
                                                            <i class="fas fa-edit text-primary me-2"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center text-danger"
                                                            href="#"
                                                            onclick="konfirmasiHapus('<?= route_to('hosting.delete', $host['id_hosting']) ?>', '<?= esc($host['domain_utama']) ?>')">
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
                                    <td colspan="9" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-server text-muted mb-3" style="font-size: 3rem;"></i>
                                            <h5 class="text-muted">Tidak ada data hosting</h5>
                                            <p class="text-muted mb-0">Silakan tambah hosting baru untuk memulai</p>
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

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-semibold" id="modalHapusLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2">Apakah Anda yakin ingin menghapus hosting dengan domain:</p>
                <p class="mb-0 fs-5 fw-bold text-danger" id="domainToDelete"></p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Batal
                </button>
                <form id="formHapus" method="POST" action="" class="d-inline">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add-on Domain -->
<?php foreach ($allHosting as $host) : ?>
    <?php if (!empty($host['add_on_domain'])): ?>
        <div class="modal fade" id="addonModal<?= $host['id_hosting'] ?>" tabindex="-1" aria-labelledby="addonModalLabel<?= $host['id_hosting'] ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title fw-semibold" id="addonModalLabel<?= $host['id_hosting'] ?>">
                            <i class="fas fa-link me-2"></i>
                            Add-on Domain untuk <?= esc($host['domain_utama']) ?>
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-end" style="width: 50px;">
                                            <span class="fw-semibold">No</span>
                                        </th>
                                        <th class="border-end">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="icon-circle bg-info bg-opacity-10 text-info">
                                                    <i class="fas fa-globe"></i>
                                                </span>
                                                <span class="fw-semibold">Domain Add-on</span>
                                            </div>
                                        </th>
                                        <th class="text-center">
                                            <div class="d-flex align-items-center justify-content-center gap-2">
                                                <span class="icon-circle bg-warning bg-opacity-10 text-warning">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </span>
                                                <span class="fw-semibold">Tanggal Expired</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $addOnDomains = explode(',', $host['add_on_domain']);
                                    $addOnExpDates = !empty($host['tgl_exp_add_domain']) ? explode(',', $host['tgl_exp_add_domain']) : [];

                                    foreach ($addOnDomains as $index => $domain) :
                                        $trimmedDomain = trim($domain);
                                        $expDate = isset($addOnExpDates[$index]) ? trim($addOnExpDates[$index]) : 'Tidak tersedia';
                                    ?>
                                        <tr>
                                            <td class="text-center border-end">
                                                <span class="text-muted fw-medium"><?= $index + 1 ?></span>
                                            </td>
                                            <td class="border-end">
                                                <div class="d-flex align-items-center py-2">
                                                    <div class="avatar-wrapper me-3">
                                                        <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle" style="width: 35px; height: 35px;">
                                                            <i class="fas fa-globe"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="mb-1">
                                                            <a href="https://<?= esc($trimmedDomain) ?>" target="_blank"
                                                                class="text-decoration-none text-dark fw-semibold user-name-link">
                                                                <?= esc($trimmedDomain) ?>
                                                            </a>
                                                            <i class="fas fa-external-link-alt text-muted ms-1" style="font-size: 12px;"></i>
                                                        </div>
                                                        <small class="text-muted">Add-on Domain</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($expDate !== 'Tidak tersedia'): ?>
                                                    <span class="status-badge" style="background-color: #fff3cd; color: #856404; border: 1px solid #856404;">
                                                        <?= esc($expDate) ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="text-muted"><em>Tidak tersedia</em></span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<!-- Loading Overlay -->
<div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999;">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<style>
    /* Icon circle styling */
    .icon-circle {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    /* Status badge styling */
    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        text-align: center;
        min-width: 60px;
    }

    .status-active {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #155724;
    }

    .status-completed {
        background-color: #cce5ff;
        color: #004085;
        border: 1px solid #004085;
    }

    .status-inactive {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #721c24;
    }

    /* User name link styling */
    .user-name-link:hover {
        color: #0d6efd !important;
        text-decoration: underline !important;
    }

    /* Hilangkan semua indikator sorting pada header tabel */
    #hostingTable thead th {
        cursor: default !important;
    }

    #hostingTable thead th:hover {
        background-color: inherit !important;
    }

    /* Hilangkan ikon sorting DataTables */
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

    /* Action button styling */
    .action-btn {
        border: 1px solid #dee2e6;
        background-color: #fff;
    }

    .action-btn:hover {
        background-color: #f8f9fa;
        border-color: #adb5bd;
    }

    /* Password toggle styling */
    .toggle-password {
        font-size: 12px;
        padding: 2px 6px;
    }
</style>

<script>
    $(document).ready(function() {
        var table = $('#hostingTable').DataTable({
            responsive: false,
            pageLength: 10,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Semua"]
            ],
            language: {
                decimal: "",
                emptyTable: "Tidak ada data hosting yang tersedia",
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
                    targets: 0
                },
                {
                    orderable: false,
                    targets: -1
                }
            ],
            autoWidth: false,
            stateSave: true,

            initComplete: function() {
                $('.dataTables_length select').addClass('form-select form-select-sm me-2');
                $('.dataTables_filter input').addClass('form-control form-control-sm').attr('placeholder', 'Ketik untuk mencari...');
                $('.dataTables_length').addClass('d-flex align-items-center');
                $('.dataTables_filter').addClass('d-flex align-items-center justify-content-end');
                $('.dataTables_filter label').addClass('d-flex align-items-center mb-0');

                $('#hostingTable_length').appendTo('#custom-length');
                $('#hostingTable_filter').appendTo('#custom-search');

                $('.dataTables_length label').addClass('d-flex align-items-center gap-2 mb-0');
            },

            drawCallback: function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });

        // Auto numbering
        table.on('order.dt search.dt', function() {
            let i = 1;
            table.rows({
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, k) {
                cell.getElementsByTagName('td')[0].innerHTML = k + 1;
            });
        }).draw();
    });

    // Toggle password visibility
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-password');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const passwordContainer = this.closest('td').querySelector('.password-mask');
                const icon = this.querySelector('i');

                if (passwordContainer.textContent === '••••••••') {
                    passwordContainer.textContent = this.getAttribute('data-password');
                    passwordContainer.classList.remove('text-muted');
                    passwordContainer.classList.add('text-dark', 'fw-medium');
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordContainer.textContent = '••••••••';
                    passwordContainer.classList.remove('text-dark', 'fw-medium');
                    passwordContainer.classList.add('text-muted');
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    });

    function exportData() {
        const table = document.getElementById('hostingTable');
        const rows = table.querySelectorAll('tbody tr');
        let csv = 'No,Hosting,Exp Hosting,Domain Utama,Exp Domain,Username,Password,Add On Domain\n';

        rows.forEach((row, index) => {
            const cols = row.querySelectorAll('td');
            if (cols.length > 1) { // Skip empty state row
                const hosting = cols[1].querySelector('a')?.textContent.trim() || '';
                const expHosting = cols[2].querySelector('.status-badge')?.textContent.trim() || '';
                const domain = cols[3].querySelector('a')?.textContent.trim() || '';
                const expDomain = cols[4].querySelector('.status-badge')?.textContent.trim() || '';
                const username = cols[5]?.textContent.trim() || '';
                const password = cols[6].querySelector('.toggle-password')?.getAttribute('data-password') || '';

                // Get add-on domains
                const addonButton = cols[7].querySelector('.view-addon-domains');
                let addonDomains = '';
                if (addonButton) {
                    const modalId = addonButton.getAttribute('data-bs-target');
                    const modal = document.querySelector(modalId);
                    if (modal) {
                        const domainLinks = modal.querySelectorAll('.list-group-item');
                        const domains = Array.from(domainLinks).map(link => {
                            return link.querySelector('.fw-semibold')?.textContent.trim() || '';
                        });
                        addonDomains = domains.join('; ');
                    }
                }

                csv += `${index + 1},"${hosting}","${expHosting}","${domain}","${expDomain}","${username}","${password}","${addonDomains}"\n`;
            }
        });

        const blob = new Blob([csv], {
            type: 'text/csv;charset=utf-8;'
        });
        const url = URL.createObjectURL(blob);

        const a = document.createElement('a');
        a.href = url;
        a.download = 'data-hosting.csv';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }

    function konfirmasiHapus(url, domain) {
        const form = document.getElementById('formHapus');
        const domainElement = document.getElementById('domainToDelete');

        form.action = url;
        domainElement.textContent = domain;

        const modal = new bootstrap.Modal(document.getElementById('modalHapus'));
        modal.show();
    }
</script>

<?= $this->endSection() ?>