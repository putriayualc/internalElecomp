<?= $this->extend('layout/template'); ?>

<?= $this->section('css') ?>
<style>
    :root {
        --primary-color: #6366f1;
        --secondary-color: #f0f4f8;
        --success-color: #10b981;
        --danger-color: #ef4444;
        --info-color: #3b82f6;
        --text-color: #333;
        --light-text: #6b7280;
        --border-radius: 12px;
        --box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --transition: all 0.3s ease;
    }

    body {
        /* font-family: 'Poppins', 'Segoe UI', sans-serif; */
        background-color: #f8fafc;
    }

    .edit-container {
        padding: 30px;
    }

    .edit-card {
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 35px;
        margin-top: 20px;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .edit-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        /* background: linear-gradient(to right, var(--info-color), #3b82f6); */
    }

    .edit-card h4 {
        color:rgb(51, 48, 48);
        font-weight: 600;
        font-size: 2rem;
        margin-bottom: 25px;
        position: relative;
        display: inline-block;
    }

    .edit-card h4::after {
        content: "";
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 40px;
        height: 3px;
        /* background-color: var(--primary-color); */
        border-radius: 2px;
    }

    .btn {
        border-radius: 8px;
        font-weight: 500;
        padding: 10px 20px;
        transition: var(--transition);
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-add {
        background-color: var(--info-color);
        color: white;
    }

    .btn-add:hover {
        background-color: #2563eb;
        transform: translateY(-2px);
    }

    .btn-delete {
        background-color: var(--danger-color);
        color: white;
    }

    .btn-delete:hover {
        background-color: #dc2626;
        transform: translateY(-2px);
    }

    .btn-save {
        background-color: var(--success-color);
        color: white;
        padding: 12px 24px;
        font-weight: 600;
    }

    .btn-save:hover {
        background-color: #059669;
        transform: translateY(-2px);
    }

    .form-control {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #d1d5db;
        transition: var(--transition);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .form-control:focus {
        border-color: var(--info-color);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        outline: none;
    }

    .member-row {
        background-color: #f9fafb;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        transition: var(--transition);
        border-left: 3px solid transparent;
    }

    .member-row:hover {
        background-color: #f3f4f6;
        border-left-color: var(--info-color);
        transform: translateX(5px);
    }

    .save-section {
        margin-top: 30px;
        display: flex;
        justify-content: flex-end;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        color: var(--info-color);
        font-weight: 500;
        text-decoration: none;
        margin-right: 20px;
        transition: var(--transition);
    }

    .back-link:hover {
        color: #4f46e5;
        transform: translateX(-3px);
    }

    .form-row {
        opacity: 0;
        transform: translateY(10px);
        animation: fadeInUp 0.4s forwards;
    }

    .form-control option {
    display: block;
    white-space: nowrap;
    min-height: 1.2em;
    padding: 0 2px 1px;
}

/* Allow dropdown to expand properly */
select.form-control {
    width: 100%;
    max-width: 100%;
    overflow: visible !important;
}

/* Ensure dropdowns can display multiple items with scrolling */
select.form-control {
    height: auto;
}

/* Prevent text cutoff in dropdowns */
.input-group select.form-control {
    text-overflow: ellipsis;
}

/* Fix for mobile view */
@media (max-width: 768px) {
    .input-group, .input-group-text, select.form-control {
        width: 100%;
    }
    
    select.form-control {
        padding-right: 30px; /* Space for dropdown arrow */
    }
}

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Day color indicators */
    .day-indicator {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .day-senin { background-color: #f87171; }
    .day-selasa { background-color: #38bdf8; }
    .day-rabu { background-color: #4ade80; }
    .day-kamis { background-color: #facc15; }
    .day-jumat { background-color: #60a5fa; }
    .day-sabtu { background-color: #c084fc; }

    /* Responsive */
    @media (max-width: 768px) {
        .edit-card {
            padding: 20px;
        }
        
        .member-row {
            padding: 10px;
        }
        
        .form-control, .btn {
            font-size: 0.9rem;
        }
    }
</style>

<!-- Adding Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Adding Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<?= $this->endSection('css') ?>

<?= $this->section('content'); ?>

<div class="container edit-container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="edit-card">
                <div class="row mb-4">
                    <div class="col">
                        <h4 class="display-6 fw-bold mb-4">
                            Edit Jadwal Piket Hari
                        </h4>
                        <p class="text-muted">Kelola daftar anggota untuk piket hari <?= ucfirst(esc($hari)) ?></p>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-primary" onclick="addRow()">
                            <i class="fas fa-plus me-2"></i> Tambah Siswa
                        </button>
                    </div>
                </div>

                <form action="<?= base_url('piket/update') ?>" method="post" id="piketForm">
                    <input type="hidden" name="hari" value="<?= esc($hari) ?>">

                    <div id="rows">
                        <?php $index = 0; foreach ($namaList as $nama): $index++; ?>
                            <div class="member-row form-row" style="animation-delay: <?= $index * 0.1 ?>s">
                                <div class="row align-items-center">
                                    <div class="col-md-8 mb-2 mb-md-0">
                                        <div class="input-group">
                                            <span class="input-group-text bg-white">
                                                <i class="fas fa-user text-primary"></i>
                                            </span>
                                            <select name="nama[]" class="form-control">
                                                <?php foreach ($semuaNama as $namaPilihan): ?>
                                                    <option value="<?= esc($namaPilihan) ?>" <?= $namaPilihan == $nama ? 'selected' : '' ?>>
                                                        <?= esc($namaPilihan) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <button type="button" class="btn btn-danger" onclick="removeRow(this)">
                                            <i class="fas fa-trash-alt me-2"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-start gap-2 mt-4">
                        <button type="submit" class="btn btn-success btn-lg d-flex align-items-center">
                            <i class="fas fa-save me-2"></i><span>Simpan</span>
                        </button>
                        <a href="<?= route_to('piket') ?>" class="btn btn-secondary btn-lg d-flex align-items-center">
                            <span>Kembali</span>
                        </a>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<script>
    function addRow() {
        const rows = document.querySelectorAll('.member-row').length;
        const row = `
            <div class="member-row form-row new-row" style="animation-delay: 0.1s">
                <div class="row align-items-center">
                    <div class="col-md-8 mb-2 mb-md-0">
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="fas fa-user text-primary"></i>
                            </span>
                            <select name="nama[]" class="form-control">
                                <option value="" selected disabled>Pilih Nama</option>
                                <?php foreach ($semuaNama as $namaPilihan): ?>
                                    <option value="<?= esc($namaPilihan) ?>"><?= esc($namaPilihan) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <button type="button" class="btn btn-delete" onclick="removeRow(this)">
                            <i class="fas fa-trash-alt me-2"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        `;
        document.getElementById('rows').insertAdjacentHTML('beforeend', row);
        
        // Apply animation to the newly added row
        setTimeout(() => {
            const newRows = document.querySelectorAll('.new-row');
            newRows.forEach(row => {
                row.classList.remove('new-row');
            });
        }, 50);
    }

    function removeRow(button) {
        const row = button.closest('.member-row');
        row.style.opacity = '0';
        row.style.transform = 'translateX(20px)';
        setTimeout(() => {
            row.remove();
        }, 300);
    }

    // Add subtle animation when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        const card = document.querySelector('.edit-card');
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100);
    });
</script>

<script>
    document.getElementById("piketForm").addEventListener("submit", function (e) {
        const selects = document.querySelectorAll('select[name="nama[]"]');
        const values = [];

        for (let select of selects) {
            const val = select.value;
            if (values.includes(val)) {
                alert(`Nama "${val}" tidak boleh duplikat!`);
                e.preventDefault(); // Hentikan submit
                return false;
            }
            values.push(val);
        }
    });
</script>

<script>
    document.addEventListener("change", function (e) {
        if (e.target.matches('select[name="nama[]"]')) {
            const selects = document.querySelectorAll('select[name="nama[]"]');
            const selectedValues = Array.from(selects).map(s => s.value);
            const duplicates = selectedValues.filter((val, idx, arr) => arr.indexOf(val) !== idx);

            if (duplicates.length > 0) {
                alert(`Nama "${duplicates[0]}" sudah dipilih. Harap pilih nama lain.`);
                e.target.value = ""; // Reset pilihan
            }
        }
    });
</script>


<?= $this->endSection(); ?>