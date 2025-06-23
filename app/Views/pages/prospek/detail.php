<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid py-3">
    <div class="rounded-3 shadow-sm mb-4"
        style="background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="d-flex justify-content-between align-items-center p-4 text-white">
            <div>
                <h1 class="h1 fw-bold">Detail Prospek</h1>
                <p class="text-white-70 small mb-0">Kelola detail perusahaan dalam prospek ini</p>
            </div>

            <div class="d-flex gap-2">
                <div class="dropdown">
                    <button class="btn btn-outline-light px-4 py-2 fs-6 d-flex align-items-center gap-2 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-download"></i>
                        <span class="d-none d-sm-inline">Ekspor/Impor</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#" onclick="exportData()">
                                <i class="bi bi-file-earmark-excel text-success me-2"></i>
                                <span>Ekspor ke Excel</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#importModal">
                                <i class="bi bi-file-earmark-arrow-up text-primary me-2"></i>
                                <span>Impor Data</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <a href="<?= base_url('prospek') ?>" class="btn btn-outline-light px-4 py-2 fs-6 d-flex align-items-center gap-2">
                    <i class="fas fa-arrow-left me-2"></i>
                    <span class="d-none d-sm-inline">Kembali</span>
                </a>
                <button type="button" class="btn btn-light text-info px-4 py-2 fs-6 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span class="d-none d-sm-inline">Tambah Perusahaan</span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body px-1">
        <div class="card-header bg-white">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title mb-0">Informasi Prospek</h5>
                </div>
            </div>
        </div>
        <div class="p-3">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Judul:</strong> <?= esc($prospek['judul']) ?></p>
                    <p><strong>Sumber Data:</strong> <?= esc($prospek['sumber_data']) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Total Perusahaan:</strong>
                        <span class="badge bg-info"><?= count($detail_prospek) ?></span>
                    </p>
                    <p><strong>Terakhir Update:</strong> <?= date('d/m/Y H:i') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="alertContainer"></div>

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
                    <table id="companyTable" class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center border-end" style="width: 60px;">
                                    <span class="fw-semibold">No</span>
                                </th>
                                <th class="text-center border-end" style="min-width: 200px;">
                                    <span class="fw-semibold">Nama Perusahaan</span>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-warning bg-opacity-10 text-warning">
                                            <i class="bi bi-geo-alt-fill"></i>
                                        </span>
                                        <span class="fw-semibold">Alamat</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-danger bg-opacity-10 text-danger">
                                            <i class="bi bi-envelope"></i>
                                        </span>
                                        <span class="fw-semibold">Email</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-success bg-opacity-10 text-success">
                                            <i class="bi bi-telephone-fill"></i>
                                        </span>
                                        <span class="fw-semibold">No HP</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <span class="icon-circle bg-info bg-opacity-10 text-info">
                                            <i class="bi bi-globe"></i>
                                        </span>
                                        <span class="fw-semibold">Website</span>
                                    </div>
                                </th>
                                <th class="text-center border-end" style="min-width: 120px;">
                                    <span class="fw-semibold">Status Email</span>
                                </th>
                                <th class="text-center border-end" style="min-width: 120px;">
                                    <span class="fw-semibold">Status WA</span>
                                </th>
                                <th class="text-center border-end" style="min-width: 150px;">
                                    <span class="fw-semibold">Keterangan</span>
                                </th>
                                <th class="text-center" style="width: 100px;">
                                    <span class="fw-semibold">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($detail_prospek)): ?>
                                <?php foreach ($detail_prospek as $index => $detail): ?>
                                    <tr>
                                        <td class="text-center border-end">
                                            <span class="text-muted fw-medium"><?= $index + 1 ?></span>
                                        </td>
                                        <td class="border-end">
                                            <div class="mb-1">
                                                <span class="text-dark fw-semibold">
                                                    <?= esc($detail['nama_perusahaan']) ?>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="text-center border-end">
                                            <span class="text-truncate d-inline-block" style="max-width: 150px;"
                                                title="<?= esc($detail['alamat']) ?>">
                                                <?= esc($detail['alamat']) ?>
                                            </span>
                                        </td>
                                        <td class="text-center border-end">
                                            <?php if (!empty($detail['email'])): ?>
                                                <a href="mailto:<?= esc($detail['email']) ?>"
                                                    class="text-decoration-none text-dark fw-medium text-truncate d-inline-block"
                                                    style="max-width: 180px;" title="<?= esc($detail['email']) ?>">
                                                    <?= esc($detail['email']) ?>
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center border-end">
                                            <?php if (!empty($detail['no_hp'])): ?>
                                                <a href="tel:<?= esc($detail['no_hp']) ?>"
                                                    class="text-truncate text-dark fw-medium">
                                                    <?= esc($detail['no_hp']) ?>
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center border-end">
                                            <?php if (!empty($detail['website'])): ?>
                                                <a href="<?= esc($detail['website']) ?>" target="_blank"
                                                    class="text-truncate text-dark fw-medium">
                                                    <?= esc($detail['website']) ?>
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center border-end">
                                            <?php if ($detail['status_email'] == 'Sudah'): ?>
                                                <span class="badge bg-success">Sudah</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Belum</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center border-end">
                                            <?php if ($detail['status_wa'] == 'Sudah'): ?>
                                                <span class="badge bg-success">Sudah</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Belum</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center border-end">
                                            <span class="text-truncate d-inline-block" style="max-width: 150px;"
                                                title="<?= esc($detail['keterangan_lainnya']) ?>">
                                                <?= esc($detail['keterangan_lainnya']) ?>
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
                                                        <a class="dropdown-item d-flex align-items-center text-primary"
                                                            href="#" onclick="viewDetail(<?= $detail['id_detail_prospek'] ?>)">
                                                            <i class="bi bi-eye text-primary me-2"></i>
                                                            <span>Lihat</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center text-warning"
                                                            href="#" onclick="editDetail(<?= $detail['id_detail_prospek'] ?>)">
                                                            <i class="bi bi-pencil-square text-warning me-2"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center text-danger"
                                                            href="#"
                                                            onclick="konfirmasiHapus('<?= route_to('prospek.delete', $prospek['id_prospek'], $detail['id_detail_prospek']) ?>', '<?= esc($detail['nama_perusahaan']) ?>')">
                                                            <i class="bi bi-trash text-danger me-2"></i>
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
                                    <td colspan="10" class="text-center py-4">
                                        <div class="empty-state">
                                            <i class="fas fa-building fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">Belum ada data perusahaan</h5>
                                            <p class="text-muted mb-3">Tambahkan perusahaan pertama untuk memulai prospek ini</p>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                                                <i class="fas fa-plus me-2"></i>Tambah Perusahaan
                                            </button>
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

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-semibold" id="addModalLabel">
                    <i class="fas fa-plus-circle me-2"></i> Tambah Perusahaan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form id="companyForm">
                <div class="modal-body">
                    <input type="hidden" id="id_prospek" name="id_prospek" value="<?= $prospek['id_prospek'] ?>">
                    <input type="hidden" id="form_mode" value="add">
                    <input type="hidden" id="edit_id" name="edit_id" value="">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_perusahaan" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="no_telepon" class="form-label">No Telepon</label>
                                <input type="text" class="form-control" id="no_telepon" name="no_telepon">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" class="form-control" id="website" name="website">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d') ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan_lainnya" class="form-label">Keterangan Lainnya</label>
                        <textarea class="form-control" id="keterangan_lainnya" name="keterangan_lainnya" rows="3"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-semibold" id="importModalLabel">
                    <i class="bi bi-file-earmark-arrow-up me-2"></i> Impor Data Perusahaan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form id="importForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="id_prospek_import" name="id_prospek" value="<?= $prospek['id_prospek'] ?>">

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle-fill me-2"></i> Unduh template Excel untuk memastikan format yang benar.
                        <a href="#" class="alert-link" onclick="downloadTemplate()">Download Template</a>
                    </div>

                    <div class="mb-3">
                        <label for="import_file" class="form-label">File Excel <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="import_file" name="import_file" accept=".xlsx, .xls" required>
                        <div class="invalid-feedback"></div>
                        <small class="text-muted">Format file harus .xlsx atau .xls (maks. 2MB)</small>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="overwrite_data" name="overwrite_data">
                        <label class="form-check-label" for="overwrite_data">
                            Hapus data lama sebelum impor
                        </label>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="importBtn">
                        <i class="bi bi-upload me-1"></i> Impor Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-semibold" id="viewModalLabel">
                    <i class="fas fa-eye me-2"></i> Detail Perusahaan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Perusahaan:</label>
                            <p id="view_nama_perusahaan">-</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email:</label>
                            <p id="view_email">-</p>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Alamat:</label>
                    <p id="view_alamat">-</p>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">No HP:</label>
                            <p id="view_no_hp">-</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">No Telepon:</label>
                            <p id="view_no_telepon">-</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Website:</label>
                            <p id="view_website">-</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal:</label>
                            <p id="view_tanggal">-</p>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Keterangan Lainnya:</label>
                    <p id="view_keterangan_lainnya">-</p>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Tutup
                </button>
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
                <p class="mb-0 fs-6">Apakah Anda yakin ingin menghapus data perusahaan ini?</p>
                <p class="fw-bold" id="delete_company_name"></p>
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

<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

<script>
    $(document).ready(function() {
        // =================================================================
        // AWAL PERBAIKAN: Inisialisasi DataTable hanya jika data ada
        // =================================================================
        <?php if (!empty($detail_prospek)): ?>
        var table = $('#companyTable').DataTable({
            responsive: false,
            pageLength: 10,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Semua"]
            ],
            language: {
                decimal: "",
                emptyTable: "Tidak ada data perusahaan yang tersedia",
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
                // Tambahkan styling bootstrap
                $('.dataTables_length select').addClass('form-select form-select-sm me-2');
                $('.dataTables_filter input').addClass('form-control form-control-sm').attr('placeholder', 'Ketik untuk mencari...');
                $('.dataTables_length').addClass('d-flex align-items-center');
                $('.dataTables_filter').addClass('d-flex align-items-center justify-content-end');
                $('.dataTables_filter label').addClass('d-flex align-items-center mb-0');

                // Pindahkan kontrol ke tempat custom
                $('#companyTable_length').appendTo('#custom-length');
                $('#companyTable_filter').appendTo('#custom-search');

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
        <?php endif; ?>
        // =================================================================
        // AKHIR PERBAIKAN
        // =================================================================
    });

    function exportData() {
        const table = document.getElementById('companyTable');
        const rows = table.querySelectorAll('tbody tr');
        let csv = 'No,Nama Perusahaan,Alamat,Email,No HP,Website,Keterangan,Tanggal\n';

        rows.forEach((row, index) => {
            const cols = row.querySelectorAll('td');
            if (cols.length < 10) return; // Skip baris 'data kosong'
            
            const nama = `"${(cols[1]?.textContent || '').trim()}"`;
            const alamat = `"${(cols[2]?.textContent || '').trim()}"`;
            const email = `"${(cols[3]?.textContent || '').trim()}"`;
            const no_hp = `"${(cols[4]?.textContent || '').trim()}"`;
            const website = `"${(cols[5]?.textContent || '').trim()}"`;
            const keterangan = `"${(cols[8]?.textContent || '').trim()}"`;
            const tanggal = `"${(cols[9]?.textContent || '').trim()}"`; // Asumsi tanggal ada di kolom ke-10

            csv += `${index + 1},${nama},${alamat},${email},${no_hp},${website},${keterangan},${tanggal}\n`;
        });

        const blob = new Blob(["\uFEFF" + csv], {
            type: 'text/csv;charset=utf-8;'
        });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'data-perusahaan-prospek.csv';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }

    function downloadTemplate() {
        const templateData = [
            ['Nama Perusahaan', 'Alamat', 'Email', 'No HP', 'Website', 'Keterangan', 'Tanggal (YYYY-MM-DD)'],
            ['Contoh Perusahaan 1', 'Jl. Contoh No.1', 'contoh1@email.com', '08123456789', 'www.contoh1.com', 'Keterangan contoh', '2023-01-01'],
        ];
        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.aoa_to_sheet(templateData);
        XLSX.utils.book_append_sheet(wb, ws, "Template");
        XLSX.writeFile(wb, 'template-impor-perusahaan.xlsx');
    }

    $('#importForm').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const id_prospek = $('#id_prospek_import').val();
        $('#import_file').removeClass('is-invalid');
        $('.invalid-feedback').text('');
        $('#importBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Mengimpor...');

        $.ajax({
            url: `<?= base_url('prospek/import') ?>/${id_prospek}`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    $('#importModal').modal('hide');
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    if (response.errors) {
                        $.each(response.errors, function(field, message) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field).siblings('.invalid-feedback').text(message);
                        });
                    } else {
                        showAlert('danger', response.message || 'Terjadi kesalahan saat mengimpor data');
                    }
                }
            },
            error: function(xhr) {
                showAlert('danger', 'Terjadi kesalahan pada server. ' + xhr.responseText);
            },
            complete: function() {
                $('#importBtn').prop('disabled', false).html('<i class="bi bi-upload me-1"></i> Impor Data');
            }
        });
    });

    function konfirmasiHapus(url, companyName = '') {
        $('#formHapus').attr('action', url);
        if (companyName) {
            $('#delete_company_name').text(companyName);
        }
        new bootstrap.Modal(document.getElementById('modalHapus')).show();
    }

    function viewDetail(id) {
        const id_prospek = $('#id_prospek').val();
        $.ajax({
            url: `<?= site_url('prospek') ?>/${id_prospek}/perusahaan/get/${id}`,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    const data = response.data;
                    $('#view_nama_perusahaan').text(data.nama_perusahaan || '-');
                    $('#view_email').html(data.email ? `<a href="mailto:${data.email}">${data.email}</a>` : '-');
                    $('#view_alamat').text(data.alamat || '-');
                    $('#view_no_hp').html(data.no_hp ? `<a href="tel:${data.no_hp}">${data.no_hp}</a>` : '-');
                    $('#view_no_telepon').html(data.no_telepon ? `<a href="tel:${data.no_telepon}">${data.no_telepon}</a>` : '-');
                    $('#view_website').html(data.website ? `<a href="${data.website}" target="_blank">${data.website}</a>` : '-');
                    $('#view_tanggal').text(data.tanggal ? formatDate(data.tanggal) : '-');
                    $('#view_keterangan_lainnya').text(data.keterangan_lainnya || '-');
                    $('#viewModal').modal('show');
                } else {
                    showAlert('danger', response.message);
                }
            },
            error: function(xhr) {
                showAlert('danger', 'Terjadi kesalahan pada server: ' + xhr.responseText);
            }
        });
    }

    function editDetail(id) {
        const id_prospek = $('#id_prospek').val();
        $.ajax({
            url: `<?= site_url('prospek') ?>/${id_prospek}/perusahaan/get/${id}`,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    const data = response.data;
                    $('#nama_perusahaan').val(data.nama_perusahaan);
                    $('#email').val(data.email || '');
                    $('#alamat').val(data.alamat || '');
                    $('#no_hp').val(data.no_hp || '');
                    $('#no_telepon').val(data.no_telepon || '');
                    $('#website').val(data.website || '');
                    $('#tanggal').val(data.tanggal || '<?= date('Y-m-d') ?>');
                    $('#keterangan_lainnya').val(data.keterangan_lainnya || '');
                    $('#form_mode').val('edit');
                    $('#edit_id').val(id);
                    $('#addModalLabel').html('<i class="fas fa-edit me-2"></i> Edit Perusahaan');
                    $('#addModal').modal('show');
                } else {
                    showAlert('danger', response.message);
                }
            },
            error: function(xhr) {
                showAlert('danger', 'Terjadi kesalahan pada server: ' + xhr.responseText);
            }
        });
    }

    $('#companyForm').on('submit', function(e) {
        e.preventDefault();
        const formMode = $('#form_mode').val();
        const id_prospek = $('#id_prospek').val();
        const url = formMode === 'add' ?
            `<?= site_url('prospek') ?>/${id_prospek}/perusahaan/store` :
            `<?= site_url('prospek') ?>/${id_prospek}/perusahaan/update/${$('#edit_id').val()}`;
        
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').text('');
        $('#submitBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...');

        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    $('#addModal').modal('hide');
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    if (response.errors) {
                        $.each(response.errors, function(field, message) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field).siblings('.invalid-feedback').text(message);
                        });
                    } else {
                        showAlert('danger', response.message);
                    }
                }
            },
            error: function(xhr) {
                showAlert('danger', 'Terjadi kesalahan pada server: ' + xhr.statusText);
            },
            complete: function() {
                $('#submitBtn').prop('disabled', false).html('<i class="bi bi-save me-1"></i> Simpan');
            }
        });
    });

    function showAlert(type, message) {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        $('#alertContainer').html(alertHtml);
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }

    $('#addModal').on('hidden.bs.modal', function() {
        $('#companyForm')[0].reset();
        $('#form_mode').val('add');
        $('#edit_id').val('');
        $('#addModalLabel').html('<i class="fas fa-plus-circle me-2"></i> Tambah Perusahaan');
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').text('');
    });

    $('#importModal').on('hidden.bs.modal', function() {
        $('#importForm')[0].reset();
        $('#import_file').removeClass('is-invalid');
        $('.invalid-feedback').text('');
    });
</script>

<?= $this->endSection(); ?>