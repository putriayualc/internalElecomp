<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<!-- Include Bootstrap Icons & CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<div class="container my-4">
    <!-- Header with title -->
    <h1 class="display-5 fw-bold mb-4">Data Siswa Magang</h1>

    <!-- Action buttons and search -->
    <div class="row g-3 mb-4 align-items-center">
        <div class="col-md-auto">
            <button class="btn btn-primary px-4 py-2 d-flex align-items-center gap-2">
                <i class="bi bi-plus"></i> Tambah Siswa
            </button>
        </div>
        <div class="col-md-auto">
            <button class="btn btn-outline-secondary d-flex align-items-center gap-2">
                <i class="bi bi-download"></i> Export
            </button>
        </div>
        <div class="col-md-4 ms-md-auto">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0 ps-0" placeholder="Search by name">
            </div>
        </div>
        <!-- <div class="col-md-3">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-calendar text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0 ps-0" placeholder="Mar 1, 2022" readonly>
            </div>
        </div> -->
        <!-- <div class="col-md-auto">
            <button class="btn btn-outline-secondary">
                <i class="bi bi-funnel"></i>
            </button>
        </div> -->
    </div>

    <!-- Table section -->
    <div class="table-responsive shadow rounded">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr class="border-bottom">
                    <th width="40" class="text-center border-end">
                        <div class="form-check d-flex justify-content-center m-0">
                            <input class="form-check-input" type="checkbox" id="checkAll">
                        </div>
                    </th>
                    <th class="text-center border-end">Nama</th>
                    <th class="text-center border-end">
                        <span class="icon-circle bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-building"></i>
                        </span>
                        Asal Instansi
                    </th>
                    <th class="text-center border-end">
                        <span class="icon-circle bg-success bg-opacity-10 text-success">
                            <i class="bi bi-telephone-fill"></i>
                        </span>
                        Telepon
                    </th>
                    <th class="text-center border-end">
                        <span class="icon-circle bg-danger bg-opacity-10 text-danger">
                            <i class="bi bi-envelope"></i>
                        </span>
                        Email
                    </th>
                    <th class="text-center border-end">
                        <span class="icon-circle bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-geo-alt-fill"></i>
                        </span>
                        Alamat
                    </th>
                    <th class="text-center border-end">
                        <span class="icon-circle bg-info bg-opacity-10 text-info">
                            <i class="bi bi-info-circle"></i>
                        </span>
                        Keterangan
                    </th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allSiswa as $siswa): ?>
                    <tr class="border-bottom">
                        <td class="text-center border-end">
                            <div class="form-check d-flex justify-content-center m-0">
                                <input class="form-check-input" type="checkbox">
                            </div>
                        </td>
                        <td class="border-end">
                            <div class="d-flex align-items-center py-2">
                                <div class="flex-shrink-0">
                                    <img src="<?= base_url('/assets/img/user/' . ($siswa['foto'] ?? 'default.jpg')); ?>"
                                        alt="Avatar" class="rounded-circle" width="50" height="50"
                                        style="object-fit: cover;">
                                </div>
                                <div class="ms-3">
                                    <div class="fw-semibold text-dark"><?= esc($siswa['nama']); ?></div>
                                    <div class="d-flex align-items-center mt-1">
                                        <small class="text-secondary me-2"><?= esc($siswa['jurusan']); ?></small>
                                        <?php
                                        $status = strtoupper($siswa['status']);
                                        switch ($status) {
                                            case 'AKTIF':
                                                $badgeClass = 'bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25';
                                                break;
                                            case 'SELESAI':
                                                $badgeClass = 'bg-success bg-opacity-10 text-success border border-success border-opacity-25';
                                                break;
                                            default:
                                                $badgeClass = 'bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25';
                                        }
                                        ?>
                                        <span class="badge <?= $badgeClass; ?> rounded-pill px-2 py-1">
                                            <small><?= $status; ?></small>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center border-end"><?= esc($siswa['asal_instansi']); ?></td>
                        <td class="text-center border-end"><?= esc($siswa['no_telepon']); ?></td>
                        <td class="text-center border-end"><?= esc($siswa['email']); ?></td>
                        <td class="text-center border-end"><?= esc($siswa['alamat']); ?></td>
                        <td class="text-center border-end"><?= esc($siswa['keterangan']); ?></td>
                        <td class="text-center">
                            <div class="action-dropdown">
                                <div class="action-btn-container">
                                    <button class="btn btn-sm action-btn" type="button">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <div class="action-menu shadow">
                                        <a class="action-item d-flex align-items-center" href="<?= base_url('siswa/edit/' . $siswa['id_siswa']); ?>">
                                            <i class="bi bi-pencil-square text-primary me-2"></i> Edit
                                        </a>
                                        <a class="action-item d-flex align-items-center text-danger" href="#"
                                            onclick="confirmDelete(<?= $siswa['id_siswa']; ?>)">
                                            <i class="bi bi-trash text-danger me-2"></i> Hapus
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($allSiswa)): ?>
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                            <i class="bi bi-emoji-frown fs-4 d-block mb-2"></i>
                            Belum ada data siswa
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data siswa ini?</p>
                <p class="text-danger mb-0"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" action="" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<nav aria-label="Page navigation" class="page-navigation">
    <div class="page-item">
        <a class="page-link" href="#" aria-label="Previous">
            <i class="bi bi-chevron-left"></i>
        </a>
    </div>
    <div class="page-item">
        <a class="page-link" href="#">1</a>
    </div>
    <div class="page-item">
        <a class="page-link active" href="#">2</a>
    </div>
    <div class="page-item">
        <a class="page-link" href="#">3</a>
    </div>
    <div class="page-item">
        <span class="page-text">dari 10 Halaman</span>
    </div>
    <div class="page-item">
        <a class="page-link" href="#" aria-label="Next">
            <i class="bi bi-chevron-right"></i>
        </a>
    </div>
</nav>

<style>
    .icon-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        margin-right: 8px;
    }

    /* Custom styles */
    .breadcrumb-item+.breadcrumb-item::before {
        content: ">";
        font-weight: 400;
    }

    .breadcrumb {
        margin-bottom: 1rem;
    }

    .display-5 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #212529;
    }

    .table-responsive {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        font-weight: 600;
        color: #495057;
        vertical-align: middle;
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        padding-top: 15px;
        padding-bottom: 15px;
    }

    .table tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.03);
    }

    .table th .icon-circle {
        display: inline-flex;
        margin-bottom: 5px;
        margin-top: 5px;
    }

    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    /* New Action dropdown styles with hover */
    .action-dropdown {
        position: relative;
    }

    .action-btn-container {
        position: relative;
    }

    .action-btn {
        color: #6c757d;
        background: transparent;
        border: none;
        padding: 0.25rem 0.5rem;
        transition: all 0.2s;
    }

    .action-btn:hover {
        color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.1);
        border-radius: 4px;
    }

    .action-menu {
        position: absolute;
        right: 0;
        top: 100%;
        background: white;
        border-radius: 0.375rem;
        min-width: 10rem;
        padding: 0.5rem 0;
        z-index: 1000;
        display: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .action-item {
        display: block;
        padding: 0.5rem 1rem;
        text-decoration: none;
        color: #212529;
        font-size: 0.9rem;
    }

    .action-item:hover {
        background-color: rgba(13, 110, 253, 0.1);
    }

    .action-item.text-danger:hover {
        background-color: rgba(220, 53, 69, 0.1);
    }

    /* Show dropdown on hover */
    .action-btn-container:hover .action-menu {
        display: block;
    }

    /* Add a small delay so it doesn't disappear immediately */
    .action-menu {
        transition: visibility 0.1s, opacity 0.1s;
        visibility: hidden;
        opacity: 0;
    }

    .action-btn-container:hover .action-menu {
        visibility: visible;
        opacity: 1;
    }

    /* Add extra area for easier hover */
    .action-menu:after {
        content: '';
        position: absolute;
        top: -10px;
        left: 0;
        right: 0;
        height: 10px;
    }

    /* Modern Page Navigation Styles */
    .page-navigation {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 2rem;
        margin-bottom: 2rem;
    }

    .page-navigation .page-item {
        display: flex;
        align-items: center;
        margin: 0 0.5rem;
    }

    .page-navigation .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 8px;
        text-decoration: none;
        color: #6c757d;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }

    .page-navigation .page-link:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
        border-color: #0d6efd;
    }

    .page-navigation .page-link.active {
        background-color: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }

    .page-navigation .page-link.disabled {
        color: #dee2e6;
        pointer-events: none;
    }

    .page-navigation .page-text {
        margin: 0 1rem;
        color: #6c757d;
        font-size: 0.9rem;
    }
</style>

<script>
    // Function to handle delete confirmation
    function confirmDelete(id) {
        // Set the form action
        document.getElementById('deleteForm').action = '<?= base_url('siswa/delete/'); ?>' + id;

        // Show the modal
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

    // Initialize Bootstrap components (if needed)
    document.addEventListener('DOMContentLoaded', function() {
        // Check all checkboxes
        document.getElementById('checkAll').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('tbody .form-check-input');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = this.checked;
            }, this);
        });
    });
</script>

<?= $this->endSection(); ?>
