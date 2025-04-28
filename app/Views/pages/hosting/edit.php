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
                                <label for="domain_utama" class="form-label">Domain Utama</label>
                                <input type="text" class="form-control" id="domain_utama" name="domain_utama" value="<?= esc($hosting['domain_utama']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="username_hosting" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username_hosting" name="username_hosting" value="<?= esc($hosting['username_hosting']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="password_hosting" class="form-label">Password</label>
                                <input type="text" class="form-control" id="password_hosting" name="password_hosting" value="<?= esc($hosting['password_hosting']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Add-On Domain</label>
                                <div id="addon-container">
                                    <?php if (isset($add_ons) && is_array($add_ons) && count($add_ons) > 0): ?>
                                        <?php foreach ($add_ons as $addon): ?>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="add_on_domain[]" value="<?= $addon['add_on_domain'] ?>" placeholder="Masukkan add-on domain">
                                                <input type="hidden" name="domains_id[]" value="<?= $addon['id_domains'] ?>">
                                                <button class="btn btn-success add-addon" type="button">+</button>
                                                <button class="btn btn-danger remove-addon" type="button" data-bs-toggle="modal" data-bs-target="#deleteAddonModal<?= $addon['id_addon'] ?>">-</button>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="add_on_domain[]" placeholder="Masukkan add-on domain">
                                            <input type="hidden" name="addon_id[]" value="0">
                                            <button class="btn btn-success add-addon" type="button">+</button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <a href="<?= route_to('hosting') ?>" class="btn btn-secondary">← Kembali</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>

                <?php if (isset($add_ons) && is_array($add_ons)): ?>
                    <?php foreach ($add_ons as $addon): ?>
                        <div class="modal fade" id="deleteAddonModal<?= $addon['id_domains'] ?>" tabindex="-1" aria-labelledby="deleteAddonLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteAddonLabel">Konfirmasi Hapus Add-On Domain</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus add-on domain <strong><?= $addon['add_on_domain'] ?></strong>?</p>
                                        <p class="text-danger"><small><i class="fas fa-exclamation-triangle me-1"></i> Semua data terkait akan terhapus permanen!</small></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="fas fa-times me-1"></i> Batal
                                        </button>
                                        <a href="<?= route_to('addon.hapus', $addon['id_hosting'], $addon['id_addon']) ?>" class="btn btn-danger">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- JavaScript untuk add-on domain dinamis -->
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.addEventListener('click', function(e) {
                            if (e.target && e.target.classList.contains('add-addon')) {
                                const container = document.getElementById('addon-container');
                                const newGroup = document.createElement('div');
                                newGroup.className = 'input-group mb-2';
                                newGroup.innerHTML = `
                    <input type="text" class="form-control" name="add_on_domain[]" placeholder="Masukkan add-on domain">
                    <input type="hidden" name="addon_id[]" value="0">
                    <button class="btn btn-danger remove-new-addon" type="button">-</button>
                `;
                                container.appendChild(newGroup);
                            }

                            if (e.target && e.target.classList.contains('remove-new-addon')) {
                                e.target.closest('.input-group').remove();
                            }
                        });
                    });
                </script>

                <?= $this->endSection(); ?>