<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0"><i class="fab fa-whatsapp me-2"></i><?= $title ?></h1>
            </div>
            <div class="col-auto">
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProspekWhatsappModal">
                        <i class="fas fa-plus me-2"></i>Tambah Prospek WhatsApp
                    </button>
                    <a href="<?= base_url('prospek') ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Prospek
                    </a>
                </div>
            </div>
        </div>

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

        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">
                            <i class="fas fa-list me-2"></i>Prospek dengan Riwayat WhatsApp
                        </h4>
                    </div>
                    <div class="col-auto">
                        <div class="card-header-action">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari prospek WhatsApp..." id="searchWhatsappData">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-card-body">
                <?php if (empty($prospek_whatsapp)): ?>
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-comments fa-3x mb-3"></i>
                        <p>Belum ada prospek yang dikirim pesan WhatsApp</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
                                    <th class="cell" width="5%">No</th>
                                    <th class="cell" width="20%">Nama Prospek</th>
                                    <th class="cell" width="15%">Sumber Data</th>
                                    <th class="cell" width="15%">Total Perusahaan</th>
                                    <th class="cell" width="15%">WA Terkirim</th>
                                    <th class="cell" width="30%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($prospek_whatsapp as $index => $prospek): ?>
                                    <tr>
                                        <td class="cell"><?= $index + 1 ?></td>
                                        <td class="cell fw-bold">
                                            <?= esc($prospek['judul']) ?>
                                        </td>
                                        <td class="cell">
                                            <span class="badge bg-info"><?= esc($prospek['sumber_data']) ?></span>
                                        </td>
                                        <td class="cell">
                                            <span class="badge bg-secondary"><?= $prospek['total_perusahaan'] ?></span>
                                        </td>
                                        <td class="cell">
                                            <span class="badge bg-success"><?= $prospek['total_whatsapp_sent'] ?></span>
                                        </td>
                                        <td class="cell">
                                            <div class="d-flex gap-1">
                                                <a href="<?= base_url('whatsapp/detail/' . $prospek['id_prospek']) ?>"
                                                   class="btn btn-sm btn-info" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button type="button"
                                                        class="btn btn-sm btn-danger btn-delete-prospek"
                                                        data-id="<?= $prospek['id_prospek'] ?>"
                                                        data-name="<?= esc($prospek['judul']) ?>"
                                                        title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
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

        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">
                            <i class="fas fa-paper-plane me-2"></i>Prospek Tersedia untuk WhatsApp
                        </h4>
                    </div>
                </div>
            </div>
            <div class="app-card-body">
                <?php if (empty($available_prospek)): ?>
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-check-circle fa-3x mb-3"></i>
                        <p>Semua prospek sudah dikirim WhatsApp atau tidak ada prospek dengan No. HP yang valid</p>
                    </div>
                <?php else: ?>
                    <div class="row">
                        <?php foreach ($available_prospek as $prospek): ?>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="card border-warning">
                                    <div class="card-body">
                                        <h6 class="card-title fw-bold"><?= esc($prospek['judul']) ?></h6>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                <i class="fas fa-tag me-1"></i><?= esc($prospek['sumber_data']) ?>
                                            </small><br>
                                            <span class="badge bg-warning text-dark">
                                                <?= $prospek['total_perusahaan_dengan_hp'] ?> perusahaan dengan No. HP
                                            </span>
                                        </p>
                                        <button type="button" class="btn btn-sm btn-warning btn-select-prospek"
                                                data-prospek-id="<?= $prospek['id_prospek'] ?>"
                                                data-prospek-name="<?= esc($prospek['judul']) ?>">
                                            <i class="fas fa-plus me-1"></i>Pilih
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addProspekWhatsappModal" tabindex="-1" aria-labelledby="addProspekWhatsappModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addProspekWhatsappModalLabel">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Prospek WhatsApp
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addProspekWhatsappForm">
                <div class="modal-body">
                    <div id="step1" class="step-content">
                        <div class="mb-3">
                            <label for="prospek_select" class="form-label">Pilih Prospek <span class="text-danger">*</span></label>
                            <select class="form-select" id="prospek_select" name="prospek_select" required>
                                <option value="">-- Pilih Prospek --</option>
                                <?php foreach ($available_prospek as $prospek): ?>
                                    <option value="<?= $prospek['id_prospek'] ?>">
                                        <?= esc($prospek['judul']) ?> (<?= $prospek['total_perusahaan_dengan_hp'] ?> perusahaan)
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

                    <div id="step2" class="step-content" style="display: none;">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label">Pilih Perusahaan <span class="text-danger">*</span></label>
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
                                </div>
                        </div>

                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan WhatsApp <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="5"
                                      placeholder="Tulis pesan yang akan dikirim ke perusahaan..." required></textarea>
                            <div class="form-text">Minimal 10 karakter</div>
                            <div class="invalid-feedback" id="error-pesan"></div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="pending" selected>Pending</option>
                                <option value="terkirim">Terkirim</option>
                                <option value="gagal">Gagal</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan">
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" id="backToStep1">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </button>
                            <div>
                                <span class="me-2" id="selectedCount">0 perusahaan dipilih</span>
                                <button type="submit" class="btn btn-success" id="submitBtn" disabled>
                                    <i class="fab fa-whatsapp me-2"></i>Tambah ke Prospek WhatsApp
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus prospek WhatsApp <strong id="deleteProspekName"></strong>?</p>
                <p class="text-danger"><small>Catatan: Ini akan menghapus semua riwayat WhatsApp terkait prospek ini.</small></p>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        let selectedProspekId = null;
        let deleteProspekId = null;

        // Event handler untuk tombol pilih prospek dari card
        $('.btn-select-prospek').click(function() {
            const prospekId = $(this).data('prospek-id');
            $('#prospek_select').val(prospekId);
            $('#addProspekWhatsappModal').modal('show');
        });

        // Event handler untuk tombol hapus
        $(document).on('click', '.btn-delete-prospek', function() {
            deleteProspekId = $(this).data('id');
            const prospekName = $(this).data('name');
            $('#deleteProspekName').text(prospekName);
            $('#deleteModal').modal('show');
        });

        // Event handler untuk tombol konfirmasi hapus
        $('#confirmDeleteBtn').click(function() {
            if (deleteProspekId) {
                $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Menghapus...');

                $.ajax({
                    url: '<?= base_url('whatsapp/delete/') ?>' + deleteProspekId,
                    type: 'POST',
                    data: {
                        <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#deleteModal').modal('hide');
                            const alertHtml = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>${response.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`;
                            $('.container-xl').prepend(alertHtml);
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', jqXHR.responseText);
                        let errorMsg = 'Terjadi kesalahan saat menghapus';
                        if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                            errorMsg = jqXHR.responseJSON.message;
                        }
                        alert(errorMsg);
                    },
                    complete: function() {
                        $('#confirmDeleteBtn').prop('disabled', false).html('<i class="fas fa-trash me-2"></i>Hapus');
                    }
                });
            }
        });

        // Event handler untuk tombol "Lanjutkan"
        $('#loadProspekDetails').click(function() {
            selectedProspekId = $('#prospek_select').val();
            if (!selectedProspekId) {
                $('#prospek_select').addClass('is-invalid');
                $('#error-prospek_select').text('Pilih prospek terlebih dahulu!');
                return;
            }
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

        // Event handler untuk tombol "Pilih Semua" dan "Batal Semua"
        $('#selectAllCompanies').click(function() {
            $('#companiesList input[type="checkbox"]:not(:disabled)').prop('checked', true);
            updateSelectedCount();
        });
        $('#unselectAllCompanies').click(function() {
            $('#companiesList input[type="checkbox"]').prop('checked', false);
            updateSelectedCount();
        });
        
        // Event handler untuk perubahan checkbox perusahaan
        $(document).on('change', '#companiesList input[type="checkbox"]', function() {
            updateSelectedCount();
        });

        // Event handler untuk submit form
        $('#addProspekWhatsappForm').submit(function(e) {
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
            $('#pesan').removeClass('is-invalid');
            $('#error-pesan').text('');

            submitProspekWhatsapp(selectedCompanies, pesan);
        });

        // Search functionality
        $('#searchWhatsappData').on('keyup', function() {
            const value = $(this).val().toLowerCase();
            $('table tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Function untuk load detail prospek
        function loadProspekDetails(prospekId) {
            $.ajax({
                url: '<?= base_url('whatsapp/get-prospek-details') ?>/' + prospekId,
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
                        alert('Tidak ada perusahaan dengan No. HP yang tersedia atau semua sudah dikirimi pesan WhatsApp.');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error loading details:', textStatus, errorThrown);
                    alert('Terjadi kesalahan saat memuat data: ' + errorThrown);
                },
                complete: function() {
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
                                <small class="text-muted">${company.no_hp}</small>
                            </div>
                            <span class="badge bg-secondary">Belum Di-WhatsApp</span>
                        </div>
                    </label>
                </div>`;
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

        // Function untuk submit prospek WhatsApp
        function submitProspekWhatsapp(selectedCompanies, pesan) {
            const status = $('#status').val();
            const keterangan = $('#keterangan').val();

            $.ajax({
                url: '<?= base_url('whatsapp/store') ?>',
                type: 'POST',
                data: {
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>',
                    selected_companies: selectedCompanies,
                    pesan: pesan,
                    status: status,
                    keterangan: keterangan
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#submitBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...');
                },
                success: function(response) {
                    if (response.success) {
                        $('#addProspekWhatsappModal').modal('hide');
                        const alertHtml = `
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>${response.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                        $('.container-xl').prepend(alertHtml);
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
                    $('#submitBtn').prop('disabled', false).html('<i class="fab fa-whatsapp me-2"></i>Tambah ke Prospek WhatsApp');
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
        $('#addProspekWhatsappModal').on('hidden.bs.modal', function() {
            $('#step2').hide();
            $('#step1').show();
            resetForm();
        });
    });
</script>

<?= $this->endSection(); ?>