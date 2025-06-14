<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <!-- Judul dan Tombol Tambah -->
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0"><?= $title ?></h1>
            </div>
            <div class="col-auto">
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProspekModal">
                        <i class="fas fa-plus me-2"></i>Tambah Prospek
                    </button>
                    <a href="<?= base_url('email') ?>" class="btn btn-info">
                        <i class="fas fa-envelope me-2"></i>Prospek Email
                    </a>
                    <a href="<?= base_url('whatsapp') ?>" class="btn btn-success">
                        <i class="fab fa-whatsapp me-2"></i>Prospek WhatsApp
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

        <?php if (session()->has('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i><?= session('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Tabel -->
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Daftar Prospek</h4>
                    </div>
                    <div class="col-auto">
                        <div class="card-header-action">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari prospek..." id="searchData">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell" width="5%">No</th>
                                <th class="cell" width="20%">Judul Prospek</th>
                                <th class="cell" width="15%">Sumber Data</th>
                                <th class="cell" width="10%">Total Perusahaan</th>
                                <th class="cell" width="10%">Email Sent</th>
                                <th class="cell" width="10%">WA Sent</th>
                                <th class="cell" width="15%">Status Komunikasi</th>
                                <th class="cell" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($prospek)): ?>
                                <?php foreach ($prospek as $index => $row): ?>
                                    <tr>
                                        <td class="cell"><?= $index + 1 ?></td>
                                        <td class="cell fw-bold">
                                            <?= esc($row['judul']) ?>
                                        </td>
                                        <td class="cell"><?= esc($row['sumber_data']) ?></td>
                                        <td class="cell">
                                            <span class="badge bg-info"><?= $row['total_perusahaan'] ?></span>
                                        </td>
                                        <td class="cell">
                                            <span class="badge bg-primary"><?= $row['total_email_sent'] ?></span>
                                        </td>
                                        <td class="cell">
                                            <span class="badge bg-success"><?= $row['total_whatsapp_sent'] ?></span>
                                        </td>
                                        <td class="cell">
                                            <?php
                                            $badgeClass = match($row['status_komunikasi']) {
                                                'Email & WA' => 'bg-warning',
                                                'Email Only' => 'bg-primary',
                                                'WA Only' => 'bg-success',
                                                default => 'bg-secondary'
                                            };
                                            ?>
                                            <span class="badge <?= $badgeClass ?>"><?= $row['status_komunikasi'] ?></span>
                                        </td>
                                        <td class="cell">
                                            <div class="d-flex gap-1">
                                                <a href="<?= base_url('prospek/detail/' . $row['id_prospek']) ?>" class="btn btn-sm btn-info" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-warning" onclick="editProspek(<?= $row['id_prospek'] ?>)" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $row['id_prospek'] ?>" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="deleteModal<?= $row['id_prospek'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $row['id_prospek'] ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="deleteModalLabel<?= $row['id_prospek'] ?>">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menghapus prospek <strong><?= esc($row['judul']) ?></strong>?</p>
                                                    <p class="text-warning"><i class="fas fa-exclamation-triangle me-2"></i>Semua data detail perusahaan dalam prospek ini juga akan terhapus!</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="fas fa-times me-2"></i>Batal
                                                    </button>
                                                    <a href="<?= base_url('prospek/delete/' . $row['id_prospek']) ?>" class="btn btn-danger">
                                                        <i class="fas fa-trash me-2"></i>Hapus
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center py-3">Tidak ada data prospek yang tersedia</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Prospek -->
<div class="modal fade" id="addProspekModal" tabindex="-1" aria-labelledby="addProspekModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addProspekModalLabel">Tambah Prospek</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="prospekForm">
                <div class="modal-body">
                    <input type="hidden" id="prospek_id" name="prospek_id">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Prospek <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                        <div class="invalid-feedback" id="error-judul"></div>
                    </div>
                    <div class="mb-3">
                        <label for="sumber_data" class="form-label">Sumber Data <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="sumber_data" name="sumber_data" required>
                        <div class="invalid-feedback" id="error-sumber_data"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Handle form submission
    $('#prospekForm').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const prospekId = $('#prospek_id').val();
        const url = prospekId ? '<?= base_url('prospek/update') ?>/' + prospekId : '<?= base_url('prospek/store') ?>';
        
        // Clear previous errors
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').text('');
        
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    $('#addProspekModal').modal('hide');
                    location.reload();
                } else {
                    if (response.errors) {
                        // Display validation errors
                        $.each(response.errors, function(field, message) {
                            $('#' + field).addClass('is-invalid');
                            $('#error-' + field).text(message);
                        });
                    }
                    alert(response.message || 'Terjadi kesalahan');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan pada server');
            }
        });
    });

    // Reset form when modal is closed
    $('#addProspekModal').on('hidden.bs.modal', function() {
        $('#prospekForm')[0].reset();
        $('#prospek_id').val('');
        $('#addProspekModalLabel').text('Tambah Prospek');
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').text('');
    });

    // Search functionality
    $('#searchData').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('table tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});

// Edit function
function editProspek(id) {
    $.ajax({
        url: '<?= base_url('prospek/edit') ?>/' + id,
        type: 'GET',
        success: function(response) {
            if (response.success) {
                $('#prospek_id').val(response.data.id_prospek);
                $('#judul').val(response.data.judul);
                $('#sumber_data').val(response.data.sumber_data);
                $('#addProspekModalLabel').text('Edit Prospek');
                $('#addProspekModal').modal('show');
            } else {
                alert(response.message || 'Terjadi kesalahan');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan pada server');
        }
    });
}
</script>

<?= $this->endSection(); ?>