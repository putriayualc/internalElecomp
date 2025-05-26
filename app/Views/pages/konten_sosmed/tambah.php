<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title mb-4">Tambah Konten Sosmed</h1>

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
                    <form action="<?= route_to('konten.simpan') ?>" method="post" enctype="multipart/form-data" id="kontenForm">
                        <?= csrf_field() ?>

                        <!-- Judul Konten -->
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Konten</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="<?= old('judul') ?>" required>
                        </div>

                        <!-- Caption Konten -->
                        <div class="mb-3">
                            <label for="caption" class="form-label">Caption</label>
                            <textarea class="form-control tiny" id="caption" name="caption" rows="4"><?= old('caption') ?></textarea>
                        </div>

                        <!-- Foto Cover -->
                        <div class="mb-3">
                            <label for="cover" class="form-label">Foto Cover</label>
                            <input type="file" class="form-control" id="cover" name="cover" accept="image/*">
                        </div>

                        <!-- File Konten -->
                        <div class="mb-3">
                            <label for="konten_file" class="form-label">Konten (gambar/video)</label>
                            <input type="file" class="form-control" id="konten_file" name="konten_file[]" accept="image/*,video/*" multiple required>
                        </div>

                        <!-- Jenis Bisnis -->
                        <div class="mb-3">
                            <label for="id_bisnis" class="form-label">Jenis Bisnis</label>
                            <select class="form-select" id="id_bisnis" name="id_bisnis" required onchange="loadSosmedCheckboxes(this.value)">
                                <option value="" disabled <?= old('id_bisnis') ? '' : 'selected' ?>>-- Pilih Bisnis --</option>
                                <?php foreach ($allBisnis as $bisnis): ?>
                                    <option value="<?= $bisnis['id_bisnis']; ?>" <?= old('id_bisnis') == $bisnis['id_bisnis'] ? 'selected' : '' ?>>
                                        <?= $bisnis['nama_bisnis']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Platform Checklist -->
                        <div class="mb-3" id="sosmed-checkboxes">
                            <label class="form-label">Pilih Platform Sosial Media</label>
                            <div id="platform-container">Pilih bisnis terlebih dahulu.</div>
                        </div>

                        <!-- Tanggal Upload -->
                        <div class="mb-3">
                            <label for="tgl_upload" class="form-label">Tanggal Upload</label>
                            <input type="date" class="form-control" id="tgl_upload" name="tgl_upload" value="<?= old('tgl_upload') ?>" required>
                        </div>

                        <!-- Tombol Aksi -->
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= route_to('konten.index') ?>" class="btn btn-secondary">Kembali</a>
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

                const selectedSosmed = <?= json_encode(old('id_sosmed') ?: []) ?>;

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

    // Load otomatis jika ada old('id_bisnis')
    window.addEventListener('DOMContentLoaded', () => {
        const selectedBisnis = "<?= old('id_bisnis') ?>";
        if (selectedBisnis) {
            loadSosmedCheckboxes(selectedBisnis);
        }
    });
</script>

<?= $this->endSection(); ?>