<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<title>Tambah Konten Sosmed</title>

<body>
    <div class="container-fluid">
        <div class="form-container shadow rounded">
            <div class="form-header">
                <h2 class="display-7 fw-bolder mb-4 text-dark">
                    Tambah Konten Sosmed
                </h2>
            </div>

            <?php if (session()->has('validation')): ?>
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        <?php foreach (session('validation') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= route_to('konten.simpan') ?>" method="POST" enctype="multipart/form-data" id="kontenForm">
                <?= csrf_field() ?>
                <div class="row g-4">
                    
                    <!-- Judul Konten -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul Konten" value="<?= old('judul') ?>" required>
                            <label for="judul">
                                <i class="bi bi-type me-2"></i>Judul Konten
                            </label>
                            <div class="invalid-feedback">
                                Judul konten harus diisi
                            </div>
                        </div>
                    </div>

                    <!-- Jenis Bisnis -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" id="id_bisnis" name="id_bisnis" required onchange="loadSosmedCheckboxes(this.value)">
                                <option value="">Pilih Jenis Bisnis</option>
                                <?php foreach ($allBisnis as $bisnis): ?>
                                    <option value="<?= $bisnis['id_bisnis']; ?>" <?= old('id_bisnis') == $bisnis['id_bisnis'] ? 'selected' : '' ?>>
                                        <?= $bisnis['nama_bisnis']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="id_bisnis">
                                <i class="bi bi-briefcase me-2"></i>Jenis Bisnis
                            </label>
                            <div class="invalid-feedback">
                                Jenis bisnis harus dipilih
                            </div>
                        </div>
                    </div>

                    <!-- Caption Konten -->
                    <div class="col-12">
                        <label for="caption" class="form-label">
                            <i class="bi bi-chat-text me-2"></i>Caption Konten
                        </label>
                        <textarea class="form-control tiny" id="caption" name="caption" rows="4" placeholder="Tulis caption konten di sini..."><?= old('caption') ?></textarea>
                        <div class="invalid-feedback">
                            Caption harus diisi
                        </div>
                    </div>

                    <!-- Tanggal Upload -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="tgl_upload" name="tgl_upload" value="<?= old('tgl_upload') ?>" required>
                            <label for="tgl_upload">
                                <i class="bi bi-calendar-check me-2"></i>Tanggal Upload
                            </label>
                            <div class="invalid-feedback">
                                Tanggal upload harus dipilih
                            </div>
                        </div>
                    </div>

                    <!-- Platform Checklist -->
                    <div class="col-md-6">
                        <div class="border p-3 rounded h-100">
                            <label class="form-label mb-3">
                                <i class="bi bi-share me-2"></i>Platform Sosial Media
                            </label>
                            <div id="platform-container" class="d-flex flex-column gap-2">
                                <small class="text-muted">Pilih bisnis terlebih dahulu.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Foto Cover -->
                    <div class="col-md-6">
                        <div class="border p-3 rounded">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="form-label">
                                    <i class="bi bi-image me-2"></i>Foto Cover
                                </label>
                            </div>
                            <div class="input-group">
                                <input type="file" class="form-control" id="cover" name="cover" accept="image/*">
                            </div>
                            <!-- Preview Image Cover -->
                            <img id="previewCover" src="#" alt="Preview Cover"
                                class="img-thumbnail mt-3 d-none" style="max-width: 200px;">
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-2"></i>
                                Ukuran maks. 2MB, format JPG/PNG
                            </small>
                        </div>
                    </div>

                    <!-- File Konten -->
                    <div class="col-md-6">
                        <div class="border p-3 rounded">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <label class="form-label">
                                    <i class="bi bi-file-earmark-play me-2"></i>File Konten
                                </label>
                            </div>
                            <div class="input-group">
                                <input type="file" class="form-control" id="konten_file" accept="image/*,video/*" multiple required>
                            </div>
                            <!-- Preview Files -->
                            <div id="previewFiles" class="mt-3 d-none">
                                <div class="row g-2" id="filesContainer"></div>
                            </div>
                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-2"></i>
                                Bisa pilih multiple file, format gambar/video. Klik X untuk menghapus file.
                            </small>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="<?= route_to('konten.index') ?>" class="btn btn-secondary btn-lg d-flex align-items-center">
                            <span>Kembali</span>
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg d-flex align-items-center">
                            <span>Simpan</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('kontenForm');

            // Form validation
            if (form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            }

            // Cover photo preview
            const coverInput = document.getElementById('cover');
            const previewCover = document.getElementById('previewCover');

            if (coverInput && previewCover) {
                coverInput.addEventListener('change', function(e) {
                    var file = e.target.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            previewCover.src = e.target.result;
                            previewCover.classList.remove('d-none');
                        }
                        reader.readAsDataURL(file);
                    } else {
                        previewCover.src = '#';
                        previewCover.classList.add('d-none');
                    }
                });
            }

            // Content files preview dengan fitur hapus individual
            const kontenInput = document.getElementById('konten_file');
            const previewFiles = document.getElementById('previewFiles');
            const filesContainer = document.getElementById('filesContainer');
            let selectedFiles = []; // Array untuk menyimpan file yang dipilih

            if (kontenInput && previewFiles && filesContainer) {
                kontenInput.addEventListener('change', function(e) {
                    // Tambah file baru ke array yang sudah ada
                    const newFiles = Array.from(e.target.files);
                    selectedFiles = [...selectedFiles, ...newFiles];
                    
                    updateFilePreview();
                    updateFileInput();
                });
            }

            // Function untuk update preview files
            function updateFilePreview() {
                filesContainer.innerHTML = '';
                
                if (selectedFiles.length > 0) {
                    previewFiles.classList.remove('d-none');
                    
                    selectedFiles.forEach((file, index) => {
                        const col = document.createElement('div');
                        col.className = 'col-6 col-md-4 col-lg-3';
                        
                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                col.innerHTML = `
                                    <div class="card position-relative">
                                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-1" 
                                                onclick="removeFile(${index})" style="width: 25px; height: 25px; z-index: 10;">
                                            <i class="bi bi-x" style="font-size: 12px;"></i>
                                        </button>
                                        <img src="${e.target.result}" class="card-img-top" style="height: 80px; object-fit: cover;">
                                        <div class="card-body p-1">
                                            <small class="text-muted">${file.name}</small>
                                        </div>
                                    </div>
                                `;
                            }
                            reader.readAsDataURL(file);
                        } else if (file.type.startsWith('video/')) {
                            col.innerHTML = `
                                <div class="card position-relative">
                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle p-1" 
                                            onclick="removeFile(${index})" style="width: 25px; height: 25px; z-index: 10;">
                                        <i class="bi bi-x" style="font-size: 12px;"></i>
                                    </button>
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 80px;">
                                        <i class="bi bi-play-circle fs-2 text-muted"></i>
                                    </div>
                                    <div class="card-body p-1">
                                        <small class="text-muted">${file.name}</small>
                                    </div>
                                </div>
                            `;
                        }
                        
                        filesContainer.appendChild(col);
                    });
                } else {
                    // Sembunyikan preview tapi jangan hilangkan input file
                    previewFiles.classList.add('d-none');
                }
            }

            // Function untuk update input file dengan file yang tersisa
            function updateFileInput() {
                if (selectedFiles.length > 0) {
                    const dt = new DataTransfer();
                    selectedFiles.forEach(file => dt.items.add(file));
                    
                    // Update input file asli
                    kontenInput.files = dt.files;
                    
                    // Tambahkan nama attribute yang benar ke input file
                    kontenInput.name = 'konten_file[]';
                } else {
                    // Jika tidak ada file, reset input file tapi tetap pertahankan element
                    kontenInput.value = '';
                    kontenInput.name = 'konten_file[]';
                }
            }

            // Function untuk menghapus file berdasarkan index (global function)
            window.removeFile = function(index) {
                selectedFiles.splice(index, 1);
                updateFilePreview();
                updateFileInput();
                
                // Reset input file jika tidak ada file tersisa agar bisa memilih file baru
                if (selectedFiles.length === 0) {
                    kontenInput.value = '';
                    kontenInput.name = 'konten_file[]';
                }
            }
        });

        // Function untuk load sosmed checkboxes
        function loadSosmedCheckboxes(idBisnis) {
            fetch("<?= base_url('konten/getByBisnis/') ?>" + idBisnis)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('platform-container');
                    container.innerHTML = '';

                    if (data.length === 0) {
                        container.innerHTML = '<small class="text-muted">Tidak ada akun sosial media untuk bisnis ini.</small>';
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
                                <i class="bi bi-${getPlatformIcon(sosmed.platform)} me-2"></i>${sosmed.platform.toUpperCase()} - ${sosmed.username}
                            </label>
                        `;
                        container.appendChild(checkbox);
                    });
                })
                .catch(err => {
                    document.getElementById('platform-container').innerHTML = '<small class="text-danger">Gagal memuat platform.</small>';
                });
        }

        // Function untuk mendapatkan icon platform
        function getPlatformIcon(platform) {
            const icons = {
                'instagram': 'instagram',
                'facebook': 'facebook', 
                'twitter': 'twitter',
                'tiktok': 'tiktok',
                'youtube': 'youtube',
                'linkedin': 'linkedin'
            };
            return icons[platform.toLowerCase()] || 'globe';
        }

        // Load otomatis jika ada old('id_bisnis')
        window.addEventListener('DOMContentLoaded', () => {
            const selectedBisnis = "<?= old('id_bisnis') ?>";
            if (selectedBisnis) {
                loadSosmedCheckboxes(selectedBisnis);
            }
        });
    </script>

</body>

<?= $this->endSection(); ?>