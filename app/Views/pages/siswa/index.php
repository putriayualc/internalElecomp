<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Data Siswa Magang</h4>
                        <a href="<?= base_url('siswa/tambah') ?>" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Tambah Siswa
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tabelSiswa">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Jurusan</th>
                                    <th>Asal Instansi</th>
                                    <th>No Telepon</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Foto</th>
                                    <th>Periode Magang</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($allSiswa as $s) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $s['nama']; ?></td>
                                        <td><?= $s['alamat']; ?></td>
                                        <td><?= $s['jurusan']; ?></td>
                                        <td><?= $s['asal_instansi']; ?></td>
                                        <td><?= $s['no_telepon']; ?></td>
                                        <td><?= $s['jenis_kelamin']; ?></td>
                                        <td><?= $s['foto']; ?></td>
                                        <td><?= date('d-m-Y', strtotime($s['tgl_masuk'])) . ' s/d ' . date('d-m-Y', strtotime($s['tgl_keluar'])); ?></td>
                                        <td>
                                            <?php if ($s['status'] == 'Aktif') : ?>
                                                <span class="badge bg-success"><?= $s['status']; ?></span>
                                            <?php elseif ($s['status'] == 'Selesai') : ?>
                                                <span class="badge bg-secondary"><?= $s['status']; ?></span>
                                            <?php else : ?>
                                                <span class="badge bg-warning text-dark"><?= $s['status']; ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="<?= base_url('siswa/detail/' . $s['id_siswa']); ?>" class="btn btn-sm btn-info text-white" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="<?= base_url('siswa/edit/' . $s['id_siswa']); ?>" class="btn btn-sm btn-warning text-white" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-danger" onclick="konfirmasiHapus('<?= base_url('siswa/hapus/' . $s['id_siswa']); ?>')" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (empty($allSiswa)) : ?>
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data siswa magang</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
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
                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data siswa ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="" id="hapusLink" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script>
    // DataTables
    $(document).ready(function() {
        $('#tabelSiswa').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            }
        });
    });

    // Konfirmasi Hapus
    function konfirmasiHapus(url) {
        $('#hapusLink').attr('href', url);
        $('#hapusModal').modal('show');
    }
</script>

<?= $this->endSection(); ?>