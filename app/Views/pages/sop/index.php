<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">SOP Elecomp</h1>
            </div>
            </br>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="<?= route_to('sop.tambah') ?>" class="btn btn-primary me-md-2"> + Tambah SOP</a>
            </div>
        </div>

        <?php if (session()->has('success')) : ?>
            <div class="alert alert-success">
                <?= session('success') ?>
            </div>
        <?php endif; ?>

        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="text-center" valign="middle">No</th>
                                <th class="text-center" valign="middle">Judul SOP</th>
                                <th class="text-center" valign="middle">Detail</th>
                                <th class="text-center" valign="middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($allSop as $i => $sop) : ?>
                                <tr>
                                    <td class="text-center"><?= $i + 1 ?></td>
                                    <td class="text-center"><?= $sop['judul_sop'] ?></td>
                                    <td class="text-center"><?= $sop['detail_sop'] ?></td>
                                    <td class="text-center">
                                        <div class="d-grid gap-2">
                                            <a href="<?= route_to('sop.detail', $sop['id_sop']) ?>" class="btn btn-info">Lihat</a>
                                            <a href="<?= route_to('sop.edit', $sop['id_sop']) ?>" class="btn btn-primary">Ubah</a>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $sop['id_sop'] ?>">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div><!--//table-responsive-->
            </div><!--//app-card-body-->
        </div><!--//app-card-->
    </div><!--//container-xl-->
</div><!--//app-content-->

<!-- Modal Konfirmasi Hapus -->
<?php foreach ($allSop as $sop) : ?>
    <div class="modal fade" id="deleteModal<?= $sop['id_sop'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus SOP berjudul "<strong><?= $sop['judul_sop'] ?></strong>"?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="<?= route_to('sop.delete', $sop['id_sop']) ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection('content') ?>
