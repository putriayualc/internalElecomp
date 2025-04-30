<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <!-- Judul dan Tombol Tambah -->
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">SOP Elecomp</h1>
            </div>
            <div class="col-auto">
                <div class="d-flex gap-2">
                    <a href="<?= route_to('sop.tambah') ?>" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Tambah SOP
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
                        <h4 class="app-card-title">Daftar SOP</h4>
                    </div>
                    <!-- <div class="col-auto">
                        <div class="card-header-action">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari SOP..." id="searchData">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell" width="5%">No</th>
                                <th class="cell" width="25%">Judul SOP</th>
                                <th class="cell" width="45%">Detail</th>
                                <th class="cell" width="25%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1; ?>
                            <?php foreach ($allSop as $sop) : ?>
                                <tr>
                                    <td class="cell"><?= $counter++ ?></td>
                                    <td class="cell fw-bold"><?= $sop['judul_sop'] ?></td>
                                    <td class="cell">
                                        <?= strlen($sop['detail_sop']) > 50 ? substr($sop['detail_sop'], 0, 50) . '...' : $sop['detail_sop'] ?>
                                    </td>
                                    <td class="cell">
                                        <div class="d-flex gap-1">
                                            <a href="<?= route_to('sop.detail', $sop['id_sop']) ?>" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye me-1"></i> Lihat
                                            </a>
                                            <a href="<?= route_to('sop.edit', $sop['id_sop']) ?>" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $sop['id_sop'] ?>">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            
                            <?php if (empty($allSop)) : ?>
                                <tr>
                                    <td colspan="4" class="text-center py-3">Tidak ada data yang tersedia</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<?php foreach ($allSop as $sop) : ?>
    <div class="modal fade" id="deleteModal<?= $sop['id_sop'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus SOP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus SOP berjudul <strong><?= $sop['judul_sop'] ?></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <a href="<?= route_to('sop.delete', $sop['id_sop']) ?>" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Script untuk fitur pencarian (opsional) -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Jika implementasi pencarian diaktifkan
        const searchInput = document.getElementById('searchData');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchValue = this.value.toLowerCase();
                const tableRows = document.querySelectorAll('tbody tr');

                tableRows.forEach(row => {
                    const judul = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
                    const detail = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || '';

                    if (judul.includes(searchValue) || detail.includes(searchValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });
</script>

<?= $this->endSection('content') ?>