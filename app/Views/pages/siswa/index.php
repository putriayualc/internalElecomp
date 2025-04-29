<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <!-- Judul dan Tombol Tambah -->
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Data Siswa Magang</h1>
            </div>
            <div class="col-auto">
                <div class="d-flex gap-2">
                    <a href="<?= base_url('siswa/tambah') ?>" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Siswa
                    </a>
                </div>
            </div>
        </div>

        <!-- Notifikasi -->
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('pesan') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Tabel -->
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Daftar Siswa Magang</h4>
                    </div>
                    <div class="col-auto">
                        <div class="card-header-action">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari siswa..." id="searchData">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left" id="tabelSiswa">
                        <thead>
                            <tr>
                                <th class="cell" width="5%">No</th>
                                <th class="cell" width="20%">Nama</th>
                                <th class="cell" width="15%">Jurusan</th>
                                <th class="cell" width="20%">Asal Instansi</th>
                                <th class="cell" width="15%">Status</th>
                                <th class="cell" width="25%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1; ?>
                            <?php foreach ($allSiswa as $s) : ?>
                                <tr>
                                    <td class="cell"><?= $counter++; ?></td>
                                    <td class="cell fw-bold"><?= $s['nama']; ?></td>
                                    <td class="cell"><?= $s['jurusan']; ?></td>
                                    <td class="cell"><?= $s['asal_instansi']; ?></td>
                                    <td class="cell">
                                        <?php if ($s['status'] == 'Aktif') : ?>
                                            <span class="badge bg-success"><?= $s['status']; ?></span>
                                        <?php elseif ($s['status'] == 'Selesai') : ?>
                                            <span class="badge bg-secondary"><?= $s['status']; ?></span>
                                        <?php else : ?>
                                            <span class="badge bg-warning text-dark"><?= $s['status']; ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="cell">
                                        <div class="d-flex gap-1">
                                            <a href="<?= base_url('siswa/detail/' . $s['id_siswa']); ?>" class="btn btn-sm btn-info text-white" title="Detail">
                                                <i class="fas fa-eye me-1"></i> Lihat
                                            </a>
                                            <a href="<?= base_url('siswa/edit/' . $s['id_siswa']); ?>" class="btn btn-sm btn-warning text-white" title="Edit">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="konfirmasiHapus('<?= base_url('siswa/hapus/' . $s['id_siswa']); ?>')" title="Hapus">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            
                            <?php if (empty($allSiswa)) : ?>
                                <tr>
                                    <td colspan="6" class="text-center py-3">Tidak ada data siswa magang</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data siswa ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Batal
                </button>
                <a href="" id="hapusLink" class="btn btn-danger">
                    <i class="fas fa-trash me-1"></i> Hapus
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // DataTables (jika diaktifkan)
        if ($.fn.DataTable) {
            $('#tabelSiswa').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                }
            });
        }
        
        // Filter pencarian manual (alternatif jika DataTables tidak aktif)
        const searchInput = document.getElementById('searchData');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchValue = this.value.toLowerCase();
                const tableRows = document.querySelectorAll('#tabelSiswa tbody tr');

                tableRows.forEach(row => {
                    const nama = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
                    const jurusan = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || '';
                    const instansi = row.querySelector('td:nth-child(4)')?.textContent.toLowerCase() || '';
                    const status = row.querySelector('td:nth-child(5)')?.textContent.toLowerCase() || '';

                    if (nama.includes(searchValue) || jurusan.includes(searchValue) || 
                        instansi.includes(searchValue) || status.includes(searchValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });

    // Konfirmasi Hapus
    function konfirmasiHapus(url) {
        document.getElementById('hapusLink').setAttribute('href', url);
        var hapusModal = new bootstrap.Modal(document.getElementById('hapusModal'));
        hapusModal.show();
    }
</script>

<?= $this->endSection(); ?>