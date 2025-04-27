<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <!-- Judul dan Tombol Tambah -->
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Backlink</h1>
            </div>
            <div class="col-auto">
                <div class="d-flex gap-2">
                    <a href="<?= route_to('email.tambah') ?>" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Email
                    </a>
                </div>
            </div>
        </div>

        <!-- Notifikasi -->
        <?php if (session()->has('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i><?= session('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Tabel -->
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Daftar Email dan Blog</h4>
                    </div>
                    <!-- <div class="col-auto">
                        <div class="card-header-action">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari email atau blog..." id="searchData">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell" width="5%">No</th>
                                <th class="cell" width="20%">Email</th>
                                <th class="cell" width="15%">Password</th>
                                <th class="cell" width="20%">Blog</th>
                                <th class="cell" width="10%">Jumlah Artikel</th>
                                <th class="cell" width="25%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $counter = 1; ?>
                            <?php foreach ($allEmail as $email) : ?>
                                <?php
                                $emailHasBlogs = false;
                                if (isset($allBlogs) && !empty($allBlogs)) {
                                    $emailBlogs = array_filter($allBlogs, function ($blog) use ($email) {
                                        return $blog['id_email'] == $email['id_email'];
                                    });
                                    $emailHasBlogs = !empty($emailBlogs);
                                }
                                ?>

                                <?php if ($emailHasBlogs) : ?>
                                    <?php
                                    $rowCount = 0;
                                    foreach ($emailBlogs as $blog) {
                                        $rowCount++;
                                    }
                                    ?>
                                    <?php $blogIndex = 0; ?>
                                    <?php foreach ($emailBlogs as $blog) : ?>
                                        <tr>
                                            <td class="cell"><?= $counter++ ?></td>
                                            <?php if ($blogIndex === 0) : ?>
                                                <td class="cell fw-bold" style="vertical-align: top;" <?= $rowCount > 1 ? 'rowspan="' . $rowCount . '"' : '' ?>><?= $email['email'] ?></td>
                                                <td class="cell" style="vertical-align: top;" <?= $rowCount > 1 ? 'rowspan="' . $rowCount . '"' : '' ?>>
                                                    <div class="d-flex align-items-center">
                                                        <span class="password-mask">••••••••</span>
                                                        <button class="btn btn-sm btn-outline-primary ms-2 toggle-password" data-password="<?= $email['password'] ?>" type="button">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            <?php endif; ?>
                                            <td class="cell fw-bold">
                                                <a href="https://<?= $blog['domain_blog'] ?>" target="_blank" class="text-decoration-none text-secondary">
                                                    <?= $blog['domain_blog'] ?>
                                                    <i class="fa-solid fa-arrow-up-right-from-square ms-1"></i>
                                                </a>
                                            </td>
                                            <td class="cell">
                                                <div class="d-flex flex-column">
                                                    <span class="badge bg-info text-dark">
                                                        <?= isset($blog['jumlah_artikel']) ? $blog['jumlah_artikel'] : 0 ?>
                                                    </span>

                                                    <a href="<?= route_to('artikel', $email['id_email'], $blog['id_blog']) ?>" class="mt-1 small text-secondary">
                                                        Lihat artikel
                                                    </a>

                                                </div>
                                            </td>
                                            <?php if ($blogIndex === 0) : ?>
                                                <td class="cell" <?= $rowCount > 1 ? 'rowspan="' . $rowCount . '"' : '' ?> style="vertical-align: top;">
                                                    <div class="d-flex gap-1">
                                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addBlogModal<?= $email['id_email'] ?>">
                                                            <i class="fas fa-plus-circle me-1"></i> Tambah Blog
                                                        </button>
                                                        <a href="<?= route_to('email.edit', $email['id_email']) ?>" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit me-1"></i> Edit
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteEmailModal<?= $email['id_email'] ?>">
                                                            <i class="fas fa-trash me-1"></i> Hapus
                                                        </button>
                                                    </div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                        <?php $blogIndex++; ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td class="cell"><?= $counter++ ?></td>
                                        <td class="cell fw-bold"><?= $email['email'] ?></td>
                                        <td class="cell">
                                            <div class="d-flex align-items-center">
                                                <span class="password-mask">••••••••</span>
                                                <button class="btn btn-sm btn-outline-primary ms-2 toggle-password" data-password="<?= $email['password'] ?>" type="button">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="cell text-muted" colspan="2">Tidak ada blog</td>
                                        <td class="cell">
                                            <div class="d-flex gap-1">
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addBlogModal<?= $email['id_email'] ?>">
                                                    <i class="fas fa-plus-circle me-1"></i> Tambah Blog
                                                </button>
                                                <a href="<?= route_to('email.edit', $email['id_email']) ?>" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit me-1"></i> Edit
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteEmailModal<?= $email['id_email'] ?>">
                                                    <i class="fas fa-trash me-1"></i> Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <?php if (empty($allEmail)) : ?>
                                <tr>
                                    <td colspan="6" class="text-center py-3">Tidak ada data yang tersedia</td>
                                </tr>
                            <?php endif; ?>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus email <strong><?= $email['email'] ?></strong>?</p>
                    <p class="text-danger"><small><i class="fas fa-exclamation-triangle me-1"></i> Semua blog dan data terkait akan ikut terhapus!</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
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
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-prmary">
                    <h5 class="modal-title" id="addBlogModalLabel<?= $email['id_email'] ?>">Tambah Blog untuk <?= $email['email'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="<?= route_to('blog.simpan', $email['id_email']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div id="blogFieldsContainer">
                            <div class="blog-field mb-3">
                                <label class="form-label">Domain Blog <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                    <input type="text" class="form-control" name="domain_blog" placeholder="contoh: myblog.wordpress.com" required>
                                    <!-- <button type="button" class="btn btn-danger btn-remove-field d-none"><i class="fas fa-trash-alt"></i></button> -->
                                </div>
                            </div>
                        </div>

                        <!-- <button type="button" class="btn btn-outline-primary btn-sm" id="addFieldBtn<?= $email['id_email'] ?>">
                            <i class="fas fa-plus me-1"></i> Tambah Domain Blog
                        </button> -->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Script untuk Toggle Password -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log("Script aktif!");
        // Toggle password visibility
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

        // Filter functionality
        document.getElementById('searchData').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('tbody tr');

            tableRows.forEach(row => {
                const email = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
                const blog = row.querySelector('td:nth-child(4)')?.textContent.toLowerCase() || '';

                if (email.includes(searchValue) || blog.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

    });
</script>

<?= $this->endSection('content') ?>