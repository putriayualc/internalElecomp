<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<title>Tambah Data Hosting</title>

<body>
    <div class="container-fluid">
        <div class="form-container shadow rounded">
            <div class="form-header">
                <h2 class="display-7 fw-bolder mb-4 text-dark">
                    Tambah Hosting
                </h2>
            </div>
            
            <?php if (session()->has('error')) : ?>
                <div class="alert alert-danger"><?= session('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('hosting/simpan') ?>" method="POST" id="hostingForm">
                <?= csrf_field() ?>
                <div class="row g-4">
                    <!-- Hosting -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="hosting" name="hosting" placeholder="Hosting" required>
                            <label for="hosting">
                                <i class="bi bi-server me-2"></i>Hosting
                            </label>
                            <div class="invalid-feedback">
                                Hosting harus diisi
                            </div>
                        </div>
                    </div>

                    <!-- Exp Hosting -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="tgl_exp_hosting" name="tgl_exp_hosting" required>
                            <label for="tgl_exp_hosting">
                                <i class="bi bi-calendar-x me-2"></i>Exp Hosting
                            </label>
                            <div class="invalid-feedback">
                                Tanggal exp hosting harus dipilih
                            </div>
                        </div>
                    </div>

                    <!-- Domain Utama -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="domain_utama" name="domain_utama" placeholder="Domain Utama" required>
                            <label for="domain_utama">
                                <i class="bi bi-globe me-2"></i>Domain Utama
                            </label>
                            <div class="invalid-feedback">
                                Domain utama harus diisi
                            </div>
                        </div>
                    </div>

                    <!-- Exp Domain -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="tgl_exp_domain" name="tgl_exp_domain" required>
                            <label for="tgl_exp_domain">
                                <i class="bi bi-calendar-x me-2"></i>Exp Domain
                            </label>
                            <div class="invalid-feedback">
                                Tanggal exp domain harus dipilih
                            </div>
                        </div>
                    </div>

                    <!-- Username Hosting -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="username_hosting" name="username_hosting" placeholder="Username Hosting" required>
                            <label for="username_hosting">
                                <i class="bi bi-person me-2"></i>Username Hosting
                            </label>
                            <div class="invalid-feedback">
                                Username hosting harus diisi
                            </div>
                        </div>
                    </div>

                    <!-- Password Hosting -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="password_hosting" name="password_hosting" placeholder="Password Hosting" required>
                            <label for="password_hosting">
                                <i class="bi bi-lock me-2"></i>Password Hosting
                            </label>
                            <div class="invalid-feedback">
                                Password hosting harus diisi
                            </div>
                        </div>
                    </div>

                    <!-- Add On Domain -->
                    <div class="col-12">
                        <div class="border p-3 rounded">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="form-label">
                                    <i class="bi bi-plus-circle me-2"></i>Add On Domain
                                </label>
                            </div>
                            
                            <div id="addon-container">
                                <div class="row mb-3 addon-entry">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="add_on_domain[0]" placeholder="Add On Domain">
                                            <label><i class="bi bi-globe2 me-2"></i>Add On Domain</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row mb-3 align-items-end">
                                            <!-- Exp Add On Domain -->
                                            <div class="col-md-9">
                                                <div class="form-floating">
                                                    <input type="date" class="form-control" name="tgl_exp_add_domain[0]" placeholder="Exp Add On Domain">
                                                    <label><i class="bi bi-calendar-x me-2"></i>Exp Add On Domain</label>
                                                </div>
                                            </div>

                                            <!-- Tombol Tambah -->
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-info text-white w-100" onclick="tambahAddon()">
                                                    Tambah
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-2"></i>
                                Tambahkan domain-domain tambahan jika ada
                            </small>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="<?= route_to('hosting.index') ?>" class="btn btn-secondary btn-lg d-flex align-items-center">
                            <span>Kembali</span>
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg d-flex align-items-center">
                            <span>Simpan</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('hostingForm');

            // Pastikan form ada
            if (form) {
                // Form validation
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            }

            // Date validation
            const tglExpHosting = document.getElementById('tgl_exp_hosting');
            const tglExpDomain = document.getElementById('tgl_exp_domain');

            if (tglExpHosting) {
                tglExpHosting.addEventListener('change', function() {
                    const today = new Date().toISOString().split('T')[0];
                    if (new Date(tglExpHosting.value) <= new Date(today)) {
                        tglExpHosting.setCustomValidity('Tanggal exp hosting harus setelah hari ini');
                    } else {
                        tglExpHosting.setCustomValidity('');
                    }
                });
            }

            if (tglExpDomain) {
                tglExpDomain.addEventListener('change', function() {
                    const today = new Date().toISOString().split('T')[0];
                    if (new Date(tglExpDomain.value) <= new Date(today)) {
                        tglExpDomain.setCustomValidity('Tanggal exp domain harus setelah hari ini');
                    } else {
                        tglExpDomain.setCustomValidity('');
                    }
                });
            }
        });
    </script>

    <script>
        let addonIndex = 1;

        function tambahAddon() {
            const container = document.getElementById('addon-container');

            const row = document.createElement('div');
            row.classList.add('row', 'mb-3', 'addon-entry');
            row.innerHTML = `
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="add_on_domain[${addonIndex}]" placeholder="Add On Domain">
                        <label><i class="bi bi-globe2 me-2"></i>Add On Domain</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row mb-3 align-items-end">
                        <div class="col-md-9">
                            <div class="form-floating">
                                <input type="date" class="form-control" name="tgl_exp_add_domain[${addonIndex}]" placeholder="Exp Add On Domain">
                                <label><i class="bi bi-calendar-x me-2"></i>Exp Add On Domain</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-danger text-white w-100" onclick="hapusAddon(this)">Hapus</button>
                        </div>
                    </div>
                </div>
            `;

            container.appendChild(row);
            addonIndex++;
        }

        function hapusAddon(button) {
            const row = button.closest('.addon-entry');
            if (row) {
                row.remove();
            }
        }
    </script>

</body>

<?= $this->endSection(); ?>