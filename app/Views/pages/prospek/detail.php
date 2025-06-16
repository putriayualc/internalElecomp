<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <!-- Header -->
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('prospek') ?>">Prospek</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
                <h1 class="app-page-title mb-0"><?= $title ?></h1>
            </div>
            <div class="col-auto">
                <div class="d-flex gap-2">
                    <a href="<?= base_url('prospek') ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fas fa-plus me-2"></i>Tambah Perusahaan
                    </button>
                </div>
            </div>
        </div>

        <!-- Info Prospek -->
        <div class="app-card shadow-sm mb-4">
            <div class="app-card-header p-3">
                <h5 class="app-card-title mb-0">Informasi Prospek</h5>
            </div>
            <div class="app-card-body p-3">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Judul:</strong> <?= esc($prospek['judul']) ?></p>
                        <p><strong>Sumber Data:</strong> <?= esc($prospek['sumber_data']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Total Perusahaan:</strong>
                            <span class="badge bg-info"><?= count($detail_prospek) ?></span>
                        </p>
                        <p><strong>Terakhir Update:</strong> <?= date('d/m/Y H:i') ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifikasi -->
        <div id="alertContainer"></div>

        <!-- Tabel Detail Perusahaan -->
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Daftar Perusahaan</h4>
                    </div>
                    <div class="col-auto">
                        <div class="card-header-action">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari perusahaan..." id="searchCompany">
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
                    <table class="table app-table-hover mb-0 text-left" id="companyTable">
                        <thead>
                            <tr>
                                <th class="cell" width="5%">No</th>
                                <th class="cell" width="20%">Nama Perusahaan</th>
                                <th class="cell" width="15%">Alamat</th>
                                <th class="cell" width="15%">Email</th>
                                <th class="cell" width="10%">No HP</th>
                                <th class="cell" width="10%">Website</th>
                                <th class="cell" width="10%">Status Email</th>
                                <th class="cell" width="10%">Status WA</th>
                                <th class="cell" width="10%">Keterangan</th>
                                <th class="cell" width="10%">Tanggal</th>
                                <th class="cell" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($detail_prospek)): ?>
                                <?php foreach ($detail_prospek as $index => $detail): ?>
                                    <tr>
                                        <td class="cell"><?= $index + 1 ?></td>
                                        <td class="cell fw-bold">
                                            <?= esc($detail['nama_perusahaan']) ?>
                                        </td>
                                        <td class="cell">
                                            <?= esc($detail['alamat']) ?>
                                        </td>
                                        <td class="cell">
                                            <?php if (!empty($detail['email'])): ?>
                                                <a href="mailto:<?= esc($detail['email']) ?>"><?= esc($detail['email']) ?></a>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="cell">
                                            <?php if (!empty($detail['no_hp'])): ?>
                                                <a href="tel:<?= esc($detail['no_hp']) ?>"><?= esc($detail['no_hp']) ?></a>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="cell">
                                            <?php if (!empty($detail['website'])): ?>
                                                <a href="<?= esc($detail['website']) ?>" target="_blank">
                                                    <?= esc($detail['website']) ?>
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="cell">
                                            <?php if ($detail['status_email'] == 'Sudah'): ?>
                                                <span class="badge bg-success">Sudah</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Belum</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="cell">
                                            <?php if ($detail['status_wa'] == 'Sudah'): ?>
                                                <span class="badge bg-success">Sudah</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Belum</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="cell">
                                            <?= esc($detail['keterangan_lainnya']) ?>
                                        </td>
                                        <td class="cell">
                                            <?= date('d/m/Y', strtotime($detail['tanggal'])) ?>
                                        </td>
                                        <td class="cell">
                                            <div class="d-flex gap-1">
                                                <button type="button" class="btn btn-sm btn-info" onclick="viewDetail(<?= $detail['id_detail_prospek'] ?>)" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-warning" onclick="editDetail(<?= $detail['id_detail_prospek'] ?>)" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(<?= $detail['id_detail_prospek'] ?>, '<?= esc($detail['nama_perusahaan']) ?>')" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="11" class="text-center py-4">
                                        <div class="empty-state">
                                            <i class="fas fa-building fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">Belum ada data perusahaan</h5>
                                            <p class="text-muted mb-3">Tambahkan perusahaan pertama untuk memulai prospek ini</p>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                                                <i class="fas fa-plus me-2"></i>Tambah Perusahaan
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Perusahaan -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Perusahaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="companyForm">
                <div class="modal-body">
                    <input type="hidden" id="id_prospek" name="id_prospek" value="<?= $prospek['id_prospek'] ?>">
                    <input type="hidden" id="form_mode" value="add">
                    <input type="hidden" id="edit_id" name="edit_id" value="">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_perusahaan" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="no_telepon" class="form-label">No Telepon</label>
                                <input type="text" class="form-control" id="no_telepon" name="no_telepon">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" class="form-control" id="website" name="website">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d') ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="keterangan_lainnya" class="form-label">Keterangan Lainnya</label>
                        <textarea class="form-control" id="keterangan_lainnya" name="keterangan_lainnya" rows="3"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Lihat Detail -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Detail Perusahaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Perusahaan:</label>
                            <p id="view_nama_perusahaan">-</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email:</label>
                            <p id="view_email">-</p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Alamat:</label>
                    <p id="view_alamat">-</p>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">No HP:</label>
                            <p id="view_no_hp">-</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">No Telepon:</label>
                            <p id="view_no_telepon">-</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Website:</label>
                            <p id="view_website">-</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal:</label>
                            <p id="view_tanggal">-</p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Keterangan Lainnya:</label>
                    <p id="view_keterangan_lainnya">-</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data perusahaan <strong id="delete_company_name"></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                    <i class="fas fa-trash me-2"></i>Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
let deleteId = null;

$(document).ready(function() {
    // Search functionality
    $('#searchCompany').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('#companyTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Form submission
    $('#companyForm').on('submit', function(e) {
        e.preventDefault();
        
        const formMode = $('#form_mode').val();
        const id_prospek = $('#id_prospek').val();
        const url = formMode === 'add' 
            ? `<?= site_url('prospek') ?>/${id_prospek}/perusahaan/store`
            : `<?= site_url('prospek') ?>/${id_prospek}/perusahaan/update/${$('#edit_id').val()}`;
        
        // Clear previous errors
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').text('');
        
        // Disable submit button
        $('#submitBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...');
        
        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    $('#addModal').modal('hide');
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    if (response.errors) {
                        // Show validation errors
                        $.each(response.errors, function(field, message) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field).siblings('.invalid-feedback').text(message);
                        });
                    } else {
                        showAlert('danger', response.message);
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', xhr.responseText);
                showAlert('danger', 'Terjadi kesalahan pada server: ' + xhr.statusText);
            },
            complete: function() {
                $('#submitBtn').prop('disabled', false).html('<i class="fas fa-save me-2"></i>Simpan');
            }
        });
    });

    // Reset form when modal is closed
    $('#addModal').on('hidden.bs.modal', function() {
        resetForm();
    });

    // Confirm delete
    $('#confirmDeleteBtn').on('click', function() {
        if (deleteId) {
            $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Menghapus...');
            
            const id_prospek = $('#id_prospek').val();
            $.ajax({
                url: `<?= site_url('prospek') ?>/${id_prospek}/perusahaan/delete/${deleteId}`,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        showAlert('success', response.message);
                        $('#deleteModal').modal('hide');
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        showAlert('danger', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', xhr.responseText);
                    showAlert('danger', 'Terjadi kesalahan pada server: ' + xhr.statusText);
                },
                complete: function() {
                    $('#confirmDeleteBtn').prop('disabled', false).html('<i class="fas fa-trash me-2"></i>Hapus');
                }
            });
        }
    });
});

// Function to show alert
function showAlert(type, message) {
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    $('#alertContainer').html(alertHtml);
    
    // Auto hide after 5 seconds
    setTimeout(() => {
        $('.alert').alert('close');
    }, 5000);
}

// Function to reset form
function resetForm() {
    $('#companyForm')[0].reset();
    $('#form_mode').val('add');
    $('#edit_id').val('');
    $('#addModalLabel').text('Tambah Perusahaan');
    $('#tanggal').val('<?= date('Y-m-d') ?>');
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').text('');
}

// Function to view detail
function viewDetail(id) {
    const id_prospek = $('#id_prospek').val();
    $.ajax({
        url: `<?= site_url('prospek') ?>/${id_prospek}/perusahaan/get/${id}`,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const data = response.data;
                $('#view_nama_perusahaan').text(data.nama_perusahaan || '-');
                $('#view_email').html(data.email ? `<a href="mailto:${data.email}">${data.email}</a>` : '-');
                $('#view_alamat').text(data.alamat || '-');
                $('#view_no_hp').html(data.no_hp ? `<a href="tel:${data.no_hp}">${data.no_hp}</a>` : '-');
                $('#view_no_telepon').html(data.no_telepon ? `<a href="tel:${data.no_telepon}">${data.no_telepon}</a>` : '-');
                $('#view_website').html(data.website ? `<a href="${data.website}" target="_blank">${data.website}</a>` : '-');
                $('#view_tanggal').text(data.tanggal ? formatDate(data.tanggal) : '-');
                $('#view_keterangan_lainnya').text(data.keterangan_lainnya || '-');
                
                $('#viewModal').modal('show');
            } else {
                showAlert('danger', response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', xhr.responseText);
            showAlert('danger', 'Terjadi kesalahan pada server');
        }
    });
}

// Function to edit detail
function editDetail(id) {
    const id_prospek = $('#id_prospek').val();
    $.ajax({
        url: `<?= site_url('prospek') ?>/${id_prospek}/perusahaan/get/${id}`,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const data = response.data;
                
                // Fill form with data
                $('#nama_perusahaan').val(data.nama_perusahaan);
                $('#email').val(data.email || '');
                $('#alamat').val(data.alamat || '');
                $('#no_hp').val(data.no_hp || '');
                $('#no_telepon').val(data.no_telepon || '');
                $('#website').val(data.website || '');
                $('#tanggal').val(data.tanggal || '<?= date('Y-m-d') ?>');
                $('#keterangan_lainnya').val(data.keterangan_lainnya || '');
                
                // Set form mode to edit
                $('#form_mode').val('edit');
                $('#edit_id').val(id);
                $('#addModalLabel').text('Edit Perusahaan');
                
                $('#addModal').modal('show');
            } else {
                showAlert('danger', response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', xhr.responseText);
            showAlert('danger', 'Terjadi kesalahan pada server');
        }
    });
}

// Function to confirm delete
function confirmDelete(id, companyName) {
    deleteId = id;
    $('#delete_company_name').text(companyName);
    $('#deleteModal').modal('show');
}

// Function to format date
function formatDate(dateString) {
    const date = new Date(dateString);
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    return `${day}/${month}/${year}`;
}
</script>

<?= $this->endSection(); ?>