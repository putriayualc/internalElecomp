<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <!-- Judul dan Tombol Tambah -->
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Data Hosting</h1>
            </div>
            <div class="col-auto">
                <div class="d-flex gap-2">
                    <a href="<?= route_to('hosting.tambah') ?>" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Hosting
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
                        <h4 class="app-card-title">Daftar Hosting</h4>
                    </div>
                    <!-- <div class="col-auto">
                        <div class="card-header-action">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari hosting..." id="searchData">
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
                                <th class="cell" width="15%">Domain Utama</th>
                                <th class="cell" width="15%">Username</th>
                                <th class="cell" width="15%">Password</th>
                                <th class="cell" width="25%">Add On Domain</th>
                                <th class="cell" width="25%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1; ?>
                            <?php foreach ($allHosting as $host) : ?>
                                <tr>
                                    <td class="cell"><?= $counter++ ?></td>
                                    <td class="cell fw-bold">
                                        <a href="https://<?= esc($host['domain_utama']) ?>" target="_blank" class="text-decoration-none text-secondary">
                                            <?= esc($host['domain_utama']) ?>
                                        </a>
                                    </td>
                                    <td class="cell"><?= esc($host['username_hosting']) ?></td>
                                    <td class="cell">
                                        <div class="d-flex align-items-center">
                                            <span class="password-mask">••••••••</span>
                                            <button class="btn btn-sm btn-outline-primary ms-2 toggle-password" data-password="<?= esc($host['password_hosting']) ?>" type="button">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="cell">
                                        <?php if (!empty($host['add_on_domain'])): ?>
                                            <?php
                                            $addOnDomains = explode(',', $host['add_on_domain']);
                                            foreach ($addOnDomains as $index => $domain) :
                                                $trimmedDomain = trim($domain);
                                            ?>
                                                <div class="mb-1">
                                                    <i class="fas fa-link me-1"></i>
                                                    <a href="https://<?= esc($trimmedDomain) ?>" target="_blank" class="text-decoration-none">
                                                        <?= esc($trimmedDomain) ?>
                                                    </a>
                                                </div>
                                                <?php if ($index < count($addOnDomains) - 1): ?>
                                                    <hr class="my-1">
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <span class="text-muted"><em>Tidak ada</em></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="cell">
                                        <div class="d-flex gap-1">
                                            <a href="<?= route_to('hosting.detail', $host['id_hosting']) ?>" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye me-1"></i> Lihat
                                            </a>
                                            <a href="<?= route_to('hosting.edit', $host['id_hosting']) ?>" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit me-1"></i> Ubah
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $host['id_hosting'] ?>">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            
                            <?php if (empty($allHosting)) : ?>
                                <tr>
                                    <td colspan="6" class="text-center py-3">Tidak ada data yang tersedia</td>
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
<?php foreach ($allHosting as $host) : ?>
    <div class="modal fade" id="deleteModal<?= $host['id_hosting'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Hosting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus hosting dengan domain utama <strong><?= esc($host['domain_utama']) ?></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <a href="<?= route_to('hosting.delete', $host['id_hosting']) ?>" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Script untuk Toggle Password -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        const toggleButtons = document.querySelectorAll('.toggle-password');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const passwordContainer = this.closest('td').querySelector('.password-mask');
                const icon = this.querySelector('i');

                if (passwordContainer.textContent === '••••••••') {
                    passwordContainer.textContent = this.getAttribute('data-password');
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordContainer.textContent = '••••••••';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        // Filter functionality (jika diaktifkan)
        const searchInput = document.getElementById('searchData');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchValue = this.value.toLowerCase();
                const tableRows = document.querySelectorAll('tbody tr');

                tableRows.forEach(row => {
                    const domain = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
                    const username = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || '';
                    const addOnDomains = row.querySelector('td:nth-child(5)')?.textContent.toLowerCase() || '';

                    if (domain.includes(searchValue) || username.includes(searchValue) || addOnDomains.includes(searchValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });
</script>

<?= $this->endSection() ?>