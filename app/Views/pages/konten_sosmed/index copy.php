<?= $this->extend('layout/template'); ?>

<?= $this->Section('content'); ?>
<div class="container mt-4">
    <h2 class="mb-4">Manajemen Sosial Media</h2>

    <!-- Dropdown Filter Bisnis -->
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

    <!-- List Konten Sosmed -->
    <div class="row">
        <?php if (empty($allKonten)): ?>
            <div class="col-12">
                <p class="text-center">Tidak ada konten ditemukan.</p>
            </div>
        <?php endif; ?>

        <?php foreach ($allKonten as $k): ?>
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="row g-0">
                        <div class="col-4">
                            <img src="<?= base_url('assets/img/' . $k['cover']) ?>" class="img-fluid rounded-start" alt="cover">
                        </div>
                        <div class="col-8">
                            <div class="card-body">
                                <h5 class="card-title mb-1"><?= esc($k['tajuk']) ?></h5>
                                <p class="card-text text-muted" style="font-size: 0.9rem;">
                                    <?= (strlen(strip_tags($k['caption'])) > 100)
                                        ? substr(strip_tags($k['caption']), 0, 100) . '...'
                                        : strip_tags($k['caption']) ?>
                                </p>
                                <div class="mb-2">
                                    <?php foreach ($k['platforms'] as $plat): ?>
                                        <i class="fab fa-<?= $plat ?> me-2"></i>
                                    <?php endforeach; ?>
                                </div>
                                <p class="card-text"><small class="text-muted">Uploaded by <?= esc($k['username']) ?> on <?= date('d M Y', strtotime($k['tgl_upload'])) ?></small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection(); ?>