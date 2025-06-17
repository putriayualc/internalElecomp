<?= $this->extend('layout/template'); ?>

<?= $this->section('css') ?>
<style>
    .container {
        max-width: 1200px;
    }

    .page-header {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 25px;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        position: relative;
    }

    .page-header h1 {
        margin: 0;
        font-weight: 600;
        color: #212529;
        font-size: 1.8rem;
    }

    .header-actions {
        display: flex;
        gap: 10px;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 25px;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.12);
    }

    .card-header {
        background-color: #fff;
        border-bottom: 1px solid #f1f2f3;
        padding: 1.2rem 1.5rem;
    }

    .card-header h3 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 600;
        color: #212529;
    }

    .card-body {
        padding: 2.5rem;
        width: 100%;
        height: 100%;
    }

    .profile-card {
        background-color: #4e73df;
        color: white;
        position: relative;
        overflow: hidden;
        height: 440px;
    }

    .profile-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('https://cdnjs.cloudflare.com/api/placeholder/1000/300') center/cover;
        opacity: 0.1;
    }

    .profile-image-container {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .profile-image {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 50%;
        border: 5px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }

    .profile-badge {
        position: absolute;
        bottom: 10px;
        right: calc(50% - 80px);
        color: white;
        font-size: 0.8rem;
        padding: 0.25rem 0.75rem;
        border-radius: 999px;
        font-weight: 500;
        white-space: nowrap;
    }

    .customer-name {
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .joined-date {
        font-size: 0.9rem;
        opacity: 0.8;
        margin-bottom: 15px;
    }

    .social-icons {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .social-icons a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        color: white;
        transition: all 0.3s ease;
        pointer-events: auto;
        /* pastikan link bisa diklik */
        z-index: 1;
        position: relative;
    }

    .social-icons a:hover {
        background-color: white;
        color: #4e73df;
        transform: translateY(-3px);
    }

    .customer-stats {
        display: flex;
        justify-content: space-around;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 20px 10px;
        margin-top: 1.5rem;
    }

    .customer-stat {
        text-align: center;
    }

    .customer-stat-value {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .customer-stat-label {
        font-size: 0.85rem;
        opacity: 0.8;
    }

    .info-card {
        height: auto;
    }

    .info-group {
        padding-bottom: 15px;
        margin-bottom: 15px;
        border-bottom: 1px solid #f1f2f3;
    }

    .info-group:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .info-label {
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
    }

    .info-label i {
        margin-right: 8px;
        width: 16px;
        text-align: center;
    }

    .info-value {
        font-weight: 500;
        color: #212529;
        margin: 0;
    }

    .status-badge {
        display: inline-block;
        padding: 0.35em 0.65em;
        font-size: 0.85em;
        font-weight: 500;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 30px;
    }

    .status-active {
        background-color: #1cc88a;
        color: white;
    }

    .status-inactive {
        background-color: #e74a3b;
        color: white;
    }

    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .btn {
        padding: 0.5rem 1.2rem;
        font-weight: 500;
        border-radius: 7px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
    }

    .btn-primary:hover {
        background-color: #3a56b1;
        border-color: #3a56b1;
    }

    .btn-danger {
        background-color: #e74a3b;
        border-color: #e74a3b;
    }

    .btn-danger:hover {
        background-color: #be3d30;
        border-color: #be3d30;
    }

    .btn-secondary {
        background-color: #858796;
        border-color: #858796;
    }

    .btn-secondary:hover {
        background-color: #717380;
        border-color: #717380;
    }

    .btn-outline {
        background-color: transparent;
        border: 1px solid #d1d3e2;
        color: #6e707e;
    }

    .btn-outline:hover {
        background-color: #f8f9fc;
    }

    .edit-icon {
        cursor: pointer;
        transition: all 0.3s ease;
        width: 30px;
        height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        /* background-color: #f8f9fc; */
        /* border-radius: 50%; */
        color: #4e73df;
    }

    .modal-content {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        border-bottom: 1px solid #f1f2f3;
        padding: 1.2rem 1.5rem;
    }

    .modal-footer {
        border-top: 1px solid #f1f2f3;
        padding: 1.2rem 1.5rem;
    }

    .alert {
        border-radius: 10px;
        border: none;
        padding: 1rem 1.5rem;
    }

    @media (max-width: 767.98px) {
        .card {
            margin-bottom: 20px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-buttons .btn {
            width: 100%;
            justify-content: center;
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
<?= $this->endSection('css') ?>

<?= $this->section('content'); ?>

<title>Detail Siswa Magang</title>

<body>
    <div class="container mt-4 mb-5 animate-fade-in">
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger d-flex align-items-center">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="page-header text-center my-4 position-relative d-flex justify-content-center align-items-center">
            <h1 class="display-6 fw-bold">Detail Siswa Magang</h1>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card profile-card">
                    <div class="card-body text-center">
                        <div class="profile-image-container">
                            <img src="<?= base_url('assets/img/user/' . ($siswa['foto'] ?? 'default.jpg')); ?>"
                                alt="<?= $siswa['nama'] ?>" class="profile-image">
                            <!-- Wrapper untuk Icon Jenis Kelamin dan Status -->
                            <div class="d-flex justify-content-center align-items-center gap-5 position-absolute"
                                style="bottom: 10px; left: 50%; transform: translateX(-50%);">
                                <!-- Icon Jenis Kelamin dalam Circle -->
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light border"
                                    style="width: 30px; height: 30px; margin-left: 30px;">
                                    <i class="fa-solid <?= strtolower($siswa['jenis_kelamin']) === 'l' ? 'fa-mars text-primary' : 'fa-venus text-danger' ?> fs-6"
                                        title="<?= strtolower($siswa['jenis_kelamin']) === 'l' ? 'Laki-laki' : 'Perempuan' ?>"></i>
                                </span>

                                <!-- Status Badge -->
                                <span class="profile-badge position-static ms-3 <?= strtolower($siswa['status']) === 'aktif' ? 'bg-success' : 'bg-secondary' ?>">
                                    <i class="fas fa-circle me-1"></i> <?= esc($siswa['status']) ?>
                                </span>
                            </div>
                        </div>

                        <h2 class="customer-name"><?= $siswa['nama'] ?></h2>
                        <p class="joined-date">
                            <i class="fas fa-calendar-alt me-1"></i> Joined <?= date('F j, Y', strtotime($siswa['tgl_masuk'])) ?>
                        </p>

                        <div class="social-icons">
                            <?php if (!empty($sosmed)) : ?>
                                <?php foreach ($sosmed as $s) :
                                    $platform = strtolower($s['platform']);
                                    $icon = match ($platform) {
                                        'instagram' => 'fab fa-instagram',
                                        'facebook'  => 'fab fa-facebook-f',
                                        'linkedin'  => 'fab fa-linkedin',
                                        'tiktok'    => 'fab fa-tiktok',
                                        default     => 'fas fa-globe',
                                    };
                                ?>
                                    <a href="<?= htmlspecialchars($s['link'], ENT_QUOTES, 'UTF-8') ?>"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="sosmed-link me-2"
                                        title="<?= htmlspecialchars($s['username_sosmed'], ENT_QUOTES, 'UTF-8') ?>"
                                        onclick="event.stopPropagation();">
                                        <i class="<?= htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') ?>"></i>
                                    </a>


                                <?php endforeach; ?>
                            <?php else : ?>
                                <span class="text-muted">Belum ada sosial media</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card info-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3><i class="fas fa-id-card me-2"></i> Informasi Pribadi</h3>
                        <a class="edit-icon" href="<?= route_to('siswa.edit', $siswa['id_siswa']) ?>">
                            <i class="fas fa-pen"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label"><i class="fas fa-user me-2"></i> Username</div>
                                    <p class="info-value"><?= esc($username) ?></p>
                                </div>
                                <div class="info-group">
                                    <div class="info-label"><i class="fas fa-map-marker-alt me-2"></i> Alamat</div>
                                    <p class="info-value"><?= $siswa['alamat'] ?></p>
                                </div>

                                <div class="info-group">
                                    <div class="info-label"><i class="fas fa-envelope me-2"></i> Email</div>
                                    <p class="info-value">
                                        <a href="mailto:<?= $siswa['email'] ?>" class="text-primary"><?= $siswa['email'] ?></a>
                                    </p>
                                </div>

                                <div class="info-group">
                                    <div class="info-label"><i class="fas fa-phone me-2"></i> Telepon</div>
                                    <p class="info-value"><?= $siswa['no_telepon'] ?></p>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="info-group">
                                    <div class="info-label"><i class="fas fa-graduation-cap me-2"></i> Jurusan</div>
                                    <p class="info-value"><?= $siswa['jurusan'] ?></p>
                                </div>

                                <div class="info-group">
                                    <div class="info-label"><i class="fas fa-building me-2"></i> Asal Instansi</div>
                                    <p class="info-value"><?= $siswa['asal_instansi'] ?></p>
                                </div>

                                <div class="info-group">
                                    <div class="info-label"><i class="fas fa-calendar-check me-2"></i> Tanggal Masuk</div>
                                    <p class="info-value"><?= date('d F Y', strtotime($siswa['tgl_masuk'])) ?></p>
                                </div>

                                <div class="info-group">
                                    <div class="info-label"><i class="fas fa-calendar-times me-2"></i> Tanggal Keluar</div>
                                    <p class="info-value"><?= $siswa['tgl_keluar'] ? date('d F Y', strtotime($siswa['tgl_keluar'])) : '-' ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="<?= route_to('siswa') ?>" class="btn btn-secondary btn-lg d-flex align-items-center">
                        <span>Kembali</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add animation when page loads
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const elements = document.querySelectorAll('.card');
                elements.forEach(function(element, index) {
                    setTimeout(function() {
                        element.classList.add('animate-fade-in');
                    }, index * 100);
                });
            }, 300);
        });
    </script>



</body>

<?= $this->endSection(); ?>