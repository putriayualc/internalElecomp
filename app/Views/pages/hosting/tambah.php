<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title mb-4">Tambah Hosting</h1>

        <?php if (session()->has('error')) : ?>
            <div class="alert alert-danger"><?= session('error') ?></div>
        <?php endif; ?>

        <div class="row g-4 settings-section">
            <div class="col-12">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <form action="<?= base_url('hosting/simpan') ?>" method="post" id="hostingForm">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="hosting" class="form-label">Hosting</label>
                            <input type="text" class="form-control" id="hosting" name="hosting" required>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_exp_hosting" class="form-label">Exp Hosting</label>
                            <input type="date" class="form-control" id="tgl_exp_hosting" name="tgl_exp_hosting" required>
                        </div>
                        <div class="mb-3">
                            <label for="domain_utama" class="form-label">Domain Utama</label>
                            <input type="text" class="form-control" id="domain_utama" name="domain_utama" required>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_exp_domain" class="form-label">Exp Domain</label>
                            <input type="date" class="form-control" id="tgl_exp_domain" name="tgl_exp_domain" required>
                        </div>
                        <div class="mb-3">
                            <label for="username_hosting" class="form-label">Username Hosting</label>
                            <input type="text" class="form-control" id="username_hosting" name="username_hosting" required>
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
                                <div class="input-group mb-2">
                                    <input type="text" name="add_on_domain[]" class="form-control" placeholder="Masukkan add on domain">
                                    <input type="date" name="tgl_exp_add_domain[]" class="form-control" placeholder="Masukkan exp add on domain">
                                    <button type="button" class="btn btn-outline-secondary btn-add-addon">Tambah</button>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('addon-container');

        container.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-add-addon')) {
                const newInputGroup = document.createElement('div');
                newInputGroup.className = 'input-group mb-2';
                newInputGroup.innerHTML = `
                    <input type="text" name="add_on_domain[]" class="form-control" placeholder="Masukkan add on domain">
                    <input type="date" name="tgl_exp_add_domain[]" class="form-control" placeholder="Masukkan Exp add on domain">
                    <button type="button" class="btn btn-outline-danger btn-remove-addon">Hapus</button>
                `;
                container.appendChild(newInputGroup);
            } else if (e.target.classList.contains('btn-remove-addon')) {
                e.target.parentElement.remove();
            }
        }
    </script>
</body>

<?= $this->endSection(); ?>