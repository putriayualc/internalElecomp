<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <h1 class="app-page-title">Detail Hosting</h1>

        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="app-card shadow-sm p-4">
                    <div class="app-card-body">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Domain Utama:</label>
                            <p><?= esc($hosting['domain_utama']) ?></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Username:</label>
                            <p><?= esc($hosting['username_hosting']) ?></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Password:</label>
                            <p><?= esc($hosting['password_hosting']) ?></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Add On Domain:</label>
                            <p><?= esc($addons['add_on_domain']) ?></p> 
                        </div>

                        <a href="<?= base_url('hosting') ?>" class="btn btn-secondary">Kembali</a>

                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
        </div><!--//row-->

    </div><!--//container-xl-->
</div><!--//app-content-->

<?= $this->endSection(); ?>
