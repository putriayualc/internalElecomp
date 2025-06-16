<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid py-3">
    <div class="rounded-3 shadow-sm mb-4"
        style="background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="d-flex justify-content-between align-items-center p-4 text-white">
            <div>
                <h1 class="h1 fw-bold">Data Siswa Magang</h1>
                <p class="text-white-70 small mb-0">Kelola data siswa yang sedang melakukan magang</p>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-outline-light px-4 py-2 fs-6 d-flex align-items-center gap-2" onclick="exportData()">
                    <i class="bi bi-download"></i>
                    <span class="d-none d-sm-inline">Export Data</span>
                </button>

                <a href="<?= route_to('siswa.tambah') ?>" class="btn btn-light text-info px-4 py-2 fs-6 d-flex align-items-center gap-2">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span class="d-none d-sm-inline">Tambah Siswa</span>
                </a>
            </div>

        </div>
    </div>
</div>



<!-- Main Content Card -->
<div class="card border-0 shadow-sm">
    <div class="card-body px-1">
        <div class="card-header bg-white">
            <div class="row align-items-start">
                <div class="col">
                    <!-- Ganti Judul dengan Custom Toolbar -->
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
                    <table id="siswaTable" class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center border-end" style="width: 60px;">
                                    <span class="fw-semibold">No</span>
                                </th>
                                <th class="text-center border-end" style="min-width: 200px;">
                                    <span class="fw-semibold">Nama Siswa</span>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-primary bg-opacity-10 text-primary">
                                            <i class="bi bi-building"></i>
                                        </span>
                                        <span class="fw-semibold">Instansi</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-success bg-opacity-10 text-success">
                                            <i class="bi bi-telephone-fill"></i>
                                        </span>
                                        <span class="fw-semibold">Telepon</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 180px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-danger bg-opacity-10 text-danger">
                                            <i class="bi bi-envelope"></i>
                                        </span>
                                        <span class="fw-semibold">Email</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-warning bg-opacity-10 text-warning">
                                            <i class="bi bi-geo-alt-fill"></i>
                                        </span>
                                        <span class="fw-semibold">Alamat</span>
                                    </div>
                                </th>
                                <!-- <th class="text-center border-end" style="min-width: 170px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-info bg-opacity-10 text-info">
                                            <i class="bi bi-info-circle"></i>
                                        </span>
                                        <span class="fw-semibold">Info Lainnya</span>
                                    </div>
                                </th> -->
                                <th class="text-center" style="width: 100px;">
                                    <span class="fw-semibold">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($siswa as $i => $siswa): ?>
                                <tr>
                                    <td class="text-center border-end">
                                        <span class="text-muted fw-medium"><?= $i + 1 ?></span>
                                    </td>
                                    <td class="border-end">
                                        <div class="d-flex align-items-center py-2">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-wrapper">
                                                    <img src="<?= base_url('assets/img/user/' . ($siswa['foto'] ?? 'default.jpg')); ?>"
                                                        alt="<?= esc($siswa['nama']); ?>"
                                                        class="avatar-img">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 min-width-0">
                                                <div class="mb-1">
                                                    <a href="<?= route_to('siswa.detail', $siswa['id_siswa']) ?>"
                                                        class="text-decoration-none text-dark fw-semibold user-name-link">
                                                        <?= esc($siswa['nama']); ?>
                                                    </a>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <small class="text-muted"><?= esc($siswa['jurusan']); ?></small>
                                                    <?php
                                                    $status = strtoupper($siswa['status']);
                                                    switch ($status) {
                                                        case 'AKTIF':
                                                            $badgeClass = 'status-badge status-active';
                                                            break;
                                                        case 'SELESAI':
                                                            $badgeClass = 'status-badge status-completed';
                                                            break;
                                                        default:
                                                            $badgeClass = 'status-badge status-inactive';
                                                    }
                                                    ?>
                                                    <span class="<?= $badgeClass; ?>">
                                                        <?= $status; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center border-end">
                                        <span class="text-truncate d-inline-block" style="max-width: 150px;"
                                            title="<?= esc($siswa['asal_instansi']); ?>">
                                            <?= esc($siswa['asal_instansi']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center border-end">
                                        <a href="tel:<?= esc($siswa['no_telepon']); ?>"
                                            class="text-truncate text-dark fw-medium">
                                            <?= esc($siswa['no_telepon']); ?>
                                        </a>
                                    </td>
                                    <td class="text-center border-end">
                                        <a href="mailto:<?= esc($siswa['email']); ?>"
                                            class="text-decoration-none text-dark fw-medium text-truncate d-inline-block"
                                            style="max-width: 180px;" title="<?= esc($siswa['email']); ?>">
                                            <?= esc($siswa['email']); ?>
                                        </a>
                                    </td>
                                    <td class="text-center border-end">
                                        <span class="text-truncate d-inline-block" style="max-width: 150px;"
                                            title="<?= esc($siswa['alamat']); ?>">
                                            <?= esc($siswa['alamat']); ?>
                                        </span>
                                    </td>
                                    <!-- <td class="text-center border-end">
                                        <span class="text-truncate d-inline-block" style="max-width: 120px;" title="<?= esc($siswa['keterangan']); ?>">
                                            <a href="<?= esc($siswa['keterangan']); ?>" target="_blank" class="text-decoration-none text-dark">
                                                <?= esc(parse_url($siswa['keterangan'], PHP_URL_HOST) ?: $siswa['keterangan']); ?>
                                                <i class="bi bi-box-arrow-up-right ms-1"></i>
                                            </a>
                                        </span>
                                    </td> -->

                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle action-btn"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center text-primary"
                                                        href="<?= route_to('siswa.edit', $siswa['id_siswa']) ?>">
                                                        <i class="bi bi-pencil-square text-primary me-2"></i>
                                                        <span>Edit</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center text-danger"
                                                        href="#"
                                                        onclick="konfirmasiHapus('<?= route_to('siswa.delete', $siswa['id_siswa']) ?>')">
                                                        <i class="bi bi-trash text-danger me-2"></i>
                                                        <span>Hapus</span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-semibold" id="modalHapusLabel">
                    <i class="bi bi-exclamation-triangle me-2"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mb-0 fs-6">Apakah Anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </button>
                <form id="formHapus" method="POST" action="" class="d-inline">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#siswaTable').DataTable({
            responsive: false,
            pageLength: 10,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Semua"]
            ],
            language: {
                decimal: "",
                emptyTable: "Tidak ada data siswa yang tersedia",
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
            // DOM harus menyertakan 'l' dan 'f' agar bisa dipindahkan
            dom: '<"dt-temp-toolbar"lf>rt<"row g-3 mt-2 pt-2 border-top"' +
                '<"col-md-5 d-flex align-items-center"i>' +
                '<"col-md-7 d-flex justify-content-md-end"p>>',
            columnDefs: [{
                orderable: false,
                searchable: false,
                targets: 0
            }],
            order: [
                [1, 'asc']
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
                $('#siswaTable_length').appendTo('#custom-length');
                $('#siswaTable_filter').appendTo('#custom-search');

                // FIX tampilan "Tampilkan 10 data"
                $('.dataTables_length label').addClass('d-flex align-items-center gap-2 mb-0');
            },

            drawCallback: function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });

        // Tambahkan penomoran otomatis di kolom pertama
        table.on('order.dt search.dt draw.dt', function() {
            let i = 1;
            table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell) {
                cell.innerHTML = i++;
            });
        }).draw();
    });

    function exportData() {
        const table = document.getElementById('siswaTable');
        const rows = table.querySelectorAll('tbody tr');
        let csv = 'No,Nama,Jurusan,Status,Asal Instansi,Telepon,Email,Alamat,Info Lainnya\n';

        rows.forEach((row, index) => {
            const cols = row.querySelectorAll('td');

            const namaElem = cols[1].querySelector('a');
            const jurusanElem = cols[1].querySelector('small');
            const statusElem = cols[1].querySelector('.status-badge');

            const nama = namaElem ? namaElem.textContent.trim() : '';
            const jurusan = jurusanElem ? jurusanElem.textContent.trim() : '';
            const status = statusElem ? statusElem.textContent.trim() : '';

            const instansi = cols[2]?.textContent.trim() ?? '';
            const telepon = cols[3]?.textContent.trim() ?? '';
            const email = cols[4]?.textContent.trim() ?? '';
            const alamat = cols[5]?.textContent.trim() ?? '';
            const info = cols[6]?.textContent.trim() ?? '';

            csv += `${index + 1},"${nama}","${jurusan}","${status}","${instansi}","${telepon}","${email}","${alamat}","${info}"\n`;
        });

        // Buat dan unduh file CSV
        const blob = new Blob([csv], {
            type: 'text/csv;charset=utf-8;'
        });
        const url = URL.createObjectURL(blob);

        const a = document.createElement('a');
        a.href = url;
        a.download = 'data-siswa.csv';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }
</script>

<script>
    function konfirmasiHapus(url) {
        const form = document.getElementById('formHapus');
        form.action = url;

        const modal = new bootstrap.Modal(document.getElementById('modalHapus'));
        modal.show();
    }
</script>



<style>
    /* Modern DataTable Styling */
    .datatable-wrapper {
        background: #fff;
        border-radius: 0;
    }

    /* Dropdown Menu Improvements */
    .dropdown-menu {
        border-radius: 8px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        border: none;
        padding: 0.5rem 0;
    }

    .dropdown-menu .dropdown-item {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
        color: #495057;
        transition: background-color 0.2s ease;
    }

    .dropdown-menu .dropdown-item:hover,
    .dropdown-menu .dropdown-item:focus {
        background-color: #f1f3f4;
        color: #212529;
    }

    /* Table Styling */
    #siswaTable {
        border-collapse: separate;
        border-spacing: 0;
        padding-left: 1rem;
        padding-right: 1rem;
        width: 100%;
        table-layout: auto;
    }

    #siswaTable thead th {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 2px solid #dee2e6;
        color: #495057;
        font-weight: 600;
        font-size: 0.875rem;
        padding: 1rem 0.75rem;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    #siswaTable tbody td {
        padding: 0.875rem 0.75rem;
        border-bottom: 1px solid #f1f3f4;
        vertical-align: middle;
    }

    #siswaTable tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.03);
        transition: background-color 0.2s ease;
    }

    #siswaTable tbody tr:last-child td {
        border-bottom: none;
    }

    .table-responsive-wrapper {
        overflow-x: auto;
        width: 100%;
    }

    /* Icon Badges */
    .icon-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        border-radius: 6px;
        font-size: 0.75rem;
        color: white;
    }

    .icon-badge.bg-primary {
        background-color: #0d6efd;
    }

    .icon-badge.bg-success {
        background-color: #198754;
    }

    .icon-badge.bg-danger {
        background-color: #dc3545;
    }

    .icon-badge.bg-warning {
        background-color: #fd7e14;
    }

    .icon-badge.bg-info {
        background-color: #0dcaf0;
    }

    /* Avatar Styling */
    .avatar-wrapper {
        position: relative;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid #e9ecef;
        background: #f8f9fa;
    }

    .avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.2s ease;
    }

    .avatar-wrapper:hover .avatar-img {
        transform: scale(1.05);
    }

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.5rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    .status-active {
        background: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        border: 1px solid rgba(13, 110, 253, 0.2);
    }

    .status-completed {
        background: rgba(25, 135, 84, 0.1);
        color: #198754;
        border: 1px solid rgba(25, 135, 84, 0.2);
    }

    .status-inactive {
        background: rgba(108, 117, 125, 0.1);
        color: #6c757d;
        border: 1px solid rgba(108, 117, 125, 0.2);
    }

    /* User Name Link */
    .user-name-link {
        transition: color 0.2s ease;
    }

    .user-name-link:hover {
        color: rgb(94, 153, 240) !important;
    }

    /* Action Button */
    .action-btn {
        border: none;
        background: #f8f9fa;
        color: #6c757d;
        border-radius: 8px;
        padding: 0.375rem 0.5rem;
        transition: all 0.2s ease;
    }

    .action-btn:hover {
        background: #e9ecef;
        color: #495057;
        transform: translateY(-1px);
    }

    /* DataTables Controls Styling */
    .dataTables_wrapper {
        padding: 1.5rem;
    }

    .dataTables_length label,
    .dataTables_filter label {
        font-weight: 500;
        color: #495057;
        font-size: 0.875rem;
    }

    .dataTables_filter input {
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        transition: all 0.2s ease;
        margin-left: 0.5rem;
        min-width: 250px;
    }

    .dataTables_filter input:focus,
    .dataTables_length select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        outline: 0;
    }

    .dataTables_length select {
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 0.375rem 2rem 0.375rem 0.75rem;
        background-color: #fff;
        transition: all 0.2s ease;
    }

    /* Pagination Styling */
    .dataTables_paginate .pagination {
        margin: 0;
        gap: 0.25rem;
    }

    .dataTables_paginate .page-link {
        border: 1px solid #dee2e6;
        color: #6c757d;
        background: #fff;
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        margin: 0;
        transition: all 0.2s ease;
        font-weight: 500;
    }

    .dataTables_paginate .page-link:hover {
        background: #e9ecef;
        border-color: #adb5bd;
        color: #495057;
        transform: translateY(-1px);
    }

    .dataTables_paginate .page-item.active .page-link {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
        box-shadow: 0 2px 4px rgba(13, 110, 253, 0.25);
    }

    .dataTables_paginate .page-item.disabled .page-link {
        background: #f8f9fa;
        border-color: #dee2e6;
        color: #adb5bd;
    }

    .dataTables_info {
        color: #6c757d;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .dataTables_empty {
        text-align: center;
        padding: 3rem 1rem !important;
        color: #6c757d;
        font-style: italic;
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header {
        border-bottom: 1px solid #f1f3f4;
    }

    @media (max-width: 768px) {
        .dataTables_wrapper {
            padding: 1rem;
        }

        .dataTables_length,
        .dataTables_filter {
            margin-bottom: 1rem;
        }

        .dataTables_filter input {
            min-width: 100%;
            margin-left: 0;
            margin-top: 0.5rem;
        }

        .dataTables_filter label {
            flex-direction: column;
            align-items: stretch !important;
        }

        .avatar-wrapper {
            width: 40px;
            height: 40px;
        }

        #siswaTable thead th,
        #siswaTable tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.875rem;
        }

        .status-badge {
            font-size: 0.6875rem;
            padding: 0.125rem 0.375rem;
        }
    }

    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .dataTables_wrapper {
            padding: 0.75rem;
        }

        .dataTables_paginate .page-link {
            padding: 0.375rem 0.5rem;
            font-size: 0.875rem;
        }

        .card-header {
            padding: 1rem;
        }

        .avatar-wrapper {
            width: 36px;
            height: 36px;
        }
    }

    .dataTables_processing {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(255, 255, 255, 0.95);
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        font-weight: 500;
        color: #495057;
        z-index: 1000;
    }

    .dataTables_scrollBody::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }

    .dataTables_scrollBody::-webkit-scrollbar-track {
        background: #f1f3f4;
    }

    .dataTables_scrollBody::-webkit-scrollbar-thumb {
        background: #ced4da;
        border-radius: 4px;
    }

    /* Default state: teks putih */
    .btn-outline-light {
        color: white;
        border-color: white;
    }

    /* Hover state: teks putih, background putih */
    .btn-outline-light:hover {
        /* background-color: white;
    border-color: white;
    color: #0dcaf0; */
        color: #0dcaf0;
        background-color: white;
        /* light blue hover */
        border-color: white;
    }

    /* Active (saat diklik): teks biru */
    .btn-outline-light:active {
        color: #0dcaf0 !important;
    }

    .btn-outline-light:focus {
        color: #0dcaf0;
        /* Bootstrap biru */
        background-color: white;
        border-color: white;
        box-shadow: none;
    }
</style>


<?= $this->endSection(); ?>