<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <!-- <h1 class="app-page-title">Dashboard</h1> -->
        <h1 class="app-page-title">Halo <?= session()->get('role') ?></h1>

        <div class="row mb-4">
            <!-- Piket Hari Ini - Left Side -->
            <div class="col-12 col-lg-4">
                <a href="<?= route_to('piket') ?>" class="text-decoration-none text-dark">
                    <div class="app-card app-card-basic shadow-sm h-100">
                        <div class="app-card-header p-3 text-white">
                            <h4 class="app-card-title mb-0">Jadwal Piket Hari Ini (<?= date('l') ?>)</h4>
                        </div>
                        <div class="app-card-body p-4">
                            <?php $piketMembers = ['Andi', 'Budi', 'Clara']; ?>
                            <?php foreach ($piketMembers as $member): ?>
                                <div class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-icon bg-light-primary me-3 rounded-circle p-2">
                                            <i class="fa fa-user text-primary fs-4"></i>
                                        </div>
                                        <div class="member-info">
                                            <h5 class="mb-0"><?= $member ?></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Stat Cards - Right Side -->
            <div class="col-12 col-lg-8">
                <div class="row g-4">
                    <!-- Card Hosting Aktif -->
                    <div class="col-6 col-md-4">
                        <a href="<?= route_to('hosting') ?>" class="text-decoration-none text-dark">
                            <div class="app-card app-card-stat shadow-sm h-100">
                                <div class="app-card-body p-3 p-lg-4">
                                    <h5 class="stat-label text-center">Hosting Aktif</h5>
                                    <div class="stat-value text-center">25</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Card SOP -->
                    <div class="col-6 col-md-4">
                        <a href="<?= route_to('sop') ?>" class="text-decoration-none text-dark">
                            <div class="app-card app-card-stat shadow-sm h-100">
                                <div class="app-card-body p-3 p-lg-4">
                                    <h5 class="stat-label text-center">SOP</h5>
                                    <div class="stat-value text-center">25</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Card Siswa Aktif -->
                    <div class="col-6 col-md-4">
                        <a href="#" class="text-decoration-none text-dark">
                            <div class="app-card app-card-stat shadow-sm h-100">
                                <div class="app-card-body p-3 p-lg-4">
                                    <h5 class="stat-label text-center">Siswa Aktif</h5>
                                    <div class="stat-value text-center">58</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Card Total Email -->
                    <div class="col-6 col-md-4">
                        <a href="<?= route_to('backlink') ?>" class="text-decoration-none text-dark">
                            <div class="app-card app-card-stat shadow-sm h-100">
                                <div class="app-card-body p-3 p-lg-4">
                                    <h5 class="stat-label text-center">Total Email</h5>
                                    <div class="stat-value text-center">142</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Card Total Blog -->
                    <div class="col-6 col-md-4">
                        <a href="<?= route_to('backlink') ?>" class="text-decoration-none text-dark">
                            <div class="app-card app-card-stat shadow-sm h-100">
                                <div class="app-card-body p-3 p-lg-4">
                                    <h5 class="stat-label text-center">Total Blog</h5>
                                    <div class="stat-value text-center">3</div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Card Total Artikel -->
                    <div class="col-6 col-md-4">
                        <a href="<?= route_to('backlink') ?>" class="text-decoration-none text-dark">
                            <div class="app-card app-card-stat shadow-sm h-100">
                                <div class="app-card-body p-3 p-lg-4">
                                    <h5 class="stat-label text-center">Total Artikel</h5>
                                    <div class="stat-value text-center">3</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div><!--//container-xl-->
</div><!--//app-content-->

<?= $this->endSection(); ?>