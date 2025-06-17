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
            <form action="<?= base_url('hosting/simpan') ?>" method="post" id="hostingForm">
                <?= csrf_field() ?>
                <div class="row g-4">
                    <!-- Domain Utama -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="domain_utama" name="domain_utama" placeholder="example.com" required>
                            <label for="domain_utama">
                                <i class="bi bi-globe me-2"></i>Domain Utama
                            </label>
                            <div class="invalid-feedback">
                                Domain utama harus diisi
                            </div>
                        </div>
                    </div>

                    <!-- Username Hosting -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="username_hosting" name="username_hosting" placeholder="Username" required>
                            <label for="username_hosting">
                                <i class="bi bi-person me-2"></i>Username Hosting
                            </label>
                            <div class="invalid-feedback">
                                Username hosting harus diisi
                            </div>
                        </div>
                    </div>

                    <!-- Password Hosting -->
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="password_hosting" name="password_hosting" placeholder="Password" required>
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
                                <div class="row mb-3">
                                    <div class="col-md-10">
                                        <div class="form-floating">
                                            <input type="text" name="add_on_domain[]" class="form-control" id="add_on_domain_0" placeholder="example.com">
                                            <label for="add_on_domain_0">Domain Tambahan</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-info text-white w-100" onclick="tambahAddOn()">
                                            Tambah
                                        </button>
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
        });

        let addOnIndex = 1;

        function tambahAddOn() {
            const container = document.getElementById('addon-container');

            const row = document.createElement('div');
            row.classList.add('row', 'mb-3', 'addon-entry');
            row.innerHTML = `
                <div class="col-md-10">
                    <div class="form-floating">
                        <input type="text" name="add_on_domain[]" class="form-control" id="add_on_domain_${addOnIndex}" placeholder="example.com">
                        <label for="add_on_domain_${addOnIndex}">Domain Tambahan</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger text-white w-100" onclick="hapusAddOn(this)">Hapus</button>
                </div>
            `;

            container.appendChild(row);
            addOnIndex++;
        }

        function hapusAddOn(button) {
            const row = button.closest('.addon-entry');
            if (row) {
                row.remove();
            }
        }
    </script>
</body>

<?= $this->endSection(); ?>