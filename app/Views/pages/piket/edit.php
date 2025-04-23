<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<h1>Edit Data Piket - <?= esc($hari) ?></h1>

<form action="/piket/update" method="post" class="form-edit-piket">
    <input type="hidden" name="hari" value="<?= esc($hari) ?>">

    <label for="nama">Nama Baru:</label>
    <input type="text" name="nama" id="nama" required>

    <button type="submit">Simpan</button>
</form>

<?= $this->endSection('content'); ?>