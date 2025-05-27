<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Tambahkan Artikel</h1>
        <hr class="mb-4">

        <div class="app-card app-card-settings shadow-sm p-4">
            <div class="card-body">

                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="alert alert-danger" role="alert">
                        <h4>Error</h4>
                        <p><?= session()->getFlashdata('error'); ?></p>
                    </div>
                <?php endif; ?>

                <form action="<?= route_to('artikel_internal.simpan') ?>" method="POST">
                    <?= csrf_field(); ?>

                    <!-- Judul -->
                    <div class="mb-3">
                        <label class="form-label">Judul Artikel</label>
                        <input type="text" class="form-control" name="judul_artikel" value="<?= old('judul_artikel') ?>" required>
                    </div>

                    <!-- Link -->
                    <div class="mb-3">
                        <label class="form-label">Link Artikel</label>
                        <input type="text" class="form-control" name="link" value="<?= old('link') ?>" required>
                    </div>

                    <!-- Keywords -->
                    <div class="mb-3">
                        <label class="form-label">Keyword</label>
                        <input type="text" class="form-control" name="keyword" value="<?= old('keyword') ?>">
                    </div>

                    <!-- Tanggal Upload -->
                    <div class="mb-3">
                        <label class="form-label">Tanggal Upload</label>
                        <input type="date" class="form-control" name="tgl_upload" value="<?= old('tgl_upload') ?>" required>
                    </div>

                    <!-- ID Bisnis -->
                    <div class="mb-3">
                        <label class="form-label">Bisnis</label>
                        <select class="form-select" name="id_bisnis" required>
                            <option value="">-- Pilih Bisnis --</option>
                            <?php foreach ($allBisnis as $bisnis): ?>
                                <option value="<?= $bisnis['id_bisnis'] ?>" <?= old('id_bisnis') == $bisnis['id_bisnis'] ? 'selected' : '' ?>>
                                    <?= $bisnis['nama_bisnis'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <!-- ID User -->
                    <div class="mb-3">
                        <label class="form-label">User</label>
                        <select class="form-select" name="id_user" required>
                            <option value="">-- Pilih User --</option>
                            <?php foreach ($allUsers as $user): ?>
                                <option value="<?= $user['id_user'] ?>" <?= old('id_user') == $user['id_user'] ? 'selected' : '' ?>>
                                    <?= $user['username'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <!-- Tombol Aksi -->
                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                        <a href="<?= base_url('artikel-internal') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>

                    <?php if (!empty(session()->getFlashdata('success'))) : ?>
                        <div class="alert alert-success mt-3" role="alert">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                </form>
            </div>
        </div><!--//app-card-->
        <hr class="my-4">
    </div><!--//container-->
</div><!--//app-content-->

<?= $this->endSection('content'); ?>