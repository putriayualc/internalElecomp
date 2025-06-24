<?= $this->extend('layout/template'); ?>
<?= $this->section('css'); ?>
<style>
    /* ====================================================== */
    /* ==      STYLE UNTUK PEWARNAAN BADGE NILAI           == */
    /* ====================================================== */

    .grade-badge {
        display: inline-block;
        padding: 0.4em 0.8em;
        font-size: 0.9em;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 50rem;
        /* Membuat bentuk pil */
        width: 60px;
        /* Lebar yang konsisten */
    }

    /* Kriteria: nilai >= 86 (Hijau) */
    .grade-badge-success {
        color: #0f5132;
        background-color: #d1e7dd;
    }

    /* Kriteria: 71 s.d. 85 (Kuning) */
    .grade-badge-warning {
        color: #664d03;
        background-color: #fff3cd;
    }

    /* Kriteria: <= 70 (Merah) */
    .grade-badge-danger {
        color: #58151c;
        background-color: #f8d7da;
    }
</style>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>

<div class="container-fluid py-3">
    <div class="rounded-3 shadow-sm mb-4"
        style="background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="d-flex justify-content-between align-items-center p-4 text-white">
            <div>
                <h1 class="h1 fw-bold">Penilaian Akhir</h1>
                <p class="text-white-70 small mb-0">Sistem Penilaian Akhir Berdasarkan Absensi dan Tugas-Tugas</p>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-light text-dark px-4 py-2 fs-6 d-flex align-items-center gap-2" onclick="hitungSemuaNilai()">
                    <i class="bi bi-calculator"></i>
                    <span class="d-none d-sm-inline">Hitung Semua</span>
                </button>

            </div>

        </div>
    </div>
</div>

<!-- Improved Filter Container -->
<div class="filter-container bg-white p-4 rounded shadow-sm border mb-3">
    <div class="row g-3 align-items-end">
        <div class="col-md-3">
            <label for="filterDari" class="form-label">Dari Tanggal</label>
            <input type="date" id="filterDari" class="form-control form-control-sm">
        </div>
        <div class="col-md-3">
            <label for="filterSampai" class="form-label">Sampai Tanggal</label>
            <input type="date" id="filterSampai" class="form-control form-control-sm">
        </div>
        <div class="col-md-3">
            <label for="filterStatus" class="form-label">Status Mahasiswa</label>
            <select id="filterStatus" class="form-select form-select-sm">
                <option value="">Semua Status</option>
                <option value="AKTIF">Mahasiswa Aktif</option>
                <option value="SELESAI">Mahasiswa Selesai</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button id="applyFilter" class="btn btn-primary btn-sm flex-grow-1 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-funnel"></i>
                <span>Terapkan Filter</span>
            </button>
            <button id="resetFilter" class="btn btn-outline-secondary btn-sm d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-arrow-clockwise"></i>
            </button>
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
                                <th class="text-center border-end" style="min-width: 140px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-primary bg-opacity-10 text-primary">
                                            <i class="bi bi-calendar"></i>
                                        </span>
                                        <span class="fw-semibold">Tanggal Selesai Magang</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 100px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-success bg-opacity-10 text-success">
                                            <i class="bi bi-calendar-check"></i>
                                        </span>
                                        <span class="fw-semibold">Nilai Absensi</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 100px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-primary bg-opacity-10 text-primary">
                                            <i class="bi bi-code-slash"></i>
                                        </span>
                                        <span class="fw-semibold">Nilai Magang</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 100px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-warning bg-opacity-10 text-warning">
                                            <i class="bi bi-tools"></i>
                                        </span>
                                        <span class="fw-semibold">Nilai Operasional</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 100px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-danger bg-opacity-10 text-danger">
                                            <i class="bi bi-file-earmark-text"></i>
                                        </span>
                                        <span class="fw-semibold">Nilai Artikel</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 100px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-secondary bg-opacity-10 text-secondary">
                                            <i class="bi bi-award"></i>
                                        </span>
                                        <span class="fw-semibold">Nilai Akhir</span>
                                    </div>
                                </th>
                                <th class="text-center" style="width: 100px;">
                                    <span class="fw-semibold">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Helper function untuk menentukan kelas CSS berdasarkan nilai
                            function getGradeBadgeClass($grade)
                            {
                                $grade = floatval($grade); // Pastikan tipe datanya float
                                if ($grade >= 86) {
                                    return 'grade-badge-success';
                                } elseif ($grade >= 71) {
                                    return 'grade-badge-warning';
                                } else {
                                    return 'grade-badge-danger';
                                }
                            }
                            ?>
                            <?php foreach ($allNilai as $i => $nilai): ?>
                                <tr id="row-siswa-<?= $nilai['id_siswa'] ?>">
                                    <td class="text-center border-end">
                                        <span class="text-muted fw-medium"><?= $i + 1 ?></span>
                                    </td>
                                    <td class="border-end">
                                        <div class="d-flex align-items-center py-2">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-wrapper">
                                                    <img src="<?= base_url('assets/img/user/' . ($nilai['foto'] ?? 'default.jpg')); ?>"
                                                        alt="<?= esc($nilai['nama']); ?>"
                                                        class="avatar-img">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 min-width-0">
                                                <div class="mb-1">
                                                    <a href="<?= route_to('siswa.detail', $nilai['id_siswa']) ?>"
                                                        class="text-decoration-none text-dark fw-semibold user-name-link">
                                                        <?= esc($nilai['nama']); ?>
                                                    </a>
                                                </div>
                                                <div class="d-flex align-items-center gap-2">
                                                    <small class="text-muted"><?= esc($nilai['jurusan']); ?></small>
                                                    <?php
                                                    $status = strtoupper($nilai['status']);
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
                                            title="<?= esc($nilai['tgl_keluar']); ?>">
                                            <?= esc($nilai['tgl_keluar']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center border-end">
                                        <span class="grade-badge <?= getGradeBadgeClass($nilai['nilai_absensi']); ?>" style="max-width: 150px;"
                                            title="<?= esc($nilai['nilai_absensi']); ?>">
                                            <?= esc($nilai['nilai_absensi']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center border-end">
                                        <span class="grade-badge <?= getGradeBadgeClass($nilai['nilai_magang']); ?>" style="max-width: 150px;"
                                            title="<?= esc($nilai['nilai_magang']); ?>">
                                            <?= esc($nilai['nilai_magang']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center border-end">
                                        <span class="grade-badge <?= getGradeBadgeClass($nilai['nilai_operasional']); ?>" style="max-width: 150px;"
                                            title="<?= esc($nilai['nilai_operasional']); ?>">
                                            <?= esc($nilai['nilai_operasional']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center border-end">
                                        <span class="grade-badge <?= getGradeBadgeClass($nilai['nilai_artikel']); ?>" style="max-width: 150px;"
                                            title="<?= esc($nilai['nilai_artikel']); ?>">
                                            <?= esc($nilai['nilai_artikel']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center border-end">
                                        <span id="total-nilai-<?= $nilai['id_siswa'] ?>" class="grade-badge <?= getGradeBadgeClass($nilai['total_nilai']); ?>" style="max-width: 190px;"
                                            title="<?= esc($nilai['total_nilai']); ?>">
                                            <?= esc($nilai['total_nilai']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);"
                                            class="btn btn-outline-success d-flex align-items-center justify-content-center gap-1 px-3 py-1 rounded-pill shadow-sm btn-hitung"
                                            style="font-size: 0.85rem;"
                                            data-id="<?= $nilai['id_siswa'] ?>"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            data-bs-html="true"
                                            title="Hitung Ulang<br>Diupdate: <?= date('d M Y H:i', strtotime($nilai['updated_at'])) ?>">
                                            <i class="bi bi-arrow-repeat"></i>
                                            <span class="d-none d-md-inline">Hitung</span>
                                        </a>
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
                $('.dataTables_length select').addClass('form-select form-select-sm me-2');
                $('.dataTables_filter input').addClass('form-control form-control-sm').attr('placeholder', 'Ketik untuk mencari...');
                $('.dataTables_length').addClass('d-flex align-items-center');
                $('.dataTables_filter').addClass('d-flex align-items-center justify-content-end');
                $('.dataTables_filter label').addClass('d-flex align-items-center mb-0');

                $('#siswaTable_length').appendTo('#custom-length');
                $('#siswaTable_filter').appendTo('#custom-search');

                $('.dataTables_length label').addClass('d-flex align-items-center gap-2 mb-0');
            },
            drawCallback: function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });

        // Add row numbers
        table.on('order.dt search.dt draw.dt', function() {
            let i = 1;
            table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell) {
                cell.innerHTML = i++;
            });
        }).draw();

        // Custom filtering function
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var minDate = $('#filterDari').val();
                var maxDate = $('#filterSampai').val();
                var statusFilter = $('#filterStatus').val();

                // Get the row element
                var row = table.row(dataIndex).nodes().to$();

                // Get the date from tgl_keluar column (column index 2)
                var rowDateStr = row.find('td:eq(2)').text().trim();
                var rowDate = rowDateStr ? new Date(rowDateStr) : null;

                // Get status from the row
                var rowStatus = row.find('.status-badge').text().trim().toUpperCase();

                // Date filtering
                var dateValid = true;
                if (minDate || maxDate) {
                    if (!rowDate) return false; // Skip if no date

                    var minDateObj = minDate ? new Date(minDate) : null;
                    var maxDateObj = maxDate ? new Date(maxDate) : null;

                    if (minDateObj && rowDate < minDateObj) {
                        dateValid = false;
                    }
                    if (maxDateObj && rowDate > maxDateObj) {
                        dateValid = false;
                    }
                }

                // Status filtering
                var statusValid = true;
                if (statusFilter && rowStatus !== statusFilter.toUpperCase()) {
                    statusValid = false;
                }

                return dateValid && statusValid;
            }
        );

        // Apply filter button
        $('#applyFilter').on('click', function() {
            table.draw();

            // Show notification
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
            Toast.fire({
                icon: 'success',
                title: 'Filter diterapkan'
            });
        });

        // Reset filter button
        $('#resetFilter').on('click', function() {
            $('#filterDari').val('');
            $('#filterSampai').val('');
            $('#filterStatus').val('');
            table.draw();
        });

        // Enable filter on Enter key
        $('#filterDari, #filterSampai, #filterStatus').on('keyup', function(e) {
            if (e.key === 'Enter') {
                $('#applyFilter').click();
            }
        });

        // Filter otomatis untuk "Mahasiswa Aktif" saat halaman dimuat
        $('#filterStatus').val('AKTIF'); // Atur dropdown ke "Mahasiswa Aktif"
        table.draw(); // Terapkan filter ke tabel
    });
</script>

<?= $this->endSection(); ?>