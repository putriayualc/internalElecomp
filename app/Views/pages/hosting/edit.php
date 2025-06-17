<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<title>Edit Data Hosting</title>

<body>
    <div class="container-fluid">
        <div class="form-container shadow rounded">
            <div class="form-header">
                <h2 class="display-7 fw-bolder mb-4 text-dark">
                    Edit Hosting
                </h2>
            </div>
            <form method="post" action="<?= base_url('hosting/update/' . $hosting['id_hosting']) ?>" id="editHostingForm">
                <?= csrf_field() ?>
                <div class="row g-4">
                    <!-- Domain Utama -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="domain_utama" name="domain_utama" 
                                   value="<?= esc($hosting['domain_utama']) ?>" placeholder="example.com" required>
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
                            <input type="text" class="form-control" id="username_hosting" name="username_hosting" 
                                   value="<?= esc($hosting['username_hosting']) ?>" placeholder="Username" required>
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
                            <input type="text" class="form-control" id="password_hosting" name="password_hosting" 
                                   value="<?= esc($hosting['password_hosting']) ?>" placeholder="Password" required>
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
                                <?php if (isset($addons) && is_array($addons) && count($addons) > 0): ?>
                                    <?php foreach ($addons as $index => $addon): ?>
                                        <div class="row mb-3 sosmed-entry">
                                            <div class="col-md-10">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="add_on_domain[]" 
                                                           id="add_on_domain_<?= $index ?>" placeholder="example.com"
                                                           value="<?= esc($addon['add_on_domain']) ?>">
                                                    <label for="add_on_domain_<?= $index ?>">Domain Tambahan</label>
                                                </div>
                                                <input type="hidden" name="domains_id[]" value="<?= esc($addon['id_domains']) ?>">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger text-white w-100" 
                                                        data-bs-toggle="modal" data-bs-target="#deleteAddonModal<?= $addon['id_domains'] ?>">
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="row mb-3 sosmed-entry">
                                        <div class="col-md-10">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="add_on_domain[]" 
                                                       id="add_on_domain_0" placeholder="example.com">
                                                <label for="add_on_domain_0">Domain Tambahan</label>
                                            </div>
                                            <input type="hidden" name="domains_id[]" value="0">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-info text-white w-100" onclick="tambahAddOn()">
                                                Tambah
                                            </button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-2"></i>
                                Tambahkan domain-domain tambahan jika ada
                            </small>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="<?= route_to('hosting') ?>" class="btn btn-secondary btn-lg d-flex align-items-center">
                            <span>Kembali</span>
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg d-flex align-items-center">
                            <span>Update</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete Add On Domain -->
    <?php foreach ($addons as $addon): ?>
        <div class="modal fade" id="deleteAddonModal<?= $addon['id_domains'] ?>" tabindex="-1" aria-labelledby="deleteAddonLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteAddonLabel">Konfirmasi Hapus Add-On Domain</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus add-on domain <strong><?= $addon['add_on_domain'] ?></strong>?</p>
                        <p class="text-danger"><small><i class="bi bi-exclamation-triangle me-1"></i> Semua data terkait akan terhapus permanen!</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x me-1"></i> Batal
                        </button>
                        <a href="<?= route_to('domain.hapus', $addon['id_hosting'], $addon['id_domains']) ?>" class="btn btn-danger">
                            <i class="bi bi-trash me-1"></i> Hapus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('editHostingForm');

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

        let addOnIndex = <?= isset($addons) ? count($addons) : 1 ?>;

        function tambahAddOn() {
            const container = document.getElementById('addon-container');

            const row = document.createElement('div');
            row.classList.add('row', 'mb-3', 'sosmed-entry');
            row.innerHTML = `
                <div class="col-md-10">
                    <div class="form-floating">
                        <input type="text" name="add_on_domain[]" class="form-control" 
                               id="add_on_domain_${addOnIndex}" placeholder="example.com">
                        <label for="add_on_domain_${addOnIndex}">Domain Tambahan</label>
                    </div>
                    <input type="hidden" name="domains_id[]" value="0">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger text-white w-100" onclick="hapusAddOn(this)">Hapus</button>
                </div>
            `;

            container.appendChild(row);
            addOnIndex++;
        }

        function hapusAddOn(button) {
            const row = button.closest('.sosmed-entry');
            if (row) {
                row.remove();
            }
        }
    </script>
</body>

<?= $this->endSection(); ?>