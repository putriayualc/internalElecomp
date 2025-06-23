<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<div class="container-fluid py-3">
    <div class="rounded-3 shadow-sm mb-4"
        style="background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="d-flex justify-content-between align-items-center p-4 text-white">
            <div>
                <h1 class="h1 fw-bold">Data Artikel Internal</h1>
                <p class="text-white-70 small mb-0">Kelola data artikel internal yang telah dipublikasi</p>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-outline-light px-4 py-2 fs-6 d-flex align-items-center gap-2" onclick="exportData()">
                    <i class="bi bi-download"></i>
                    <span class="d-none d-sm-inline">Export Data</span>
                </button>

                <a href="<?= route_to('artikel_internal.tambah') ?>" class="btn btn-light text-info px-4 py-2 fs-6 d-flex align-items-center gap-2">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span class="d-none d-sm-inline">Tambah Artikel</span>
                </a>
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

    <?php if (session()->has('edit_success')) : ?>
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= session('edit_success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('delete_success')) : ?>
        <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-trash me-2"></i><?= session('delete_success') ?>
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

<!--  -->

<div class="card border-0 shadow-sm">
    <div class="card-body px-1">
        <div class="card-header bg-white">
            <div class="row align-items-start">
                <div class="col">
                    <div class="row" id="custom-toolbar">
                        <div class="col-md-6 d-flex align-items-center" id="custom-length"></div>
                        <div class="col-md-6 d-flex justify-content-md-end justify-content-start mt-2 mt-md-0" id="custom-search"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="datatable-wrapper">
            <div class="table-responsive">
                <div class="table-responsive-wrapper">
                    <table id="artikelTable" class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center border-end" style="width: 60px;">
                                    <span class="fw-semibold">No</span>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-primary bg-opacity-10 text-primary">
                                            <i class="bi bi-file-text"></i>
                                        </span>
                                        <span class="fw-semibold">Judul Artikel</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 130px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-success bg-opacity-10 text-success">
                                            <i class="bi bi-calendar"></i>
                                        </span>
                                        <span class="fw-semibold">Tanggal Upload</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 200px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-info bg-opacity-10 text-info">
                                            <i class="bi bi-link-45deg"></i>
                                        </span>
                                        <span class="fw-semibold">Link</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-warning bg-opacity-10 text-warning">
                                            <i class="bi bi-tags"></i>
                                        </span>
                                        <span class="fw-semibold">Keyword</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-danger bg-opacity-10 text-danger">
                                            <i class="bi bi-building"></i>
                                        </span>
                                        <span class="fw-semibold">Bisnis</span>
                                    </div>
                                </th>
                                <?php if (session()->get('role') === 'admin') : ?>
                                    <th class="text-center border-end" style="min-width: 90px;">
                                        <div class="d-flex align-items-center justify-content-center gap-2">
                                            <span class="icon-circle bg-secondary bg-opacity-10 text-secondary">
                                                <i class="bi bi-person"></i>
                                            </span>
                                            <span class="fw-semibold">User</span>
                                        </div>
                                    </th>
                                <?php endif; ?>
                                <th class="text-center" style="width: 100px;">
                                    <span class="fw-semibold">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php // KODE YANG DIPERBAIKI: Menghapus kondisi if/else untuk data kosong.
                            // Cukup lakukan looping. Jika $allArtikel kosong, tbody akan kosong
                            // dan DataTables akan menanganinya secara otomatis.
                            ?>
                            <?php foreach ($allArtikel as $i => $artikel) : ?>
                                <tr>
                                    <td class="text-center border-end">
                                        <span class="text-muted fw-medium"><?= $i + 1 ?></span>
                                    </td>
                                    <td class="border-end">
                                        <div class="d-flex align-items-center py-2">
                                            <div class="flex-grow-1 min-width-0">
                                                <div class="mb-1">
                                                    <span class="text-dark fw-semibold d-block" style="line-height: 1.4;">
                                                        <?= esc($artikel['judul_artikel']); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center border-end">
                                        <span class="badge bg-light text-dark px-3 py-2">
                                            <?= date('d M Y', strtotime($artikel['tgl_upload'])) ?>
                                        </span>
                                    </td>
                                    <td class="border-end">
                                        <a href="<?= esc($artikel['link']) ?>" target="_blank"
                                            class="text-decoration-none text-primary fw-medium text-truncate d-inline-block"
                                            style="max-width: 200px;" title="<?= esc($artikel['link']) ?>">
                                            <i class="bi bi-box-arrow-up-right me-1"></i>
                                            <?= esc($artikel['link']) ?>
                                        </a>
                                    </td>
                                    <td class="text-center border-end">
                                        <span class="text-truncate d-inline-block fw-medium" style="max-width: 150px;">
                                            <?= esc($artikel['keyword']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center border-end">
                                        <span class="text-truncate d-inline-block fw-medium" style="max-width: 150px;"
                                            title="<?= esc($artikel['nama_bisnis']) ?>">
                                            <?= esc($artikel['nama_bisnis']) ?>
                                        </span>
                                    </td>
                                    <?php if (session()->get('role') === 'admin') : ?>
                                        <td class="text-center border-end">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="d-flex align-items-center justify-content-center bg-secondary bg-opacity-10 text-secondary rounded-circle me-2" style="width: 32px; height: 32px;">
                                                    <i class="bi bi-person fs-6"></i>
                                                </div>
                                                <span class="fw-medium"><?= esc($artikel['username']) ?></span>
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle action-btn"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center text-primary"
                                                        href="<?= base_url('artikel_internal/edit/' . $artikel['id_artikel_internal']) ?>">
                                                        <i class="bi bi-pencil-square text-primary me-2"></i>
                                                        <span>Edit</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center text-danger"
                                                        href="#"
                                                        onclick="konfirmasiHapus('<?= base_url('artikel_internal/delete/' . $artikel['id_artikel_internal']) ?>')">
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
                <p class="mb-0 fs-6">Apakah Anda yakin ingin menghapus data artikel ini?</p>
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

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#artikelTable').DataTable({
            responsive: false,
            pageLength: 10,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Semua"]
            ],
            language: {
                decimal: "",
                emptyTable: "<div class='text-center py-5'><div class='d-flex flex-column align-items-center text-muted'><i class='bi bi-inbox fs-1 mb-3 opacity-50'></i><p class='mb-0 fs-6'>Belum ada artikel yang ditambahkan</p></div></div>",
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
                    targets: 0 // Kolom "No" tidak bisa di-sort dan di-search
                },
                {
                    // Menonaktifkan sorting dan searching untuk kolom 'Aksi'
                    orderable: false,
                    searchable: false,
                    targets: -1 // Target kolom terakhir
                }
            ],
            order: [
                [1, 'asc'] // Default order berdasarkan Judul Artikel
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
                $('#artikelTable_length').appendTo('#custom-length');
                $('#artikelTable_filter').appendTo('#custom-search');

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
            }).nodes().each(function(cell, index) {
                cell.innerHTML = table.page.info().start + index + 1;
            });
        }).draw();
    });

    function exportData() {
        const table = document.getElementById('artikelTable');
        const rows = table.querySelectorAll('tbody tr');
        const isAdmin = <?= session()->get('role') === 'admin' ? 'true' : 'false' ?>;

        let csvContent = "data:text/csv;charset=utf-8,";
        let headers = isAdmin ?
            'No,Judul Artikel,Tanggal Upload,Link,Keyword,Bisnis,User' :
            'No,Judul Artikel,Tanggal Upload,Link,Keyword,Bisnis';
        csvContent += headers + "\r\n";

        rows.forEach((row, index) => {
            // Lewati baris "data kosong" yang mungkin dibuat oleh DataTables
            if (row.querySelectorAll('td').length > 1) {
                let rowData = [];
                const no = row.cells[0].textContent.trim();
                const judul = `"${row.cells[1].textContent.trim().replace(/"/g, '""')}"`;
                const tanggal = `"${row.cells[2].textContent.trim()}"`;
                const link = `"${row.cells[3].textContent.trim()}"`;
                const keyword = `"${row.cells[4].textContent.trim()}"`;
                const bisnis = `"${row.cells[5].textContent.trim()}"`;

                rowData.push(no, judul, tanggal, link, keyword, bisnis);

                if (isAdmin) {
                    const user = `"${row.cells[6].textContent.trim()}"`;
                    rowData.push(user);
                }

                csvContent += rowData.join(',') + "\r\n";
            }
        });

        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "data-artikel-internal.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function konfirmasiHapus(url) {
        const form = document.getElementById('formHapus');
        form.action = url;

        const modal = new bootstrap.Modal(document.getElementById('modalHapus'));
        modal.show();
    }
</script>

<?= $this->endSection(); ?>