<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <!-- Judul dan Tombol Tambah -->
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Prospek Kirim E-Mail</h1>
            </div>
            <div class="col-auto">
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahProspekModal">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Prospek
                    </a>
                </div>
            </div>
        </div>

        <!-- Notifikasi (Contoh statis) -->
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>Data prospek berhasil disimpan!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <!-- Tabel -->
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Daftar Prospek</h4>
                    </div>
                </div>
            </div>
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell" width="5%">No</th>
                                <th class="cell" width="70%">Judul</th>
                                <th class="cell" width="25%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data Statis -->
                            <tr>
                                <td class="cell">1</td>
                                <td class="cell fw-bold">Prospek Promosi W2B</td>
                                <td class="cell">
                                    <div class="d-flex gap-1">
                                        <a href="<?= route_to('email.detail') ?>" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal1">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell">2</td>
                                <td class="cell fw-bold">Prospek Penulisan Artikel</td>
                                <td class="cell">
                                    <div class="d-flex gap-1">
                                        <a href="#" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal2">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell">3</td>
                                <td class="cell fw-bold">Prospek Webinar</td>
                                <td class="cell">
                                    <div class="d-flex gap-1">
                                        <a href="#" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal3">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Prospek -->
<div class="modal fade" id="tambahProspekModal" tabindex="-1" aria-labelledby="tambahProspekModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="tambahProspekModalLabel">Tambah Prospek Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formTambahProspek">
                    <div class="mb-3">
                        <label for="judulProspek" class="form-label">Judul Prospek <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="judulProspek" name="judulProspek" placeholder="Masukkan judul prospek" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategoriProspek" class="form-label">Kategori</label>
                        <select class="form-select" id="kategoriProspek" name="kategoriProspek">
                            <option value="" selected disabled>Pilih kategori</option>
                            <option value="1">Penjualan</option>
                            <option value="2">Pemasaran</option>
                            <option value="3">Pengembangan Produk</option>
                            <option value="4">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsiProspek" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiProspek" name="deskripsiProspek" rows="3" placeholder="Masukkan deskripsi prospek"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tanggalProspek" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggalProspek" name="tanggalProspek">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Batal
                </button>
                <button type="button" class="btn btn-primary" id="btnSimpanProspek" data-bs-dismiss="modal">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus (Statis) -->
<div class="modal fade" id="deleteModal1" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Prospek</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus prospek berjudul <strong>Prospek Sistem Manajemen Gudang PT Maju Jaya</strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Batal
                </button>
                <a href="#" class="btn btn-danger">
                    <i class="fas fa-trash me-1"></i> Hapus
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal2" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Prospek</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus prospek berjudul <strong>Instalasi Server Baru untuk PT Teknologi Mitra</strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Batal
                </button>
                <a href="#" class="btn btn-danger">
                    <i class="fas fa-trash me-1"></i> Hapus
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal3" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Prospek</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus prospek berjudul <strong>Pengembangan Aplikasi Mobile CV Sentosa Abadi</strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Batal
                </button>
                <a href="#" class="btn btn-danger">
                    <i class="fas fa-trash me-1"></i> Hapus
                </a>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk simulasi simpan data (static) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mendapatkan referensi tombol simpan
    const btnSimpan = document.getElementById('btnSimpanProspek');
    
    // Menambahkan event listener untuk tombol simpan
    if(btnSimpan) {
        btnSimpan.addEventListener('click', function() {
            // Tampilkan notifikasi sukses (yang sudah ada di halaman)
            const alertSuccess = document.querySelector('.alert-success');
            if(alertSuccess) {
                alertSuccess.classList.add('show');
                setTimeout(function() {
                    alertSuccess.classList.remove('show');
                }, 3000); // Notifikasi akan hilang setelah 3 detik
            }
            
            // Reset form
            document.getElementById('formTambahProspek').reset();
        });
    }
});
</script>
 
<?= $this->endSection('content') ?>