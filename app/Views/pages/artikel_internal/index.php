<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="app-page-title mb-0">Data Artikel Internal</h1>
            <a href="<?= route_to('artikel_internal.tambah') ?>" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Artikel
            </a>
        </div>

        <!-- Flash Success -->
        <?php if (session()->has('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> <?= session('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Table -->
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body p-3 p-lg-4">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Judul Artikel</th>
                                <th>Tanggal Upload</th>
                                <th>Link</th>
                                <th>Keyword</th>
                                <th>Bisnis</th>
                                <?php if (session()->get('role')  === 'admin') : ?>
                                    <th>User</th>
                                <?php endif; ?>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($allArtikel)) : ?>
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <i class="fas fa-info-circle text-info me-2"></i>
                                        Belum ada artikel yang ditambahkan.
                                    </td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($allArtikel as $i => $artikel) : ?>
                                    <tr>
                                        <td class="text-center"><?= $i + 1 ?></td>
                                        <td><?= esc($artikel['judul_artikel']) ?></td>
                                        <td><?= date('d M Y', strtotime($artikel['tgl_upload'])) ?></td>
                                        <td class="text-break"><?= esc($artikel['link']) ?></td>
                                        <td><?= esc($artikel['keyword']) ?></td>
                                        <td><?= esc($artikel['nama_bisnis']) ?></td>
                                        <?php if (session()->get('role')  === 'admin') : ?>
                                            <td><?= esc($artikel['username']) ?></td>
                                        <?php endif; ?>
                                        <td class="text-center">
                                            <a href="<?= base_url('artikel_internal/edit/' . $artikel['id_artikel_internal']) ?>" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $artikel['id_artikel_internal'] ?>">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <?php foreach ($allArtikel as $artikel) : ?>
            <div class="modal fade" id="deleteModal<?= $artikel['id_artikel_internal'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title">
                                <i class="fas fa-exclamation-triangle me-2"></i> Konfirmasi Hapus
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus artikel <strong><?= esc($artikel['judul_artikel']) ?></strong>?
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <a href="<?= base_url('artikel_internal/delete/' . $artikel['id_artikel_internal']) ?>" class="btn btn-danger">
                                Hapus
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<?= $this->endSection(); ?>