<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <h1 class="app-page-title">Edit Hosting</h1>

        <div class="row g-4 settings-section">
            <div class="col-12">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">

                        <form method="post" action="<?= base_url('hosting/update/' . $hosting['id_hosting']) ?>">
                            <?= csrf_field() ?>

                            <div class="mb-3">
                                <label for="hosting" class="form-label">Hosting</label>
                                <input type="text" class="form-control" id="hosting" name="hosting" value="<?= esc($hosting['hosting']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="tgl_exp_hosting" class="form-label">Exp Hosting</label>
                                <input type="date" class="form-control" id="tgl_exp_hosting" name="tgl_exp_hosting" value="<?= esc($hosting['tgl_exp_hosting']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="domain_utama" class="form-label">Domain Utama</label>
                                <input type="text" class="form-control" id="domain_utama" name="domain_utama" value="<?= esc($hosting['domain_utama']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="tgl_exp_domain" class="form-label">Exp Domain Utama</label>
                                <input type="date" class="form-control" id="tgl_exp_domain" name="tgl_exp_domain" value="<?= esc($hosting['tgl_exp_domain']) ?>" required>
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

                            <div class="mb-3">
                                <label class="form-label">Add-On Domain</label>
                                <div id="addon-container">
                                    <?php if (!empty($addons)): ?>
                                        <?php foreach ($addons as $index => $addon): ?>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="add_on_domain[]" value="<?= esc($addon['add_on_domain']) ?>" placeholder="Masukkan add-on domain">
                                                <input type="date" class="form-control" name="tgl_exp_add_domain[]" value="<?= esc($addon['tgl_exp_add_domain']) ?>" placeholder="Masukkan exp add-on domain">
                                                <input type="hidden" name="domains_id[]" value="<?= esc($addon['id_domains']) ?>">
                                                <?php if ($index == 0): ?>
                                                    <button class="btn btn-success add-addon" type="button">+</button>
                                                <?php endif; ?>
                                                <button class="btn btn-danger remove-addon" type="button" data-bs-toggle="modal" data-bs-target="#deleteAddonModal<?= $addon['id_domains'] ?>">-</button>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="add_on_domain[]" placeholder="Masukkan add-on domain">
                                            <input type="date" class="form-control" name="tgl_exp_add_domain[]" placeholder="Masukkan exp add-on domain">
                                            <input type="hidden" name="domains_id[]" value="0">
                                            <button class="btn btn-success add-addon" type="button">+</button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="d-flex justify-content-start gap-2">
                                <a href="<?= route_to('hosting') ?>" class="btn btn-secondary">← Kembali</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>

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

        <?php foreach ($addons as $addon): ?>
            <div class="modal fade" id="deleteAddonModal<?= $addon['id_domains'] ?>" tabindex="-1" aria-labelledby="deleteAddonLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">Konfirmasi Hapus Add-On Domain</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Yakin ingin menghapus add-on domain <strong><?= esc($addon['add_on_domain']) ?></strong>?</p>
                            <p class="text-danger"><small><i class="fas fa-exclamation-triangle me-1"></i> Data akan terhapus permanen!</small></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <a href="<?= route_to('domain.hapus', $addon['id_hosting'], $addon['id_domains']) ?>" class="btn btn-danger">
                                Hapus
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.addEventListener('click', function(e) {
                    if (e.target && e.target.classList.contains('add-addon')) {
                        const container = document.getElementById('addon-container');
                        const newGroup = document.createElement('div');
                        newGroup.className = 'input-group mb-2';
                        newGroup.innerHTML = `
                            <input type="text" class="form-control" name="add_on_domain[]" placeholder="Masukkan add-on domain">
                            <input type="date" class="form-control" name="tgl_exp_add_domain[]" placeholder="Masukkan add-on domain">
                            <input type="hidden" name="domains_id[]" value="0">
                            <button class="btn btn-danger remove-addon" type="button">-</button>
                        `;
                        container.appendChild(newGroup);
                    }

                    if (e.target && e.target.classList.contains('remove-addon') && !e.target.hasAttribute('data-bs-toggle')) {
                        e.target.closest('.input-group').remove();
                    }
                });
            });
        </script>

    </div>
</div>

<?= $this->endSection(); ?>