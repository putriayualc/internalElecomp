<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('whatsapp') ?>">
                                <i class="fas fa-envelope me-1"></i>Prospek Whatsapp
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?= esc($prospek['judul']) ?>
                        </li>
                    </ol>
                </nav>
                <h1 class="app-page-title mb-0">
                    <i class="fas fa-list-alt me-2"></i><?= esc($prospek['judul']) ?>
                </h1>
                <p class="text-muted mb-0">
                    <i class="fas fa-tag me-1"></i>Sumber: <?= esc($prospek['sumber_data']) ?>
                </p>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" id="btnAddWhatsapp" data-id-prospek="<?= $prospek['id_prospek'] ?>">
                    <i class="fas fa-plus me-2"></i>Tambah Whatsapp
                </button>
                <a href="<?= base_url('whatsapp') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-header p-3">
                 <h4 class="app-card-title"><i class="fas fa-history me-2"></i>Riwayat Whatsapp</h4>
            </div>
            <div class="app-card-body">
                <?php if (empty($whatsapp_history)): ?>
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-inbox fa-3x mb-3"></i>
                        <h5>Belum Ada Whatsapp Terkirim</h5>
                        <p>Riwayat whatsapp untuk prospek ini akan muncul di sini.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
                                    <th class="cell" width="5%">No</th>
                                    <th class="cell" width="25%">Perusahaan</th>
                                    <th class="cell" width="15%">Tanggal Kirim</th>
                                    <th class="cell" width="15%">Status</th>
                                    <th class="cell" width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($whatsapp_history as $index => $whatsapp): ?>
                                    <tr>
                                        <td class="cell"><?= $index + 1 ?></td>
                                        <td class="cell fw-bold"><?= esc($whatsapp['nama_perusahaan']) ?></td>
                                        <td class="cell"><?= date('d/m/Y H:i', strtotime($whatsapp['tanggal'])) ?></td>
                                        <td class="cell">
                                            <?php
                                            $statusClass = ['terkirim' => 'bg-success', 'pending' => 'bg-warning', 'gagal' => 'bg-danger'];
                                            $statusText = ['terkirim' => 'Terkirim', 'pending' => 'Pending', 'gagal' => 'Gagal'];
                                            ?>
                                            <span class="badge <?= $statusClass[$whatsapp['status']] ?? 'bg-secondary' ?>">
                                                <?= $statusText[$whatsapp['status']] ?? 'N/A' ?>
                                            </span>
                                            <?php if (!empty($whatsapp['keterangan'])): ?>
                                                <br><small class="text-muted"><?= esc($whatsapp['keterangan']) ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td class="cell">
                                            <div class="btn-group" role="group">
                                                 <button type="button" class="btn btn-sm btn-info btn-view-message" data-bs-toggle="modal" data-bs-target="#messageModal" data-company="<?= esc($whatsapp['nama_perusahaan']) ?>" data-date="<?= date('d/m/Y H:i', strtotime($whatsapp['tanggal'])) ?>" data-message="<?= esc($whatsapp['pesan']) ?>" title="Lihat Pesan"><i class="fas fa-eye"></i></button>
                                                 <button type="button" class="btn btn-sm btn-warning btn-edit-whatsapp" data-id="<?= $whatsapp['id_prospek_whatsapp'] ?>" data-id-detail="<?= $whatsapp['id_detail_prospek'] ?? '' ?>" data-company="<?= esc($whatsapp['nama_perusahaan']) ?>" data-message="<?= esc($whatsapp['pesan']) ?>" data-status="<?= esc($whatsapp['status']) ?>" data-keterangan="<?= esc($whatsapp['keterangan'] ?? '') ?>" title="Edit"><i class="fas fa-edit"></i></button>
                                                 <button type="button" class="btn btn-sm btn-danger btn-delete-whatsapp" data-id="<?= $whatsapp['id_prospek_whatsapp'] ?>" data-company="<?= esc($whatsapp['nama_perusahaan']) ?>" title="Hapus"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addMultipleWhatsappsModal" tabindex="-1" aria-labelledby="addMultipleWhatsappsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addMultipleWhatsappsModalLabel"><i class="fas fa-paper-plane me-2"></i>Kirim Whatsapp Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addMultipleWhatsappsForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                             <label class="form-label fw-bold">Pilih Perusahaan Penerima</label>
                             <div>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="selectAllCompanies"><i class="fas fa-check-double me-1"></i>Pilih Semua</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="unselectAllCompanies"><i class="fas fa-times me-1"></i>Batal Semua</button>
                            </div>
                        </div>
                        <div id="companyListContainer" class="border rounded p-3" style="max-height: 250px; overflow-y: auto;">
                            <div class="text-center text-muted p-3">Memuat perusahaan...</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="pesan_multiple" class="form-label fw-bold">Pesan Whatsapp</label>
                        <textarea class="form-control" id="pesan_multiple" name="pesan" rows="6" required minlength="10" placeholder="Tulis template pesan whatsapp di sini..."></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="status_multiple" class="form-label fw-bold">Status</label>
                            <select class="form-select" id="status_multiple" name="status" required>
                                <option value="terkirim" selected>Terkirim</option>
                                <option value="pending">Pending</option>
                                <option value="gagal">Gagal</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="keterangan_multiple" class="form-label fw-bold">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan_multiple" name="keterangan" placeholder="Opsional (misal: Follow Up ke-2)">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="me-auto text-muted" id="selectedCountText">0 perusahaan dipilih</span>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btnSaveMultipleWhatsapps" disabled>
                        <i class="fas fa-save me-2"></i>Simpan & Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editWhatsappModal" tabindex="-1" aria-labelledby="editWhatsappModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
             <div class="modal-header bg-warning">
                <h5 class="modal-title" id="editWhatsappModalLabel"><i class="fas fa-edit me-2"></i>Edit Riwayat Whatsapp</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
             <form id="editWhatsappForm" method="post">
                <div class="modal-body">
                    <input type="hidden" id="edit_id_prospek_whatsapp" name="id_prospek_whatsapp">
                    <div class="mb-3">
                        <label for="edit_nama_perusahaan" class="form-label">Perusahaan</label>
                        <input type="text" class="form-control" id="edit_nama_perusahaan" name="nama_perusahaan" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit_pesan" class="form-label">Pesan Whatsapp</label>
                        <textarea class="form-control" id="edit_pesan" name="pesan" rows="8" required></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_status" class="form-label">Status</label>
                            <select class="form-select" id="edit_status" name="status" required>
                                <option value="terkirim">Terkirim</option>
                                <option value="pending">Pending</option>
                                <option value="gagal">Gagal</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" id="edit_keterangan" name="keterangan" placeholder="Opsional">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning" id="btnUpdateWhatsapp">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="messageModalLabel"><i class="fas fa-envelope-open me-2"></i>Detail Pesan Whatsapp</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Perusahaan:</strong> <span id="modal-company"></span></p>
                <p><strong>Tanggal Kirim:</strong> <span id="modal-date"></span></p>
                <strong>Pesan:</strong>
                <div id="modal-message" class="border rounded p-3 bg-light mt-2" style="white-space: pre-wrap;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteConfirmModalLabel"><i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus riwayat whatsapp untuk perusahaan <strong id="companyToDelete"></strong>?</p>
                <p class="text-danger">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="btnConfirmDelete">Hapus</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Variabel global
    let selectedWhatsappId = null;
    const addMultipleWhatsappsModal = new bootstrap.Modal(document.getElementById('addMultipleWhatsappsModal'));
    const editWhatsappModal = new bootstrap.Modal(document.getElementById('editWhatsappModal'));
    const deleteConfirmModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));

    // --- FUNGSI BARU UNTUK TAMBAH MULTIPLE WHATSAPP ---

    // 1. Tombol utama "Tambah Whatsapp" ditekan
    $('#btnAddWhatsapp').click(function() {
        const idProspek = $(this).data('id-prospek');
        $('#addMultipleWhatsappsForm')[0].reset();
        loadCompaniesForNewWhatsapp(idProspek);
        addMultipleWhatsappsModal.show();
    });

    // 2. Memuat daftar perusahaan dengan checkbox ke dalam modal
    function loadCompaniesForNewWhatsapp(idProspek) {
        const container = $('#companyListContainer');
        container.html('<div class="text-center text-muted p-3"><div class="spinner-border spinner-border-sm"></div> Memuat...</div>');
        
        $.ajax({
            url: '<?= base_url('whatsapp/get-prospek-details') ?>/' + idProspek,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                let html = '';
                if (response.success && response.details.length > 0) {
                    response.details.forEach(function(company) {
                        html += `
                        <div class="form-check">
                            <input class="form-check-input company-checkbox" type="checkbox" value="${company.id_detail_prospek}" id="company_${company.id_detail_prospek}">
                            <label class="form-check-label" for="company_${company.id_detail_prospek}">
                                <strong>${company.nama_perusahaan}</strong> <br>
                                <small class="text-muted">${company.whatsapp || 'Tidak ada whatsapp'}</small>
                            </label>
                        </div>`;
                    });
                } else {
                    html = '<div class="text-center text-muted p-3">Tidak ada perusahaan dengan whatsapp valid di prospek ini.</div>';
                }
                container.html(html);
                updateSelectedCount();
            },
            error: function() {
                container.html('<div class="text-center text-danger p-3">Gagal memuat data.</div>');
            }
        });
    }

    // 3. Update counter & status tombol simpan saat checkbox berubah
    $(document).on('change', '.company-checkbox', updateSelectedCount);
    
    $('#selectAllCompanies').click(function() {
        $('.company-checkbox').prop('checked', true);
        updateSelectedCount();
    });

    $('#unselectAllCompanies').click(function() {
        $('.company-checkbox').prop('checked', false);
        updateSelectedCount();
    });

    function updateSelectedCount() {
        const count = $('.company-checkbox:checked').length;
        $('#selectedCountText').text(count + ' perusahaan dipilih');
        $('#btnSaveMultipleWhatsapps').prop('disabled', count === 0);
    }

    // 4. Submit form untuk mengirim whatsapp ke banyak perusahaan
    $('#addMultipleWhatsappsForm').submit(function(e) {
        e.preventDefault();

        const selectedCompanies = $('.company-checkbox:checked').map(function() {
            return this.value;
        }).get();

        const formData = {
            selected_companies: selectedCompanies,
            pesan: $('#pesan_multiple').val(),
            status: $('#status_multiple').val(),
            keterangan: $('#keterangan_multiple').val(),
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        };

        $.ajax({
            url: '<?= base_url('whatsapp/storeWhatsapp') ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                $('#btnSaveMultipleWhatsapps').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Menyimpan...');
            },
            success: function(response) {
                if (response.success) {
                    addMultipleWhatsappsModal.hide();
                    Swal.fire('Berhasil!', response.message, 'success').then(() => location.reload());
                } else {
                    Swal.fire('Gagal!', response.message || 'Terjadi kesalahan.', 'error');
                }
            },
            error: function() {
                Swal.fire('Error!', 'Tidak dapat terhubung ke server.', 'error');
            },
            complete: function() {
                 $('#btnSaveMultipleWhatsapps').prop('disabled', false).html('<i class="fas fa-save me-2"></i>Simpan & Kirim');
            }
        });
    });


    // --- FUNGSI LAMA UNTUK LIHAT, EDIT, HAPUS (TETAP DIPERLUKAN) ---

    // Event handler untuk tombol "Lihat Pesan"
    $(document).on('click', '.btn-view-message', function() {
        $('#modal-company').text($(this).data('company'));
        $('#modal-date').text($(this).data('date'));
        $('#modal-message').text($(this).data('message'));
    });

    // Event handler untuk tombol edit whatsapp
    $(document).on('click', '.btn-edit-whatsapp', function() {
        $('#edit_id_prospek_whatsapp').val($(this).data('id'));
        $('#edit_nama_perusahaan').val($(this).data('company'));
        $('#edit_pesan').val($(this).data('message'));
        $('#edit_status').val($(this).data('status'));
        $('#edit_keterangan').val($(this).data('keterangan'));
        editWhatsappModal.show();
    });
    
    // Submit form edit
    $('#editWhatsappForm').submit(function(e) {
        e.preventDefault();
        const id = $('#edit_id_prospek_whatsapp').val();
        const formData = $(this).serialize() + '&<?= csrf_token() ?>=' + '<?= csrf_hash() ?>';

        $.ajax({
            url: '<?= base_url('whatsapp/updateWhatsapp') ?>/' + id,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    editWhatsappModal.hide();
                    Swal.fire('Berhasil!', response.message, 'success').then(() => location.reload());
                } else {
                    Swal.fire('Gagal!', response.message || 'Gagal memperbarui.', 'error');
                }
            }
        });
    });

    // Event handler untuk tombol hapus whatsapp
    $(document).on('click', '.btn-delete-whatsapp', function() {
        selectedWhatsappId = $(this).data('id');
        $('#companyToDelete').text($(this).data('company'));
        deleteConfirmModal.show();
    });

    // Event handler untuk konfirmasi hapus
    $('#btnConfirmDelete').click(function() {
        $.ajax({
            url: '<?= base_url('whatsapp/deleteWhatsapp') ?>/' + selectedWhatsappId,
            type: 'POST',
            data: {'<?= csrf_token() ?>': '<?= csrf_hash() ?>'},
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    deleteConfirmModal.hide();
                    Swal.fire('Dihapus!', response.message, 'success').then(() => location.reload());
                } else {
                    Swal.fire('Gagal!', response.message || 'Gagal menghapus.', 'error');
                }
            }
        });
    });
});
</script>

<?= $this->endSection(); ?>