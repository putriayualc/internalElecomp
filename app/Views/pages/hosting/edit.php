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
                                    <?php if (isset($addons) && is_array($addons) && count($addons) > 0): ?>
                                        <?php foreach ($addons as $addon): ?>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="add_on_domain[]" value="<?= esc($addon['add_on_domain']) ?>" placeholder="Masukkan add-on domain">
                                                <input type="hidden" name="domains_id[]" value="<?= esc($addon['id_domains']) ?>">
                                                <button class="btn btn-success add-addon" type="button">+</button>
                                                <button class="btn btn-danger remove-addon" type="button" data-bs-toggle="modal" data-bs-target="#deleteAddonModal<?= $addon['id_domains'] ?>">-</button>
                                                </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="add_on_domain[]" placeholder="Masukkan add-on domain">
                                            <button class="btn btn-success add-addon" type="button">+</button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="d-flex justify-content-start gap-2">
                                <a href="<?= route_to('hosting') ?>" class="btn btn-secondary">
                                    ← Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                    </div>
                </div>
            </div>
        </div>

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
                    <p class="text-danger"><small><i class="fas fa-exclamation-triangle me-1"></i> Semua data terkait akan terhapus permanen!</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <!-- Link untuk menghapus add-on domain -->
                    <a href="<?= route_to('domain.hapus', $addon['id_hosting'], $addon['id_domains']) ?>" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

        
        <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menambahkan input domain baru
        document.addEventListener('click', function(e) {
            // Jika tombol tambah domain (+) diklik
            if (e.target && e.target.classList.contains('add-addon')) {
                const container = document.getElementById('addon-container');
                const newGroup = document.createElement('div');
                newGroup.className = 'input-group mb-2';
                newGroup.innerHTML = `
                    <input type="text" class="form-control" name="add_on_domain[]" placeholder="Masukkan add-on domain">
                    <input type="hidden" name="domains_id[]" value="0">
                    <button class="btn btn-danger remove-addon" type="button">-</button>
                `;
                container.appendChild(newGroup);
            }

            // Menghapus input domain yang baru ditambahkan
            if (e.target && e.target.classList.contains('remove-addon')) {
                e.target.closest('.input-group').remove();
            }
        });
    });
</script>

        <?= $this->endSection(); ?>