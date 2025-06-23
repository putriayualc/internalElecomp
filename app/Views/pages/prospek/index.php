<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid py-3">
    <div class="rounded-3 shadow-sm mb-4"
        style="background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="d-flex justify-content-between align-items-center p-4 text-white">
            <div>
                <h1 class="h1 fw-bold"><?= $title ?></h1>
                <p class="text-white-70 small mb-0">Kelola data prospek perusahaan untuk pemasaran</p>
            </div>

            <div class="d-flex gap-2">
                <a href="<?= base_url('whatsapp') ?>" class="btn btn-outline-light px-4 py-2 fs-6 d-flex align-items-center gap-2">
                    <i class="fab fa-whatsapp"></i>
                    <span class="d-none d-sm-inline">Prospek WhatsApp</span>
                </a>

                <a href="<?= base_url('email') ?>" class="btn btn-outline-light px-4 py-2 fs-6 d-flex align-items-center gap-2">
                    <i class="fas fa-envelope"></i>
                    <span class="d-none d-sm-inline">Prospek Email</span>
                </a>

                <button type="button" class="btn btn-light text-info px-4 py-2 fs-6 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addProspekModal">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span class="d-none d-sm-inline">Tambah Prospek</span>
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
                    <table id="prospekTable" class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center border-end" style="width: 60px;">
                                    <span class="fw-semibold">No</span>
                                </th>
                                <th class="text-center border-end" style="min-width: 200px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-primary bg-opacity-10 text-primary">
                                            <i class="fas fa-bullseye"></i>
                                        </span>
                                        <span class="fw-semibold">Judul Prospek</span>
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
                                <th class="text-center border-end" style="min-width: 100px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-success bg-opacity-10 text-success">
                                            <i class="fab fa-whatsapp"></i>
                                        </span>
                                        <span class="fw-semibold">WA Sent</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-warning bg-opacity-10 text-warning">
                                            <i class="fas fa-comments"></i>
                                        </span>
                                        <span class="fw-semibold">Status Komunikasi</span>
                                    </div>
                                </th>
                                <th class="text-center" style="width: 120px;">
                                    <span class="fw-semibold">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($prospek)): ?>
                                <?php foreach ($prospek as $index => $row): ?>
                                    <tr>
                                        <td class="text-center border-end">
                                            <span class="text-muted fw-medium"><?= $index + 1 ?></span>
                                        </td>
                                        <td class="border-end">
                                            <div class="d-flex align-items-center py-2">
                                                <div class="flex-grow-1 min-width-0">
                                                    <div class="mb-1">
                                                        <a href="<?= base_url('prospek/detail/' . $row['id_prospek']) ?>"
                                                            class="text-decoration-none text-dark fw-semibold user-name-link">
                                                            <?= esc($row['judul']) ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center border-end">
                                            <span class="text-truncate d-inline-block fw-medium" style="max-width: 150px;"
                                                title="<?= esc($row['sumber_data']) ?>">
                                                <?= esc($row['sumber_data']) ?>
                                            </span>
                                        </td>
                                        <td class="text-center border-end">
                                            <span class="status-badge" style="background-color: #e3f2fd; color: #1565c0; border: 1px solid #1565c0;">
                                                <?= $row['total_perusahaan'] ?>
                                            </span>
                                        </td>
                                        <td class="text-center border-end">
                                            <span class="status-badge" style="background-color: #e8f5e8; color: #2e7d32; border: 1px solid #2e7d32;">
                                                <?= $row['total_email_sent'] ?>
                                            </span>
                                        </td>
                                        <td class="text-center border-end">
                                            <span class="status-badge" style="background-color: #e8f5e8; color: #388e3c; border: 1px solid #388e3c;">
                                                <?= $row['total_whatsapp_sent'] ?>
                                            </span>
                                        </td>
                                        <td class="text-center border-end">
                                            <?php
                                            $badgeClass = match ($row['status_komunikasi']) {
                                                'Email & WA' => 'status-badge' . ' ' . 'status-active',
                                                'Email Only' => 'status-badge' . ' ' . 'status-completed',
                                                'WA Only' => 'status-badge' . ' ' . 'status-completed',
                                                default => 'status-badge' . ' ' . 'status-inactive'
                                            };
                                            ?>
                                            <span class="<?= $badgeClass ?>">
                                                <?= $row['status_komunikasi'] ?>
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
                                                            href="<?= base_url('prospek/detail/' . $row['id_prospek']) ?>">
                                                            <i class="fas fa-eye text-info me-2"></i>
                                                            <span>Detail</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center text-warning"
                                                            href="#" onclick="editProspek(<?= $row['id_prospek'] ?>)">
                                                            <i class="fas fa-edit text-warning me-2"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center text-danger"
                                                            href="#" onclick="hapusProspek(<?= $row['id_prospek'] ?>, '<?= esc($row['judul']) ?>')">
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
                                    <td colspan="8" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-inbox text-muted mb-3" style="font-size: 3rem;"></i>
                                            <h5 class="text-muted">Tidak ada data prospek</h5>
                                            <p class="text-muted mb-0">Silakan tambah prospek baru untuk memulai</p>
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

<!-- Modal Tambah/Edit Prospek -->
<div class="modal fade" id="addProspekModal" tabindex="-1" aria-labelledby="addProspekModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-semibold" id="addProspekModalLabel">
                    <i class="fas fa-plus-circle me-2"></i> Tambah Prospek
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="prospekForm">
                <div class="modal-body">
                    <input type="hidden" id="prospek_id" name="prospek_id">
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-semibold">
                            Judul Prospek <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="judul" name="judul" required
                            placeholder="Masukkan judul prospek">
                        <div class="invalid-feedback" id="error-judul"></div>
                    </div>
                    <div class="mb-3">
                        <label for="sumber_data" class="form-label fw-semibold">
                            Sumber Data <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="sumber_data" name="sumber_data" required
                            placeholder="Masukkan sumber data">
                        <div class="invalid-feedback" id="error-sumber_data"></div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
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
                <p class="mb-2">Apakah Anda yakin ingin menghapus prospek <strong id="namaProspekHapus"></strong>?</p>
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <small>Semua data detail perusahaan dalam prospek ini juga akan terhapus!</small>
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

<style>
    /* Hilangkan semua indikator sorting pada header tabel */
    #prospekTable thead th {
        cursor: default !important;
    }

    #prospekTable thead th:hover {
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

<script>
    $(document).ready(function() {
        var table = $('#prospekTable').DataTable({
            responsive: false,
            pageLength: 10,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Semua"]
            ],
            language: {
                decimal: "",
                emptyTable: "Tidak ada data prospek yang tersedia",
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
                    orderable: false, // Kolom "No" tidak perlu bisa di-search
                    searchable: false,
                    targets: 0
                },
                {
                    orderable: false, // Kolom "Aksi" tidak perlu bisa di-sort
                    targets: -1 // -1 menargetkan kolom terakhir
                }
            ],
            // === PERUBAHAN DI SINI ===
            // Urutkan berdasarkan kolom pertama (No) secara descending.
            // Ini akan membuat data terbaru (yang punya nomor urut terbesar) berada di atas.
            // order: [
            //     [0, 'desc']
            // ],
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
                $('#prospekTable_length').appendTo('#custom-length');
                $('#prospekTable_filter').appendTo('#custom-search');

                // FIX tampilan "Tampilkan 10 data"
                $('.dataTables_length label').addClass('d-flex align-items-center gap-2 mb-0');
            },

            drawCallback: function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });

        // Penomoran otomatis yang tetap berurutan (sudah benar)
        table.on('order.dt search.dt', function() {
            let i = 1;
            table.rows({
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, k) {
                cell.getElementsByTagName('td')[0].innerHTML = k + 1;
            });
        }).draw();
    });


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

    // FUNGSI DELETE YANG DIPERBAIKI
    function hapusProspek(id, judul) {
        $('#namaProspekHapus').text(judul);
        $('#modalHapus').modal('show');

        // Set event handler untuk tombol konfirmasi hapus
        $('#btnKonfirmasiHapus').off('click').on('click', function() {
            hapusProspekKonfirmasi(id);
        });
    }

    function hapusProspekKonfirmasi(id) {
        // Show loading
        $('#loadingOverlay').show();

        $.ajax({
            url: '<?= base_url('prospek/delete') ?>/' + id,
            type: 'POST', // UBAH KE POST
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                $('#loadingOverlay').hide();
                $('#modalHapus').modal('hide');

                if (response.success) {
                    alert('Prospek berhasil dihapus');
                    window.location.reload();
                } else {
                    alert(response.message || 'Gagal menghapus prospek');
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
</script>

<?= $this->endSection(); ?>