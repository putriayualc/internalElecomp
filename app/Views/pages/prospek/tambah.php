<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <!-- Judul Halaman -->
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Tambah Prospek Elecomp</h1>
            </div>
            <div class="col-auto">
                <a href="<?= route_to('prospek.index') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="app-card app-card-settings shadow-sm mb-4">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Formulir Prospek Baru</h4>
                    </div>
                </div>
            </div>
            <div class="app-card-body p-4">
                <form action="<?= route_to('prospek.index') ?>" method="POST">
                    <!-- CSRF Token (untuk keamanan) -->
                    <?= csrf_field() ?>
                    
                    <!-- Informasi Umum -->
                    <div class="mb-4">
                        <h5 class="mb-3">Informasi Umum</h5>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Prospek <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="judul" name="judul" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-select" id="kategori" name="kategori" required>
                                        <option value="" selected disabled>Pilih Kategori</option>
                                        <option value="1">Pengembangan Aplikasi</option>
                                        <option value="2">Implementasi Sistem</option>
                                        <option value="3">Instalasi Jaringan</option>
                                        <option value="4">Konsultasi IT</option>
                                        <option value="5">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="tanggal_dibuat" class="form-label">Tanggal Dibuat <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tanggal_dibuat" name="tanggal_dibuat" value="<?= date('Y-m-d') ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status Prospek <span class="text-danger">*</span></label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="" selected disabled>Pilih Status</option>
                                        <option value="1">Potensial</option>
                                        <option value="2">Sedang Berjalan</option>
                                        <option value="3">Selesai</option>
                                        <option value="4">Batal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi Prospek <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Informasi Klien -->
                    <div class="mb-4">
                        <h5 class="mb-3">Informasi Klien</h5>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="nama_klien" class="form-label">Nama Perusahaan/Klien <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_klien" name="nama_klien" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="email_kien" class="form-label">Email Klien</label>
                                    <input type="email" class="form-control" id="email_klien" name="email_klien">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="telepon_klien" class="form-label">Telepon Klien</label>
                                    <input type="text" class="form-control" id="telepon_klien" name="telepon_klien">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="kontak_person" class="form-label">Nama Kontak Person</label>
                                    <input type="text" class="form-control" id="kontak_person" name="kontak_person">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="alamat_klien" class="form-label">Alamat Klien</label>
                                    <textarea class="form-control" id="alamat_klien" name="alamat_klien" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Detail Proyek -->
                    <div class="mb-4">
                        <h5 class="mb-3">Detail Proyek</h5>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="nilai_proyek" class="form-label">Estimasi Nilai Proyek (Rp)</label>
                                    <input type="text" class="form-control" id="nilai_proyek" name="nilai_proyek">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="estimasi_waktu" class="form-label">Estimasi Waktu (hari)</label>
                                    <input type="number" class="form-control" id="estimasi_waktu" name="estimasi_waktu" min="1">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="tanggal_target" class="form-label">Tanggal Target Penyelesaian</label>
                                    <input type="date" class="form-control" id="tanggal_target" name="tanggal_target">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="prioritas" class="form-label">Prioritas</label>
                                    <select class="form-select" id="prioritas" name="prioritas">
                                        <option value="" selected disabled>Pilih Prioritas</option>
                                        <option value="1">Rendah</option>
                                        <option value="2">Sedang</option>
                                        <option value="3">Tinggi</option>
                                        <option value="4">Urgent</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Catatan Tambahan -->
                    <div class="mb-4">
                        <h5 class="mb-3">Catatan Tambahan</h5>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan</label>
                                    <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="perlu_tindak_lanjut" name="perlu_tindak_lanjut">
                                    <label class="form-check-label" for="perlu_tindak_lanjut">
                                        Perlu tindak lanjut segera
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Dokumen Pendukung -->
                    <div class="mb-4">
                        <h5 class="mb-3">Dokumen Pendukung</h5>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="file_dokumen" class="form-label">Upload Dokumen (opsional)</label>
                                    <input type="file" class="form-control" id="file_dokumen" name="file_dokumen" multiple>
                                    <div class="form-text">Format yang didukung: PDF, DOC, DOCX, XLS, XLSX (Maks. 5MB)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tombol Submit dan Reset -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <button type="reset" class="btn btn-secondary">
                                    <i class="fas fa-undo me-1"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Simpan Prospek
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk menangani form secara statis -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validasi sederhana
        const judul = document.getElementById('judul').value;
        const kategori = document.getElementById('kategori').value;
        const deskripsi = document.getElementById('deskripsi').value;
        const namaKlien = document.getElementById('nama_klien').value;
        
        if (!judul || !kategori || !deskripsi || !namaKlien) {
            alert('Mohon lengkapi semua field yang wajib diisi (bertanda *)');
            return;
        }
        
        // Redirect ke halaman daftar dengan parameter success
        window.location.href = '<?= route_to('prospek.index') ?>?status=success&message=Data+prospek+berhasil+disimpan';
    });
});
</script>

<?= $this->endSection('content') ?>