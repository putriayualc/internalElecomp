<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title mb-4">Tambah Akun Sosmed</h1>

        <?php if (session()->has('error')) : ?>
            <div class="alert alert-danger"><?= session('error') ?></div>
        <?php endif; ?>

        <div class="row g-4 settings-section">
            <div class="col-12">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <form action="<?= route_to('sosmed.simpan') ?>" method="post" id="sosmedForm">
                        <?= csrf_field() ?>

                          <!-- Input untuk Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>

                        <!-- Dropdown untuk Nama Bisnis -->
                        <div class="mb-3">
                            <label for="id_bisnis" class="form-label">Nama Bisnis</label>
                            <select class="form-select" id="id_bisnis" name="id_bisnis" required>
                                <option value="" disabled selected>-- Pilih Bisnis --</option>
                                <?php foreach ($allBisnis as $bisnis): ?>
                                    <option value="<?= $bisnis['id_bisnis']; ?>"><?= $bisnis['nama_bisnis']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Dropdown untuk Platform -->
                        <div class="mb-3">
                            <label for="platform" class="form-label">Platform</label>
                            <select class="form-select" id="platform" name="platform" required>
                                <option value="" disabled selected>-- Pilih Platform --</option>
                                <option value="ig">Instagram</option>
                                <option value="fb">Facebook</option>
                                <option value="tiktok">TikTok</option>
                                <option value="linkedin">LinkedIn</option>
                            </select>
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= route_to('sosmed.index') ?>" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
