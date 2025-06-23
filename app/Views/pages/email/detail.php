<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid py-3">
    <div class="rounded-3 shadow-sm mb-4" style="background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1593697821034-73af01208535?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="d-flex justify-content-between align-items-center p-4 text-white">
            <div>
                <h1 class="h1 fw-bold"><?= esc($prospek['judul']) ?></h1>
                <p class="text-white-70 small mb-0">Kelola data Email prospek untuk pemasaran</p>
            </div>

            <div class="d-flex gap-2">
                <a href="<?= base_url('prospek') ?>" class="btn btn-outline-light px-4 py-2 fs-6 d-flex align-items-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    <span class="d-none d-sm-inline">Kembali</span>
                </a>

                <button type="button" class="btn btn-light text-info px-4 py-2 fs-6 d-flex align-items-center gap-2" id="btnAddEmail" data-id-prospek="<?= $prospek['id_prospek'] ?>">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span class="d-none d-sm-inline">Tambah Email</span>
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
<div class="card border-0 shadow-sm">
    <div class="card-body px-1">
        <div class="card-header bg-white">
            <div class="row align-items-start">
                <div class="col">
                    <!-- Custom Toolbar -->
                    <div class="row" id="custom-toolbar">
                        <div class="col-md-6 d-flex align-items-center" id="custom-length"></div>
                        <div class="col-md-6 d-flex justify-content-md-end justify-content-start mt-2 mt-md-0" id="custom-search"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTable Container -->
        <div class="datatable-wrapper">
            <div class="table-responsive">
                <div class="table-responsive-wrapper">
                    <table id="emailTable" class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center border-end" style="width: 60px;">
                                    <span class="fw-semibold">No</span>
                                </th>
                                <th class="border-end" style="min-width: 200px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-primary bg-opacity-10 text-primary">
                                            <i class="fas fa-building"></i>
                                        </span>
                                        <span class="fw-semibold">Perusahaan</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-info bg-opacity-10 text-info">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                        <span class="fw-semibold">Tanggal Kirim</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 120px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-success bg-opacity-10 text-success">
                                            <i class="fab fa-email"></i>
                                        </span>
                                        <span class="fw-semibold">Status</span>
                                    </div>
                                </th>
                                <th class="text-center" style="width: 120px;">
                                    <span class="fw-semibold">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($email_history)): ?>
                                <?php foreach ($email_history as $index => $row): ?>
                                    <tr>
                                        <td class="text-center border-end">
                                            <span class="text-muted fw-medium"><?= $index + 1 ?></span>
                                        </td>
                                        <td class="border-end">
                                            <div class="d-flex align-items-center py-2">
                                                <div class="flex-grow-1 min-width-0">
                                                    <div class="mb-1 fw-semibold text-dark">
                                                        <?= esc($row['nama_perusahaan']) ?>
                                                    </div>
                                                    <small class="text-muted">
                                                        <i class="fab fa-email"></i> <?= $row['email'] ?? 'Tidak ada no. hp' ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center border-end">
                                            <span class="text-muted fw-medium"><?= date('d M Y, H:i', strtotime($row['tanggal'])) ?></span>
                                        </td>
                                        <td class="text-center border-end">
                                            <?php
                                            $badgeClass = match ($row['status']) {
                                                'terkirim' => 'status-badge status-active',
                                                'pending' => 'status-badge status-completed',
                                                'gagal' => 'status-badge status-inactive',
                                                default => 'status-badge status-inactive'
                                            };
                                            ?>
                                            <span class="<?= $badgeClass ?>">
                                                <?= ucfirst($row['status']) ?>
                                            </span>
                                            <?php if (!empty($row['keterangan'])): ?>
                                                <br>
                                                <small class="text-muted fst-italic"><?= esc($row['keterangan']) ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle action-btn"
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center text-info btn-view-message"
                                                            href="#" data-bs-toggle="modal" data-bs-target="#messageModal"
                                                            data-company="<?= esc($row['nama_perusahaan']) ?>"
                                                            data-date="<?= date('d/m/Y H:i', strtotime($row['tanggal'])) ?>"
                                                            data-message="<?= esc($row['pesan']) ?>">
                                                            <i class="fas fa-eye text-info me-2"></i>
                                                            <span>Detail</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center text-primary btn-edit-email"
                                                            href="#" data-id="<?= $row['id_prospek_email'] ?>"
                                                            data-id-detail="<?= $row['id_detail_prospek'] ?? '' ?>"
                                                            data-company="<?= esc($row['nama_perusahaan']) ?>"
                                                            data-message="<?= esc($row['pesan']) ?>"
                                                            data-status="<?= esc($row['status']) ?>"
                                                            data-keterangan="<?= esc($row['keterangan'] ?? '') ?>">
                                                            <i class="fas fa-edit text-primary me-2"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center text-danger btn-delete-email"
                                                            href="#" data-id="<?= $row['id_prospek_email'] ?>"
                                                            data-company="<?= esc($row['nama_perusahaan']) ?>">
                                                            <i class="fas fa-trash text-danger me-2"></i>
                                                            <span>Hapus</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Email -->
<div class="modal fade" id="addMultipleEmailsModal" tabindex="-1" aria-labelledby="addMultipleEmailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title fw-semibold" id="addMultipleEmailsModalLabel">
                    <i class="fas fa-plus-circle me-2"></i> Tambah Email
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addMultipleEmailsForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label fw-semibold">Pilih Perusahaan Penerima <span class="text-danger">*</span></label>
                            <div>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="selectAllCompanies">
                                    <i class="fas fa-check-double me-1"></i>Pilih Semua
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="unselectAllCompanies">
                                    <i class="fas fa-times me-1"></i>Batal Semua
                                </button>
                            </div>
                        </div>
                        <div id="companyListContainer" class="border rounded p-3" style="max-height: 250px; overflow-y: auto;">
                            <!-- Daftar perusahaan akan dimuat di sini -->
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="pesan_multiple" class="form-label fw-semibold">Pesan Email <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="pesan_multiple" name="pesan" rows="6" required
                            placeholder="Tulis template pesan email di sini..."></textarea>
                        <div class="form-text">Minimal 10 karakter.</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="status_multiple" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="status_multiple" name="status" required>
                                <option value="terkirim" selected>Terkirim</option>
                                <option value="pending">Pending</option>
                                <option value="gagal">Gagal</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="keterangan_multiple" class="form-label fw-semibold">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan_multiple" name="keterangan"
                                placeholder="Opsional (misal: Follow Up ke-2)">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <span class="me-auto text-muted fw-medium" id="selectedCountText">0 perusahaan dipilih</span>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btnSaveMultipleEmails" disabled>
                        <i class="fas fa-save me-1"></i> Simpan & Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Email -->
<div class="modal fade" id="editEmailModal" tabindex="-1" aria-labelledby="editEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-dark">
                <h5 class="modal-title fw-semibold" id="editEmailModalLabel">
                    <i class="fas fa-edit me-2"></i> Edit Email
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editEmailForm">
                <div class="modal-body">
                    <input type="hidden" id="edit_id_prospek_email" name="id_prospek_email">
                    <div class="mb-3">
                        <label for="edit_nama_perusahaan" class="form-label fw-semibold">Perusahaan</label>
                        <input type="text" class="form-control" id="edit_nama_perusahaan" name="nama_perusahaan" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit_pesan" class="form-label fw-semibold">Pesan Email <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="edit_pesan" name="pesan" rows="8" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_status" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="edit_status" name="status" required>
                                <option value="terkirim">Terkirim</option>
                                <option value="pending">Pending</option>
                                <option value="gagal">Gagal</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_keterangan" class="form-label fw-semibold">Keterangan</label>
                            <input type="text" class="form-control" id="edit_keterangan" name="keterangan"
                                placeholder="Opsional">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btnUpdateEmail">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Lihat Pesan -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title fw-semibold" id="messageModalLabel">
                    <i class="fas fa-envelope-open-text me-2"></i> Detail Pesan Email
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Perusahaan:</strong> <span id="modal-company" class="fw-medium"></span></p>
                <p><strong>Tanggal Kirim:</strong> <span id="modal-date" class="fw-medium"></span></p>
                <strong>Pesan:</strong>
                <div id="modal-message" class="border rounded p-3 bg-light mt-2" style="white-space: pre-wrap;"></div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-semibold" id="deleteConfirmModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus riwayat Email untuk perusahaan <strong id="companyToDelete"></strong>?</p>
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <small>Tindakan ini tidak dapat dibatalkan.</small>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Batal
                </button>
                <button type="button" class="btn btn-danger" id="btnConfirmDelete">
                    <i class="fas fa-trash me-1"></i> Ya, Hapus
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

<style>
    /* Hilangkan semua indikator sorting pada header tabel */
    #emailTable thead th {
        cursor: default !important;
    }

    #emailTable thead th:hover {
        background-color: inherit !important;
    }

    /* Hilangkan ikon sorting DataTables */
    table.dataTable thead th,
    table.dataTable thead td {
        border-bottom: 1px solid #ddd;
    }

    table.dataTable thead .sorting,
    table.dataTable thead .sorting_asc,
    table.dataTable thead .sorting_desc,
    table.dataTable thead .sorting_asc_disabled,
    table.dataTable thead .sorting_desc_disabled {
        background-image: none !important;
        cursor: default !important;
    }

    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:after {
        display: none !important;
    }

    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_desc:before {
        display: none !important;
    }
</style>

<style>
    /* Style konsisten dengan halaman prospek */
    .icon-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }

    .status-badge {
        display: inline-block;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
    }

    .status-active {
        background-color: #e8f5e8;
        color: #2e7d32;
        border: 1px solid #2e7d32;
    }

    .status-completed {
        background-color: #fff3e0;
        color: #ef6c00;
        border: 1px solid #ef6c00;
    }

    .status-inactive {
        background-color: #ffebee;
        color: #c62828;
        border: 1px solid #c62828;
    }
</style>

<script>
    $(document).ready(function() {
        var table = $('#emailTable').DataTable({
            responsive: false,
            pageLength: 10,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Semua"]
            ],
            language: {
                decimal: "",
                emptyTable: "Tidak ada data Email yang tersedia",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 - 0 dari 0 data",
                infoFiltered: "(difilter dari _MAX_ total data)",
                lengthMenu: "Tampilkan _MENU_ data",
                loadingRecords: "Memuat...",
                processing: "Memproses...",
                search: "Cari:",
                searchPlaceholder: "Ketik untuk mencari...",
                zeroRecords: "Tidak ada data yang cocok",
                paginate: {
                    first: "❮❮",
                    last: "❯❯",
                    next: "❯",
                    previous: "❮"
                }
            },
            dom: '<"dt-temp-toolbar"lf>rt<"row g-3 mt-2 pt-2 border-top"' +
                '<"col-md-5 d-flex align-items-center"i>' +
                '<"col-md-7 d-flex justify-content-md-end"p>>',
            columnDefs: [{
                    orderable: false,
                    searchable: false,
                    targets: 0
                },
                {
                    orderable: false,
                    targets: -1
                }
            ],
            autoWidth: false,
            stateSave: true,

            initComplete: function() {
                // Tambahkan styling bootstrap
                $('.dataTables_length select').addClass('form-select form-select-sm me-2');
                $('.dataTables_filter input').addClass('form-control form-control-sm').attr('placeholder', 'Ketik untuk mencari...');
                $('.dataTables_length').addClass('d-flex align-items-center');
                $('.dataTables_filter').addClass('d-flex align-items-center justify-content-end');
                $('.dataTables_filter label').addClass('d-flex align-items-center mb-0');

                // Pindahkan kontrol ke tempat custom
                $('#emailTable_length').appendTo('#custom-length');
                $('#emailTable_filter').appendTo('#custom-search');

                // FIX tampilan "Tampilkan 10 data"
                $('.dataTables_length label').addClass('d-flex align-items-center gap-2 mb-0');
            },

            drawCallback: function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });

        // Penomoran otomatis yang tetap berurutan
        table.on('order.dt search.dt', function() {
            let i = 1;
            table.rows({
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, k) {
                cell.getElementsByTagName('td')[0].innerHTML = k + 1;
            });
        }).draw();

        // Variabel global
        let selectedEmailId = null;
        const addMultipleEmailsModal = new bootstrap.Modal(document.getElementById('addMultipleEmailsModal'));
        const editEmailModal = new bootstrap.Modal(document.getElementById('editEmailModal'));
        const deleteConfirmModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
        const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));

        // --- FUNGSI UNTUK TAMBAH MULTIPLE EMAIL ---
        $('#btnAddEmail').click(function() {
            const idProspek = $(this).data('id-prospek');
            $('#addMultipleEmailsForm')[0].reset();
            loadCompaniesForNewEmail(idProspek);
            addMultipleEmailsModal.show();
        });

        function loadCompaniesForNewEmail(idProspek) {
            const container = $('#companyListContainer');
            container.html('<div class="text-center text-muted p-3"><div class="spinner-border spinner-border-sm"></div> Memuat...</div>');

            $.ajax({
                url: '<?= base_url('email/get-prospek-details') ?>/' + idProspek,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    let html = '';
                    if (response.success && response.details.length > 0) {
                        response.details.forEach(function(company) {
                            html += `
                                <div class="form-check mb-2">
                                    <input class="form-check-input company-checkbox" type="checkbox" value="${company.id_detail_prospek}" id="company_add_${company.id_detail_prospek}">
                                    <label class="form-check-label" for="company_add_${company.id_detail_prospek}">
                                        <strong>${company.nama_perusahaan}</strong> <br>
                                        <small class="text-muted"><i class="fab fa-email"></i> ${company.email || 'Tidak ada email'}</small>
                                    </label>
                                </div>`;
                        });
                    } else {
                        html = '<div class="text-center text-muted p-3">Tidak ada perusahaan baru dengan Email yang valid di prospek ini.</div>';
                    }
                    container.html(html);
                    updateSelectedCount();
                },
                error: function() {
                    container.html('<div class="text-center text-danger p-3">Gagal memuat data perusahaan.</div>');
                }
            });
        }

        $(document).on('change', '#addMultipleEmailsModal .company-checkbox', updateSelectedCount);

        $('#addMultipleEmailsModal #selectAllCompanies').click(function() {
            $('#addMultipleEmailsModal .company-checkbox').prop('checked', true);
            updateSelectedCount();
        });

        $('#addMultipleEmailsModal #unselectAllCompanies').click(function() {
            $('#addMultipleEmailsModal .company-checkbox').prop('checked', false);
            updateSelectedCount();
        });

        function updateSelectedCount() {
            const count = $('#addMultipleEmailsModal .company-checkbox:checked').length;
            $('#selectedCountText').text(count + ' perusahaan dipilih');
            $('#btnSaveMultipleEmails').prop('disabled', count === 0);
        }

        $('#addMultipleEmailsForm').submit(function(e) {
            e.preventDefault();

            const selectedCompanies = $('#addMultipleEmailsModal .company-checkbox:checked').map(function() {
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
                url: '<?= base_url('email/store') ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                beforeSend: function() {
                    $('#btnSaveMultipleEmails').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...');
                },
                success: function(response) {
                    if (response.success) {
                        addMultipleEmailsModal.hide();
                        showNotification('success', response.message);
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        showNotification('error', response.message || 'Terjadi kesalahan.');
                    }
                },
                error: function() {
                    showNotification('error', 'Tidak dapat terhubung ke server.');
                },
                complete: function() {
                    $('#btnSaveMultipleEmails').prop('disabled', false).html('<i class="fas fa-save me-2"></i>Simpan & Kirim');
                }
            });
        });

        // --- FUNGSI UNTUK LIHAT, EDIT, HAPUS ---
        $(document).on('click', '.btn-view-message', function(e) {
            e.preventDefault();
            $('#modal-company').text($(this).data('company'));
            $('#modal-date').text($(this).data('date'));
            $('#modal-message').text($(this).data('message'));
            messageModal.show();
        });

        $(document).on('click', '.btn-edit-email', function(e) {
            e.preventDefault();
            $('#edit_id_prospek_email').val($(this).data('id'));
            $('#edit_nama_perusahaan').val($(this).data('company'));
            $('#edit_pesan').val($(this).data('message'));
            $('#edit_status').val($(this).data('status'));
            $('#edit_keterangan').val($(this).data('keterangan'));
            editEmailModal.show();
        });

        $('#editEmailForm').submit(function(e) {
            e.preventDefault();
            const id = $('#edit_id_prospek_email').val();
            const formData = $(this).serialize() + '&<?= csrf_token() ?>=' + '<?= csrf_hash() ?>';

            $.ajax({
                url: '<?= base_url('email/updateEmail') ?>/' + id,
                type: 'POST',
                data: formData,
                dataType: 'json',
                beforeSend: function() {
                    $('#btnUpdateEmail').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...');
                },
                success: function(response) {
                    if (response.success) {
                        editEmailModal.hide();
                        showNotification('success', response.message);
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        showNotification('error', response.message || 'Gagal memperbarui.');
                    }
                },
                error: function() {
                    showNotification('error', 'Tidak dapat terhubung ke server.');
                },
                complete: function() {
                    $('#btnUpdateEmail').prop('disabled', false).html('<i class="fas fa-save me-1"></i> Simpan Perubahan');
                }
            });
        });

        $(document).on('click', '.btn-delete-email', function(e) {
            e.preventDefault();
            selectedEmailId = $(this).data('id');
            $('#companyToDelete').text($(this).data('company'));
            deleteConfirmModal.show();
        });

        $('#btnConfirmDelete').click(function() {
            $.ajax({
                url: '<?= base_url('email/deleteEmail') ?>/' + selectedEmailId,
                type: 'POST',
                data: {
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#btnConfirmDelete').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Menghapus...');
                },
                success: function(response) {
                    if (response.success) {
                        deleteConfirmModal.hide();
                        showNotification('success', response.message);
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        deleteConfirmModal.hide();
                        showNotification('error', response.message || 'Gagal menghapus.');
                    }
                },
                error: function() {
                    deleteConfirmModal.hide();
                    showNotification('error', 'Tidak dapat terhubung ke server.');
                },
                complete: function() {
                    $('#btnConfirmDelete').prop('disabled', false).html('<i class="fas fa-trash me-1"></i> Ya, Hapus');
                }
            });
        });

        // Function untuk menampilkan notifikasi
        function showNotification(type, message) {
            // Hapus notifikasi yang ada
            $('.alert').remove();

            let alertClass = '';
            let icon = '';

            switch (type) {
                case 'success':
                    alertClass = 'alert-success';
                    icon = 'fas fa-check-circle';
                    break;
                case 'error':
                    alertClass = 'alert-danger';
                    icon = 'fas fa-exclamation-circle';
                    break;
                case 'warning':
                    alertClass = 'alert-warning';
                    icon = 'fas fa-exclamation-triangle';
                    break;
                default:
                    alertClass = 'alert-info';
                    icon = 'fas fa-info-circle';
            }

            const alertHtml = `
                <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                    <i class="${icon} me-2"></i>${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;

            // Tambahkan notifikasi di dalam container-fluid setelah div pertama (header dengan gradient)
            $('.container-fluid.py-3 .rounded-3.shadow-sm.mb-4').after(alertHtml);

            // Auto dismiss setelah 5 detik
            setTimeout(function() {
                $('.alert').fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 5000);
        }
    });
</script>

<?= $this->endSection(); ?>