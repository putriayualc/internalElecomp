<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<title>Tambah Akun Sosmed</title>

<body>
    <div class="container-fluid">
        <div class="form-container shadow rounded">
            <div class="form-header">
                <h2 class="display-7 fw-bolder mb-4 text-dark">
                    Tambah Akun Sosmed
                </h2>
            </div>

            <?php if (session()->has('error')) : ?>
                <div class="alert alert-danger"><?= session('error') ?></div>
            <?php endif; ?>

            <form action="<?= route_to('sosmed.simpan') ?>" method="POST" id="sosmedForm">
                <?= csrf_field() ?>
                
                <div class="row g-4">
                    <!-- Username -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            <label for="username">
                                <i class="bi bi-person-circle me-2"></i>Username
                            </label>
                            <div class="invalid-feedback">
                                Username harus diisi
                            </div>
                        </div>
                    </div>

                    <!-- Platform -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="platform" name="platform" required>
                                <option value="">Pilih Platform</option>
                                <option value="instagram">Instagram</option>
                                <option value="facebook">Facebook</option>
                                <option value="tiktok">TikTok</option>
                                <option value="linkedin">LinkedIn</option>
                            </select>
                            <label for="platform">
                                <i class="bi bi-globe me-2"></i>Platform
                            </label>
                            <div class="invalid-feedback">
                                Platform harus dipilih
                            </div>
                        </div>
                    </div>

                    <!-- Nama Bisnis -->
                    <div class="col-12">
                        <div class="form-floating">
                            <select class="form-select" id="id_bisnis" name="id_bisnis" required>
                                <option value="">Pilih Bisnis</option>
                                <?php foreach ($allBisnis as $bisnis): ?>
                                    <option value="<?= $bisnis['id_bisnis']; ?>"><?= $bisnis['nama_bisnis']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="id_bisnis">
                                <i class="bi bi-building me-2"></i>Nama Bisnis
                            </label>
                            <div class="invalid-feedback">
                                Bisnis harus dipilih
                            </div>
                        </div>
                    </div>

                    <!-- User Pengelola -->
                    <div class="col-12">
                        <div class="border p-3 rounded">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="form-label">
                                    <i class="bi bi-people me-2"></i>User Pengelola
                                </label>
                            </div>
                            
                            <div id="user-container">
                                <div class="row mb-3">
                                    <div class="col-md-9">
                                        <div class="form-floating">
                                            <select name="id_user[]" class="form-select" required>
                                                <option value="" disabled selected>Pilih User</option>
                                                <?php foreach ($allUsers as $user): ?>
                                                    <option value="<?= $user['id_user']; ?>">
                                                        <?= $user['nama']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <label><i class="bi bi-person me-2"></i>User Pengelola</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-info text-white w-100" onclick="tambahUser()">
                                            Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-2"></i>
                                Pilih minimal satu user pengelola untuk akun sosmed ini
                            </small>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="<?= route_to('sosmed.index') ?>" class="btn btn-secondary btn-lg d-flex align-items-center">
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
            const form = document.getElementById('sosmedForm');

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

    <script>
        let userIndex = 1;

        function tambahUser() {
            const container = document.getElementById('user-container');

            const row = document.createElement('div');
            row.classList.add('row', 'mb-3', 'user-entry');
            row.innerHTML = `
                <div class="col-md-9">
                    <div class="form-floating">
                        <select name="id_user[]" class="form-select" required>
                            <option value="" disabled selected>Pilih User</option>
                            <?php foreach ($allUsers as $user): ?>
                                <option value="<?= $user['id_user']; ?>">
                                    <?= $user['nama']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label><i class="bi bi-person me-2"></i>User Pengelola</label>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <button type="button" class="btn btn-danger text-white w-100" onclick="hapusUser(this)">
                        Hapus
                    </button>
                </div>
            `;

            container.appendChild(row);
            userIndex++;
        }

        function hapusUser(button) {
            const row = button.closest('.user-entry');
            if (row) {
                row.remove();
            }
        }
    </script>

</body>

<?= $this->endSection();?>
