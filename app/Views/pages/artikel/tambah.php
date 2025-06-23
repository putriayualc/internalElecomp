<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<title>Tambah Artikel</title>

<body>
    <div class="container-fluid">
        <div class="form-container shadow rounded">
            <div class="form-header">
                <h2 class="display-7 fw-bolder mb-4 text-dark">
                    Tambah Artikel
                </h2>
            </div>

            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger" role="alert">
                    <h4>Error</h4>
                    <p><?= session()->getFlashdata('error'); ?></p>
                </div>
            <?php endif; ?>

            <form action="<?= route_to('artikel.simpan', $id_email, $id_blog) ?>" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_blog" value="<?= esc($id_blog) ?>">
                
                <div class="row g-4">
                    <!-- Judul Artikel -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="judul_artikel" name="judul_artikel" placeholder="Judul Artikel" value="<?= old('judul_artikel') ?>" required>
                            <label for="judul_artikel">
                                <i class="bi bi-journal-text me-2"></i>Judul Artikel
                            </label>
                            <div class="invalid-feedback">
                                Judul artikel harus diisi
                            </div>
                        </div>
                    </div>

                    <!-- Jenis Artikel -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="jenis" name="jenis" required>
                                <option value="">Pilih Jenis Artikel</option>
                                <?php foreach ($jenis as $j) : ?>
                                    <option value="<?= $j ?>" <?= old('jenis') == $j ? 'selected' : '' ?>>
                                        <?= ucfirst($j) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="jenis">
                                <i class="bi bi-tag me-2"></i>Jenis Artikel
                            </label>
                            <div class="invalid-feedback">
                                Jenis artikel harus dipilih
                            </div>
                        </div>
                    </div>

                    <!-- Link Artikel -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="url" class="form-control" id="link" name="link" placeholder="Link Artikel" value="<?= old('link') ?>">
                            <label for="link">
                                <i class="bi bi-link-45deg me-2"></i>Link Artikel
                            </label>
                            <div class="invalid-feedback">
                                Format URL tidak valid
                            </div>
                        </div>
                    </div>

                    <!-- Link To -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="url" class="form-control" id="link_to" name="link_to" placeholder="Link To" value="<?= old('link_to') ?>">
                            <label for="link_to">
                                <i class="bi bi-arrow-up-right-square me-2"></i>Link To
                            </label>
                            <div class="invalid-feedback">
                                Format URL tidak valid
                            </div>
                        </div>
                    </div>

                    <!-- Link Type -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="link_type" name="link_type">
                                <option value="">Pilih Link Type</option>
                                <option value="img" <?= old('link_type') == 'img' ? 'selected' : '' ?>>Image</option>
                                <option value="video" <?= old('link_type') == 'video' ? 'selected' : '' ?>>Video</option>
                                <option value="naked_url" <?= old('link_type') == 'naked_url' ? 'selected' : '' ?>>Naked URL</option>
                                <option value="text" <?= old('link_type') == 'text' ? 'selected' : '' ?>>Text</option>
                            </select>
                            <label for="link_type">
                                <i class="bi bi-file-earmark-text me-2"></i>Link Type
                            </label>
                        </div>
                    </div>

                    <!-- Keywords -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="keywords" name="keywords" placeholder="Keywords" value="<?= old('keywords') ?>">
                            <label for="keywords">
                                <i class="bi bi-key me-2"></i>Keywords
                            </label>
                        </div>
                    </div>

                    <!-- Anchor Text -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="anchor_text" name="anchor_text" placeholder="Anchor Text" value="<?= old('anchor_text') ?>">
                            <label for="anchor_text">
                                <i class="bi bi-cursor-text me-2"></i>Anchor Text
                            </label>
                        </div>
                    </div>

                    <!-- Tanggal Upload -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="tgl_upload" name="tgl_upload" value="<?= old('tgl_upload') ?>" required>
                            <label for="tgl_upload">
                                <i class="bi bi-calendar-check me-2"></i>Tanggal Upload
                            </label>
                            <div class="invalid-feedback">
                                Tanggal upload harus dipilih
                            </div>
                        </div>
                    </div>

                    <!-- Indexed -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="indexed" name="indexed">
                                <option value="">Pilih Status Indexed</option>
                                <option value="sudah" <?= old('indexed') == 'sudah' ? 'selected' : '' ?>>Sudah</option>
                                <option value="belum" <?= old('indexed') == 'belum' ? 'selected' : '' ?>>Belum</option>
                            </select>
                            <label for="indexed">
                                <i class="bi bi-check-circle me-2"></i>Status Indexed
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="<?= route_to('artikel', $id_email, $id_blog) ?>" class="btn btn-secondary btn-lg d-flex align-items-center">
                            <i class="bi bi-arrow-left me-2"></i>
                            <span>Kembali</span>
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg d-flex align-items-center">
                            <i class="bi bi-save me-2"></i>
                            <span>Simpan</span>
                        </button>
                    </div>
                </div>
            </form>

            <?php if (!empty(session()->getFlashdata('success'))) : ?>
                <div class="alert alert-success mt-3" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');

            // Form validation
            if (form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            }

            // Date validation - set minimum date to today
            const tglUpload = document.getElementById('tgl_upload');
            if (tglUpload) {
                const today = new Date().toISOString().split('T')[0];
                tglUpload.setAttribute('min', today);
            }

            // URL validation
            const urlInputs = document.querySelectorAll('input[type="url"]');
            urlInputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value && !this.checkValidity()) {
                        this.setCustomValidity('Format URL tidak valid. Contoh: https://example.com');
                    } else {
                        this.setCustomValidity('');
                    }
                });
            });
        });
    </script>

</body>

<?= $this->endSection();?>
