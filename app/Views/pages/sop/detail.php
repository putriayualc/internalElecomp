<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <h1 class="app-page-title">Detail SOP</h1>

        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="app-card shadow-sm p-4">
                    <div class="app-card-body">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul SOP:</label>
                            <p><?= esc($sop['judul_sop']) ?></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Detail SOP:</label>
                            <p><?= esc($sop['detail_sop']) ?></p>
                        </div>

                        <a href="<?= base_url('sop') ?>" class="btn btn-secondary">Kembali</a>

                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
        </div><!--//row-->

    </div><!--//container-xl-->
</div><!--//app-content-->

<?= $this->endSection(); ?>
