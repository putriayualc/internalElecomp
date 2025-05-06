<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Tambahkan Email</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="card-body">

                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                        <div class="alert alert-danger" role="alert">
                            <h4>Error</h4>
                            <p><?php echo session()->getFlashdata('error'); ?></p>
                        </div>
                    <?php endif; ?>

                    <form action="<?= route_to('email.simpan') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Email <br></label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?= old('email') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password <br></label>
                                    <input type="text" class="form-control" id="password" name="password" value="<?= old('password') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama User <br></label>
                                    <select class="form-select select2" name="id_user">
                                        <option value="">-- Pilih User --</option>
                                        <?php foreach ($allUsers as $user): ?>
                                            <option value="<?= $user['id_user']; ?>">
                                                <?= $user['nama'] ?? $user['username']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Domain Blog <br></label>
                                    <div id="domain-container">
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="domain_blog[]" placeholder="ex : coba.blogspot.com">
                                            <button class="btn btn-success add-domain" type="button">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            <div class="col">
                                <?php if (!empty(session()->getFlashdata('success'))) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo session()->getFlashdata('success') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!--//app-card-->
        </div><!--//row-->

        <hr class="my-4">
    </div><!--//container-fluid-->
</div><!--//app-content-->

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
                <input type="text" class="form-control" name="domain_blog[]" placeholder="Masukkan domain blog">
                <button class="btn btn-danger remove-domain" type="button">-</button>
            `;
                container.appendChild(newGroup);
            }

            // Remove domain input
            if (e.target && e.target.classList.contains('remove-domain')) {
                e.target.closest('.input-group').remove();
            }
        });
    });
</script>

<?= $this->endSection('content'); ?>