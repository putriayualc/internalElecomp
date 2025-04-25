<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Tambahkan Artikel</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="card-body">

                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                        <div class="alert alert-danger" role="alert">
                            <h4>Error</h4>
                            <p><?php echo session()->getFlashdata('error'); ?></p>
                        </div>
                    <?php endif; ?>

                    <form action="<?= route_to('artikel.simpan', $blog['id_email'], $blog['id_blog']) ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col">
                                <!-- Input Judul -->
                                <div class="mb-3">
                                    <label class="form-label">Judul Artikel <br><span class="custom-color custom-label">judul Artikel hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="judul_artikel" name="judul_artikel" value="<?= old('judul_artikel') ?>">
                                </div>

                                <!-- Deskripsi -->
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Artikel</label>
                                    <textarea class="form-control tiny" id="deskripsi_artikel" name="deskripsi_artikel"><?= old('deskripsi_artikel') ?></textarea>
                                </div>

                                <!-- Gambar -->
                                <div class="mb-3">
                                    <label class="form-label">Gambar Artikel</label>
                                    <input class="form-control" type="file" id="foto_artikel" name="foto_artikel">
                                </div>
                                <p>*Ukuran gambar maksimal 572x572 pixels</p>
                                <p>*Format gambar harus berekstensi jpg/png/jpeg</p>

                                <!-- Tanggal Upload -->
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Upload</label>
                                    <input type="date" class="form-control" id="tanggal_upload" name="tanggal_upload" value="<?= old('tanggal_upload') ?>">
                                </div>

                                <!-- Jenis -->
                                <div class="mb-3">
                                    <label class="form-label">Jenis</label>
                                    <select class="form-select" id="jenis_artikel" name="jenis_artikel">
                                        <option value="artikel" <?= old('jenis_artikel') == 'artikel' ? 'selected' : '' ?>>Artikel</option>
                                        <option value="backlink" <?= old('jenis_artikel') == 'backlink' ? 'selected' : '' ?>>Backlink</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    <div class="col">
                        <?php if (!empty(session()->getFlashdata('success'))) : ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                </form>
            </div>
        </div><!--//app-card-->
    </div><!--//row-->

    <hr class="my-4">
</div><!--//container-fluid-->
</div><!--//app-content-->

<?= $this->endSection('content'); ?>
