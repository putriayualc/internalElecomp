<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid py-3">
    <div class="rounded-3 shadow-sm mb-4"
        style="background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="d-flex justify-content-between align-items-center p-4 text-white">
            <div>
                <h1 class="h1 fw-bold">Detail SOP</h1>
                <p class="text-white-70 small mb-0">Informasi lengkap Standard Operating Procedure</p>
            </div>

            <div class="d-flex gap-2">
                <a href="<?= base_url('sop') ?>" class="btn btn-light text-info px-4 py-2 fs-6 d-flex align-items-center gap-2">
                    <i class="fas fa-arrow-left me-2"></i>
                    <span class="d-none d-sm-inline">Kembali</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Card -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="row g-4">
            <div class="col-12">
                <!-- Judul SOP Section -->
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="icon-circle bg-primary bg-opacity-10 text-primary" style="width: 40px; height: 40px; font-size: 18px;">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-semibold text-dark">Judul SOP</h4>
                            <p class="text-muted small mb-0">Nama dari Standard Operating Procedure</p>
                        </div>
                    </div>
                    <div class="bg-light rounded-3 p-3 border-start border-primary border-4">
                        <p class="mb-0 text-dark fw-medium"><?= esc($sop['judul_sop']) ?></p>
                    </div>
                </div>

                <!-- Detail SOP Section -->
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="icon-circle bg-success bg-opacity-10 text-success" style="width: 40px; height: 40px; font-size: 18px;">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-semibold text-dark">Detail SOP</h4>
                            <p class="text-muted small mb-0">Deskripsi lengkap dari prosedur operasional</p>
                        </div>
                    </div>
                    <div class="bg-light rounded-3 p-4 border-start border-success border-4">
                        <div class="text-dark">
                            <?= htmlspecialchars_decode($sop['detail_sop']) ?>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-2 justify-content-end pt-3 border-top">
                    <?php if (session()->get('role') === 'admin') : ?>
                        <a href="<?= route_to('sop.edit', $sop['id_sop']) ?>" class="btn btn-primary px-4 py-2 d-flex align-items-center gap-2">
                            <i class="fas fa-edit"></i>
                            <span>Edit SOP</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Icon Circle Style - consistent with index page */
    .icon-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    /* Text white opacity for header */
    .text-white-70 {
        color: rgba(255, 255, 255, 0.7) !important;
    }

    /* Content styling */
    .bg-light {
        background-color: #f8f9fa !important;
    }

    /* Border styling */
    .border-4 {
        border-width: 4px !important;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .card-body {
            padding: 1.5rem !important;
        }

        .d-flex.gap-2 {
            flex-direction: column;
            gap: 0.5rem !important;
        }

        .btn {
            justify-content: center;
        }
    }
</style>

<?= $this->endSection(); ?>