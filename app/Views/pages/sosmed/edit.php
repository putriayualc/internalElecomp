<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title mb-4">Edit Akun Sosmed</h1>

        <?php if (session()->has('error')): ?>
            <?php $errors = session('error'); ?>
            <?php if (is_array($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $err): ?>
                            <li><?= esc($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php else: ?>
                <div class="alert alert-danger"><?= esc($errors) ?></div>
            <?php endif; ?>
        <?php endif; ?>


        <div class="row g-4 settings-section">
            <div class="col-12">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <form action="<?= route_to('sosmed.update', $sosmed['id_sosmed']) ?>" method="post" id="sosmedForm">
                        <?= csrf_field() ?>
                        <!-- Input untuk Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= esc($sosmed['username']) ?>" required>
                        </div>

                        <!-- Dropdown untuk Nama Bisnis -->
                        <div class="mb-3">
                            <label for="id_bisnis" class="form-label">Nama Bisnis</label>
                            <select class="form-select" id="id_bisnis" name="id_bisnis" required>
                                <?php foreach ($allBisnis as $bisnis): ?>
                                    <option value="<?= $bisnis['id_bisnis']; ?>" <?= $bisnis['id_bisnis'] == $sosmed['id_bisnis'] ? 'selected' : '' ?>>
                                        <?= $bisnis['nama_bisnis']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Dropdown untuk Platform -->
                        <div class="mb-3">
                            <label for="platform" class="form-label">Platform</label>
                            <select class="form-select" id="platform" name="platform" required>
                                <?php
                                $platforms = ['instagram', 'facebook', 'tiktok', 'linkedin'];
                                foreach ($platforms as $platform):
                                ?>
                                    <option value="<?= $platform ?>" <?= $platform == $sosmed['platform'] ? 'selected' : '' ?>>
                                        <?= ucfirst($platform) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- User Pengelola -->
                        <div class="mb-3">
                            <label class="form-label">Pilih User Pengelola</label>
                            <div id="user-wrapper">
                                <?php
                                $i = 0;
                                foreach ($selectedUsers as $idUser): ?>
                                    <div class="input-group mb-2">
                                        <select name="id_user[]" class="form-select" required>
                                            <option value="" disabled>-- Pilih User --</option>
                                            <?php foreach ($allUsers as $user): ?>
                                                <option value="<?= $user['id_user']; ?>" <?= $user['id_user'] == $idUser ? 'selected' : '' ?>>
                                                    <?= $user['nama']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="button" class="btn btn-outline-danger remove-user <?= $i == 0 ? 'd-none' : '' ?>">Hapus</button>
                                    </div>
                                <?php
                                    $i++;
                                endforeach; ?>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm" id="add-user">+ Tambah User</button>
                        </div>


                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="<?= route_to('sosmed') ?>" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('add-user').addEventListener('click', function() {
        const wrapper = document.getElementById('user-wrapper');
        const firstSelectGroup = wrapper.querySelector('.input-group');
        const clone = firstSelectGroup.cloneNode(true);

        clone.querySelector('.remove-user').classList.remove('d-none');
        clone.querySelector('select').value = '';
        wrapper.appendChild(clone);
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-user')) {
            e.target.closest('.input-group').remove();
        }
    });
</script>

<?= $this->endSection(); ?>