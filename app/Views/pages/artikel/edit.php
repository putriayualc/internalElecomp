<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Edit Artikel</h1>
        <hr class="mb-4">

        <div class="app-card app-card-settings shadow-sm p-4">
            <div class="card-body">

                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="alert alert-danger" role="alert">
                        <h4>Error</h4>
                        <p><?= session()->getFlashdata('error'); ?></p>
                    </div>
                <?php endif; ?>

                <form action="<?= route_to('artikel.update', $id_email, $id_blog, $artikel['id_artikel']) ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <!-- Judul -->
                    <div class="mb-3">
                        <label class="form-label">Judul Artikel</label>
                        <input type="text" class="form-control" name="judul_artikel" value="<?= old('judul_artikel', $artikel['judul_artikel']) ?>" required>
                    </div>

                    <!-- Jenis -->
                    <div class="mb-3">
                        <label class="form-label">Jenis Artikel</label>
                        <select class="form-select" name="jenis" required>
                            <option value="artikel" <?= $artikel['jenis'] == 'artikel' ? 'selected' : '' ?>>Artikel</option>
                            <option value="backlink" <?= $artikel['jenis'] == 'backlink' ? 'selected' : '' ?>>Backlink</option>
                        </select>
                    </div>

                    <!-- Link -->
                    <div class="mb-3">
                        <label class="form-label">Link Artikel</label>
                        <input type="url" class="form-control" name="link" value="<?= old('link', $artikel['link']) ?>">
                    </div>

                    <!-- Link To -->
                    <div class="mb-3">
                        <label class="form-label">Link To</label>
                        <input type="url" class="form-control" name="link_to" value="<?= old('link_to', $artikel['link_to']) ?>">
                    </div>

                    <!-- Link Type -->
                    <div class="mb-3">
                        <label class="form-label">Link Type</label>
                        <select class="form-select" name="link_type">
                            <option value="">-- Pilih --</option>
                            <option value="img" <?= old('link_type', $artikel['link_type']) == 'img' ? 'selected' : '' ?>>image</option>
                            <option value="video" <?= old('link_type', $artikel['link_type']) == 'video' ? 'selected' : '' ?>>video</option>
                            <option value="naked_url" <?= old('link_type', $artikel['link_type']) == 'naked_url' ? 'selected' : '' ?>>naked url</option>
                            <option value="text" <?= old('link_type', $artikel['link_type']) == 'text' ? 'selected' : '' ?>>text</option>
                        </select>
                    </div>

                    <!-- Keywords -->
                    <div class="mb-3">
                        <label class="form-label">Keywords</label>
                        <input type="text" class="form-control" name="keywords" value="<?= old('keywords', $artikel['keywords']) ?>">
                    </div>

                    <!-- Anchor Text -->
                    <div class="mb-3">
                        <label class="form-label">Anchor Text</label>
                        <input type="text" class="form-control" name="anchor_text" value="<?= old('anchor_text', $artikel['anchor_text']) ?>">
                    </div>

                    <!-- Tanggal Upload -->
                    <div class="mb-3">
                        <label class="form-label">Tanggal Upload</label>
                        <input type="date" class="form-control" name="tanggal_upload" value="<?= old('tanggal_upload', date('Y-m-d', strtotime($artikel['tgl_upload']))) ?>" required>
                    </div>

                    <!-- Indexed -->
                    <div class="mb-3">
                        <label class="form-label">Indexed</label>
                        <select class="form-select" name="indexed">
                            <option value="">-- Pilih --</option>
                            <option value="sudah" <?= old('indexed', $artikel['indexed']) == 'sudah' ? 'selected' : '' ?>>Sudah</option>
                            <option value="belum" <?= old('indexed', $artikel['indexed']) == 'belum' ? 'selected' : '' ?>>Belum</option>
                        </select>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update
                        </button>
                        <a href="<?= route_to('artikel', $id_email, $id_blog) ?>" class="btn btn-secondary">
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

<?= $this->endSection(); ?>
