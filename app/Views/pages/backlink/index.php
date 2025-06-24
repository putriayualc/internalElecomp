<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid py-3">
    <div class="rounded-3 shadow-sm mb-4"
        style="background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1432888622747-4eb9a8efeb07?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="d-flex justify-content-between align-items-center p-4 text-white">
            <div>
                <h1 class="h1 fw-bold">Backlink</h1>
                <p class="text-white-70 small mb-0">Kelola email dan blog untuk kampanye backlink</p>
            </div>
            <div class="d-flex gap-2">
                <a href="<?= route_to('email.tambah') ?>" class="btn btn-light text-info px-4 py-2 fs-6 d-flex align-items-center gap-2">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span class="d-none d-sm-inline">Tambah Email</span>
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

<?php if (session()->getFlashdata('success') || session()->has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <?= session()->getFlashdata('success') ?: session('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
<?php endif; ?>

<?php if (session()->has('delete_success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-trash me-2"></i><?= session('delete_success') ?>
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
                    <table id="backlinkTable" class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center border-end" style="width: 60px;">
                                    <span class="fw-semibold">No</span>
                                </th>
                                <th class="text-center border-end" style="min-width: 250px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-primary bg-opacity-10 text-primary">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <span class="fw-semibold">Email</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-warning bg-opacity-10 text-warning">
                                            <i class="fas fa-key"></i>
                                        </span>
                                        <span class="fw-semibold">Password</span>
                                    </div>
                                </th>
                                <?php if (session()->get('role') === 'admin') : ?>
                                    <th class="text-center border-end" style="min-width: 150px;">
                                        <div class="d-flex align-items-center justify-content-center gap-2">
                                            <span class="icon-circle bg-info bg-opacity-10 text-info">
                                                <i class="fas fa-user"></i>
                                            </span>
                                            <span class="fw-semibold">User</span>
                                        </div>
                                    </th>
                                <?php endif; ?>
                                <th class="text-center border-end" style="min-width: 250px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-success bg-opacity-10 text-success">
                                            <i class="fas fa-globe"></i>
                                        </span>
                                        <span class="fw-semibold">Blog dan Total Artikel</span>
                                    </div>
                                </th>
                                <!-- <th class="text-center border-end" style="min-width: 120px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-secondary bg-opacity-10 text-secondary">
                                            <i class="fas fa-file-alt"></i>
                                        </span>
                                        <span class="fw-semibold">Total Artikel</span>
                                    </div>
                                </th> -->
                                <th class="text-center" style="width: 200px;">
                                    <span class="fw-semibold">Aksi</span>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($allEmail as $email) : ?>
                                <?php
                                // Ambil semua blog untuk email ini
                                $emailBlogs = [];
                                $totalArtikel = 0;
                                $firstBlogId = null; // Untuk link total artikel
                                if (isset($allBlogs) && !empty($allBlogs)) {
                                    $emailBlogs = array_filter($allBlogs, function ($blog) use ($email) {
                                        return $blog['id_email'] == $email['id_email'];
                                    });
                                    // Hitung total artikel dan ambil ID blog pertama
                                    foreach ($emailBlogs as $blog) {
                                        $totalArtikel += isset($blog['jumlah_artikel']) ? $blog['jumlah_artikel'] : 0;
                                        if ($firstBlogId === null) {
                                            $firstBlogId = $blog['id_blog'];
                                        }
                                    }
                                }
                                ?>
                                <tr>
                                    <td class="text-center border-end">
                                        <span class="text-muted fw-medium"></span>
                                    </td>

                                    <!-- Email Info -->
                                    <td class="border-end">
                                        <div class="d-flex align-items-center py-2">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="position-relative">
                                                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center"
                                                        style="width: 60px; height: 60px;">
                                                        <i class="fas fa-envelope fs-5"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 min-width-0">
                                                <div class="mb-1">
                                                    <span class="text-dark fw-semibold"><?= esc($email['email']) ?></span>
                                                </div>
                                                <div class="text-muted small">
                                                    Email Account
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Password -->
                                    <td class="text-center border-end">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="password-mask me-2">••••••••</span>
                                            <button class="btn btn-sm btn-outline-primary toggle-password" data-password="<?= esc($email['password']) ?>" type="button">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>

                                    <!-- User (jika admin) -->
                                    <?php if (session()->get('role') === 'admin') : ?>
                                        <td class="text-center border-end">
                                            <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">
                                                <i class="fas fa-user me-1"></i>
                                                <?= esc($email['nama_user']) ?>
                                            </span>
                                        </td>
                                    <?php endif; ?>

                                    <!-- Blog List -->
                                    <td class="border-end">
                                        <?php if (!empty($emailBlogs)) : ?>
                                            <div class="blog-list">
                                                <?php foreach ($emailBlogs as $index => $blog) : ?>
                                                    <div class="blog-item <?= $index > 0 ? 'mt-2 pt-2 border-top border-light' : '' ?>">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="flex-grow-1">
                                                                <a href="https://<?= esc($blog['domain_blog']) ?>"
                                                                    target="_blank"
                                                                    class="text-decoration-none text-success fw-medium d-flex align-items-center">
                                                                    <i class="fas fa-external-link-alt me-2"></i>
                                                                    <span class="text-truncate"><?= esc($blog['domain_blog']) ?></span>
                                                                </a>
                                                            </div>
                                                            <div class="ms-2">
                                                                <a href="<?= route_to('artikel', $email['id_email'], $blog['id_blog']) ?>"
                                                                    class="badge bg-secondary bg-opacity-10 text-secondary text-decoration-none hover-badge">
                                                                    <i class="fas fa-file-alt me-1"></i>
                                                                    <?= isset($blog['jumlah_artikel']) ? $blog['jumlah_artikel'] : 0 ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php else : ?>
                                            <div class="py-3 text-muted text-center">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Tidak ada blog
                                            </div>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Total Artikel -->
                                    <!-- <td class="text-center border-end">
                                        <?php if ($totalArtikel > 0 && $firstBlogId !== null) : ?>
                                            <a href="<?= route_to('artikel', $email['id_email'], $firstBlogId) ?>"
                                                class="badge bg-primary bg-opacity-10 text-primary text-decoration-none hover-total-artikel px-3 py-2 fs-6"
                                                title="Klik untuk melihat artikel">
                                                <i class="fas fa-file-alt me-1"></i>
                                                <strong><?= $totalArtikel ?></strong>
                                            </a>
                                        <?php else : ?>
                                            <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 fs-6">
                                                <i class="fas fa-file-alt me-1"></i>
                                                <strong><?= $totalArtikel ?></strong>
                                            </div>
                                        <?php endif; ?>
                                    </td> -->

                                    <!-- Actions -->
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle action-btn"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                                <li>
                                                    <button type="button" class="dropdown-item d-flex align-items-center text-success"
                                                        data-bs-toggle="modal" data-bs-target="#addBlogModal<?= $email['id_email'] ?>">
                                                        <i class="fas fa-plus-circle text-success me-2"></i>
                                                        <span>Tambah Blog</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center text-primary"
                                                        href="<?= route_to('email.edit', $email['id_email']) ?>">
                                                        <i class="fas fa-edit text-primary me-2"></i>
                                                        <span>Edit</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item d-flex align-items-center text-danger"
                                                        data-bs-toggle="modal" data-bs-target="#deleteEmailModal<?= $email['id_email'] ?>">
                                                        <i class="fas fa-trash text-danger me-2"></i>
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

<!-- Modal Konfirmasi Hapus Email -->
<?php foreach ($allEmail as $email) : ?>
    <div class="modal fade" id="deleteEmailModal<?= $email['id_email'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-semibold" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i> Konfirmasi Hapus Email
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="mb-3">
                            <i class="fas fa-exclamation-triangle-fill text-warning" style="font-size: 3rem;"></i>
                        </div>
                        <p class="mb-3 fs-6">Apakah Anda yakin ingin menghapus email:</p>
                        <div class="alert alert-light border">
                            <strong><?= esc($email['email']) ?></strong>
                        </div>
                        <div class="alert alert-warning">
                            <i class="fas fa-info-circle me-2"></i>
                            Semua blog dan data terkait akan ikut terhapus!
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <a href="<?= route_to('email.hapus', $email['id_email']) ?>" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Blog -->
    <div class="modal fade" id="addBlogModal<?= $email['id_email'] ?>" tabindex="-1" aria-labelledby="addBlogModalLabel<?= $email['id_email'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color:rgba(0, 175, 228, 0.99)">
                    <h5 class="modal-title fw-semibold" id="addBlogModalLabel<?= $email['id_email'] ?>">
                        <i class="fas fa-plus-circle me-2"></i> Tambah Blog untuk <?= esc($email['email']) ?>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form action="<?= route_to('blog.simpan', $email['id_email']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div id="blogFieldsContainer">
                            <div class="blog-field mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-globe text-primary me-2"></i>Domain Blog
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                    <input type="text" class="form-control" name="domain_blog" placeholder="contoh: myblog.wordpress.com" required>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Masukkan domain blog tanpa https://
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
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
    .hover-badge {
        transition: all 0.2s ease;
    }

    .hover-badge:hover {
        background-color: rgb(59, 190, 255) !important;
        color: #fff !important;
        transform: translateY(-1px);
    }

    .hover-total-artikel {
        transition: all 0.2s ease;
    }

    .hover-total-artikel:hover {
        background-color: rgb(59, 190, 255) !important;
        color: #fff !important;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .action-btn {
        transition: all 0.2s ease;
    }

    .action-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
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

    .text-white-70 {
        opacity: 0.8;
    }

    .toggle-password {
        transition: all 0.2s ease;
    }

    .toggle-password:hover {
        transform: scale(1.05);
    }

    .password-mask {
        font-family: monospace;
        font-size: 1.1em;
    }

    .blog-list {
        max-height: 200px;
        overflow-y: auto;
    }

    .blog-item {
        padding: 0.25rem 0;
    }

    .blog-item:hover {
        background-color: rgba(0, 123, 255, 0.05);
        border-radius: 0.25rem;
        padding: 0.25rem 0.5rem;
    }

    .text-truncate {
        max-width: 200px;
    }
</style>

<script>
    $(document).ready(function() {
        var isAdmin = <?= session()->get('role') === 'admin' ? 'true' : 'false' ?>;

        var columnDefs = [{
                orderable: false,
                searchable: false,
                targets: 0 // Kolom No
            },
            {
                orderable: false,
                searchable: false,
                targets: -1 // Kolom Aksi
            }
        ];

        // Jika bukan admin, sembunyikan kolom User (index 3)
        if (!isAdmin) {
            columnDefs.push({
                targets: 3,
                visible: false,
                searchable: false
            });
        }

        var table = $('#backlinkTable').DataTable({
            responsive: false,
            pageLength: 10,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Semua"]
            ],
            language: {
                decimal: "",
                emptyTable: "Tidak ada email yang tersedia",
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
            columnDefs: columnDefs,
            order: [
                [1, 'asc'] // Urutkan berdasarkan kolom Email
            ],
            autoWidth: false,
            stateSave: true,
            initComplete: function() {
                $('.dataTables_length select').addClass('form-select form-select-sm me-2');
                $('.dataTables_filter input').addClass('form-control form-control-sm').attr('placeholder', 'Ketik untuk mencari...');
                $('.dataTables_length').addClass('d-flex align-items-center');
                $('.dataTables_filter').addClass('d-flex align-items-center justify-content-end');
                $('.dataTables_filter label').addClass('d-flex align-items-center mb-0');

                $('#backlinkTable_length').appendTo('#custom-length');
                $('#backlinkTable_filter').appendTo('#custom-search');

                $('.dataTables_length label').addClass('d-flex align-items-center gap-2 mb-0');
            },
            drawCallback: function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });

        // Auto numbering
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

    // Toggle password visibility
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-password');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const passwordContainer = this.closest('td').querySelector('.password-mask');
                const icon = this.querySelector('i');
                if (passwordContainer.textContent === '••••••••') {
                    passwordContainer.textContent = this.getAttribute('data-password');
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordContainer.textContent = '••••••••';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    });
</script>

<?= $this->endSection(); ?>