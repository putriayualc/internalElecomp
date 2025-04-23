<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <h1 class="app-page-title">Edit SOP</h1>

        <div class="row g-4 settings-section">
            <div class="col-12">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">

                        <form method="post" action="<?= base_url('sop/update/' . $sop['id_sop']) ?>">
                            <?= csrf_field() ?>

                            <div class="mb-3">
                                <label for="judul_sop" class="form-label">Judul SOP</label>
                                <input type="text" class="form-control" id="judul_sop" name="judul_sop" value="<?= esc($sop['judul_sop']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="detail_sop" class="form-label">Detail SOP</label>
                                <textarea class="form-control" id="detail_sop" name="detail_sop" rows="5" required><?= esc($sop['detail_sop']) ?></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?= base_url('sop') ?>" class="btn btn-secondary">Kembali</a>
                        </form>

                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
        </div><!--//row-->

    </div><!--//container-xl-->
</div><!--//app-content-->

<?= $this->endSection(); ?>
