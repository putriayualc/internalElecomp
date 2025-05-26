<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <!-- Back Navigation -->
        <div class="col-md-4 text-lg mt-3 mt-md-0">
            <a href="<?= route_to('backlink') ?>" class="btn btn-outline-secondary me-2">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <!-- Header Section -->
        <div class="app-card shadow-sm mb-4">
            <div class="app-card-body p-3 p-lg-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="app-page-title mb-0">Data Artikel</h1>
                        <div class="d-flex align-items-center mt-2">
                            <span class="badge bg-primary me-2">Blog:</span>
                            <h5 class="mb-0"><?= $blog['domain_blog'] ?? 'Untitled Blog' ?></h5>
                        </div>
                        <p class="text-muted mt-2 mb-0">
                            <i class="fas fa-info-circle me-1"></i>
                            Kelola semua artikel untuk blog "<?= $blog['domain_blog'] ?? 'Untitled Blog' ?>"
                        </p>
                    </div>
                    <div class="d-flex">
                        <a href="<?= route_to('artikel.tambah', $blog['id_email'], $blog['id_blog']) ?>" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> <?= $addText ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifikasi sukses -->
        <?php if (session()->has('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> <?= session('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Tabel Artikel -->
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-header p-3 p-lg-4 border-bottom">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title mb-0"><i class="fas fa-newspaper text-primary me-2"></i>Daftar Artikel</h4>
                    </div>
                    <div class="col text-end">
                        <span class="badge bg-primary rounded-pill"><?= count($allArtikel) ?> Artikel</span>
                    </div>
                </div>
            </div>
            <div class="app-card-body p-3 p-lg-4">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 text-left">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="white-space: nowrap;">No</th>
                                <th style="min-width: 200px;">Judul Artikel</th>
                                <th style="white-space: nowrap;">Tanggal Upload</th>
                                <th style="min-width: 150px;">Link</th>
                                <th style="min-width: 100px;">Link To</th>
                                <th style="min-width: 80px;">Link Type</th>
                                <th style="min-width: 110px;">Keywords</th>
                                <th style="min-width: 110px;">Anchor Text</th>
                                <th class="text-center" style="white-space: nowrap;">Indexed</th>
                                <th class="text-center" style="white-space: nowrap;">Jenis</th>
                                <th class="text-center" style="white-space: nowrap;">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (empty($allArtikel)) : ?>
                                <tr>
                                    <td colspan="11" class="text-center py-4">
                                        <div class="py-3">
                                            <i class="fas fa-info-circle text-info mb-2 fa-2x"></i>
                                            <p class="mb-0">Belum ada artikel yang ditambahkan</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($allArtikel as $i => $artikel) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i + 1 ?></td>
                                        <td class="fw-bold text-break"><?= $artikel['judul_artikel'] ?></td>
                                        <td class="text-center"><?= date('d M Y', strtotime($artikel['tgl_upload'])) ?></td>
                                        <td class="text-break" style="max-width: 200px;" title="<?= $artikel['link'] ?>"><?= $artikel['link'] ?></td>
                                        <td class="text-break"><?= $artikel['link_to'] ?></td>
                                        <td class="text-break"><?= $artikel['link_type'] ?></td>
                                        <td class="text-break" style="max-width: 200px;" title="<?= $artikel['keywords'] ?>"><?= $artikel['keywords'] ?></td>
                                        <td class="text-break"><?= $artikel['anchor_text'] ?></td>
                                        <td class="text-center">
                                            <span class="badge bg-<?= $artikel['indexed'] == 'sudah' ? 'success' : 'danger' ?>">
                                                <?= ucfirst($artikel['indexed']) ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-<?= $artikel['jenis'] == 'backlink' ? 'info' : 'success' ?>">
                                                <?= ucfirst($artikel['jenis']) ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2 flex-wrap">
                                                <a href="<?= route_to('artikel.edit', $blog['id_email'], $blog['id_blog'], $artikel['id_artikel']) ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit me-1"></i> Ubah
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $artikel['id_artikel'] ?>">
                                                    <i class="fas fa-trash me-1"></i> Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div><!--//table-responsive-->
            </div><!--//app-card-body-->
        </div><!--//app-card-->
    </div><!--//container-fluid-->
</div><!--//app-content-->

<!-- Modal Konfirmasi Hapus -->
<?php foreach ($allArtikel as $artikel) : ?>
    <div class="modal fade" id="deleteModal<?= $artikel['id_artikel'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i> Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <p class="mb-0">Apakah Anda yakin ingin menghapus artikel <strong>"<?= $artikel['judul_artikel'] ?>"</strong>?</p>
                    <p class="text-muted small mt-2 mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <a href="<?= route_to('artikel.hapus', $blog['id_email'], $blog['id_blog'], $artikel['id_artikel']) ?>" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection('content') ?>