<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title mb-4">Edit Konten Sosmed</h1>

        <?php if (session()->has('validation')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session('validation') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="row g-4 settings-section">
            <div class="col-12">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <form action="<?= route_to('konten.update', $konten['id_konten']) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <!-- Judul Konten -->
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Konten</label>
                            <input type="text" class="form-control" id="judul" name="judul"
                                value="<?= old('judul', $konten['judul']) ?>" required>
                        </div>

                        <!-- Caption Konten -->
                        <div class="mb-3">
                            <label for="caption" class="form-label">Caption</label>
                            <textarea class="form-control tiny" id="caption" name="caption" rows="4"><?= old('caption', $konten['caption']) ?></textarea>
                        </div>

                        <!-- Foto Cover -->
                        <div class="mb-3">
                            <label for="cover" class="form-label">Foto Cover</label>
                            <?php if (!empty($konten['cover'])): ?>
                                <div class="mb-2">
                                    <img src="<?= base_url('assets/sosmed/cover/' . $konten['cover']) ?>" alt="Cover Lama" style="max-height: 150px;">
                                </div>
                            <?php endif; ?>
                            <input type="file" class="form-control" id="cover" name="cover" accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti cover.</small>
                        </div>

                        <!-- File Konten -->
                        <div class="mb-3">
                            <label for="konten_file" class="form-label">Konten (gambar/video)</label>
                            <input type="file" class="form-control" id="konten_file" name="konten_file[]" accept="image/*,video/*" multiple>
                            <small class="text-muted">Kosongkan jika tidak ingin menambah file baru.</small>

                            <?php if (!empty($kontenFiles)): ?>
                                <div class="mt-3">
                                    <label class="form-label">Konten Saat Ini:</label>
                                    <div class="row">
                                        <?php foreach ($kontenFiles as $file): ?>
                                            <div class="col-md-3 mb-2 position-relative">
                                                <?php if (strpos($file['media'], '.mp4') !== false): ?>
                                                    <video controls style="width: 100%;">
                                                        <source src="<?= base_url('assets/sosmed/konten/' . $file['media']) ?>" type="video/mp4">
                                                    </video>
                                                <?php else: ?>
                                                    <img src="<?= base_url('assets/sosmed/konten/' . $file['media']) ?>" class="img-fluid" alt="Konten">
                                                <?php endif; ?>
                                                <a href="<?= route_to('konten.deleteMedia', $file['id_detail_konten']) ?>" class="btn btn-danger btn-sm position-absolute top-0 end-0" onclick="return confirm('Yakin hapus file ini?')">×</a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Jenis Bisnis -->
                        <div class="mb-3">
                            <label for="id_bisnis" class="form-label">Jenis Bisnis</label>
                            <select class="form-select" id="id_bisnis" name="id_bisnis" required onchange="loadSosmedCheckboxes(this.value)">
                                <?php foreach ($allBisnis as $bisnis): ?>
                                    <option value="<?= $bisnis['id_bisnis']; ?>"
                                        <?= old('id_bisnis', $selectedBisnis) == $bisnis['id_bisnis'] ? 'selected' : '' ?>>
                                        <?= $bisnis['nama_bisnis']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Platform Checklist -->
                        <div class="mb-3" id="sosmed-checkboxes">
                            <label class="form-label">Pilih Platform Sosial Media</label>
                            <div id="platform-container">Memuat...</div>
                        </div>

                        <!-- Tanggal Upload -->
                        <div class="mb-3">
                            <label for="tgl_upload" class="form-label">Tanggal Upload</label>
                            <input type="date" class="form-control" id="tgl_upload" name="tgl_upload"
                                value="<?= old('tgl_upload', $konten['tgl_upload']) ?>" required>
                        </div>

                        <!-- Tombol Aksi -->
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="<?= route_to('konten') ?>" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS untuk Load Sosmed -->
<script>
    function loadSosmedCheckboxes(idBisnis) {
        fetch("<?= base_url('konten/getByBisnis/') ?>" + idBisnis)
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('platform-container');
                container.innerHTML = '';

                if (data.length === 0) {
                    container.innerHTML = '<p class="text-muted">Tidak ada akun sosial media untuk bisnis ini.</p>';
                    return;
                }

                const selectedSosmed = <?= json_encode(old('id_sosmed', $selectedSosmed ?? [])) ?>;

                data.forEach(sosmed => {
                    const checkbox = document.createElement('div');
                    checkbox.className = "form-check";

                    checkbox.innerHTML = `
                        <input class="form-check-input" type="checkbox" name="id_sosmed[]" value="${sosmed.id_sosmed}" id="sosmed_${sosmed.id_sosmed}"
                            ${selectedSosmed.includes(sosmed.id_sosmed.toString()) ? 'checked' : ''}>
                        <label class="form-check-label" for="sosmed_${sosmed.id_sosmed}">
                            ${sosmed.platform.toUpperCase()} - ${sosmed.username}
                        </label>
                    `;
                    container.appendChild(checkbox);
                });
            })
            .catch(err => {
                document.getElementById('platform-container').innerHTML = '<p class="text-danger">Gagal memuat platform.</p>';
            });
    }

    window.addEventListener('DOMContentLoaded', () => {
        const selectedBisnis = "<?= old('id_bisnis', $selectedBisnis) ?>";
        if (selectedBisnis) {
            loadSosmedCheckboxes(selectedBisnis);
        }
    });
</script>

<?= $this->endSection(); ?>