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
        <?php foreach (['ig' => 'Instagram', 'fb' => 'Facebook', 'linkedin' => 'LinkedIn', 'tiktok' => 'TikTok'] as $key => $name): ?>
            <a href="?platform=<?= $key ?>&id_bisnis=<?= $id_bisnis ?? '' ?>" class="badge bg-secondary me-2 <?= ($platformFilter ?? '') === $key ? 'bg-primary' : '' ?>">
                <?= $name ?>
            </a>
        <?php endforeach; ?>
        <a href="?id_bisnis=<?= $id_bisnis ?? '' ?>" class="badge bg-danger">Reset</a>
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
                                    <img src="<?= base_url('assets/img/' . $k['cover']) ?>" alt="cover" class="me-3" width="50" height="50" style="object-fit: cover; border-radius: 5px;">
                                    <div>
                                        <strong><?= esc($k['tajuk']) ?></strong><br>
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
                                <a href="<?= route_to('konten.delete', $k['id_konten']) ?>" onclick="return confirm('Yakin ingin menghapus?')" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>