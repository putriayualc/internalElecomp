<?= $this->extend('layout/template'); ?>
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
                <button class="btn btn-outline-light px-4 py-2 fs-6 d-flex align-items-center gap-2" onclick="exportData()">
                    <i class="bi bi-download"></i>
                    <span class="d-none d-sm-inline">Export Data</span>
                </button>
                <button class="btn btn-light text-dark px-4 py-2 fs-6 d-flex align-items-center gap-2" onclick="hitungSemuaNilai()">
                    <i class="bi bi-calculator"></i>
                    <span class="d-none d-sm-inline">Hitung Semua</span>
                </button>

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
                                        <span class="fw-semibold">Tanggal Selesai Magang</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-success bg-opacity-10 text-success">
                                            <i class="bi bi-telephone-fill"></i>
                                        </span>
                                        <span class="fw-semibold">Nilai Absensi</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 180px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-danger bg-opacity-10 text-danger">
                                            <i class="bi bi-envelope"></i>
                                        </span>
                                        <span class="fw-semibold">Nilai Magang</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 180px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-danger bg-opacity-10 text-danger">
                                            <i class="bi bi-envelope"></i>
                                        </span>
                                        <span class="fw-semibold">Nilai Operasional</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-warning bg-opacity-10 text-warning">
                                            <i class="bi bi-geo-alt-fill"></i>
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
                            <?php foreach ($allNilai as $i => $nilai): ?>
                                <tr>
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
                                        <span class="text-truncate d-inline-block" style="max-width: 150px;"
                                            title="<?= esc($nilai['nilai_absensi']); ?>">
                                            <?= esc($nilai['nilai_absensi']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center border-end">
                                        <span class="text-truncate d-inline-block" style="max-width: 150px;"
                                            title="<?= esc($nilai['nilai_magang']); ?>">
                                            <?= esc($nilai['nilai_magang']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center border-end">
                                        <span class="text-truncate d-inline-block" style="max-width: 150px;"
                                            title="<?= esc($nilai['nilai_operasional']); ?>">
                                            <?= esc($nilai['nilai_operasional']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center border-end">
                                        <span class="text-truncate d-inline-block" style="max-width: 190px;"
                                            title="<?= esc($nilai['total_nilai']); ?>">
                                            <?= esc($nilai['total_nilai']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);"
                                            class="btn btn-sm btn-success me-1 btn-hitung"
                                            data-id="<?= $nilai['id_siswa'] ?>"
                                            title="Hitung ulang nilai">
                                            <i class="bi bi-calculator"></i>
                                        </a>
                                        <span class="text-muted"
                                            data-bs-toggle="tooltip"
                                            title="Terakhir diupdate: <?= date('d M Y H:i', strtotime($nilai['updated_at'])) ?>">
                                            <i class="bi bi-clock"></i>
                                        </span>
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
    $(document).on('click', '.btn-hitung', function() {
        const btn = $(this);
        const id = btn.data('id');
        btn.prop('disabled', true).html('<i class="spinner-border spinner-border-sm"></i>');

        $.ajax({
            url: '<?= base_url('nilai_akhir/hitung/') ?>' + id,
            method: 'POST',
            data: {
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            success: function(res) {
                location.reload(); // atau update total_nilai langsung jika ingin tanpa reload
            },
            error: function() {
                alert('Gagal menghitung nilai.');
                btn.prop('disabled', false).html('<i class="bi bi-calculator"></i>');
            }
        });
    });

    function hitungSemuaNilai() {
        if (!confirm('Yakin ingin menghitung ulang semua nilai?')) return;

        const btns = $('.btn-hitung');
        btns.prop('disabled', true);

        $.ajax({
            url: '<?= base_url('nilai_akhir/hitung_semua') ?>',
            method: 'POST',
            data: {
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            success: function(res) {
                location.reload(); // atau refresh data secara dinamis
            },
            error: function() {
                alert('Gagal menghitung semua nilai.');
                btns.prop('disabled', false);
            }
        });
    }
</script>

<?= $this->endSection(); ?>