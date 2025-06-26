<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<title>Tambah Artikel Internal</title>

<body>
    <div class="container-fluid">
        <div class="form-container shadow rounded">
            <div class="form-header">
                <h2 class="display-7 fw-bolder mb-4 text-dark">
                    Tambah Artikel Internal
                </h2>
            </div>

            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger" role="alert">
                    <h4>Error</h4>
                    <p><?= session()->getFlashdata('error'); ?></p>
                </div>
            <?php endif; ?>

            <form action="<?= route_to('artikel_internal.simpan') ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="row g-4">
                    
                    <!-- Judul Artikel -->
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="judul_artikel" name="judul_artikel" placeholder="Judul Artikel" value="<?= old('judul_artikel') ?>" required>
                            <label for="judul_artikel">
                                <i class="bi bi-pencil-square me-2"></i>Judul Artikel
                            </label>
                            <div class="invalid-feedback">
                                Judul artikel harus diisi
                            </div>
                        </div>
                    </div>

                    <!-- Link Artikel -->
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="url" class="form-control" id="link" name="link" placeholder="Link Artikel" value="<?= old('link') ?>" required>
                            <label for="link">
                                <i class="bi bi-link-45deg me-2"></i>Link Artikel
                            </label>
                            <div class="invalid-feedback">
                                Link artikel harus diisi dengan format URL yang valid
                            </div>
                        </div>
                    </div>

                    <!-- Keyword -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Keyword" value="<?= old('keyword') ?>">
                            <label for="keyword">
                                <i class="bi bi-tags me-2"></i>Keyword
                            </label>
                            <div class="invalid-feedback">
                                Format keyword tidak valid
                            </div>
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

                    <!-- Bisnis -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="id_bisnis" name="id_bisnis" required>
                                <option value="">Pilih Bisnis</option>
                                <?php foreach ($allBisnis as $bisnis): ?>
                                    <option value="<?= $bisnis['id_bisnis'] ?>" <?= old('id_bisnis') == $bisnis['id_bisnis'] ? 'selected' : '' ?>>
                                        <?= $bisnis['nama_bisnis'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="id_bisnis">
                                <i class="bi bi-building me-2"></i>Bisnis
                            </label>
                            <div class="invalid-feedback">
                                Bisnis harus dipilih
                            </div>
                        </div>
                    </div>

                    <?php if (session()->get('role') === 'admin') : ?>
                        <!-- User -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="id_user" name="id_user" required>
                                    <option value="">Pilih User</option>
                                    <?php foreach ($allUsers as $user): ?>
                                        <option value="<?= $user['id_user'] ?>" <?= old('id_user') == $user['id_user'] ? 'selected' : '' ?>>
                                            <?= $user['username'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="id_user">
                                    <i class="bi bi-person-circle me-2"></i>User
                                </label>
                                <div class="invalid-feedback">
                                    User harus dipilih
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="<?= base_url('artikel_internal') ?>" class="btn btn-secondary btn-lg d-flex align-items-center">
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

            // URL validation for link field
            const linkInput = document.getElementById('link');
            if (linkInput) {
                linkInput.addEventListener('input', function() {
                    const urlPattern = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
                    if (linkInput.value && !urlPattern.test(linkInput.value)) {
                        linkInput.setCustomValidity('Masukkan URL yang valid');
                    } else {
                        linkInput.setCustomValidity('');
                    }
                });
            }

            // Date validation - tidak boleh tanggal masa depan yang terlalu jauh
            const tglUpload = document.getElementById('tgl_upload');
            if (tglUpload) {
                const today = new Date();
                const maxDate = new Date();
                maxDate.setFullYear(today.getFullYear() + 1);
                
                tglUpload.max = maxDate.toISOString().split('T')[0];
                
                tglUpload.addEventListener('change', function() {
                    const selectedDate = new Date(tglUpload.value);
                    if (selectedDate > maxDate) {
                        tglUpload.setCustomValidity('Tanggal upload tidak boleh terlalu jauh di masa depan');
                    } else {
                        tglUpload.setCustomValidity('');
                    }
                });
            }
        });
    </script>

</body>

<?= $this->endSection(); ?>