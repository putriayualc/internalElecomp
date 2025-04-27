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
                            <label for="domain_utama" class="form-label">Domain Utama</label>
                            <input type="text" class="form-control" id="domain_utama" name="domain_utama" required>
                        </div>
                        <div class="mb-3">
                            <label for="username_hosting" class="form-label">Username Hosting</label>
                            <input type="text" class="form-control" id="username_hosting" name="username_hosting" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_hosting" class="form-label">Password Hosting</label>
                            <input type="text" class="form-control" id="password_hosting" name="password_hosting" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Add On Domain</label>
                            <div id="addon-container">
                                <div class="input-group mb-2">
                                    <input type="text" name="add_on_domain[]" class="form-control" placeholder="Masukkan add on domain">
                                    <button type="button" class="btn btn-outline-secondary btn-add-addon">Tambah</button>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= route_to('hosting.index') ?>" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('addon-container');

        container.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-add-addon')) {
                const newInputGroup = document.createElement('div');
                newInputGroup.className = 'input-group mb-2';
                newInputGroup.innerHTML = `
                    <input type="text" name="add_on_domain[]" class="form-control" placeholder="Masukkan add on domain">
                    <button type="button" class="btn btn-outline-danger btn-remove-addon">Hapus</button>
                `;
                container.appendChild(newInputGroup);
            } else if (e.target.classList.contains('btn-remove-addon')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>

<?= $this->endSection(); ?>
