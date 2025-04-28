<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Data Hosting</h1>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="<?= route_to('hosting.tambah') ?>" class="btn btn-primary me-md-2"> + Tambah Hosting</a>
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
                                <th class="text-center">No</th>
                                <th class="text-center">Domain Utama</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Password</th>
                                <th class="text-center">Add On Domain</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($allHosting as $i => $host) : ?>
                                <tr>
                                    <td class="text-center"><?= $i + 1 ?></td>
                                    <td class="text-center"><?= esc($host['domain_utama']) ?></td>
                                    <td class="text-center"><?= esc($host['username_hosting']) ?></td>
                                    <td class="text-center"><?= esc($host['password_hosting']) ?></td>
                                    <td class="text-start">
                                        <?php if (!empty($host['add_on_domain'])): ?>
                                            <?php
                                            $addOnDomains = explode(',', $host['add_on_domain']);
                                            foreach ($addOnDomains as $index => $domain) :
                                                $trimmedDomain = trim($domain);
                                            ?>
                                                <div class="mb-1">
                                                    🔗 <a href="http://<?= esc($trimmedDomain) ?>" target="_blank" rel="noopener noreferrer">
                                                        <?= esc($trimmedDomain) ?>
                                                    </a>
                                                </div>
                                                <?php if ($index < count($addOnDomains) - 1): ?>
                                                    <hr class="my-1">
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <em>Tidak ada</em>
                                        <?php endif; ?>
                                    </td>


                                    <td class="text-center">
                                        <div class="d-grid gap-2">
                                            <a href="<?= route_to('hosting.detail', $host['id_hosting']) ?>" class="btn btn-info">Lihat</a>
                                            <a href="<?= route_to('hosting.edit', $host['id_hosting']) ?>" class="btn btn-primary">Ubah</a>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $host['id_hosting'] ?>">
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
<?php foreach ($allHosting as $host) : ?>
    <div class="modal fade" id="deleteModal<?= $host['id_hosting'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus hosting dengan domain utama "<strong><?= esc($host['domain_utama']) ?></strong>"?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="<?= route_to('hosting.delete', $host['id_hosting']) ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection() ?>