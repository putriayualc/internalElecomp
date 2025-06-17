<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<h2>Detail Piket Mingguan</h2>

<?php foreach ($piketDetail as $hari => $list): ?>
    <div class="card mt-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <?= $hari ?>
            <!-- Tombol lihat detail -->
            <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?= esc($hari) ?>">
                Lihat Detail
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal<?= esc($hari) ?>" tabindex="-1" aria-labelledby="modalLabel<?= esc($hari) ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel<?= esc($hari) ?>">Detail Piket - <?= $hari ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <?php foreach ($list as $data): ?>
                            <li><?= esc($data['username']) ?> — <strong><?= esc($data['tugas']) ?></strong></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection() ?>