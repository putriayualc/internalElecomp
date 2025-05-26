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
        background-color: #1cc88a;
        color: white;
        font-size: 0.8rem;
        padding: 0.25rem 0.5rem;
        border-radius: 30px;
        font-weight: 500;
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
        height: 434px;
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
                            <span class="profile-badge">
                                <i class="fas fa-circle me-1"></i> <?= $siswa['status'] ?>
                            </span>
                        </div>


                        <h2 class="customer-name"><?= $siswa['nama'] ?></h2>
                        <p class="joined-date">
                            <i class="fas fa-calendar-alt me-1"></i> Joined <?= date('F j, Y', strtotime($siswa['tgl_masuk'])) ?>
                        </p>

                        <div class="social-icons">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
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

                                <div class="info-group">
                                    <div class="info-label"><i class="fas fa-venus-mars me-2"></i> Jenis Kelamin</div>
                                    <p class="info-value">
                                        <?= $siswa['jenis_kelamin'] === 'p' ? 'Perempuan' : 'Laki-laki' ?>
                                    </p>
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

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                    <h4 class="mt-3">Are you sure?</h4>
                    <p class="text-muted">You are about to delete this customer. This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                    <a href="<?= site_url('siswa/delete/' . $siswa['id_siswa']) ?>" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Yes, Delete
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Reset Password Modal -->
    <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetPasswordModalLabel">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <i class="fas fa-key text-primary" style="font-size: 3rem;"></i>
                    <h4 class="mt-3">Reset Password</h4>
                    <p class="text-muted">Are you sure you want to reset the password for this customer? They will receive an email with instructions.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                    <a href="<?= site_url('customers/reset-password/' . $siswa['id_siswa']) ?>" class="btn btn-primary">
                        <i class="fas fa-check me-1"></i> Yes, Reset
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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