<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Edit Artikel</h1>
        <hr class="mb-4">

        <?php if (!empty(session()->getFlashdata('error'))) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
        <?php endif; ?>

        <form action="<?= route_to('artikel.update', $id_email, $id_blog, $artikel['id_artikel']) ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <div class="mb-3">
                <label for="judul_artikel" class="form-label">Judul Artikel</label>
                <input type="text" class="form-control" id="judul_artikel" name="judul_artikel" value="<?= old('judul_artikel', $artikel['judul_artikel']) ?>">
            </div>

            <div class="mb-3">
                <label for="deskripsi_artikel" class="form-label">Deskripsi Artikel</label>
                <textarea class="form-control tiny" id="deskripsi_artikel" name="deskripsi_artikel"><?= old('deskripsi_artikel', $artikel['deskripsi_artikel']) ?></textarea>
            </div>

            <div class="mb-3">
                <label for="foto_artikel" class="form-label">Gambar Artikel</label>
                <input class="form-control" type="file" id="foto_artikel" name="foto_artikel">
                <?php if (!empty($artikel['foto'])) : ?>
                    <p class="mt-2">Gambar Saat Ini: <br>
                        <img src="<?= base_url('assets/img/artikel/' . $artikel['foto']) ?>" alt="Gambar Artikel" width="150">
                    </p>
                <?php endif; ?>
                <small class="text-muted">* Maks 572x572px, format jpg/jpeg/png</small>
            </div>

            <div class="mb-3">
                <label for="tanggal_upload" class="form-label">Tanggal Upload</label>
                <input type="date" class="form-control" id="tanggal_upload" name="tanggal_upload" value="<?= old('tanggal_upload', date('Y-m-d', strtotime($artikel['tgl_upload']))) ?>">
            </div>

            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis</label>
                <select class="form-select" id="jenis" name="jenis">
                    <option value="artikel" <?= ($artikel['jenis'] == 'artikel') ? 'selected' : '' ?>>Artikel</option>
                    <option value="backlink" <?= ($artikel['jenis'] == 'backlink') ? 'selected' : '' ?>>Backlink</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>