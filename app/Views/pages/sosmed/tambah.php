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
                                <option value="instagram">Instagram</option>
                                <option value="facebook">Facebook</option>
                                <option value="tiktok">TikTok</option>
                                <option value="linkedin">LinkedIn</option>
                            </select>
                        </div>

                        <!-- Tambahkan ini di bagian sebelum tombol submit -->
                        <div class="mb-3">
                            <label class="form-label">Pilih User Pengelola</label>
                            <div id="user-wrapper">
                                <div class="input-group mb-2">
                                    <select name="id_user[]" class="form-select" required>
                                        <option value="" disabled selected>-- Pilih User --</option>
                                        <?php foreach ($allUsers as $user): ?>
                                            <option value="<?= $user['id_user']; ?>">
                                                <?= $user['nama']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="button" class="btn btn-outline-danger remove-user d-none">Hapus</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm" id="add-user">+ Tambah User</button>
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

<script>
    document.getElementById('add-user').addEventListener('click', function () {
        const wrapper = document.getElementById('user-wrapper');
        const firstSelectGroup = wrapper.querySelector('.input-group');
        const clone = firstSelectGroup.cloneNode(true);

        clone.querySelector('.remove-user').classList.remove('d-none');
        clone.querySelector('select').value = ''; // reset value
        wrapper.appendChild(clone);
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-user')) {
            e.target.closest('.input-group').remove();
        }
    });
</script>

<?= $this->endSection(); ?>