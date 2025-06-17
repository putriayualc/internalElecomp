<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<title>Edit Data Siswa Magang</title>

<body>
    <div class="container-fluid">
        <div class="form-container shadow rounded">
            <div class="form-header">
                <h2 class="display-7 fw-bolder mb-4 text-dark">
                    Edit Siswa Magang
                </h2>
            </div>
            <form action="<?= route_to('siswa.update', $siswa['id_siswa']) ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row g-4">

                    <!-- Nama Lengkap -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $siswa['nama'] ?>" placeholder="Nama Lengkap" required>
                            <label for="nama">
                                <i class="bi bi-person me-2"></i>Nama Lengkap
                            </label>
                            <div class="invalid-feedback">
                                Nama lengkap harus diisi
                            </div>
                        </div>
                    </div>

                    <!-- Jurusan -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?= $siswa['jurusan'] ?>" placeholder="Jurusan" required>
                            <label for="jurusan">
                                <i class="bi bi-book me-2"></i>Jurusan
                            </label>
                            <div class="invalid-feedback">
                                Jurusan harus diisi
                            </div>
                        </div>
                    </div>


                    <!-- Asal Instansi -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="asal_instansi" name="asal_instansi" value="<?= $siswa['asal_instansi'] ?>" placeholder="Asal Instansi" required>
                            <label for="asal_instansi">
                                <i class="bi bi-building me-2"></i>Asal Instansi
                            </label>
                            <div class="invalid-feedback">
                                Asal instansi harus diisi
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <?php foreach ($jenisKelaminList as $jk): ?>
                                    <option value="<?= $jk ?>" <?= isset($siswa['jenis_kelamin']) && $siswa['jenis_kelamin'] === $jk ? 'selected' : '' ?>>
                                        <?= $jk === 'l' ? 'Laki-laki' : ($jk === 'p' ? 'Perempuan' : $jk) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="jenis_kelamin"><i class="bi bi-gender-ambiguous me-2"></i>Jenis Kelamin</label>
                            <div class="invalid-feedback">Jenis kelamin harus dipilih</div>
                        </div>
                    </div>



                    <!-- Nomor Telepon -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="tel" class="form-control" id="no_telepon" name="no_telepon" value="<?= $siswa['no_telepon'] ?>" placeholder="Nomor Telepon" required pattern="[0-9]+" minlength="10" maxlength="15">
                            <label for="no_telepon">
                                <i class="bi bi-telephone me-2"></i>Nomor Telepon
                            </label>
                            <div class="invalid-feedback">
                                Nomor telepon harus diisi dengan angka yang valid
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" name="email" value="<?= $siswa['email'] ?>" placeholder="Email" required>
                            <label for="email">
                                <i class="bi bi-envelope me-2"></i>Email
                            </label>
                            <div class="invalid-feedback">
                                Email harus diisi dengan format yang valid
                            </div>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Alamat Lengkap" id="alamat" name="alamat" style="height: 100px" required><?= $siswa['alamat'] ?></textarea>
                            <label for="alamat"><i class="bi bi-geo-alt me-2"></i>Alamat Lengkap</label>
                            <div class="invalid-feedback">Alamat harus diisi</div>
                        </div>
                    </div>


                    <!-- Tanggal Masuk -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?= $siswa['tgl_masuk'] ?>" required>
                            <label for="tgl_masuk">
                                <i class="bi bi-calendar-check me-2"></i>Tanggal Masuk
                            </label>
                            <div class="invalid-feedback">
                                Tanggal masuk harus dipilih
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal Keluar -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="tgl_keluar" name="tgl_keluar" value="<?= $siswa['tgl_keluar'] ?>" required>
                            <label for="tgl_keluar">
                                <i class="bi bi-calendar-x me-2"></i>Tanggal Keluar
                            </label>
                            <div class="invalid-feedback">
                                Tanggal keluar harus dipilih
                            </div>
                        </div>
                    </div>

                    <!-- Sosmed -->
                    <div id="sosmed-container">
                        <?php if (!empty($sosmed)) : ?>
                            <?php foreach ($sosmed as $i => $row) : ?>
                                <div class="row mb-3 sosmed-row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="sosmed[<?= $i ?>][platform]" required>
                                                <option value="" disabled <?= !$row['platform'] ? 'selected' : '' ?>>Pilih Platform</option>
                                                <?php foreach ($platformList as $platform): ?>
                                                    <option value="<?= $platform ?>" <?= $row['platform'] == $platform ? 'selected' : '' ?>>
                                                        <?= ucfirst($platform) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <label><i class="bi bi-globe me-2"></i>Platform Sosmed</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row mb-3 align-items-end">
                                            <div class="col-md-9">
                                                <div class="form-floating">
                                                    <input type="text"
                                                        class="form-control"
                                                        name="sosmed[<?= $i ?>][username_sosmed]"
                                                        placeholder="username"
                                                        value="<?= esc($row['username_sosmed']) ?>"
                                                        required>
                                                    <label><i class="bi bi-person-circle me-2"></i>Username</label>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <?php if ($i === array_key_last($sosmed)) : ?>
                                                    <button type="button" class="btn btn-info text-white w-100" onclick="tambahSosmed()">
                                                        Tambah
                                                    </button>
                                                <?php else: ?>
                                                    <button type="button" class="btn btn-danger w-100" onclick="hapusBarisIni(this)">
                                                        Hapus
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <!-- Kosong, render 1 input default -->
                            <div class="row mb-3 sosmed-row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" name="sosmed[0][platform]" required>
                                            <option value="" disabled selected>Pilih Platform</option>
                                            <?php foreach ($platformList as $platform): ?>
                                                <option value="<?= $platform ?>"><?= ucfirst($platform) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label><i class="bi bi-globe me-2"></i>Platform Sosmed</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row mb-3 align-items-end">
                                        <div class="col-md-9">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="sosmed[0][username_sosmed]" placeholder="username" required>
                                                <label><i class="bi bi-person-circle me-2"></i>Username</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-info text-white w-100" onclick="tambahSosmed()">
                                                Tambah
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>




                    <!-- Foto -->
                    <!-- HTML FORM -->
                    <div class="col-12">
                        <div class="border p-3 rounded">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="form-label">
                                    <i class="bi bi-image me-2"></i>Unggah Foto Profil
                                </label>
                            </div>
                            <div class="input-group">
                                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                            </div>

                            <img id="previewImage"
                                src="<?= isset($siswa['foto']) && $siswa['foto'] ? base_url('assets/img/user/' . $siswa['foto']) . '?v=' . time() : '#' ?>"
                                alt="Preview Foto"
                                class="img-thumbnail mt-3 <?= isset($siswa['foto']) && $siswa['foto'] ? '' : 'd-none' ?>"
                                style="max-width: 200px;">

                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-2"></i>
                                Ukuran maks. 2MB, format JPG/PNG
                            </small>
                        </div>
                    </div>

                    <!-- JS PREVIEW SCRIPT -->


                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="<?= route_to('siswa') ?>" class="btn btn-secondary btn-lg d-flex align-items-center">
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
            const form = document.getElementById('editSiswaForm');

            // Form validation
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);

            // Date validation
            const tglMasuk = document.getElementById('tgl_masuk');
            const tglKeluar = document.getElementById('tgl_keluar');

            tglMasuk.addEventListener('change', function() {
                tglKeluar.min = tglMasuk.value;
            });

            tglKeluar.addEventListener('change', function() {
                if (new Date(tglKeluar.value) <= new Date(tglMasuk.value)) {
                    tglKeluar.setCustomValidity('Tanggal keluar harus setelah tanggal masuk');
                } else {
                    tglKeluar.setCustomValidity('');
                }
            });
        });
    </script>

    <script>
        // Ambil jumlah data awal dari PHP
        let sosmedIndex = <?= isset($sosmed) && is_array($sosmed) ? count($sosmed) : 1 ?>;

        function tambahSosmed() {
            const container = document.getElementById('sosmed-container');

            // Hilangkan tombol tambah di baris terakhir sebelumnya (ganti jadi hapus)
            const lastButtons = container.querySelectorAll('.sosmed-row:last-child .btn');
            if (lastButtons.length > 0) {
                lastButtons.forEach(btn => {
                    btn.classList.remove('btn-info', 'text-white');
                    btn.classList.add('btn-danger');
                    btn.textContent = 'Hapus';
                    btn.setAttribute('onclick', 'hapusSosmed(this)');
                });
            }

            const row = document.createElement('div');
            row.classList.add('row', 'mb-3', 'sosmed-row');
            row.innerHTML = `
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <select class="form-select" name="sosmed[${sosmedIndex}][platform]" required>
                        <option value="" disabled selected>Pilih Platform</option>
                        <?php foreach ($platformList as $platform): ?>
                            <option value="<?= $platform ?>"><?= ucfirst($platform) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label><i class="bi bi-globe me-2"></i>Platform Sosmed</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row mb-3 align-items-end">
                    <div class="col-md-9">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="sosmed[${sosmedIndex}][username_sosmed]" placeholder="username" required>
                            <label><i class="bi bi-person-circle me-2"></i>Username</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-info text-white w-100" onclick="tambahSosmed()">Tambah</button>
                    </div>
                </div>
            </div>
        `;

            container.appendChild(row);
            sosmedIndex++;
        }

        function hapusSosmed(button) {
            const row = button.closest('.sosmed-row');
            if (!row) return;

            const container = document.getElementById('sosmed-container');
            const allRows = container.querySelectorAll('.sosmed-row');

            // Jika hanya 1 baris, jangan hapus
            if (allRows.length === 1) return;

            row.remove();

            // Setelah hapus, pastikan hanya baris terakhir yang punya tombol Tambah
            const newRows = container.querySelectorAll('.sosmed-row');
            newRows.forEach((r, i) => {
                const btn = r.querySelector('.btn');
                if (i === newRows.length - 1) {
                    btn.classList.remove('btn-danger');
                    btn.classList.add('btn-info', 'text-white');
                    btn.textContent = 'Tambah';
                    btn.setAttribute('onclick', 'tambahSosmed()');
                } else {
                    btn.classList.remove('btn-info', 'text-white');
                    btn.classList.add('btn-danger');
                    btn.textContent = 'Hapus';
                    btn.setAttribute('onclick', 'hapusSosmed(this)');
                }
            });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fotoInput = document.getElementById('foto');
            const previewImage = document.getElementById('previewImage');

            if (fotoInput && previewImage) {
                fotoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            previewImage.src = event.target.result;
                            previewImage.classList.remove('d-none');
                        };
                        reader.readAsDataURL(file);
                    }
                });
            } else {
                console.warn("Elemen foto atau previewImage tidak ditemukan.");
            }
        });
    </script>



    <?= $this->endSection(); ?>