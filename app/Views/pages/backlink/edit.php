<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Edit Email</h1>
        <hr class="mb-4">

        <?php if (!empty(session()->getFlashdata('error'))) : ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('error') as $err) : ?>
                        <li><?= esc($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>


        <?php if (!empty(session()->getFlashdata('success'))) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>

        <form action="<?= route_to('email.update', $email['id_email']) ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= old('email', $email['email']) ?>">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" id="password" name="password" value="<?= old('password', $email['password']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Nama User <br></label>
                <select class="form-select" name="id_user">
                    <option value="">-- Pilih User --</option>
                    <?php foreach ($allUsers as $user): ?>
                        <option value="<?= $user['id_user']; ?>" <?= ($user['id_user'] == $email['id_user']) ? 'selected' : ''; ?>>
                            <?= $user['nama'] ?? $user['username']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Domain Blog</label>
                <div id="domain-container">
                    <?php if (isset($blogs) && is_array($blogs) && count($blogs) > 0): ?>
                        <?php foreach ($blogs as $domain): ?>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="domain_blog[]" value="<?= $domain['domain_blog'] ?>" placeholder="Masukkan domain blog">
                                <input type="hidden" name="domain_id[]" value="<?= $domain['id_blog'] ?>">
                                <button class="btn btn-success add-domain" type="button">+</button>
                                <button class="btn btn-danger remove-domain" type="button" data-bs-toggle="modal" data-bs-target="#deleteBlogModal<?= $domain['id_blog'] ?>">-</button>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="domain_blog[]" placeholder="ex : users@gmail.com">
                            <button class="btn btn-success add-domain" type="button">+</button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <a href="<?= route_to('backlink') ?>" class="btn btn-secondary">← Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?php foreach ($blogs as $domain): ?>
    <div class="modal fade" id="deleteBlogModal<?= $domain['id_blog'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus blog <strong><?= $domain['domain_blog'] ?></strong>?</p>
                    <p class="text-danger"><small><i class="fas fa-exclamation-triangle me-1"></i> Semua blog dan artikel terkait akan ikut terhapus!</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <a href="<?= route_to('blog.hapus', $domain['id_email'], $domain['id_blog']) ?>" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- JavaScript for dynamic domain inputs -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add new domain input
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('add-domain')) {
                const container = document.getElementById('domain-container');
                const newGroup = document.createElement('div');
                newGroup.className = 'input-group mb-2';
                newGroup.innerHTML = `
                <input type="text" class="form-control" name="domain_blog[]" placeholder="ex : users@gmail.com">
                <input type="hidden" name="domain_id[]" value="0">
                <button class="btn btn-danger remove-new-domain" type="button">-</button>
            `;
                container.appendChild(newGroup);
            }

            // Untuk hapus input domain baru
            if (e.target && e.target.classList.contains('remove-new-domain')) {
                e.target.closest('.input-group').remove();
            }
        });
    });
</script>

<?= $this->endSection(); ?>