<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid py-3">
    <div class="rounded-3 shadow-sm mb-4"
        style="background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1611926653458-09294b3142bf?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="d-flex justify-content-between align-items-center p-4 text-white">
            <div>
                <h1 class="h1 fw-bold">Manajemen Sosial Media</h1>
                <p class="text-white-70 small mb-0">Kelola konten sosial media untuk berbagai platform dan bisnis</p>
            </div>

            <div class="d-flex gap-2">
                <a href="<?= route_to('konten.tambah') ?>" class="btn btn-light text-info px-4 py-2 fs-6 d-flex align-items-center gap-2">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span class="d-none d-sm-inline">Tambah Konten</span>
                </a>
            </div>
        </div>
    </div>
</div>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
<?php endif; ?>

<!-- Filter Section -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="row g-3">
            <!-- Filter Bisnis -->
            <div class="col-md-6">
                <label for="filterBisnis" class="form-label fw-semibold">
                    <i class="bi bi-building text-primary me-2"></i>Filter Bisnis
                </label>
                <select id="filterBisnis" class="form-select" onchange="location.href=this.value">
                    <option value="<?= route_to('konten') ?>" <?= empty($id_bisnis) ? 'selected' : '' ?>>-- Semua Bisnis --</option>
                    <?php foreach ($allBisnis as $b) : ?>
                        <option value="<?= route_to('konten.filter', $b['id_bisnis']) ?>" <?= (!empty($id_bisnis) && $id_bisnis == $b['id_bisnis']) ? 'selected' : '' ?>>
                            <?= $b['nama_bisnis']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Filter Platform -->
            <div class="col-md-6">
                <label class="form-label fw-semibold">
                    <i class="bi bi-share text-success me-2"></i>Filter Platform
                </label>
                <div id="platformTags" class="d-flex flex-wrap gap-2">
                    <?php foreach (['instagram' => 'Instagram', 'facebook' => 'Facebook', 'linkedin' => 'LinkedIn', 'tiktok' => 'TikTok'] as $key => $name): ?>
                        <span class="badge fs-6 platform-badge <?= (in_array($key, explode(',', $platformFilter ?? ''))) ? 'bg-primary' : 'bg-secondary' ?>"
                            data-platform="<?= $key ?>" style="cursor:pointer; padding: 8px 12px;">
                            <i class="fab fa-<?= $key ?> me-1"></i><?= $name ?>
                        </span>
                    <?php endforeach; ?>
                    <a href="?<?= $id_bisnis ? 'id_bisnis=' . $id_bisnis : '' ?>" class="badge bg-danger fs-6" style="padding: 8px 12px;">
                        <i class="bi bi-arrow-clockwise me-1"></i>Reset
                    </a>
                </div>
            </div>
        </div>
    </div>
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
                    <table id="kontenTable" class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center border-end" style="width: 60px;">
                                    <span class="fw-semibold">No</span>
                                </th>
                                <th class="text-center border-end" style="min-width: 300px;">
                                    <span class="fw-semibold">Konten</span>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-primary bg-opacity-10 text-primary">
                                            <i class="bi bi-building"></i>
                                        </span>
                                        <span class="fw-semibold">Bisnis</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-success bg-opacity-10 text-success">
                                            <i class="bi bi-share"></i>
                                        </span>
                                        <span class="fw-semibold">Platform</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-warning bg-opacity-10 text-warning">
                                            <i class="bi bi-calendar-event"></i>
                                        </span>
                                        <span class="fw-semibold">Tanggal Upload</span>
                                    </div>
                                </th>
                                <th class="text-center" style="width: 100px;">
                                    <span class="fw-semibold">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($allKonten)): ?>
                                <?php foreach ($allKonten as $i => $k): ?>
                                    <tr>
                                        <td class="text-center border-end">
                                            <span class="text-muted fw-medium"><?= $i + 1 ?></span>
                                        </td>
                                        <td class="border-end">
                                            <div class="d-flex align-items-center py-2">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="position-relative">
                                                        <img src="<?= base_url('assets/sosmed/cover/' . $k['cover']) ?>" 
                                                             alt="cover" 
                                                             class="rounded"
                                                             style="width: 60px; height: 60px; object-fit: cover;">
                                                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-25 rounded d-flex align-items-center justify-content-center opacity-0 hover-overlay">
                                                            <i class="bi bi-eye text-white"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 min-width-0">
                                                    <div class="mb-1">
                                                        <a href="<?= route_to('konten.detail', $k['id_konten']) ?>"
                                                           class="text-decoration-none text-dark fw-semibold user-name-link">
                                                            <?= esc($k['judul']); ?>
                                                        </a>
                                                    </div>
                                                    <div class="text-muted small text-truncate" style="max-width: 250px;">
                                                        <?= (strlen(strip_tags($k['caption'])) > 80)
                                                            ? substr(strip_tags($k['caption']), 0, 80) . '...'
                                                            : strip_tags($k['caption']) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center border-end">
                                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                                <i class="bi bi-building me-1"></i>
                                                <?= esc($k['nama_bisnis']); ?>
                                            </span>
                                        </td>
                                        <td class="text-center border-end">
                                            <div class="d-flex justify-content-center gap-1 flex-wrap">
                                                <?php foreach ($k['platforms'] as $plat): ?>
                                                    <span class="badge bg-<?= getPlatformColor($plat) ?> bg-opacity-10 text-<?= getPlatformColor($plat) ?> px-2 py-1">
                                                        <i class="fab fa-<?= $plat ?> me-1"></i>
                                                        <?= ucfirst($plat) ?>
                                                    </span>
                                                <?php endforeach; ?>
                                            </div>
                                        </td>
                                        <td class="text-center border-end">
                                            <span class="fw-medium"><?= date('d M Y', strtotime($k['tgl_upload'])) ?></span>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle action-btn"
                                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center text-info"
                                                           href="<?= route_to('konten.detail', $k['id_konten']) ?>">
                                                            <i class="bi bi-eye text-info me-2"></i>
                                                            <span>Detail</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center text-primary"
                                                           href="<?= route_to('konten.edit', $k['id_konten']) ?>">
                                                            <i class="bi bi-pencil-square text-primary me-2"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center text-danger"
                                                           href="#"
                                                           onclick="konfirmasiHapus('<?= route_to('konten.delete', $k['id_konten']) ?>', '<?= esc($k['judul']) ?>')">
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
            <div class="modal-body">
                <div class="text-center">
                    <div class="mb-3">
                        <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 3rem;"></i>
                    </div>
                    <p class="mb-3 fs-6">Apakah Anda yakin ingin menghapus konten:</p>
                    <div class="alert alert-light border" id="kontenName"></div>
                    <div class="alert alert-warning">
                        <i class="bi bi-info-circle me-2"></i>
                        Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait.
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </button>
                <form id="formHapus" method="GET" action="" class="d-inline">
                    <?= csrf_field() ?>
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

<style>
.hover-overlay {
    transition: opacity 0.3s ease;
}

.hover-overlay:hover {
    opacity: 1 !important;
}

.user-name-link {
    transition: color 0.2s ease;
}

.user-name-link:hover {
    color: var(--bs-primary) !important;
}

.action-btn {
    transition: all 0.2s ease;
}

.action-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

.platform-badge {
    transition: all 0.2s ease;
}

.platform-badge:hover {
    transform: translateY(-1px);
}

.icon-circle {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.status-badge {
    font-size: 0.75rem;
    font-weight: 600;
    padding: 4px 8px;
    border-radius: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.text-white-70 {
    opacity: 0.8;
}
</style>

<script>
$(document).ready(function() {
    var table = $('#kontenTable').DataTable({
        responsive: false,
        pageLength: 10,
        lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "Semua"]
        ],
        language: {
            decimal: "",
            emptyTable: "Tidak ada konten yang tersedia",
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
        columnDefs: [
            {
                orderable: false,
                searchable: false,
                targets: 0
            },
            {
                orderable: false,
                searchable: false,
                targets: -1 // Last column (Actions)
            }
        ],
        order: [[1, 'asc']],
        autoWidth: false,
        stateSave: true,
        initComplete: function() {
            $('.dataTables_length select').addClass('form-select form-select-sm me-2');
            $('.dataTables_filter input').addClass('form-control form-control-sm').attr('placeholder', 'Ketik untuk mencari...');
            $('.dataTables_length').addClass('d-flex align-items-center');
            $('.dataTables_filter').addClass('d-flex align-items-center justify-content-end');
            $('.dataTables_filter label').addClass('d-flex align-items-center mb-0');

            $('#kontenTable_length').appendTo('#custom-length');
            $('#kontenTable_filter').appendTo('#custom-search');

            $('.dataTables_length label').addClass('d-flex align-items-center gap-2 mb-0');
        },
        drawCallback: function() {
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    });

    // Auto numbering - hanya jika ada data
    table.on('order.dt search.dt draw.dt', function() {
        let i = 1;
        table.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, index) {
            cell.innerHTML = i++;
        });
    }).draw();
});

// Platform filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const badges = document.querySelectorAll('.platform-badge');
    const url = new URL(window.location.href);
    let selected = url.searchParams.get('platform')?.split(',') || [];

    badges.forEach(badge => {
        badge.addEventListener('click', function() {
            const platform = this.getAttribute('data-platform');
            if (!platform) return; // Skip reset button
            
            const index = selected.indexOf(platform);

            if (index > -1) {
                selected.splice(index, 1);
            } else {
                selected.push(platform);
            }

            const params = new URLSearchParams(window.location.search);

            if (selected.length > 0) {
                params.set('platform', selected.join(','));
            } else {
                params.delete('platform');
            }

            if ("<?= $id_bisnis ?>") {
                params.set('id_bisnis', "<?= $id_bisnis ?>");
            }

            window.location.href = `${window.location.pathname}?${params.toString()}`;
        });
    });
});

function konfirmasiHapus(url, namaKonten) {
    const form = document.getElementById('formHapus');
    const kontenName = document.getElementById('kontenName');
    
    form.action = url;
    kontenName.innerHTML = '<strong>' + namaKonten + '</strong>';

    const modal = new bootstrap.Modal(document.getElementById('modalHapus'));
    modal.show();
}
</script>

<?php
// Helper function for platform colors
function getPlatformColor($platform) {
    switch(strtolower($platform)) {
        case 'instagram': return 'danger';
        case 'facebook': return 'primary';
        case 'linkedin': return 'info';
        case 'tiktok': return 'dark';
        default: return 'secondary';
    }
}
?>

<?= $this->endSection(); ?>