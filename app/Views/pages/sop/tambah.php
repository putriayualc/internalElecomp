<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<title>Tambah SOP</title>

<body>
    <div class="container-fluid">
        <div class="form-container shadow rounded">
            <div class="form-header">
                <h2 class="display-7 fw-bolder mb-4 text-dark">
                    Tambah SOP
                </h2>
            </div>
            <form action="<?= base_url('sop/simpan') ?>" method="POST" id="sopForm">
                <?= csrf_field() ?>
                <div class="row g-4">
                    <!-- Judul SOP -->
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="judul_sop" name="judul_sop" placeholder="Judul SOP" required>
                            <label for="judul_sop">
                                <i class="bi bi-file-text me-2"></i>Judul SOP
                            </label>
                            <div class="invalid-feedback">
                                Judul SOP harus diisi
                            </div>
                        </div>
                    </div>

                    <!-- Detail SOP -->
                    <div class="col-12">
                        <div class="border p-3 rounded">
                            <label class="form-label">Detail SOP</label>
                                <textarea class="form-control tiny" id="detail_sop" name="detail_sop"><?= old('detail_sop') ?></textarea>
                            <div class="invalid-feedback">
                                Detail SOP harus diisi
                            </div>
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-2"></i>
                                Gunakan editor untuk memformat teks dengan baik
                            </small>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="<?= base_url('sop') ?>" class="btn btn-secondary btn-lg d-flex align-items-center">
                            <span>Kembali</span>
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg d-flex align-items-center">
                            <span>Simpan</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('sopForm');

            // Pastikan form ada
            if (form) {
                // Form validation
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            }
        });
    </script>

</body>

<?= $this->endSection(); ?>