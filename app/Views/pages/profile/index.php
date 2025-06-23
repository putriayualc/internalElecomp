<?= $this->extend('layout/template'); ?>
<?= $this->section('css') ?>
<style>
    .profile-wrapper {
        min-height: 100vh;
        padding: 2rem 0;
    }

    .profile-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .profile-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        border-radius: 24px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
    }

    .profile-header {
        background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
        padding: 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: repeating-linear-gradient(45deg,
                transparent,
                transparent 2px,
                rgba(255, 255, 255, 0.05) 2px,
                rgba(255, 255, 255, 0.05) 4px);
        animation: slide 20s linear infinite;
    }

    @keyframes slide {
        0% {
            transform: translate(-50%, -50%) rotate(0deg);
        }

        100% {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }

    .profile-title {
        color: white;
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        position: relative;
        z-index: 2;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .profile-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1rem;
        margin-top: 0.5rem;
        position: relative;
        z-index: 2;
    }

    .profile-content {
        display: flex;
        min-height: 600px;
    }

    .profile-left {
        flex: 0 0 350px;
        background: linear-gradient(135deg, #f8f9ff 0%, #e3f2fd 100%);
        padding: 2.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        border-right: 1px solid rgba(33, 150, 243, 0.1);
    }

    .profile-right {
        flex: 1;
        background: white;
        padding: 2.5rem;
    }

    .profile-avatar-section {
        text-align: center;
        margin-bottom: 2rem;
    }

    .profile-avatar-container {
        position: relative;
        display: inline-block;
        margin-bottom: 1.5rem;
    }

    .profile-avatar {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        border: 6px solid #2196F3;
        box-shadow: 0 20px 40px rgba(33, 150, 243, 0.3);
        transition: all 0.3s ease;
        object-fit: cover;
    }

    .profile-avatar:hover {
        transform: scale(1.05);
        box-shadow: 0 25px 50px rgba(33, 150, 243, 0.4);
    }

    .avatar-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1976D2;
        margin-bottom: 0.5rem;
        text-align: center;
    }

    .avatar-role {
        font-size: 1rem;
        color: #666;
        margin-bottom: 1rem;
        text-align: center;
    }

    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
        width: 100%;
        margin-bottom: 2rem;
    }

    .btn-modern {
        padding: 0.8rem 1.5rem;
        border-radius: 50px;
        border: none;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
    }

    .btn-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .btn-modern:hover::before {
        left: 100%;
    }

    .btn-edit {
        background: linear-gradient(135deg, rgb(0, 0, 255) 0%, rgb(0, 0, 255) 100%);
        color: white;
    }

    .btn-edit:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(255, 152, 0, 0.4);
        color: white;
    }

    .btn-password {
        background: linear-gradient(135deg, #9C27B0 0%, #7B1FA2 100%);
        color: white;
    }

    .btn-password:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(156, 39, 176, 0.4);
        color: white;
    }

    .profile-stats {
        width: 100%;
        margin-bottom: 2rem;
    }

    .stat-item {
        background: rgba(255, 255, 255, 0.8);
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        text-align: center;
        border: 1px solid rgba(33, 150, 243, 0.1);
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        background: rgba(255, 255, 255, 1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        font-size: 2rem;
        color: #2196F3;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 0.25rem;
    }

    .stat-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .form-group {
        position: relative;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-control-modern {
        width: 100%;
        padding: 1rem 3rem 1rem 1.2rem;
        border: 2px solid #E3F2FD;
        border-radius: 12px;
        background: rgba(227, 242, 253, 0.3);
        font-size: 1rem;
        transition: all 0.3s ease;
        color: #333;
        font-weight: 500;
    }

    .form-control-modern:focus {
        outline: none;
        border-color: #2196F3;
        background: rgba(227, 242, 253, 0.5);
        box-shadow: 0 0 0 4px rgba(33, 150, 243, 0.1);
    }

    .form-label {
        position: absolute;
        top: -0.7rem;
        left: 1rem;
        background: white;
        padding: 0 0.5rem;
        font-size: 0.9rem;
        font-weight: 600;
        color: #2196F3;
        border-radius: 4px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .form-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #2196F3;
        font-size: 1.1rem;
    }

    .status-container {
        position: relative;
        padding-top: 1rem;
    }

    .status-badge-modern {
        display: inline-flex;
        align-items: center;
        padding: 0.7rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .status-active {
        background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
        color: white;
        box-shadow: 0 8px 20px rgba(76, 175, 80, 0.3);
    }

    .status-inactive {
        background: linear-gradient(135deg, #757575 0%, #616161 100%);
        color: white;
        box-shadow: 0 8px 20px rgba(117, 117, 117, 0.3);
    }

    .status-badge-modern::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.9);
        margin-right: 0.5rem;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1976D2;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #E3F2FD;
    }

    @media (max-width: 992px) {
        .profile-content {
            flex-direction: column;
        }

        .profile-left {
            flex: none;
            border-right: none;
            border-bottom: 1px solid rgba(33, 150, 243, 0.1);
            padding: 2rem;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
        }

        .action-buttons {
            flex-direction: row;
            justify-content: center;
            gap: 1rem;
        }

        .btn-modern {
            flex: 1;
            max-width: 200px;
        }
    }

    @media (max-width: 768px) {
        .profile-wrapper {
            padding: 1rem;
        }

        .profile-left,
        .profile-right {
            padding: 1.5rem;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .action-buttons {
            flex-direction: column;
            gap: 0.8rem;
        }

        .btn-modern {
            max-width: none;
        }

        .profile-title {
            font-size: 1.5rem;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
        }
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>

<div class="profile-wrapper">
    <div class="profile-container">
        <div class="card profile-card">
            <div class="profile-header">
                <h2 class="profile-title">Profil Pengguna</h2>
                <p class="profile-subtitle">Informasi lengkap pengguna sistem</p>
            </div>

            <div class="profile-content">
                <!-- Left Side - Photo and Actions -->
                <div class="profile-left">
                    <div class="profile-avatar-section">
                        <div class="profile-avatar-container position-relative">
                            <?php
                            $fotoProfil = !empty($foto) && file_exists(FCPATH . 'assets/img/user/' . $foto)
                                ? base_url('assets/img/user/' . $foto)
                                : base_url('assets/img/avatar.png');
                            ?>
                            <img src="<?= $fotoProfil ?>" class="profile-avatar" alt="Foto Profil">

                            <!-- Icon pensil -->
                            <button type="button" class="btn btn-sm btn-light position-absolute bottom-0 end-0 rounded-circle shadow"
                                data-bs-toggle="modal" data-bs-target="#gantiFotoModal" title="Ganti Foto">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                        </div>

                        <div class="avatar-name"><?= esc($nama) ?></div>
                        <div class="avatar-role"><?= esc($jurusan) ?></div>

                        <!-- Action buttons moved here, right below the name/role -->
                        <div class="action-buttons">
                            <a href="<?= base_url('profile/ganti-password') ?>" class="btn-modern btn-password" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                <i class="bi bi-key-fill me-2"></i>Ganti Password
                            </a>
                        </div>
                    </div>

                    <div class="profile-stats">
                        <!-- <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <div class="stat-label">Tanggal Masuk</div>
                            <div class="stat-value"><?= date('d M Y', strtotime($tgl_masuk)) ?></div>
                        </div> -->

                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="stat-label">Status</div>
                            <div class="stat-value">
                                <span class="status-badge-modern <?= $status == 'Aktif' ? 'status-active' : 'status-inactive' ?>">
                                    <?= $status ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Form -->
                <div class="profile-right">
                    <h3 class="section-title">Informasi Personal</h3>

                    <form action="<?= base_url('profile/update/' . $id_siswa) ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control-modern" value="<?= esc($nama) ?>" required>
                                <i class="bi bi-person-fill form-icon"></i>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control-modern" required>
                                    <option value="l" <?= $jenis_kelamin == 'l' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="p" <?= $jenis_kelamin == 'p' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                                <i class="bi bi-gender-ambiguous form-icon"></i>
                            </div>

                            <div class="form-group full-width">
                                <label class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control-modern" value="<?= esc($alamat) ?>" required>
                                <i class="bi bi-geo-alt-fill form-icon"></i>
                            </div>

                            <div class="form-group">
                                <label class="form-label">No. Telepon</label>
                                <input type="text" name="no_telepon" class="form-control-modern" value="<?= esc($no_telepon) ?>" required>
                                <i class="bi bi-telephone-fill form-icon"></i>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control-modern" value="<?= esc($email) ?>" required>
                                <i class="bi bi-envelope-fill form-icon"></i>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Jurusan</label>
                                <input type="text" name="jurusan" class="form-control-modern" value="<?= esc($jurusan) ?>" required>
                                <i class="bi bi-mortarboard-fill form-icon"></i>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Asal Instansi</label>
                                <input type="text" name="asal_instansi" class="form-control-modern" value="<?= esc($asal_instansi) ?>" required>
                                <i class="bi bi-building form-icon"></i>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Tanggal Masuk</label>
                                <input type="date" name="tgl_masuk" class="form-control-modern" value="<?= $tgl_masuk ?>" required>
                                <i class="bi bi-calendar-check form-icon"></i>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Tanggal Keluar</label>
                                <input type="date" name="tgl_keluar" class="form-control-modern" value="<?= $tgl_keluar ?>">
                                <i class="bi bi-calendar-x form-icon"></i>
                            </div>

                            
                        </div>

                        <!-- Tombol Simpan Perubahan -->
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn-modern btn-edit">
                                <i class="bi bi-pencil-square me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal Ganti Foto Profil -->
<div class="modal fade" id="gantiFotoModal" tabindex="-1" aria-labelledby="gantiFotoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('profile/update-foto') ?>" method="post" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gantiFotoModalLabel">Ganti Foto Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="foto" class="form-label">Pilih Foto Baru</label>
                    <input class="form-control" type="file" id="foto" name="foto" accept="image/*" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Upload</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('profile/update-password') ?>" method="post">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordLabel">Ganti Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Password Lama" required>
                        <label for="current_password">Password Lama</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Password Baru" required minlength="6">
                        <label for="new_password">Password Baru</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>