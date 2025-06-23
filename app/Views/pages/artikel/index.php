<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid py-3">
    <div class="rounded-3 shadow-sm mb-4"
        style="background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="d-flex justify-content-between align-items-center p-4 text-white">
            <div>
                <h1 class="h1 fw-bold">Data Artikel</h1>
                <p class="text-white-70 small mb-0">Kelola semua artikel untuk blog "<?= $blog['domain_blog'] ?? 'Untitled Blog' ?>"</p>
            </div>

            <div class="d-flex gap-2">
                <a href="<?= route_to('backlink') ?>" class="btn btn-outline-light px-4 py-2 fs-6 d-flex align-items-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    <span class="d-none d-sm-inline">Kembali</span>
                </a>

                <a href="<?= route_to('artikel.tambah', $blog['id_email'], $blog['id_blog']) ?>" class="btn btn-light text-info px-4 py-2 fs-6 d-flex align-items-center gap-2">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span class="d-none d-sm-inline"><?= $addText ?? 'Tambah Artikel' ?></span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Notifikasi sukses -->
<?php if (session()->has('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> <?= session('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

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
                    <table id="artikelTable" class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center border-end" style="width: 60px;">
                                    <span class="fw-semibold">No</span>
                                </th>
                                <th class="text-center border-end" style="min-width: 200px;">
                                    <span class="fw-semibold">Judul Artikel</span>
                                </th>
                                <th class="text-center border-end" style="min-width: 120px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-primary bg-opacity-10 text-primary">
                                            <i class="bi bi-calendar"></i>
                                        </span>
                                        <span class="fw-semibold">Tanggal</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-success bg-opacity-10 text-success">
                                            <i class="bi bi-link-45deg"></i>
                                        </span>
                                        <span class="fw-semibold">Link</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 120px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-danger bg-opacity-10 text-danger">
                                            <i class="bi bi-arrow-right"></i>
                                        </span>
                                        <span class="fw-semibold">Link To</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 110px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-warning bg-opacity-10 text-warning">
                                            <i class="bi bi-tag"></i>
                                        </span>
                                        <span class="fw-semibold">Link Type</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 120px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-info bg-opacity-10 text-info">
                                            <i class="bi bi-key"></i>
                                        </span>
                                        <span class="fw-semibold">Keywords</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 120px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-secondary bg-opacity-10 text-secondary">
                                            <i class="bi bi-text-left"></i>
                                        </span>
                                        <span class="fw-semibold">Anchor Text</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 90px;">
                                    <span class="fw-semibold">Status</span>
                                </th>
                                <th class="text-center" style="width: 100px;">
                                    <span class="fw-semibold">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($allArtikel)) : ?>
                                <?php foreach ($allArtikel as $i => $artikel) : ?>
                                    <tr>
                                        <td class="text-center border-end">
                                            <span class="text-muted fw-medium"><?= $i + 1 ?></span>
                                        </td>
                                        <td class="border-end">
                                            <div class="d-flex align-items-center py-2">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar-img d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle" style="width: 40px; height: 40px;">
                                                            <i class="bi bi-file-earmark-text"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 min-width-0">
                                                    <div class="mb-1">
                                                        <span class="text-dark fw-semibold text-truncate d-block" style="max-width: 180px;" title="<?= esc($artikel['judul_artikel']); ?>">
                                                            <?= esc($artikel['judul_artikel']); ?>
                                                        </span>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <?php
                                                        $jenis = strtoupper($artikel['jenis']);
                                                        switch ($jenis) {
                                                            case 'BACKLINK':
                                                                $badgeClass = 'status-badge status-active';
                                                                break;
                                                            case 'ARTIKEL':
                                                                $badgeClass = 'status-badge status-completed';
                                                                break;
                                                            default:
                                                                $badgeClass = 'status-badge status-inactive';
                                                        }
                                                        ?>
                                                        <span class="<?= $badgeClass; ?>">
                                                            <?= $jenis; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center border-end">
                                            <small class="text-muted fw-medium">
                                                <?= date('d M Y', strtotime($artikel['tgl_upload'])) ?>
                                            </small>
                                        </td>
                                        <td class="text-center border-end">
                                            <a href="<?= esc($artikel['link']); ?>" target="_blank" 
                                               class="text-decoration-none text-dark fw-medium text-truncate d-inline-block"
                                               style="max-width: 130px;" title="<?= esc($artikel['link']); ?>">
                                                <?= esc($artikel['link']); ?>
                                            </a>
                                        </td>
                                        <td class="text-center border-end">
                                            <span class="text-truncate d-inline-block" style="max-width: 100px;"
                                                  title="<?= esc($artikel['link_to']); ?>">
                                                <?= esc($artikel['link_to']); ?>
                                            </span>
                                        </td>
                                        <td class="text-center border-end">
                                            <span class="text-truncate d-inline-block" style="max-width: 90px;"
                                                  title="<?= esc($artikel['link_type']); ?>">
                                                <?= esc($artikel['link_type']); ?>
                                            </span>
                                        </td>
                                        <td class="text-center border-end">
                                            <span class="text-truncate d-inline-block" style="max-width: 100px;"
                                                  title="<?= esc($artikel['keywords']); ?>">
                                                <?= esc($artikel['keywords']); ?>
                                            </span>
                                        </td>
                                        <td class="text-center border-end">
                                            <span class="text-truncate d-inline-block" style="max-width: 100px;"
                                                  title="<?= esc($artikel['anchor_text']); ?>">
                                                <?= esc($artikel['anchor_text']); ?>
                                            </span>
                                        </td>
                                        <td class="text-center border-end">
                                            <?php
                                            $indexed = strtoupper($artikel['indexed']);
                                            switch ($indexed) {
                                                case 'SUDAH':
                                                    $statusClass = 'status-badge status-completed';
                                                    break;
                                                case 'BELUM':
                                                    $statusClass = 'status-badge status-inactive';
                                                    break;
                                                default:
                                                    $statusClass = 'status-badge status-inactive';
                                            }
                                            ?>
                                            <span class="<?= $statusClass; ?>">
                                                <?= $indexed; ?>
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
                                                           href="<?= route_to('artikel.edit', $blog['id_email'], $blog['id_blog'], $artikel['id_artikel']) ?>">
                                                            <i class="bi bi-pencil-square text-primary me-2"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center text-danger"
                                                           href="#"
                                                           onclick="konfirmasiHapus('<?= route_to('artikel.hapus', $blog['id_email'], $blog['id_blog'], $artikel['id_artikel']) ?>', '<?= esc($artikel['judul_artikel']) ?>')">
                                                            <i class="bi bi-trash text-danger me-2"></i>
                                                            <span>Hapus</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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
                    <i class="bi bi-exclamation-triangle me-2"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mb-2 fs-6">Apakah Anda yakin ingin menghapus artikel:</p>
                <p class="mb-0 fs-6 fw-bold" id="namaArtikel"></p>
                <p class="text-muted small mt-2 mb-0">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </button>
                <form id="formHapus" method="GET" action="/hapus-data" class="d-inline">
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i> Hapus
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
        var table = $('#artikelTable').DataTable({
            responsive: false,
            pageLength: 10,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Semua"]
            ],
            language: {
                decimal: "",
                emptyTable: "<div class='text-center py-5'><i class='bi bi-info-circle text-info mb-2' style='font-size: 2rem;'></i><br><span class='text-muted'>Belum ada artikel yang ditambahkan</span></div>",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 - 0 dari 0 data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                lengthMenu: "Tampilkan _MENU_ data",
                loadingRecords: "Memuat...",
                processing: "Memproses...",
                search: "Cari:",
                searchPlaceholder: "Ketik untuk mencari...",
                zeroRecords: "<div class='text-center py-4'><i class='bi bi-search text-muted mb-2' style='font-size: 1.5rem;'></i><br><span class='text-muted'>Tidak ada data yang cocok dengan pencarian</span></div>",
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
            }],
            order: [
                [1, 'asc']
            ],
            autoWidth: false,
            stateSave: true,

            initComplete: function() {
                $('.dataTables_length select').addClass('form-select form-select-sm me-2');
                $('.dataTables_filter input').addClass('form-control form-control-sm').attr('placeholder', 'Ketik untuk mencari...');
                $('.dataTables_length').addClass('d-flex align-items-center');
                $('.dataTables_filter').addClass('d-flex align-items-center justify-content-end');
                $('.dataTables_filter label').addClass('d-flex align-items-center mb-0');

                $('#artikelTable_length').appendTo('#custom-length');
                $('#artikelTable_filter').appendTo('#custom-search');

                $('.dataTables_length label').addClass('d-flex align-items-center gap-2 mb-0');
            },

            drawCallback: function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });

        // Penomoran otomatis hanya jika ada data
        table.on('order.dt search.dt draw.dt', function() {
            let i = 1;
            table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell) {
                cell.innerHTML = i++;
            });
        }).draw();
    });

    function konfirmasiHapus(url, namaArtikel) {
        const form = document.getElementById('formHapus');
        const namaArtikelElem = document.getElementById('namaArtikel');
        
        form.action = url;
        namaArtikelElem.textContent = namaArtikel;

        const modal = new bootstrap.Modal(document.getElementById('modalHapus'));
        modal.show();
    }
</script>

<style>
    .icon-circle {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .avatar-wrapper {
        width: 40px;
        height: 40px;
    }

    .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #e9ecef;
    }

    .status-badge {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
        border-radius: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-active {
        background-color: #d4edda;
        color: #155724;
    }

    .status-completed {
        background-color: #cce5ff;
        color: #004085;
    }

    .status-inactive {
        background-color: #f8d7da;
        color: #721c24;
    }

    .action-btn {
        border: 1px solid #dee2e6;
        background: white;
        color: #6c757d;
        transition: all 0.2s ease;
    }

    .action-btn:hover {
        border-color: #0d6efd;
        color: #0d6efd;
        background: #f8f9fa;
    }

    .text-white-70 {
        opacity: 0.9;
    }

    .table th {
        vertical-align: middle;
        border-bottom: 2px solid #dee2e6;
    }

    .table td {
        vertical-align: middle;
    }

    .datatable-wrapper {
        background: white;
        border-radius: 0.375rem;
    }

    /* Custom empty state styling */
    .dataTables_empty {
        padding: 3rem 1rem !important;
    }
</style>

<?= $this->endSection();?>