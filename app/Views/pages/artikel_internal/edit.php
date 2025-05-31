<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="app-page-title mb-0">Edit Artikel Internal</h1>
        </div>

        <!-- Flash Error -->
        <?php if (session()->has('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> <?= session('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <div class="app-card shadow-sm mb-5 p-4">
            <form action="<?= base_url('artikel_internal/update/' . $artikel['id_artikel_internal']) ?>" method="post">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="judul_artikel" class="form-label">Judul Artikel</label>
                    <input type="text" name="judul_artikel" id="judul_artikel" class="form-control" required value="<?= old('judul_artikel', $artikel['judul_artikel']) ?>">
                </div>

                <div class="mb-3">
                    <label for="tgl_upload" class="form-label">Tanggal Upload</label>
                    <input type="date" name="tgl_upload" id="tgl_upload" class="form-control" required value="<?= old('tgl_upload', $artikel['tgl_upload']) ?>">
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">Link</label>
                    <input type="text" name="link" id="link" class="form-control" required value="<?= old('link', $artikel['link']) ?>">
                </div>

                <div class="mb-3">
                    <label for="keyword" class="form-label">Keyword</label>
                    <input type="text" name="keyword" id="keyword" class="form-control" required value="<?= old('keyword', $artikel['keyword']) ?>">
                </div>

                <div class="mb-3">
                    <label for="id_bisnis" class="form-label">Bisnis</label>
                    <select name="id_bisnis" id="id_bisnis" class="form-select" required>
                        <option value="">-- Pilih Bisnis --</option>
                        <?php foreach ($allBisnis as $bisnis) : ?>
                            <option value="<?= $bisnis['id_bisnis'] ?>" <?= old('id_bisnis', $artikel['id_bisnis']) == $bisnis['id_bisnis'] ? 'selected' : '' ?>>
                                <?= esc($bisnis['nama_bisnis']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <?php if (session()->get('role')  === 'admin') : ?>
                    <div class="mb-3">
                        <label for="id_user" class="form-label">User</label>
                        <select name="id_user" id="id_user" class="form-select" required>
                            <option value="">-- Pilih User --</option>
                            <?php foreach ($allUsers as $user) : ?>
                                <option value="<?= $user['id_user'] ?>" <?= old('id_user', $artikel['id_user']) == $user['id_user'] ? 'selected' : '' ?>>
                                    <?= esc($user['username']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>


                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('artikel_internal') ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>