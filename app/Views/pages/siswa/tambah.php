<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<title>Tambah Data Siswa Magang</title>

<body>
    <div class="container-fluid">
        <div class="form-container shadow rounded">
            <div class="form-header">
                <h2 class="display-7 fw-bolder mb-4 text-dark">
                    Tambah Siswa Magang
                </h2>
            </div>
            <form action="<?= route_to('siswa.tambah') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row g-4">
                    <!-- Nama Lengkap -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
                            <label for="nama">
                                <i class="bi bi-person me-2"></i>Nama Lengkap
                            </label>
                            <div class="invalid-feedback">
                                Nama lengkap harus diisi
                            </div>
                        </div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="laki_laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                            <label for="jenis_kelamin">
                                <i class="bi bi-gender-ambiguous me-2"></i>Jenis Kelamin
                            </label>
                            <div class="invalid-feedback">
                                Jenis kelamin harus dipilih
                            </div>
                        </div>
                    </div>

                    <!-- Jurusan -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="jurusan" required>
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
                            <input type="text" class="form-control" id="asal_instansi" name="asal_instansi" placeholder="Asal Instansi" required>
                            <label for="asal_instansi">
                                <i class="bi bi-building me-2"></i>Asal Instansi
                            </label>
                            <div class="invalid-feedback">
                                Asal instansi harus diisi
                            </div>
                        </div>
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="tel" class="form-control" id="no_telepon" name="no_telepon" placeholder="Nomor Telepon" required pattern="[0-9]+" minlength="10" maxlength="15">
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
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
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
                            <textarea class="form-control" placeholder="Alamat Lengkap" id="alamat" name="alamat" style="height: 100px" required></textarea>
                            <label for="alamat">
                                <i class="bi bi-geo-alt me-2"></i>Alamat Lengkap
                            </label>
                            <div class="invalid-feedback">
                                Alamat harus diisi
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal Masuk -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" required>
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
                            <input type="date" class="form-control" id="tgl_keluar" name="tgl_keluar" required>
                            <label for="tgl_keluar">
                                <i class="bi bi-calendar-x me-2"></i>Tanggal Keluar
                            </label>
                            <div class="invalid-feedback">
                                Tanggal keluar harus dipilih
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="status" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="selesai">Selesai</option>
                                <option value="pending">Pending</option>
                            </select>
                            <label for="status">
                                <i class="bi bi-check-circle me-2"></i>Status
                            </label>
                            <div class="invalid-feedback">
                                Status harus dipilih
                            </div>
                        </div>
                    </div>

                    <!-- Keterangan  -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan Tambahan" required>
                            <label for="keterangan">
                                <i class="bi bi-info-circle me-2"></i>Info Lainnya
                            </label>
                            <div class="invalid-feedback">
                                Keterangan harus diisi dengan format email yang valid
                            </div>
                        </div>
                    </div>


                    <!-- Foto -->
                    <div class="col-12">
                        <div class="border p-3 rounded">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="form-label">
                                    <i class="bi bi-image me-2"></i>Unggah Foto Profil
                                </label>
                            </div>
                            <div class="input-group">
                                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                                <!-- <label class="input-group-text" for="foto">
                                    <i class="bi bi-upload me-2"></i>Pilih Foto
                                </label> -->
                            </div>

                            <!-- Preview Image dipindah ke sini -->
                            <img id="previewImage" src="#" alt="Preview Foto"
                                class="img-thumbnail mt-3 d-none" style="max-width: 200px;">

                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-2"></i>
                                Ukuran maks. 2MB, format JPG/PNG
                            </small>
                        </div>
                    </div>


                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="<?= route_to('siswa') ?>" class="btn btn-secondary btn-lg d-flex align-items-center">
                            <span>Kembali</span>
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg d-flex align-items-center">
                            <i class="fas fa-save me-2"></i><span>Simpan</span>
                        </button>
                    </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('internshipForm');

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

            // Date validation
            const tglMasuk = document.getElementById('tgl_masuk');
            const tglKeluar = document.getElementById('tgl_keluar');

            if (tglMasuk && tglKeluar) {
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
            }

            // Foto preview
            const fotoInput = document.getElementById('foto');
            const previewImage = document.getElementById('previewImage');

            if (fotoInput && previewImage) {
                fotoInput.addEventListener('change', function(e) {
                    var file = e.target.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            previewImage.src = e.target.result;
                            previewImage.classList.remove('d-none');
                        }
                        reader.readAsDataURL(file);
                    } else {
                        previewImage.src = '#';
                        previewImage.classList.add('d-none');
                    }
                });
            }
        });
    </script>


</body>

<?= $this->endSection(); ?>