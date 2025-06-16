<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
    <h4>Data Artikel Trending</h4>
    <a href="/artikeltrending/tambah" class="btn btn-success mb-3">+ Tambah Artikel</a>
    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>ID Siswa</th>
                <th>Link</th>
                <th>Tanggal Penugasan</th>
                <th>Tanggal Upload</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($artikel as $a): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $a['id_siswa'] ?></td>
                    <td><a href="<?= $a['link_trending'] ?>" target="_blank">Lihat</a></td>
                    <td><?= $a['tanggal_penugasan'] ?></td>
                    <td><?= $a['tanggal_upload'] ?></td>
                    <td>
                        <a href="/artikeltrending/hapus/<?= $a['id_artikel_trending'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?= $this->endSection();?>