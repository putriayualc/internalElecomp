<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="piket">
    <h1>Data Piket</h1>
    <div class="piket-container">
        <?php foreach ($piketData as $hari => $namaList): ?>
            <?php
            $lowerHari = strtolower($hari);
            $class = 'piket-box ' . $lowerHari;
            ?>
            <div class="<?= $class ?>">
                <h3>
                    <?= $hari ?>
                    <a href="<?= base_url('piket/edit/' . strtolower($hari)) ?>" title="Edit">
                        <span>✎</span>
                    </a>
                </h3>
                <ul>
                    <?php foreach ($namaList as $nama): ?>
                        <li><?= $nama ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection('content'); ?>