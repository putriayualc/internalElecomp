<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<title>Edit Akun Sosmed</title>

<body>
    <div class="container-fluid">
        <div class="form-container shadow rounded">
            <div class="form-header">
                <h2 class="display-7 fw-bolder mb-4 text-dark">
                    Edit Akun Sosmed
                </h2>
            </div>

            <?php if (session()->has('error')): ?>
                <?php $errors = session('error'); ?>
                <?php if (is_array($errors)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errors as $err): ?>
                                <li><?= esc($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger"><?= esc($errors) ?></div>
                <?php endif; ?>
            <?php endif; ?>

            <form action="<?= route_to('sosmed.update', $sosmed['id_sosmed']) ?>" method="POST" id="sosmedForm">
                <?= csrf_field() ?>
                <div class="row g-4">

                    <!-- Username -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="username" name="username" value="<?= esc($sosmed['username']) ?>" placeholder="Username" required>
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
                                <?php
                                $platforms = ['instagram', 'facebook', 'tiktok', 'linkedin'];
                                foreach ($platforms as $platform):
                                ?>
                                    <option value="<?= $platform ?>" <?= $platform == $sosmed['platform'] ? 'selected' : '' ?>>
                                        <?= ucfirst($platform) ?>
                                    </option>
                                <?php endforeach; ?>
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
                                <option value="">Pilih Nama Bisnis</option>
                                <?php foreach ($allBisnis as $bisnis): ?>
                                    <option value="<?= $bisnis['id_bisnis']; ?>" <?= $bisnis['id_bisnis'] == $sosmed['id_bisnis'] ? 'selected' : '' ?>>
                                        <?= $bisnis['nama_bisnis']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="id_bisnis">
                                <i class="bi bi-building me-2"></i>Nama Bisnis
                            </label>
                            <div class="invalid-feedback">
                                Nama bisnis harus dipilih
                            </div>
                        </div>
                    </div>

                    <!-- User Pengelola -->
                    <div class="col-12">
                        <div class="border p-3 rounded">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <label class="form-label mb-0">
                                    <i class="bi bi-people me-2"></i>User Pengelola
                                </label>
                            </div>

                            <div id="user-wrapper">
                                <?php foreach ($selectedUsers as $i => $idUser): ?>
                                    <div class="row mb-3 user-row">
                                        <div class="col-md-9">
                                            <div class="form-floating">
                                                <select name="id_user[]" class="form-select" required>
                                                    <option value="" disabled>Pilih User</option>
                                                    <?php foreach ($allUsers as $user): ?>
                                                        <option value="<?= $user['id_user']; ?>" <?= $user['id_user'] == $idUser ? 'selected' : '' ?>>
                                                            <?= $user['nama']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <label><i class="bi bi-person me-2"></i>Nama User</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex align-items-end h-100 gap-2">
                                                <?php if ($i === array_key_last($selectedUsers)): ?>
                                                    <button type="button" class="btn btn-info text-white w-50" id="add-user">Tambah</button>
                                                    <button type="button" class="btn btn-danger w-50 remove-user">Hapus</button>
                                                <?php else: ?>
                                                    <button type="button" class="btn btn-danger w-100 remove-user">Hapus</button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>


                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-2"></i>
                                Pilih user yang akan mengelola akun sosial media ini
                            </small>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="<?= route_to('sosmed') ?>" class="btn btn-secondary btn-lg d-flex align-items-center">
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
            const form = document.getElementById('sosmedForm');

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userWrapper = document.getElementById('user-wrapper');
            let userIndex = <?= count($selectedUsers) ?>;

            // Add user functionality
            function addUser() {
                // Ubah tombol terakhir (Tambah) jadi Hapus
                const lastRow = userWrapper.querySelector('.user-row:last-child');
                if (lastRow) {
                    const btnContainer = lastRow.querySelector('.d-flex');
                    btnContainer.innerHTML = `
            <button type="button" class="btn btn-danger w-100 remove-user">Hapus</button>
        `;
                }

                // Buat baris baru dengan tombol Tambah dan Hapus berdampingan
                const row = document.createElement('div');
                row.classList.add('row', 'mb-3', 'user-row');
                row.innerHTML = `
        <div class="col-md-9">
            <div class="form-floating">
                <select name="id_user[]" class="form-select" required>
                    <option value="" disabled selected>Pilih User</option>
                    <?php foreach ($allUsers as $user): ?>
                        <option value="<?= $user['id_user']; ?>"><?= $user['nama']; ?></option>
                    <?php endforeach; ?>
                </select>
                <label><i class="bi bi-person me-2"></i>Nama User</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="d-flex align-items-end h-100 gap-2">
                <button type="button" class="btn btn-info text-white w-50" id="add-user">Tambah</button>
                <button type="button" class="btn btn-danger w-50 remove-user">Hapus</button>
            </div>
        </div>
    `;
                userWrapper.appendChild(row);


                userIndex++;
            }

            // Remove user functionality
            function removeUser(button) {
                const row = button.closest('.user-row');
                if (!row) return;

                const allRows = userWrapper.querySelectorAll('.user-row');

                // Don't remove if only one row
                if (allRows.length === 1) return;

                row.remove();

                // Make sure last row has add button
                const newRows = userWrapper.querySelectorAll('.user-row');
                newRows.forEach((r, i) => {
                    const btn = r.querySelector('.btn');
                    if (i === newRows.length - 1) {
                        btn.classList.remove('btn-danger', 'remove-user');
                        btn.classList.add('btn-info', 'text-white');
                        btn.textContent = 'Tambah';
                        btn.setAttribute('onclick', 'addUser()');
                    } else {
                        btn.classList.remove('btn-info', 'text-white');
                        btn.classList.add('btn-danger', 'remove-user');
                        btn.textContent = 'Hapus';
                        btn.removeAttribute('onclick');
                    }
                });
            }

            // Event delegation for dynamic buttons
            userWrapper.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-user')) {
                    removeUser(e.target);
                } else if (e.target.id === 'add-user' || e.target.textContent.trim() === 'Tambah') {
                    addUser();
                }
            });

            // Make functions global for inline onclick
            window.addUser = addUser;
            window.removeUser = removeUser;
        });
    </script>
</body>

<?= $this->endSection();?>
