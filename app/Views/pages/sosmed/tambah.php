<?= $this->extend('layout/template'); ?>

<?= $this->Section('css'); ?>
<style>
    .platform-preview-icon {
        font-size: 2rem;
        margin-bottom: 10px;
    }
    .platform-option {
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid #e9ecef;
    }
    .platform-option:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .platform-option.selected {
        border-color: #0d6efd;
        background-color: #e7f1ff;
    }
    .facebook-color { color: #3b5998; }
    .twitter-color { color: #1DA1F2; }
    .instagram-color { color: #E1306C; }
    .linkedin-color { color: #0077B5; }
    .tiktok-color { color: #000000; }
    .pinterest-color { color: #E60023; }
    .youtube-color { color: #FF0000; }
</style>
<?= $this->endSection('css'); ?>

<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <!-- Breadcrumb dan Judul -->
        <div class="row g-3 mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= route_to('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= route_to('sosmed') ?>">Social Media</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Akun</li>
                    </ol>
                </nav>
                <h1 class="app-page-title">Tambah Akun Social Media</h1>
            </div>
        </div>

        <!-- Formulir -->
        <div class="app-card app-card-settings shadow-sm mb-4">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Form Tambah Akun</h4>
                    </div>
                </div>
            </div>
            <div class="app-card-body">
                <form action="<?= route_to('sosmed.simpan') ?>" method="post" class="settings-form">
                    <?= csrf_field() ?>

                    <!-- Platform Selection -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Platform <span class="text-danger">*</span></label>
                        <div class="row g-3 mb-2">
                            <div class="col-6 col-md-3">
                                <div class="card platform-option text-center p-3" data-platform="Facebook">
                                    <div class="platform-preview-icon facebook-color">
                                        <i class="fab fa-facebook"></i>
                                    </div>
                                    <h6>Facebook</h6>
                                    <input type="radio" name="platform" value="Facebook" class="d-none" required>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card platform-option text-center p-3" data-platform="Twitter">
                                    <div class="platform-preview-icon twitter-color">
                                        <i class="fab fa-twitter"></i>
                                    </div>
                                    <h6>Twitter</h6>
                                    <input type="radio" name="platform" value="Twitter" class="d-none">
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card platform-option text-center p-3" data-platform="Instagram">
                                    <div class="platform-preview-icon instagram-color">
                                        <i class="fab fa-instagram"></i>
                                    </div>
                                    <h6>Instagram</h6>
                                    <input type="radio" name="platform" value="Instagram" class="d-none">
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card platform-option text-center p-3" data-platform="LinkedIn">
                                    <div class="platform-preview-icon linkedin-color">
                                        <i class="fab fa-linkedin"></i>
                                    </div>
                                    <h6>LinkedIn</h6>
                                    <input type="radio" name="platform" value="LinkedIn" class="d-none">
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-6 col-md-3">
                                <div class="card platform-option text-center p-3" data-platform="TikTok">
                                    <div class="platform-preview-icon tiktok-color">
                                        <i class="fab fa-tiktok"></i>
                                    </div>
                                    <h6>TikTok</h6>
                                    <input type="radio" name="platform" value="TikTok" class="d-none">
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card platform-option text-center p-3" data-platform="Pinterest">
                                    <div class="platform-preview-icon pinterest-color">
                                        <i class="fab fa-pinterest"></i>
                                    </div>
                                    <h6>Pinterest</h6>
                                    <input type="radio" name="platform" value="Pinterest" class="d-none">
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="card platform-option text-center p-3" data-platform="YouTube">
                                    <div class="platform-preview-icon youtube-color">
                                        <i class="fab fa-youtube"></i>
                                    </div>
                                    <h6>YouTube</h6>
                                    <input type="radio" name="platform" value="YouTube" class="d-none">
                                </div>
                            </div>
                        </div>
                        <?php if (isset($validation) && $validation->hasError('platform')) : ?>
                            <div class="text-danger mt-2"><?= $validation->getError('platform') ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Basic Information -->
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="usernamePrefix">@</span>
                                    <input type="text" class="form-control <?= (isset($validation) && $validation->hasError('username')) ? 'is-invalid' : '' ?>" 
                                           id="username" name="username" value="<?= old('username') ?>" 
                                           placeholder="username" required>
                                </div>
                                <?php if (isset($validation) && $validation->hasError('username')) : ?>
                                    <div class="invalid-feedback"><?= $validation->getError('username') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="nama_akun" class="form-label">Nama Akun</label>
                                <input type="text" class="form-control" id="nama_akun" name="nama_akun" 
                                       value="<?= old('nama_akun') ?>" placeholder="Nama akun atau halaman">
                            </div>
                        </div>
                    </div>

                    <!-- Credentials -->
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control <?= (isset($validation) && $validation->hasError('email')) ? 'is-invalid' : '' ?>" 
                                       id="email" name="email" value="<?= old('email') ?>" 
                                       placeholder="email@example.com" required>
                                <?php if (isset($validation) && $validation->hasError('email')) : ?>
                                    <div class="invalid-feedback"><?= $validation->getError('email') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control <?= (isset($validation) && $validation->hasError('password')) ? 'is-invalid' : '' ?>" 
                                           id="password" name="password" required>
                                    <button class="btn btn-outline-secondary toggle-password-input" type="button">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <?php if (isset($validation) && $validation->hasError('password')) : ?>
                                    <div class="invalid-feedback"><?= $validation->getError('password') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Information -->
                    <div class="row mb-3">
                        <div class="col-12 col-md-4">
                            <div class="mb-3">
                                <label for="followers" class="form-label">Followers</label>
                                <input type="number" class="form-control" id="followers" name="followers" 
                                       value="<?= old('followers', 0) ?>" min="0">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="mb-3">
                                <label for="posts" class="form-label">Posts</label>
                                <input type="number" class="form-control" id="posts" name="posts" 
                                       value="<?= old('posts', 0) ?>" min="0">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="mb-3">
                                <label for="id_user" class="form-label">User <span class="text-danger">*</span></label>
                                <select class="form-select <?= (isset($validation) && $validation->hasError('id_user')) ? 'is-invalid' : '' ?>" 
                                        id="id_user" name="id_user" required>
                                    <option value="" selected disabled>Pilih User</option>
                                    <?php if (isset($allUsers) && !empty($allUsers)) : ?>
                                        <?php foreach ($allUsers as $user) : ?>
                                            <option value="<?= $user['id_user'] ?>" <?= old('id_user') == $user['id_user'] ? 'selected' : '' ?>>
                                                <?= $user['nama_user'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <?php if (isset($validation) && $validation->hasError('id_user')) : ?>
                                    <div class="invalid-feedback"><?= $validation->getError('id_user') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= old('keterangan') ?></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="text-end">
                        <a href="<?= route_to('sosmed') ?>" class="btn btn-secondary me-2">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Platform selection
        const platformOptions = document.querySelectorAll('.platform-option');
        platformOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Remove selected class from all options
                platformOptions.forEach(opt => {
                    opt.classList.remove('selected');
                    opt.querySelector('input[type="radio"]').checked = false;
                });
                
                // Add selected class to clicked option
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;
            });
        });

        // Toggle password visibility
        const toggleButton = document.querySelector('.toggle-password-input');
        toggleButton.addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
</script>

<?= $this->endSection('content') ?>