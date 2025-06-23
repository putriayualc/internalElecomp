<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid py-3">
    <div class="rounded-3 shadow-sm mb-4"
        style="background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="d-flex justify-content-between align-items-center p-4 text-white">
            <div>
                <h1 class="h1 fw-bold"><i class="fas fa-envelope me-2"></i><?= $title ?></h1>
                <p class="text-white-70 small mb-0">Kelola data prospek email untuk pemasaran</p>
            </div>

            <div class="d-flex gap-2">
                <a href="<?= base_url('prospek') ?>" class="btn btn-outline-light px-4 py-2 fs-6 d-flex align-items-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    <span class="d-none d-sm-inline">Kembali ke Prospek</span>
                </a>

                <button type="button" class="btn btn-light text-info px-4 py-2 fs-6 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addProspekEmailModal">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span class="d-none d-sm-inline">Tambah Prospek Email</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Notifikasi -->
    <?php if (session()->has('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= session('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i><?= session('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
</div>

<!-- Main Content Card -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body px-1">
        <div class="card-header bg-white">
            <div class="row align-items-start">
                <div class="col">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-list me-2"></i>Prospek yang Sudah Dikirim Email
                    </h5>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" placeholder="Cari prospek email..." id="searchEmailData">
                        <button class="btn btn-primary btn-sm" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="text-center border-end" style="width: 60px;">
                            <span class="fw-semibold">No</span>
                        </th>
                        <th class="border-end" style="min-width: 200px;">
                            <div class="d-flex align-items-center gap-2">
                                <span class="icon-circle bg-primary bg-opacity-10 text-primary">
                                    <i class="fas fa-bullseye"></i>
                                </span>
                                <span class="fw-semibold">Nama Prospek</span>
                            </div>
                        </th>
                        <th class="text-center border-end" style="min-width: 150px;">
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <span class="icon-circle bg-success bg-opacity-10 text-success">
                                    <i class="fas fa-database"></i>
                                </span>
                                <span class="fw-semibold">Sumber Data</span>
                            </div>
                        </th>
                        <th class="text-center border-end" style="min-width: 120px;">
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <span class="icon-circle bg-info bg-opacity-10 text-info">
                                    <i class="fas fa-building"></i>
                                </span>
                                <span class="fw-semibold">Total Perusahaan</span>
                            </div>
                        </th>
                        <th class="text-center border-end" style="min-width: 100px;">
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <span class="icon-circle bg-primary bg-opacity-10 text-primary">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <span class="fw-semibold">Email Sent</span>
                            </div>
                        </th>
                        <th class="text-center" style="width: 120px;">
                            <span class="fw-semibold">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($prospek_email)): ?>
                        <?php foreach ($prospek_email as $index => $prospek): ?>
                            <tr>
                                <td class="text-center border-end">
                                    <span class="text-muted fw-medium"><?= $index + 1 ?></span>
                                </td>
                                <td class="border-end">
                                    <div class="d-flex align-items-center py-2">
                                        <div class="flex-grow-1 min-width-0">
                                            <div class="mb-1">
                                                <a href="<?= base_url('email/detail/' . $prospek['id_prospek']) ?>"
                                                    class="text-decoration-none text-dark fw-semibold user-name-link">
                                                    <?= esc($prospek['judul']) ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center border-end">
                                    <span class="text-truncate d-inline-block fw-medium" style="max-width: 150px;"
                                        title="<?= esc($prospek['sumber_data']) ?>">
                                        <?= esc($prospek['sumber_data']) ?>
                                    </span>
                                </td>
                                <td class="text-center border-end">
                                    <span class="status-badge" style="background-color: #e3f2fd; color: #1565c0; border: 1px solid #1565c0;">
                                        <?= $prospek['total_perusahaan'] ?>
                                    </span>
                                </td>
                                <td class="text-center border-end">
                                    <span class="status-badge" style="background-color: #e8f5e8; color: #2e7d32; border: 1px solid #2e7d32;">
                                        <?= $prospek['total_email_sent'] ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle action-btn"
                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center text-info"
                                                    href="<?= base_url('email/detail/' . $prospek['id_prospek']) ?>">
                                                    <i class="fas fa-eye text-info me-2"></i>
                                                    <span>Detail</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center text-danger"
                                                    href="#" onclick="hapusProspekEmail(<?= $prospek['id_prospek'] ?>, '<?= esc($prospek['judul']) ?>')">
                                                    <i class="fas fa-trash text-danger me-2"></i>
                                                    <span>Hapus</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-inbox text-muted mb-3" style="font-size: 3rem;"></i>
                                    <h5 class="text-muted">Belum ada prospek yang dikirim email</h5>
                                    <p class="text-muted mb-0">Silakan tambah prospek email baru untuk memulai</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Prospek yang tersedia untuk dikirim email -->
<div class="card border-0 shadow-sm">
    <div class="card-body px-1">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">
                <i class="fas fa-paper-plane me-2"></i>Prospek Tersedia untuk Email
            </h5>
        </div>
        
        <div class="card-body">
            <?php if (!empty($available_prospek)): ?>
                <div class="row">
                    <?php foreach ($available_prospek as $prospek): ?>
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card border-warning h-100">
                                <div class="card-body">
                                    <h6 class="card-title fw-bold"><?= esc($prospek['judul']) ?></h6>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            <i class="fas fa-tag me-1"></i><?= esc($prospek['sumber_data']) ?>
                                        </small><br>
                                        <span class="badge bg-warning text-dark">
                                            <?= $prospek['total_perusahaan_dengan_email'] ?> perusahaan dengan email
                                        </span>
                                    </p>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <button type="button" class="btn btn-sm btn-warning w-100 btn-select-prospek"
                                        data-prospek-id="<?= $prospek['id_prospek'] ?>"
                                        data-prospek-name="<?= esc($prospek['judul']) ?>">
                                        <i class="fas fa-plus me-1"></i>Pilih
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fas fa-check-circle text-muted mb-3" style="font-size: 3rem;"></i>
                        <h5 class="text-muted">Semua prospek sudah dikirim email</h5>
                        <p class="text-muted mb-0">Tidak ada prospek dengan email yang valid tersedia</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Tambah Prospek Email -->
<div class="modal fade" id="addProspekEmailModal" tabindex="-1" aria-labelledby="addProspekEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-semibold" id="addProspekEmailModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Prospek Email
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addProspekEmailForm">
                <div class="modal-body">
                    <!-- Step 1: Pilih Prospek -->
                    <div id="step1" class="step-content">
                        <div class="mb-3">
                            <label for="prospek_select" class="form-label fw-semibold">Pilih Prospek <span class="text-danger">*</span></label>
                            <select class="form-select" id="prospek_select" name="prospek_select" required>
                                <option value="">-- Pilih Prospek --</option>
                                <?php foreach ($available_prospek as $prospek): ?>
                                    <option value="<?= $prospek['id_prospek'] ?>">
                                        <?= esc($prospek['judul']) ?> (<?= $prospek['total_perusahaan_dengan_email'] ?> perusahaan)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback" id="error-prospek_select"></div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" id="loadProspekDetails">
                                <i class="fas fa-arrow-right me-2"></i>Lanjutkan
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Pilih Perusahaan dan Tulis Pesan -->
                    <div id="step2" class="step-content" style="display: none;">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-semibold">Pilih Perusahaan <span class="text-danger">*</span></label>
                                <div>
                                    <button type="button" class="btn btn-sm btn-outline-primary" id="selectAllCompanies">
                                        <i class="fas fa-check-double me-1"></i>Pilih Semua
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" id="unselectAllCompanies">
                                        <i class="fas fa-times me-1"></i>Batal Semua
                                    </button>
                                </div>
                            </div>
                            <div id="companiesList" class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                                <!-- Daftar perusahaan akan dimuat di sini -->
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="pesan" class="form-label fw-semibold">Pesan Email <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="5"
                                placeholder="Tulis pesan yang akan dikirim ke perusahaan..." required></textarea>
                            <div class="form-text">Minimal 10 karakter</div>
                            <div class="invalid-feedback" id="error-pesan"></div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="pending" selected>Pending</option>
                                <option value="terkirim">Terkirim</option>
                                <option value="gagal">Gagal</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan">
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary" id="backToStep1">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </button>
                            <div>
                                <span class="me-2" id="selectedCount">0 perusahaan dipilih</span>
                                <button type="submit" class="btn btn-success" id="submitBtn" disabled>
                                    <i class="fas fa-paper-plane me-2"></i>Tambah ke Prospek Email
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-semibold" id="modalHapusLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2">Apakah Anda yakin ingin menghapus prospek email <strong id="namaProspekHapus"></strong>?</p>
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <small>Semua riwayat email terkait prospek ini juga akan terhapus!</small>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Batal
                </button>
                <button type="button" class="btn btn-danger" id="btnKonfirmasiHapus">
                    <i class="fas fa-trash me-1"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999;">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let selectedProspekId = null;
        let deleteProspekId = null;

        // Event handler untuk tombol pilih prospek dari card
        $('.btn-select-prospek').click(function() {
            const prospekId = $(this).data('prospek-id');
            const prospekName = $(this).data('prospek-name');

            $('#prospek_select').val(prospekId);
            $('#addProspekEmailModal').modal('show');
        });

        // Event handler untuk tombol "Lanjutkan"
        $('#loadProspekDetails').click(function() {
            selectedProspekId = $('#prospek_select').val();
            if (!selectedProspekId) {
                $('#prospek_select').addClass('is-invalid');
                $('#error-prospek_select').text('Pilih prospek terlebih dahulu!');
                return;
            }

            // Clear error
            $('#prospek_select').removeClass('is-invalid');
            $('#error-prospek_select').text('');

            loadProspekDetails(selectedProspekId);
        });

        // Event handler untuk tombol "Kembali"
        $('#backToStep1').click(function() {
            $('#step2').hide();
            $('#step1').show();
            resetForm();
        });

        // Event handler untuk tombol "Pilih Semua"
        $('#selectAllCompanies').click(function() {
            $('#companiesList input[type="checkbox"]:not(:disabled)').prop('checked', true);
            updateSelectedCount();
        });

        // Event handler untuk tombol "Batal Semua"
        $('#unselectAllCompanies').click(function() {
            $('#companiesList input[type="checkbox"]').prop('checked', false);
            updateSelectedCount();
        });

        // Event handler untuk perubahan checkbox perusahaan
        $(document).on('change', '#companiesList input[type="checkbox"]', function() {
            updateSelectedCount();
        });

        // Event handler untuk submit form
        $('#addProspekEmailForm').submit(function(e) {
            e.preventDefault();

            const selectedCompanies = $('#companiesList input[type="checkbox"]:checked').map(function() {
                return this.value;
            }).get();

            if (selectedCompanies.length === 0) {
                alert('Pilih minimal satu perusahaan!');
                return;
            }

            const pesan = $('#pesan').val().trim();
            if (pesan.length < 10) {
                $('#pesan').addClass('is-invalid');
                $('#error-pesan').text('Pesan minimal 10 karakter!');
                return;
            }

            // Clear error
            $('#pesan').removeClass('is-invalid');
            $('#error-pesan').text('');

            submitProspekEmail(selectedCompanies, pesan);
        });

        // Search functionality
        $('#searchEmailData').on('keyup', function() {
            const value = $(this).val().toLowerCase();
            $('table tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Function untuk hapus prospek email
        function hapusProspekEmail(id, judul) {
            $('#namaProspekHapus').text(judul);
            $('#modalHapus').modal('show');

            // Set event handler untuk tombol konfirmasi hapus
            $('#btnKonfirmasiHapus').off('click').on('click', function() {
                hapusProspekEmailKonfirmasi(id);
            });
        }

        function hapusProspekEmailKonfirmasi(id) {
            // Show loading
            $('#loadingOverlay').show();

            $.ajax({
                url: '<?= base_url('email/delete') ?>/' + id,
                type: 'POST',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('#loadingOverlay').hide();
                    $('#modalHapus').modal('hide');

                    if (response.success) {
                        alert('Prospek email berhasil dihapus');
                        window.location.reload();
                    } else {
                        alert(response.message || 'Gagal menghapus prospek email');
                    }
                },
                error: function(xhr, status, error) {
                    $('#loadingOverlay').hide();
                    $('#modalHapus').modal('hide');

                    console.error('Error:', error);
                    console.log('Status:', status);
                    console.log('Response:', xhr.responseText);

                    let errorMessage = 'Terjadi kesalahan pada server';
                    try {
                        const errorResponse = JSON.parse(xhr.responseText);
                        if (errorResponse.message) {
                            errorMessage = errorResponse.message;
                        }
                    } catch (e) {
                        // Jika tidak bisa parse JSON, gunakan pesan default
                    }

                    alert(errorMessage);
                }
            });
        }

        // Function untuk load detail prospek
        function loadProspekDetails(prospekId) {
            $.ajax({
                url: '<?= base_url('email/get-prospek-details') ?>/' + prospekId,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    $('#loadProspekDetails').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Loading...');
                },
                success: function(response) {
                    if (response.success && response.details.length > 0) {
                        displayCompanies(response.details);
                        $('#step1').hide();
                        $('#step2').show();
                    } else {
                        alert('Tidak ada perusahaan dengan email yang tersedia atau semua sudah dikirim email');
                        $('#loadProspekDetails').prop('disabled', false).html('<i class="fas fa-arrow-right me-2"></i>Lanjutkan');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error loading details:', textStatus, errorThrown);
                    alert('Terjadi kesalahan saat memuat data: ' + errorThrown);
                    $('#loadProspekDetails').prop('disabled', false).html('<i class="fas fa-arrow-right me-2"></i>Lanjutkan');
                }
            });
        }

        // Function untuk display companies
        function displayCompanies(companies) {
            let html = '';

            companies.forEach(function(company) {
                html += `
<div class="form-check mb-2 d-flex align-items-center">
    <input class="form-check-input me-2" type="checkbox" 
           value="${company.id_detail_prospek}" 
           id="company_${company.id_detail_prospek}" 
           name="selected_companies[]">
    <label class="form-check-label flex-grow-1" for="company_${company.id_detail_prospek}">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <strong>${company.nama_perusahaan}</strong><br>
                <small class="text-muted">${company.email}</small>
            </div>
            <span class="badge bg-secondary">Belum Dikirim</span>
        </div>
    </label>
</div>
`;
            });

            $('#companiesList').html(html);
            updateSelectedCount();
        }

        // Function untuk update jumlah perusahaan yang dipilih
        function updateSelectedCount() {
            const selectedCount = $('#companiesList input[type="checkbox"]:checked').length;
            $('#selectedCount').text(selectedCount + ' perusahaan dipilih');
            $('#submitBtn').prop('disabled', selectedCount === 0);
        }

        // Function untuk submit prospek email
        function submitProspekEmail(selectedCompanies, pesan) {
            const status = $('#status').val();
            const keterangan = $('#keterangan').val();

            $.ajax({
                url: '<?= base_url('email/store') ?>',
                type: 'POST',
                data: {
                    selected_companies: selectedCompanies,
                    pesan: pesan,
                    status: status,
                    keterangan: keterangan,
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#submitBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...');
                },
                success: function(response) {
                    if (response.success) {
                        $('#addProspekEmailModal').modal('hide');
                        // Show success message
                        const alertHtml = `
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>${response.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                `;
                        $('.container-fluid').prepend(alertHtml);
                        // Reload page after short delay
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error submitting:', textStatus, errorThrown);
                    alert('Terjadi kesalahan saat menyimpan: ' + errorThrown);
                },
                complete: function() {
                    $('#submitBtn').prop('disabled', false).html('<i class="fas fa-paper-plane me-2"></i>Tambah ke Prospek Email');
                }
            });
        }

        // Function untuk reset form
        function resetForm() {
            $('#prospek_select').val('');
            $('#companiesList').empty();
            $('#pesan').val('');
            $('#selectedCount').text('0 perusahaan dipilih');
            $('#submitBtn').prop('disabled', true);
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
        }

        // Reset form saat modal ditutup
        $('#addProspekEmailModal').on('hidden.bs.modal', function() {
            $('#step2').hide();
            $('#step1').show();
            resetForm();
        });
    });
</script>

<?= $this->endSection(); ?>