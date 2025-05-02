<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <!-- Judul dan Tombol Tambah -->
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">List Prospek ECP</h1>
            </div>
            <div class="col-auto">
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>TAMBAH
                    </a>
                </div>
            </div>
        </div>

        <!-- Tabel -->
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">No</th>
                                <th class="cell">Nama Perusahaan</th>
                                <th class="cell">Alamat</th>
                                <th class="cell">No HP</th>
                                <th class="cell">No Telepon</th>
                                <th class="cell">Email</th>
                                <th class="cell">Website</th>
                                <th class="cell">Keterangan Lainnya</th>
                                <th class="cell">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="cell">1</td>
                                <td class="cell">Perusahaan A</td>
                                <td class="cell">Jln. Soekarno Hatta</td>
                                <td class="cell">087568084257</td>
                                <td class="cell">03378998</td>
                                <td class="cell">perusahaan@gmail.com</td>
                                <td class="cell">perusahaan.com</td>
                                <td class="cell">-</td>
                                <td class="cell">
                                    <div class="d-flex gap-1">
                                        <a href="#" class="btn btn-sm btn-info">
                                            Lihat
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning">
                                            Edit
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal1">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell">2</td>
                                <td class="cell">Perusahaan B</td>
                                <td class="cell">Jln. Kertosono</td>
                                <td class="cell">086479156294</td>
                                <td class="cell">084280</td>
                                <td class="cell">perusahaan1@gmail.com</td>
                                <td class="cell">perusahaan1.com</td>
                                <td class="cell">-</td>
                                <td class="cell">
                                    <div class="d-flex gap-1">
                                        <a href="#" class="btn btn-sm btn-info">
                                            Lihat
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning">
                                            Edit
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal2">
                                            Hapus
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

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal1" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Prospek</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus prospek <strong>Perusahaan A</strong>?</p>
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
                <p>Apakah Anda yakin ingin menghapus prospek <strong>Perusahaan B</strong>?</p>
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

<?= $this->endSection('content') ?>