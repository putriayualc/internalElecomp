<?= $this->extend('layout/template'); ?>

<?= $this->Section('content'); ?>
<h2 class="mb-4">Manajemen Sosial Media</h2>

<!-- Dropdown Filter Bisnis -->
<div class="container mt-4">
    <div class="mb-3">
        <form>
            <label for="filterBisnis" class="form-label">Filter berdasarkan Bisnis:</label>
            <select id="filterBisnis" class="form-select" onchange="location.href=this.value">
                <option value="<?= route_to('konten') ?>" <?= empty($id_bisnis) ? 'selected' : '' ?>>-- Semua Bisnis --</option>
                <?php foreach ($allBisnis as $b) : ?>
                    <option value="<?= route_to('konten.filter', $b['id_bisnis']) ?>" <?= (!empty($id_bisnis) && $id_bisnis == $b['id_bisnis']) ? 'selected' : '' ?>>
                        <?= $b['nama_bisnis']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <!-- Filter Platform -->
    <div class="mb-3">
        <strong>Platform:</strong>
        <div id="platformTags">
            <?php foreach (['ig' => 'Instagram', 'fb' => 'Facebook', 'linkedin' => 'LinkedIn', 'tiktok' => 'TikTok'] as $key => $name): ?>
                <span class="badge me-2 platform-badge <?= (in_array($key, explode(',', $platformFilter ?? ''))) ? 'bg-primary' : 'bg-secondary' ?>"
                    data-platform="<?= $key ?>" style="cursor:pointer;">
                    <?= $name ?>
                </span>
            <?php endforeach; ?>
            <a href="?<?= $id_bisnis ? 'id_bisnis=' . $id_bisnis : '' ?>" class="badge bg-danger">Reset</a>
        </div>
    </div>

    <!-- Tombol Tambah Konten -->
    <div class="mb-3">
        <a href="<?= route_to('konten.tambah') ?>" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Konten
        </a>
    </div>


    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Konten</th>
                    <th>Platform</th>
                    <th>Tanggal Upload</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($allKonten)): ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada konten ditemukan.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($allKonten as $k): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?= base_url('assets/sosmed/cover/' . $k['cover']) ?>" alt="cover" class="me-3" width="50" height="50" style="object-fit: cover; border-radius: 5px;">
                                    <div>
                                        <strong><?= esc($k['judul']) ?></strong><br>
                                        <span class="text-muted" style="font-size: 0.9rem;">
                                            <?= (strlen(strip_tags($k['caption'])) > 60)
                                                ? substr(strip_tags($k['caption']), 0, 60) . '...'
                                                : strip_tags($k['caption']) ?>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php foreach ($k['platforms'] as $plat): ?>
                                    <i class="fab fa-<?= $plat ?> me-2"></i>
                                <?php endforeach; ?>
                            </td>
                            <td>
                                <?= date('Y-m-d', strtotime($k['tgl_upload'])) ?><br>
                                <small><?= date('H:i', strtotime($k['tgl_upload'])) ?></small>
                            </td>
                            <td>
                                <a href="<?= route_to('konten.view', $k['id_konten']) ?>" class="text-primary me-2"><i class="fas fa-eye"></i></a>
                                <a href="<?= route_to('konten.edit', $k['id_konten']) ?>" class="text-success me-2"><i class="fas fa-edit"></i></a>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteKontenModal<?= $k['id_konten'] ?>" data-bs-toggle="tooltip" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Media Sosial -->
<?php foreach ($allKonten as $k) : ?>
    <div class="modal fade" id="deleteKontenModal<?= $k['id_konten'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Konfirmasi Hapus Data
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="mb-0">Apakah Anda yakin ingin menghapus konten sosial media:</p>
                    <div class="d-flex align-items-center mt-3 p-3 bg-light rounded">
                        <?= $k['judul']; ?>
                    </div>
                    <div class="alert alert-warning mt-3 mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <a href="<?= route_to('konten.delete', $k['id_konten']) ?>" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const badges = document.querySelectorAll('.platform-badge');
        const url = new URL(window.location.href);
        let selected = url.searchParams.get('platform')?.split(',') || [];

        badges.forEach(badge => {
            badge.addEventListener('click', function() {
                const platform = this.getAttribute('data-platform');
                const index = selected.indexOf(platform);

                if (index > -1) {
                    selected.splice(index, 1); // hapus jika sudah ada
                } else {
                    selected.push(platform); // tambah jika belum ada
                }

                // Update parameter URL
                const params = new URLSearchParams(window.location.search);

                if (selected.length > 0) {
                    params.set('platform', selected.join(','));
                } else {
                    params.delete('platform');
                }

                // Pertahankan id_bisnis jika ada
                if ("<?= $id_bisnis ?>") {
                    params.set('id_bisnis', "<?= $id_bisnis ?>");
                }

                window.location.href = `${window.location.pathname}?${params.toString()}`;
            });
        });
    });
</script>


<?= $this->endSection(); ?>