<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<title>Edit SOP</title>

<body>
    <div class="container-fluid">
        <div class="form-container shadow rounded">
            <div class="form-header">
                <h2 class="display-7 fw-bolder mb-4 text-dark">
                    Edit SOP
                </h2>
            </div>
            <form action="<?= base_url('sop/update/' . $sop['id_sop']) ?>" method="POST">
                <?= csrf_field() ?>
                <div class="row g-4">

                    <!-- Judul SOP -->
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="judul_sop" name="judul_sop" value="<?= esc($sop['judul_sop']) ?>" placeholder="Judul SOP" required>
                            <label for="judul_sop">
                                <i class="bi bi-card-heading me-2"></i>Judul SOP
                            </label>
                            <div class="invalid-feedback">
                                Judul SOP harus diisi
                            </div>
                        </div>
                    </div>

                    <!-- Detail SOP -->
                    <div class="col-12">
                        <div class="border p-3 rounded">
                            <label class="form-label mb-3">
                                <i class="bi bi-file-text me-2"></i>Detail SOP
                            </label>
                            <textarea class="form-control tiny" id="detail_sop" name="detail_sop" style="min-height: 300px;" required><?= old('detail_sop', $sop['detail_sop']) ?></textarea>
                            <div class="invalid-feedback">
                                Detail SOP harus diisi
                            </div>
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-2"></i>
                                Masukkan detail lengkap prosedur operasional standar
                            </small>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="<?= base_url('sop') ?>" class="btn btn-secondary btn-lg d-flex align-items-center">
                            <span>Kembali</span>
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg d-flex align-items-center">
                            <span>Update</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');

            // Form validation
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    </script>

<?= $this->endSection(); ?>