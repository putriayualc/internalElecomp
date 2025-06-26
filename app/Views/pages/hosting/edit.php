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
            <form action="<?= base_url('hosting/update/' . $hosting['id_hosting']) ?>" method="POST">
                <?= csrf_field() ?>
                <div class="row g-4">

                    <!-- Hosting -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="hosting" name="hosting" value="<?= esc($hosting['hosting']) ?>" placeholder="Hosting" required>
                            <label for="hosting">
                                <i class="bi bi-server me-2"></i>Hosting
                            </label>
                            <div class="invalid-feedback">
                                Hosting harus diisi
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal Expired Hosting -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="tgl_exp_hosting" name="tgl_exp_hosting" value="<?= esc($hosting['tgl_exp_hosting']) ?>" required>
                            <label for="tgl_exp_hosting">
                                <i class="bi bi-calendar-x me-2"></i>Exp Hosting
                            </label>
                            <div class="invalid-feedback">
                                Tanggal expired hosting harus dipilih
                            </div>
                        </div>
                    </div>

                    <!-- Domain Utama -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="domain_utama" name="domain_utama" value="<?= esc($hosting['domain_utama']) ?>" placeholder="Domain Utama" required>
                            <label for="domain_utama">
                                <i class="bi bi-globe me-2"></i>Domain Utama
                            </label>
                            <div class="invalid-feedback">
                                Domain utama harus diisi
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal Expired Domain -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="tgl_exp_domain" name="tgl_exp_domain" value="<?= esc($hosting['tgl_exp_domain']) ?>" required>
                            <label for="tgl_exp_domain">
                                <i class="bi bi-calendar-x me-2"></i>Exp Domain Utama
                            </label>
                            <div class="invalid-feedback">
                                Tanggal expired domain harus dipilih
                            </div>
                        </div>
                    </div>

                     <!-- Username Hosting -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="username_hosting" name="username_hosting" value="<?= esc($hosting['username_hosting']) ?>"  placeholder="Username Hosting" required>
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
                            <input type="text" class="form-control" id="password_hosting" name="password_hosting" value="<?= esc($hosting['password_hosting']) ?>" placeholder="Password Hosting" required>
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
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <label class="form-label fw-bold">
                                    <i class="bi bi-plus-circle me-2"></i>Add On Domain
                                </label>
                            </div>

                            <div id="addon-container">
                                <?php if (!empty($addons)): ?>
                                    <?php foreach ($addons as $index => $addon): ?>
                                        <div class="row mb-3 addon-row align-items-end">
                                            <!-- Add-On Domain -->
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input type="text" class="form-control" name="add_on_domain[]" value="<?= esc($addon['add_on_domain']) ?>" placeholder="Add-On Domain" required>
                                                    <label><i class="bi bi-globe2 me-2"></i>Add-On Domain</label>
                                                </div>
                                            </div>

                                            <!-- Expired Date -->
                                            <div class="col-md-5">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input type="date" class="form-control" name="tgl_exp_add_domain[]" value="<?= esc($addon['tgl_exp_add_domain']) ?>" required>
                                                    <label><i class="bi bi-calendar-check me-2"></i>Exp Add-On</label>
                                                </div>
                                            </div>

                                            <!-- Hidden ID -->
                                            <input type="hidden" name="domains_id[]" value="<?= esc($addon['id_domains']) ?>">

                                            <!-- Tombol Tambah/Hapus -->
                                            <div class="col-md-3 d-flex gap-2">
                                                <?php if ($index === array_key_last($addons)): ?>
                                                    <button type="button" class="btn btn-info text-white w-50 py-2 add-addon">Tambah</button>
                                                    <button type="button" class="btn btn-danger w-50 py-2" data-bs-toggle="modal" data-bs-target="#deleteAddonModal<?= $addon['id_domains'] ?>">Hapus</button>
                                                <?php else: ?>
                                                    <button type="button" class="btn btn-danger w-100 py-2" data-bs-toggle="modal" data-bs-target="#deleteAddonModal<?= $addon['id_domains'] ?>">Hapus</button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <!-- Default empty row -->
                                    <div class="row mb-3 addon-row align-items-end">
                                        <!-- Add-On Domain -->
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input type="text" class="form-control" name="add_on_domain[]" placeholder="Add-On Domain">
                                                <label><i class="bi bi-globe2 me-2"></i>Add-On Domain</label>
                                            </div>
                                        </div>

                                        <!-- Expired Date -->
                                        <div class="col-md-5">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input type="date" class="form-control" name="tgl_exp_add_domain[]">
                                                <label><i class="bi bi-calendar-check me-2"></i>Exp Add-On</label>
                                            </div>
                                        </div>

                                        <!-- Hidden ID -->
                                        <input type="hidden" name="domains_id[]" value="0">

                                        <!-- Tombol Tambah -->
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-info text-white w-100 py-2 add-addon">Tambah</button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-2"></i>
                                Tambahkan domain tambahan yang terhubung dengan hosting ini
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

    <!-- Delete Modals -->
    <?php if (!empty($addons)): ?>
        <?php foreach ($addons as $addon): ?>
            <div class="modal fade" id="deleteAddonModal<?= $addon['id_domains'] ?>" tabindex="-1" aria-labelledby="deleteAddonLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">
                                <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus Add-On Domain
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Yakin ingin menghapus add-on domain <strong><?= esc($addon['add_on_domain']) ?></strong>?</p>
                            <p class="text-danger">
                                <small><i class="bi bi-exclamation-triangle me-1"></i> Data akan terhapus permanen!</small>
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <a href="<?= route_to('domain.hapus', $addon['id_hosting'], $addon['id_domains']) ?>" class="btn btn-danger">
                                <i class="bi bi-trash me-2"></i>Hapus
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            let addonIndex = <?= isset($addons) && is_array($addons) ? count($addons) : 1 ?>;

            // Form validation
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);

            // Date validation
            const tglExpHosting = document.getElementById('tgl_exp_hosting');
            const tglExpDomain = document.getElementById('tgl_exp_domain');

            tglExpHosting.addEventListener('change', function() {
                if (new Date(tglExpHosting.value) <= new Date()) {
                    tglExpHosting.setCustomValidity('Tanggal expired hosting harus setelah hari ini');
                } else {
                    tglExpHosting.setCustomValidity('');
                }
            });

            tglExpDomain.addEventListener('change', function() {
                if (new Date(tglExpDomain.value) <= new Date()) {
                    tglExpDomain.setCustomValidity('Tanggal expired domain harus setelah hari ini');
                } else {
                    tglExpDomain.setCustomValidity('');
                }
            });

            // Add-on domain functionality
            function tambahAddon() {
                const container = document.getElementById('addon-container');
                
                // Ubah baris terakhir: hanya tombol Hapus
                const lastRow = container.querySelector('.addon-row:last-child');
                if (lastRow) {
                    const btnWrapper = lastRow.querySelector('.col-md-3');
                    btnWrapper.innerHTML = `
                        <button type="button" class="btn btn-danger w-100 py-2 remove-addon">Hapus</button>
                    `;
                }

                const row = document.createElement('div');
                row.classList.add('row', 'mb-3', 'addon-row', 'align-items-end');
                row.innerHTML = `
                    <div class="col-md-4">
                        <div class="form-floating mb-3 mb-md-0">
                            <input type="text" class="form-control" name="add_on_domain[]" placeholder="Add-On Domain">
                            <label><i class="bi bi-globe2 me-2"></i>Add-On Domain</label>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-floating mb-3 mb-md-0">
                            <input type="date" class="form-control" name="tgl_exp_add_domain[]">
                            <label><i class="bi bi-calendar-check me-2"></i>Exp Add-On</label>
                        </div>
                    </div>

                    <input type="hidden" name="domains_id[]" value="0">

                    <div class="col-md-3 d-flex gap-2">
                        <button type="button" class="btn btn-info text-white w-50 py-2 add-addon">Tambah</button>
                        <button type="button" class="btn btn-danger w-50 py-2 remove-addon">Hapus</button>
                    </div>
                `;

                container.appendChild(row);
                addonIndex++;
            }

            function hapusAddon(button) {
                const row = button.closest('.addon-row');
                if (!row) return;

                const container = document.getElementById('addon-container');
                const allRows = container.querySelectorAll('.addon-row');

                if (allRows.length === 1) return; // Jangan hapus jika hanya 1

                row.remove();

                // Pastikan baris terakhir punya tombol tambah
                const lastRow = container.querySelector('.addon-row:last-child');
                if (lastRow) {
                    const btnWrapper = lastRow.querySelector('.col-md-3');
                    btnWrapper.innerHTML = `
                        <button type="button" class="btn btn-info text-white w-50 py-2 add-addon">Tambah</button>
                        <button type="button" class="btn btn-danger w-50 py-2 remove-addon">Hapus</button>
                    `;
                }
            }

            // Event delegation for dynamic buttons
            document.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('add-addon')) {
                    tambahAddon();
                }

                if (e.target && e.target.classList.contains('remove-addon') && !e.target.hasAttribute('data-bs-toggle')) {
                    hapusAddon(e.target);
                }
            });
        });
    </script>

<?= $this->endSection();?>
