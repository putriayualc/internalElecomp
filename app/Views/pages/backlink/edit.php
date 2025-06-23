<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<title>Edit Email</title>

<body>
    <div class="container-fluid">
        <div class="form-container shadow rounded">
            <div class="form-header">
                <h2 class="display-7 fw-bolder mb-4 text-dark">
                    Edit Email
                </h2>
            </div>
            
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger" role="alert">
                    <h4>Error</h4>
                    <?php if (is_array(session()->getFlashdata('error'))) : ?>
                        <ul>
                            <?php foreach (session()->getFlashdata('error') as $err) : ?>
                                <li><?= esc($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p><?= session()->getFlashdata('error'); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <form action="<?= route_to('email.update', $email['id_email']) ?>" method="POST" id="emailForm" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                
                <div class="row g-4">
                    <!-- Email -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= old('email', $email['email']) ?>" required>
                            <label for="email">
                                <i class="bi bi-envelope me-2"></i>Email
                            </label>
                            <div class="invalid-feedback">
                                Email harus diisi dengan format yang benar
                            </div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="<?= old('password', $email['password']) ?>" required>
                            <label for="password">
                                <i class="bi bi-lock me-2"></i>Password
                            </label>
                            <div class="invalid-feedback">
                                Password harus diisi
                            </div>
                        </div>
                    </div>

                    <!-- Nama User (hanya untuk admin) -->
                    <?php if (session()->get('role') === 'admin') : ?>
                        <div class="col-12">
                            <div class="form-floating">
                                <select class="form-select" id="id_user" name="id_user" required>
                                    <option value="">-- Pilih User --</option>
                                    <?php foreach ($allUsers as $user) : ?>
                                        <option value="<?= $user['id_user']; ?>" <?= ($user['id_user'] == $email['id_user']) ? 'selected' : ''; ?>>
                                            <?= $user['nama'] ?? $user['username']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="id_user">
                                    <i class="bi bi-person me-2"></i>Nama User
                                </label>
                                <div class="invalid-feedback">
                                    User harus dipilih
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Domain Blog -->
                    <div class="col-12">
                        <div class="border p-3 rounded">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="form-label">
                                    <i class="bi bi-globe me-2"></i>Domain Blog
                                </label>
                            </div>
                            
                            <div id="domain-container">
                                <?php if (isset($blogs) && is_array($blogs) && count($blogs) > 0) : ?>
                                    <?php foreach ($blogs as $index => $domain) : ?>
                                        <div class="row mb-3 domain-entry">
                                            <div class="col-md-9">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="domain_blog[]" value="<?= $domain['domain_blog'] ?>" placeholder="Domain Blog">
                                                    <input type="hidden" name="domain_id[]" value="<?= $domain['id_blog'] ?>">
                                                    <label>
                                                        <i class="bi bi-globe2 me-2"></i>Domain Blog
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 d-flex align-items-end gap-2">
                                                <?php if ($index == 0) : ?>
                                                    <button type="button" class="btn btn-info text-white flex-fill add-domain">
                                                        <i class="bi bi-plus-circle me-2"></i>
                                                        <span>Tambah</span>
                                                    </button>
                                                <?php endif; ?>
                                                <button type="button" class="btn btn-danger text-white flex-fill" data-bs-toggle="modal" data-bs-target="#deleteBlogModal<?= $domain['id_blog'] ?>">
                                                    <i class="bi bi-trash me-2"></i>
                                                    <span>Hapus</span>
                                                </button>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <div class="row mb-3 domain-entry">
                                        <div class="col-md-9">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="domain_blog[]" placeholder="Domain Blog">
                                                <input type="hidden" name="domain_id[]" value="0">
                                                <label>
                                                    <i class="bi bi-globe2 me-2"></i>Domain Blog
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 d-flex align-items-end">
                                            <button type="button" class="btn btn-info text-white w-100 add-domain">
                                                <i class="bi bi-plus-circle me-2"></i>
                                                <span>Tambah</span>
                                            </button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-2"></i>
                                Contoh: coba.blogspot.com
                            </small>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="<?= route_to('backlink') ?>" class="btn btn-secondary btn-lg d-flex align-items-center">
                            <i class="bi bi-arrow-left me-2"></i>
                            <span>Kembali</span>
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg d-flex align-items-center">
                            <i class="bi bi-pencil-square me-2"></i>
                            <span>Update</span>
                        </button>
                    </div>
                </div>
            </form>

            <?php if (!empty(session()->getFlashdata('success'))) : ?>
                <div class="alert alert-success mt-3" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- Delete Blog Modals -->
    <?php if (isset($blogs) && is_array($blogs)) : ?>
        <?php foreach ($blogs as $domain) : ?>
            <div class="modal fade" id="deleteBlogModal<?= $domain['id_blog'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $domain['id_blog'] ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="deleteModalLabel<?= $domain['id_blog'] ?>">
                                <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus Blog
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus blog <strong><?= $domain['domain_blog'] ?></strong>?</p>
                            <p class="text-danger">
                                <small>
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    Semua blog dan artikel terkait akan ikut terhapus!
                                </small>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary d-flex align-items-center" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-2"></i>
                                <span>Batal</span>
                            </button>
                            <a href="<?= route_to('blog.hapus', $domain['id_email'], $domain['id_blog']) ?>" class="btn btn-danger d-flex align-items-center">
                                <i class="bi bi-trash me-2"></i>
                                <span>Hapus</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('emailForm');

            // Form validation
            if (form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            }

            // Email validation
            const emailInput = document.getElementById('email');
            if (emailInput) {
                emailInput.addEventListener('blur', function() {
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (this.value && !emailPattern.test(this.value)) {
                        this.setCustomValidity('Format email tidak valid');
                    } else {
                        this.setCustomValidity('');
                    }
                });
            }

            // Add new domain input
            document.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('add-domain')) {
                    const container = document.getElementById('domain-container');
                    const row = document.createElement('div');
                    row.classList.add('row', 'mb-3', 'domain-entry');
                    row.innerHTML = `
                        <div class="col-md-9">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="domain_blog[]" placeholder="Domain Blog">
                                <input type="hidden" name="domain_id[]" value="0">
                                <label>
                                    <i class="bi bi-globe2 me-2"></i>Domain Blog
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="button" class="btn btn-danger text-white w-100 remove-new-domain">
                                <i class="bi bi-trash me-2"></i>
                                <span>Hapus</span>
                            </button>
                        </div>
                    `;
                    container.appendChild(row);
                }

                // Remove new domain input
                if (e.target && e.target.classList.contains('remove-new-domain')) {
                    e.target.closest('.domain-entry').remove();
                }
            });
        });
    </script>

</body>

<?= $this->endSection(); ?>