<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid py-4">
    <div class="rounded-3 shadow-sm mb-4"
        style="background: linear-gradient(rgba(13,110,253,0.85), rgba(13,110,253,0.85)), url('https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="d-flex justify-content-between align-items-center p-4 text-white">
            <div>
                <h1 class="h1 mb-1 fw-bold">Data Siswa Magang</h1>
                <p class="text-white-50 small mb-0">Kelola data siswa yang sedang melakukan magang</p>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-outline-light px-4 py-2 fs-6 d-flex align-items-center gap-2" onclick="exportData()">
                    <i class="bi bi-download"></i>
                    <span class="d-none d-sm-inline">Export Data</span>
                </button>
                <button class="btn btn-light text-primary px-4 py-2 fs-6 d-flex align-items-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span class="d-none d-sm-inline">Tambah Siswa</span>
                </button>
            </div>
        </div>
    </div>
</div>



<!-- Main Content Card -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="h5 mb-0 text-gray-700 fw-semibold">Daftar Siswa Magang</h6>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <!-- DataTable Container -->
        <div class="datatable-wrapper">
            <div class="table-responsive">
                <table id="siswaTable" class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center border-end" style="width: 60px;">
                                <span class="fw-semibold">No</span>
                            </th>
                            <th class="text-center border-end" style="min-width: 200px;">
                                <span class="fw-semibold">Nama Siswa</span>
                            </th>
                            <th class="text-center border-end" style="min-width: 150px;">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <span class="icon-circle bg-primary bg-opacity-10 text-primary">
                                        <i class="bi bi-building"></i>
                                    </span>
                                    <span class="fw-semibold">Instansi</span>
                                </div>
                            </th>
                            <th class="text-center border-end" style="min-width: 150px;">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <span class="icon-circle bg-success bg-opacity-10 text-success">
                                        <i class="bi bi-telephone-fill"></i>
                                    </span>
                                    <span class="fw-semibold">Telepon</span>
                                </div>
                            </th>
                            <th class="text-center border-end" style="min-width: 180px;">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <span class="icon-circle bg-danger bg-opacity-10 text-danger">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <span class="fw-semibold">Email</span>
                                </div>
                            </th>
                            <th class="text-center border-end" style="min-width: 150px;">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <span class="icon-circle bg-warning bg-opacity-10 text-warning">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </span>
                                    <span class="fw-semibold">Alamat</span>
                                </div>
                            </th>
                            <th class="text-center border-end" style="min-width: 170px;">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <span class="icon-circle bg-info bg-opacity-10 text-info">
                                        <i class="bi bi-info-circle"></i>
                                    </span>
                                    <span class="fw-semibold">Info Lainnya</span>
                                </div>
                            </th>
                            <th class="text-center" style="width: 100px;">
                                <span class="fw-semibold">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($siswa as $i => $siswa): ?>
                            <tr>
                                <td class="text-center border-end">
                                    <span class="text-muted fw-medium"><?= $i + 1 ?></span>
                                </td>
                                <td class="border-end">
                                    <div class="d-flex align-items-center py-2">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-wrapper">
                                                <img src="<?= base_url('assets/img/user/' . ($siswa['foto'] ?? 'default.jpg')); ?>"
                                                    alt="<?= esc($siswa['nama']); ?>"
                                                    class="avatar-img">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 min-width-0">
                                            <div class="mb-1">
                                                <a href="<?= route_to('siswa.detail', $siswa['id_siswa']) ?>"
                                                    class="text-decoration-none text-dark fw-semibold user-name-link">
                                                    <?= esc($siswa['nama']); ?>
                                                </a>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <small class="text-muted"><?= esc($siswa['jurusan']); ?></small>
                                                <?php
                                                $status = strtoupper($siswa['status']);
                                                switch ($status) {
                                                    case 'AKTIF':
                                                        $badgeClass = 'status-badge status-active';
                                                        break;
                                                    case 'SELESAI':
                                                        $badgeClass = 'status-badge status-completed';
                                                        break;
                                                    default:
                                                        $badgeClass = 'status-badge status-inactive';
                                                }
                                                ?>
                                                <span class="<?= $badgeClass; ?>">
                                                    <?= $status; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center border-end">
                                    <span class="text-truncate d-inline-block" style="max-width: 150px;"
                                        title="<?= esc($siswa['asal_instansi']); ?>">
                                        <?= esc($siswa['asal_instansi']); ?>
                                    </span>
                                </td>
                                <td class="text-center border-end">
                                    <a href="tel:<?= esc($siswa['no_telepon']); ?>"
                                        class="text-decoration-none text-success fw-medium">
                                        <?= esc($siswa['no_telepon']); ?>
                                    </a>
                                </td>
                                <td class="text-center border-end">
                                    <a href="mailto:<?= esc($siswa['email']); ?>"
                                        class="text-decoration-none text-primary fw-medium text-truncate d-inline-block"
                                        style="max-width: 180px;" title="<?= esc($siswa['email']); ?>">
                                        <?= esc($siswa['email']); ?>
                                    </a>
                                </td>
                                <td class="text-center border-end">
                                    <span class="text-truncate d-inline-block" style="max-width: 150px;"
                                        title="<?= esc($siswa['alamat']); ?>">
                                        <?= esc($siswa['alamat']); ?>
                                    </span>
                                </td>
                                <td class="text-center border-end">
                                    <span class="text-truncate d-inline-block" style="max-width: 120px;"
                                        title="<?= esc($siswa['keterangan']); ?>">
                                        <?= esc($siswa['keterangan']); ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle action-btn"
                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="<?= route_to('siswa.detail', $siswa['id_siswa']) ?>">
                                                    <i class="bi bi-eye text-info me-2"></i>
                                                    <span>Detail</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="<?= route_to('siswa.edit', $siswa['id_siswa']) ?>">
                                                    <i class="bi bi-pencil-square text-primary me-2"></i>
                                                    <span>Edit</span>
                                                </a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <button class="dropdown-item d-flex align-items-center text-danger"
                                                    onclick="confirmDelete(<?= $siswa['id_siswa'] ?>)">
                                                    <i class="bi bi-trash text-danger me-2"></i>
                                                    <span>Hapus</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger bg-opacity-10 border-bottom">
                <h5 class="modal-title text-danger fw-semibold" id="deleteModalLabel">
                    <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <p class="mb-2">Apakah Anda yakin ingin menghapus data siswa ini?</p>
                <p class="text-danger mb-0 small">
                    <i class="bi bi-info-circle me-1"></i>
                    Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>Batal
                </button>
                <form id="deleteForm" action="" method="POST" class="d-inline">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash me-1"></i>Ya, Hapus
                    </button>
                </form>
            </div>
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

<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#siswaTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Semua"]
            ],

            // Language configuration
            language: {
                decimal: "",
                emptyTable: "Tidak ada data siswa yang tersedia",
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

            // Layout configuration with Bootstrap classes
            dom: '<"row g-3 mb-3"<"col-sm-12 col-md-6 d-flex align-items-center"l><"col-sm-12 col-md-6"f>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"row g-3 mt-2 pt-2 border-top"<"col-sm-12 col-md-5 d-flex align-items-center"i><"col-sm-12 col-md-7"p>>',

            // Column configuration
            columnDefs: [{
                    orderable: false,
                    targets: [0, 7] // No dan Aksi
                },
                {
                    searchable: false,
                    targets: [0, 7] // No dan Aksi
                }
            ],

            // Default sorting
            order: [
                [1, 'asc']
            ],

            // Additional options
            autoWidth: false,
            processing: false,
            serverSide: false,
            stateSave: true,
            stateDuration: 60 * 60 * 24, // 24 hours

            // Callbacks
            initComplete: function(settings, json) {
                // Style the controls
                $('.dataTables_length select').addClass('form-select form-select-sm me-2');
                $('.dataTables_filter input').addClass('form-control form-control-sm').attr('placeholder', 'Ketik untuk mencari...');

                // Add some custom styling
                $('.dataTables_length').addClass('d-flex align-items-center');
                $('.dataTables_filter').addClass('d-flex align-items-center justify-content-end');
                $('.dataTables_filter label').addClass('d-flex align-items-center mb-0');
            },

            drawCallback: function(settings) {
                // Re-initialize tooltips
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });

        // Export functionality
        window.exportData = function() {
            const data = table.data().toArray();
            let csv = 'No,Nama,Jurusan,Status,Asal Instansi,Telepon,Email,Alamat,Info Lainnya\n';

            data.forEach(function(row, index) {
                const nama = $(row[1]).find('a').text().trim();
                const jurusan = $(row[1]).find('small').first().text().trim();
                const status = $(row[1]).find('.status-badge').text().trim();
                const instansi = $(row[2]).text().trim();
                const telepon = $(row[3]).text().trim();
                const email = $(row[4]).text().trim();
                const alamat = $(row[5]).text().trim();
                const info = $(row[6]).text().trim();

                csv += `${index + 1},"${nama}","${jurusan}","${status}","${instansi}","${telepon}","${email}","${alamat}","${info}"\n`;
            });

            const blob = new Blob([csv], {
                type: 'text/csv;charset=utf-8;'
            });
            const link = document.createElement('a');
            const url = URL.createObjectURL(blob);

            link.setAttribute('href', url);
            link.setAttribute('download', `data_siswa_magang_${new Date().toISOString().split('T')[0]}.csv`);
            link.style.visibility = 'hidden';

            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        };

        // Delete confirmation
        window.confirmDelete = function(id) {
            document.getElementById('deleteForm').action = '<?= base_url('siswa/delete/'); ?>' + id;
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        };
    });
</script>

<style>
    /* Modern DataTable Styling */
    .datatable-wrapper {
        background: #fff;
        border-radius: 0;
    }

    /* Table Styling */
    #siswaTable {
        border-collapse: separate;
        border-spacing: 0;
    }

    #siswaTable thead th {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 2px solid #dee2e6;
        color: #495057;
        font-weight: 600;
        font-size: 0.875rem;
        padding: 1rem 0.75rem;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    #siswaTable tbody td {
        padding: 0.875rem 0.75rem;
        border-bottom: 1px solid #f1f3f4;
        vertical-align: middle;
    }

    #siswaTable tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.03);
        transition: background-color 0.2s ease;
    }

    #siswaTable tbody tr:last-child td {
        border-bottom: none;
    }

    /* Icon Badges */
    .icon-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        border-radius: 6px;
        font-size: 0.75rem;
        color: white;
    }

    .icon-badge.bg-primary {
        background-color: #0d6efd;
    }

    .icon-badge.bg-success {
        background-color: #198754;
    }

    .icon-badge.bg-danger {
        background-color: #dc3545;
    }

    .icon-badge.bg-warning {
        background-color: #fd7e14;
    }

    .icon-badge.bg-info {
        background-color: #0dcaf0;
    }

    /* Avatar Styling */
    .avatar-wrapper {
        position: relative;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid #e9ecef;
        background: #f8f9fa;
    }

    .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.2s ease;
    }

    .avatar-wrapper:hover .avatar-img {
        transform: scale(1.05);
    }

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.5rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    .status-active {
        background: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        border: 1px solid rgba(13, 110, 253, 0.2);
    }

    .status-completed {
        background: rgba(25, 135, 84, 0.1);
        color: #198754;
        border: 1px solid rgba(25, 135, 84, 0.2);
    }

    .status-inactive {
        background: rgba(108, 117, 125, 0.1);
        color: #6c757d;
        border: 1px solid rgba(108, 117, 125, 0.2);
    }

    /* User Name Link */
    .user-name-link {
        transition: color 0.2s ease;
    }

    .user-name-link:hover {
        color: #0d6efd !important;
    }

    /* Action Button */
    .action-btn {
        border: none;
        background: #f8f9fa;
        color: #6c757d;
        border-radius: 8px;
        padding: 0.375rem 0.5rem;
        transition: all 0.2s ease;
    }

    .action-btn:hover {
        background: #e9ecef;
        color: #495057;
        transform: translateY(-1px);
    }

    /* DataTables Controls Styling */
    .dataTables_wrapper {
        padding: 1.5rem;
    }

    .dataTables_length label {
        font-weight: 500;
        color: #495057;
        font-size: 0.875rem;
    }

    .dataTables_filter label {
        font-weight: 500;
        color: #495057;
        font-size: 0.875rem;
    }

    .dataTables_filter input {
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        transition: all 0.2s ease;
        margin-left: 0.5rem;
        min-width: 250px;
    }

    .dataTables_filter input:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        outline: 0;
    }

    .dataTables_length select {
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 0.375rem 2rem 0.375rem 0.75rem;
        background-color: #fff;
        transition: all 0.2s ease;
    }

    .dataTables_length select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        outline: 0;
    }

    /* Pagination Styling */
    .dataTables_paginate .pagination {
        margin: 0;
        gap: 0.25rem;
    }

    .dataTables_paginate .page-link {
        border: 1px solid #dee2e6;
        color: #6c757d;
        background: #fff;
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        margin: 0;
        transition: all 0.2s ease;
        font-weight: 500;
    }

    .dataTables_paginate .page-link:hover {
        background: #e9ecef;
        border-color: #adb5bd;
        color: #495057;
        transform: translateY(-1px);
    }

    .dataTables_paginate .page-item.active .page-link {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
        box-shadow: 0 2px 4px rgba(13, 110, 253, 0.25);
    }

    .dataTables_paginate .page-item.disabled .page-link {
        background: #f8f9fa;
        border-color: #dee2e6;
        color: #adb5bd;
    }

    /* Info Text */
    .dataTables_info {
        color: #6c757d;
        font-size: 0.875rem;
        font-weight: 500;
    }

    /* Empty State */
    .dataTables_empty {
        text-align: center;
        padding: 3rem 1rem !important;
        color: #6c757d;
        font-style: italic;
    }

    /* Card Enhancements */
    .card {
        border-radius: 12px;
        overflow: hidden;
        /* padding: 5%; */
        background-color:#dc3545;
    }

    .card-header {
        border-bottom: 1px solid #f1f3f4;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .dataTables_wrapper {
            padding: 1rem;
        }

        .dataTables_length,
        .dataTables_filter {
            margin-bottom: 1rem;
        }

        .dataTables_filter input {
            min-width: 100%;
            margin-left: 0;
            margin-top: 0.5rem;
        }

        .dataTables_filter label {
            flex-direction: column;
            align-items: stretch !important;
        }

        .avatar-wrapper {
            width: 40px;
            height: 40px;
        }

        #siswaTable thead th,
        #siswaTable tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.875rem;
        }

        .status-badge {
            font-size: 0.6875rem;
            padding: 0.125rem 0.375rem;
        }
    }

    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .dataTables_wrapper {
            padding: 0.75rem;
        }

        .dataTables_paginate .page-link {
            padding: 0.375rem 0.5rem;
            font-size: 0.875rem;
        }

        .card-header {
            padding: 1rem;
        }

        .avatar-wrapper {
            width: 36px;
            height: 36px;
        }
    }

    /* Loading State */
    .dataTables_processing {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(255, 255, 255, 0.95);
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        font-weight: 500;
        color: #495057;
        z-index: 1000;
    }

    /* Scrollbar Styling */
    .dataTables_scrollBody::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }

    .dataTables_scrollBody::-webkit-scrollbar-track {
        background: #f1f3f4;
        border-radius: 3px;
    }

    .dataTables_scrollBody::-webkit-scrollbar-thumb {
        background: #ced4da;
        border-radius: 3px;
    }

    .dataTables_scrollBody::-webkit-scrollbar-thumb:hover {
        background: #adb5bd;
    }

    /* Text Truncation Improvements */
    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Links in table */
    #siswaTable a {
        transition: all 0.2s ease;
    }

    #siswaTable a:hover {
        text-decoration: underline !important;
    }

    /* Dropdown Menu Improvements */
    .dropdown-menu {
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 0.5rem 0;
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        transform: translateX(2px);
    }

    .dropdown-divider {
        margin: 0.25rem 0;
    }
</style>

<?= $this->endSection(); ?>
