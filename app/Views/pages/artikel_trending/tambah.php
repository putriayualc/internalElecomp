
<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
    <h4>Tambah Artikel Trending</h4>
    <form action="/artikeltrending/simpan" method="post">
        <div class="mb-3">
            <label>ID Siswa</label>
            <input type="number" name="id_siswa" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Link Artikel</label>
            <input type="url" name="link_trending" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Penugasan</label>
            <input type="date" name="tanggal_penugasan" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

</div>

<?= $this->endSection();?>