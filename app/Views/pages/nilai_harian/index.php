<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid py-3">
    <div class="rounded-3 shadow-sm mb-4"
        style="background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="d-flex justify-content-between align-items-center p-4 text-white">
            <div>
                <h1 class="h1 fw-bold">Penilaian Magang Harian</h1>
                <p class="text-white-70 small mb-0">Sistem Penilaian Harian Berdasarkan Laporan Kegiatan</p>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-outline-light px-4 py-2 fs-6 d-flex align-items-center gap-2" onclick="exportData()">
                    <i class="bi bi-download"></i>
                    <span class="d-none d-sm-inline">Export Data</span>
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
                                <th class="text-center border-end" style="width: 130px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-primary bg-opacity-10 text-primary">
                                            <i class="bi bi-building"></i>
                                        </span>
                                        <span class="fw-semibold">Tanggal</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-success bg-opacity-10 text-success">
                                            <i class="bi bi-telephone-fill"></i>
                                        </span>
                                        <span class="fw-semibold">Laporan Tugas</span>
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
                                        <span class="fw-semibold">Feedback</span>
                                    </div>
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
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center border-end">
                                        <span class="text-truncate d-inline-block" style="max-width: 150px;"
                                            title="<?= esc($nilai['tgl_absen']); ?>">
                                            <?= date('d F Y', strtotime($nilai['tgl_absen'])); ?>
                                        </span>
                                    </td>
                                    <td class="text-center border-end">
                                        <span class="text-truncate d-inline-block" style="max-width: 150px;"
                                            title="<?= esc($nilai['laporan_tugas']); ?>">
                                            <?= esc($nilai['laporan_tugas']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center border-end">
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <input type="number"
                                                class="form-control form-control-sm text-center input-nilai"
                                                style="width: 70px;"
                                                data-id="<?= $nilai['id_absen'] ?>"
                                                data-field="nilai_magang"
                                                value="<?= esc($nilai['nilai_magang']) ?>"
                                                min="0" max="100">
                                            <button class="btn btn-sm btn-outline-success btn-simpan-nilai d-none"
                                                data-id="<?= $nilai['id_absen'] ?>"
                                                data-field="nilai_magang">
                                                <i class="bi bi-check-circle"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-center border-end">
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <input type="number"
                                                class="form-control form-control-sm text-center input-nilai"
                                                style="width: 70px;"
                                                data-id="<?= $nilai['id_absen'] ?>"
                                                data-field="nilai_operasional"
                                                value="<?= esc($nilai['nilai_operasional']) ?>"
                                                min="0" max="100">
                                            <button class="btn btn-sm btn-outline-success btn-simpan-nilai d-none"
                                                data-id="<?= $nilai['id_absen'] ?>"
                                                data-field="nilai_operasional">
                                                <i class="bi bi-check-circle"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-center border-end">
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <input type="text"
                                                class="form-control form-control-sm text-center input-nilai"
                                                style="width: 150px;"
                                                data-id="<?= $nilai['id_absen'] ?>"
                                                data-field="feedback"
                                                value="<?= esc($nilai['feedback']) ?>">
                                            <button class="btn btn-sm btn-outline-success btn-simpan-nilai d-none"
                                                data-id="<?= $nilai['id_absen'] ?>"
                                                data-field="feedback">
                                                <i class="bi bi-check-circle"></i>
                                            </button>
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
                [2, 'desc']
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
    // Tampilkan tombol simpan saat input diubah
    $(document).on('input', '.input-nilai', function() {
        $(this).siblings('.btn-simpan-nilai').removeClass('d-none');
    });

    // Simpan nilai saat tombol diklik
    $(document).on('click', '.btn-simpan-nilai', function() {
        const btn = $(this);
        const input = btn.siblings('.input-nilai');
        const id = btn.data('id');
        const field = btn.data('field');
        const value = input.val();

        $.ajax({
            url: '<?= route_to('nilai.simpan') ?>',
            method: 'POST',
            data: {
                id_absen: id,
                field: field,
                value: value,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            success: function(res) {
                btn.addClass('d-none');
                input.addClass('is-valid');
                setTimeout(() => input.removeClass('is-valid'), 1000);
            },
            error: function(err) {
                input.addClass('is-invalid');
                setTimeout(() => input.removeClass('is-invalid'), 2000);
            }
        });
    });
</script>

<?= $this->endSection(); ?>