<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<title>Tambah Data Email</title>

<body>
    <div class="container-fluid">
        <div class="form-container shadow rounded">
            <div class="form-header">
                <h2 class="display-7 fw-bolder mb-4 text-dark">
                    Tambah Email
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

            <form action="<?= route_to('email.simpan') ?>" method="POST" id="emailForm" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                
                <div class="row g-4">
                    <!-- Email -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= old('email') ?>" required>
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
                            <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="<?= old('password') ?>" required>
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
                                        <option value="<?= $user['id_user']; ?>" <?= old('id_user') == $user['id_user'] ? 'selected' : '' ?>>
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
                                <div class="row mb-3 domain-entry">
                                    <div class="col-md-9">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="domain_blog[0]" placeholder="Domain Blog">
                                            <label>
                                                <i class="bi bi-globe2 me-2"></i>Domain Blog
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Tombol Tambah -->
                                    <div class="col-md-3 d-flex align-items-end">
                                        <button type="button" class="btn btn-info text-white w-100" onclick="tambahDomain()">
                                            <i class="bi bi-plus-circle me-2"></i>
                                            <span>Tambah</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-2"></i>
                                Contoh: coba.blogspot.com
                            </small>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="<?= route_to('email.index') ?>" class="btn btn-secondary btn-lg d-flex align-items-center">
                            <i class="bi bi-arrow-left me-2"></i>
                            <span>Kembali</span>
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg d-flex align-items-center">
                            <i class="bi bi-save me-2"></i>
                            <span>Simpan</span>
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
        });

        let domainIndex = 1;

        function tambahDomain() {
            const container = document.getElementById('domain-container');

            const row = document.createElement('div');
            row.classList.add('row', 'mb-3', 'domain-entry');
            row.innerHTML = `
                <div class="col-md-9">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="domain_blog[${domainIndex}]" placeholder="Domain Blog">
                        <label>
                            <i class="bi bi-globe2 me-2"></i>Domain Blog
                        </label>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="button" class="btn btn-danger text-white w-100" onclick="hapusDomain(this)">
                        <i class="bi bi-trash me-2"></i>
                        <span>Hapus</span>
                    </button>
                </div>
            `;

            container.appendChild(row);
            domainIndex++;
        }

        function hapusDomain(button) {
            const row = button.closest('.domain-entry');
            if (row) {
                row.remove();
            }
        }
    </script>

</body>

<?= $this->endSection(); ?>