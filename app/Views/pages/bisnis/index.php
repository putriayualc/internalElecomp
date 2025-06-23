<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid py-3">
    <div class="rounded-3 shadow-sm mb-4"
        style="background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="d-flex justify-content-between align-items-center p-4 text-white">
            <div>
                <h1 class="h1 fw-bold">Data Bisnis</h1>
                <p class="text-white-70 small mb-0">Kelola data bisnis dan informasi terkait</p>
            </div>

            <div class="d-flex gap-2">
                <button type="button" class="btn btn-light text-info px-4 py-2 fs-6 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#tambahBisnisModal">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span class="d-none d-sm-inline">Tambah Bisnis</span>
                </button>
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

    <?php if (session()->has('edit_success')) : ?>
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= session('edit_success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('delete_success')) : ?>
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= session('delete_success') ?>
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
                    <table id="bisnisTable" class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center border-end" style="width: 60px;">
                                    <span class="fw-semibold">No</span>
                                </th>
                                <th class="text-center border-end" style="min-width: 200px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-primary bg-opacity-10 text-primary">
                                            <i class="fas fa-building"></i>
                                        </span>
                                        <span class="fw-semibold">Nama Bisnis</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 200px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-success bg-opacity-10 text-success">
                                            <i class="fas fa-globe"></i>
                                        </span>
                                        <span class="fw-semibold">Website</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-info bg-opacity-10 text-info">
                                            <i class="fas fa-share-alt"></i>
                                        </span>
                                        <span class="fw-semibold">Jumlah Sosmed</span>
                                    </div>
                                </th>
                                <th class="text-center" style="width: 120px;">
                                    <span class="fw-semibold">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($allBisnis)): ?>
                                <?php foreach ($allBisnis as $index => $bisnis): ?>
                                    <tr>
                                        <td class="text-center border-end">
                                            <span class="text-muted fw-medium"><?= $index + 1 ?></span>
                                        </td>
                                        <td class="border-end">
                                            <div class="d-flex align-items-center py-2">
                                                <div class="flex-grow-1 min-width-0">
                                                    <div class="mb-1">
                                                        <span class="text-dark fw-semibold">
                                                            <?= esc($bisnis['nama_bisnis']) ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center border-end">
                                            <?php if (!empty($bisnis['website'])): ?>
                                                <a href="<?= esc($bisnis['website']) ?>" target="_blank"
                                                    class="text-decoration-none text-primary fw-medium text-truncate d-inline-block"
                                                    style="max-width: 200px;" title="<?= esc($bisnis['website']) ?>">
                                                    <?= esc($bisnis['website']) ?>
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center border-end">
                                            <span class="status-badge" style="background-color: #e3f2fd; color: #1565c0; border: 1px solid #1565c0;">
                                                <?= isset($bisnis['jumlah_sosmed']) ? $bisnis['jumlah_sosmed'] : 0 ?>
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
                                                        <a class="dropdown-item d-flex align-items-center text-primary"
                                                            href="#" data-bs-toggle="modal" data-bs-target="#editBisnisModal<?= $bisnis['id_bisnis'] ?>">
                                                            <i class="bi bi-pencil-square text-primary me-2"></i> <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center text-danger"
                                                            href="#" data-bs-toggle="modal" data-bs-target="#deleteBisnisModal<?= $bisnis['id_bisnis'] ?>">
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
                                    <td colspan="5" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-inbox text-muted mb-3" style="font-size: 3rem;"></i>
                                            <h5 class="text-muted">Tidak ada data bisnis</h5>
                                            <p class="text-muted mb-0">Silakan tambah bisnis baru untuk memulai</p>
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

<!-- Modal Tambah Bisnis -->
<div class="modal fade" id="tambahBisnisModal" tabindex="-1" aria-labelledby="tambahBisnisModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header text-white" style="background-color:rgba(0, 175, 228, 0.99)">
                <h5 class="modal-title fw-semibold" id="tambahBisnisModalLabel">
                    <i class="fas fa-plus-circle me-2"></i> Tambah Bisnis
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= route_to('bisnis.simpan') ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_bisnis" class="form-label fw-semibold">
                            Nama Bisnis <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="nama_bisnis" required
                            placeholder="Masukkan nama bisnis">
                    </div>
                    <div class="mb-3">
                        <label for="website" class="form-label fw-semibold">Website</label>
                        <input type="url" class="form-control" name="website" placeholder="https://example.com">
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Bisnis -->
<?php foreach ($allBisnis as $bisnis) : ?>
    <div class="modal fade" id="editBisnisModal<?= $bisnis['id_bisnis'] ?>" tabindex="-1" aria-labelledby="editBisnisModalLabel<?= $bisnis['id_bisnis'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title fw-semibold" id="editBisnisModalLabel<?= $bisnis['id_bisnis'] ?>">
                        <i class="fas fa-edit me-2"></i> Edit Bisnis
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= route_to('bisnis.update', $bisnis['id_bisnis']) ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namaBisnis<?= $bisnis['id_bisnis'] ?>" class="form-label fw-semibold">
                                Nama Bisnis <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="nama_bisnis" id="namaBisnis<?= $bisnis['id_bisnis'] ?>" value="<?= esc($bisnis['nama_bisnis']) ?>" required
                                placeholder="Masukkan nama bisnis">
                        </div>
                        <div class="mb-3">
                            <label for="website<?= $bisnis['id_bisnis'] ?>" class="form-label fw-semibold">Website</label>
                            <input type="url" class="form-control" name="website" id="website<?= $bisnis['id_bisnis'] ?>" value="<?= esc($bisnis['website']) ?>" placeholder="https://example.com">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Konfirmasi Hapus -->
<?php foreach ($allBisnis as $bisnis) : ?>
    <div class="modal fade" id="deleteBisnisModal<?= $bisnis['id_bisnis'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $bisnis['id_bisnis'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-semibold" id="deleteModalLabel<?= $bisnis['id_bisnis'] ?>">
                        <i class="fas fa-exclamation-triangle me-2"></i> Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">Apakah Anda yakin ingin menghapus bisnis <strong><?= esc($bisnis['nama_bisnis']) ?></strong>?</p>
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <small>Tindakan ini tidak dapat dibatalkan!</small>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <form method="GET" action="<?= route_to('bisnis.delete', $bisnis['id_bisnis']) ?>" class="d-inline">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<style>
    /* Hilangkan semua indikator sorting pada header tabel */
    #bisnisTable thead th {
        cursor: default !important;
    }

    #bisnisTable thead th:hover {
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
</style>

<script>
    $(document).ready(function() {
        var table = $('#bisnisTable').DataTable({
            responsive: false,
            pageLength: 10,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Semua"]
            ],
            language: {
                decimal: "",
                emptyTable: "Tidak ada data bisnis yang tersedia",
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
                    orderable: false, // Kolom "No" tidak perlu bisa di-search
                    searchable: false,
                    targets: 0
                },
                {
                    orderable: false, // Kolom "Aksi" tidak perlu bisa di-sort
                    targets: -1 // -1 menargetkan kolom terakhir
                }
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
                $('#bisnisTable_length').appendTo('#custom-length');
                $('#bisnisTable_filter').appendTo('#custom-search');

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
    });
</script>

<?= $this->endSection(); ?>