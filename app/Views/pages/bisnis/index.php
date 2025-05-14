<?= $this->extend('layout/template'); ?>

<?= $this->Section('css'); ?>
<style>
    .hover-badge {
        background-color: rgb(0, 144, 216) !important;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .hover-badge:hover {
        background-color: rgb(59, 190, 255) !important;
        color: #fff !important;
    }
</style>

<?= $this->endSection('css'); ?>

<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <!-- Judul dan Tombol Tambah -->
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Bisnis</h1>
            </div>
            <div class="col-auto">
                <div class="d-flex gap-2">
                    <a href="<?= route_to('bisnis.tambah') ?>" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Bisnis
                    </a>
                </div>
            </div>
        </div>

        <!-- Notifikasi -->
        <?php if (session()->has('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i><?= session('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Tabel -->
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Daftar Bisnis</h4>
                    </div>
                </div>
            </div>
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell" width="5%">No</th>
                                <th class="cell" width="20%">Nama Bisnis</th>
                                <th class="cell" width="20%">Website</th>
                                <th class="cell" width="8%">Jumlah Sosmed</th>
                                <th class="cell" width="25%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $counter = 1; ?>
                            <?php foreach ($allBisnis as $bisnis) : ?>
                                <tr>
                                    <td class="cell"><?= $counter++; ?></td>
                                    <td class="cell"><?= $bisnis['nama_bisnis']; ?></td>
                                    <td class="cell"><?= $bisnis['website']; ?></td>
                                    <td class="cell">
                                        <div class="d-flex flex-column">
                                            <a href="#"
                                                class="badge text-dark text-decoration-none hover-badge">
                                                <?= isset($bisnis['jumlah_sosmed']) ? $bisnis['jumlah_sosmed'] : 0 ?>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="cell" style="vertical-align: top;">
                                        <div class="d-flex gap-1">
                                        
                                            <a href="#" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteBisnisModal<?= $bisnis['id_bisnis'] ?>">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>                         
                                           
                           
                            <?php endforeach; ?>

                            <?php if (empty($allBisnis)) : ?>
                                <tr>
                                    <td colspan="5" class="text-center py-3">Tidak ada data yang tersedia</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Bisnis -->
<?php foreach ($allBisnis as $bisnis) : ?>
    <div class="modal fade" id="deleteBisnisModal<?= $bisnis['id_bisnis'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data <strong><?= $bisnis['nama_bisnis'] ?></strong>?</p>
                    <p class="text-danger"><small><i class="fas fa-exclamation-triangle me-1"></i> Semua data terkait akan ikut terhapus!</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <a href="<?= route_to('bisnis.hapus', $bisnis['id_bisnis']) ?>" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>


<?= $this->endSection('content') ?>