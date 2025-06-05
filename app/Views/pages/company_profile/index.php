<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <!-- Judul dan Tombol Tambah -->
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Company Profile</h1>
            </div>
            <div class="col-auto">
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahComproModal">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Company Profile
                    </button>
                </div>
            </div>
        </div>

        <!-- Notifikasi -->
        <?php if (session()->has('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i><?= session('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Tabel -->
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <h4 class="app-card-title">Daftar Company Profile</h4>
                    </div>
                </div>
            </div>
            <div class="app-card-body">
    <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
            <thead>
                <tr>
                                <th class="cell">No</th>
                                <th class="cell">Nama Client</th>
                                <th class="cell">Nama Usaha</th>
                                <th class="cell">Email</th>
                                <th class="cell">No HP</th>
                                <th class="cell">Kota/Kabupaten</th>
                                <th class="cell">Harga Awal</th>
                                <th class="cell">Kode Voucher</th>
                                <th class="cell">Potongan</th>
                                <th class="cell">Harga Akhir</th>
                                <th class="cell">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($profiles) && !empty($profiles)): ?>
                    <?php foreach ($profiles as $index => $profile): ?>
                    <tr>
                                    <td class="cell"><?= $index + 1 ?></td>
                                    <td class="cell"><?= esc($profile['nama_client']) ?></td>
                                    <td class="cell"><?= esc($profile['nama_usaha']) ?></td>
                                    <td class="cell"><?= esc($profile['email_client']) ?></td>
                                    <td class="cell"><?= esc($profile['no_hp_client']) ?></td>
                                    <td class="cell"><?= esc($profile['kota_kab_client']) ?></td>
                                    <td class="cell">Rp <?= number_format($profile['harga_awal'], 0, ',', '.') ?></td>
                                    <td class="cell"><?= esc($profile['kode_voucher'] ?? '-') ?></td>
                                    <td class="cell"><?= $profile['potongan'] ? $profile['potongan'] . '%' : '-' ?></td>
                                    <td class="cell">Rp <?= number_format($profile['harga_akhir'], 0, ',', '.') ?></td>
                                    <td class="cell">
                                        <div class="d-flex gap-1 justify-content-center">
                                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" 
                                                    data-bs-target="#editComproModal<?= $profile['id_compro'] ?>">
                                                <i class="fas fa-edit me-1"></i> Edit
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" 
                                                    data-bs-target="#deleteComproModal<?= $profile['id_compro'] ?>">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                                    <td colspan="11" class="text-center py-3">Tidak ada data yang tersedia</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Company Profile -->
<div class="modal fade" id="tambahComproModal" tabindex="-1" aria-labelledby="tambahComproModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('company_profile/store') ?>" method="post" id="createForm">
            <?= csrf_field() ?>
    <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="tambahComproModalLabel">Tambah Company Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="alamat_web" class="form-label">Alamat Web</label>
                <input type="text" class="form-control" id="alamat_web" name="alamat_web" required>
            </div>
                    <div class="mb-3">
                        <label for="nama_client" class="form-label">Nama Client</label>
                <input type="text" class="form-control" id="nama_client" name="nama_client" required>
            </div>
                    <div class="mb-3">
                        <label for="nama_usaha" class="form-label">Nama Usaha</label>
                <input type="text" class="form-control" id="nama_usaha" name="nama_usaha" required>
            </div>
                    <div class="mb-3">
                        <label for="no_hp_client" class="form-label">No HP Client</label>
                <input type="text" class="form-control" id="no_hp_client" name="no_hp_client" required>
            </div>
                    <div class="mb-3">
                        <label for="email_client" class="form-label">Email Client</label>
                <input type="email" class="form-control" id="email_client" name="email_client" required>
            </div>
                    <div class="mb-3">
                        <label for="kota_kab_client" class="form-label">Kota/Kabupaten</label>
                <input type="text" class="form-control" id="kota_kab_client" name="kota_kab_client" required>
            </div>
                    <div class="mb-3">
                        <label for="harga_awal" class="form-label">Harga Awal</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control" id="harga_awal" name="harga_awal" 
                                   value="<?= number_format(3000000, 0, ',', '.') ?>" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="id_voucher" class="form-label">Kode Voucher</label>
                        <select class="form-control" id="id_voucher" name="id_voucher" onchange="hitungHargaAkhir()">
                            <option value="">Pilih Voucher</option>
                            <?php if(isset($vouchers) && !empty($vouchers)): ?>
                                <?php foreach ($vouchers as $voucher): ?>
                                    <option value="<?= $voucher['id_voucher'] ?>" 
                                            data-potongan="<?= $voucher['total_diskon'] ?>"
                                            data-jumlah="<?= $voucher['jumlah_voucher'] ?>">
                                        <?= $voucher['kode_voucher'] ?> 
                                        (<?= $voucher['total_diskon'] ?>% - Tersedia: <?= $voucher['jumlah_voucher'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>Tidak ada voucher yang tersedia</option>
                            <?php endif; ?>
                        </select>
                        <small class="text-muted">Pilih voucher untuk mendapatkan diskon</small>
                    </div>
                    <div class="mb-3">
                        <label for="potongan_harga" class="form-label">Potongan Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control" id="potongan_harga" name="potongan_harga" readonly>
                        </div>
                        <div id="potongan_text" class="text-info mt-1"></div>
                    </div>
                    <div class="mb-3">
                        <label for="harga_akhir" class="form-label">Harga Akhir</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control" id="harga_akhir" name="harga_akhir" readonly>
                        </div>
                        <div id="harga_akhir_text" class="text-success mt-1"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Company Profile -->
<?php if(isset($profiles) && !empty($profiles)): ?>
    <?php foreach ($profiles as $profile): ?>
    <div class="modal fade" id="editComproModal<?= $profile['id_compro'] ?>" tabindex="-1" aria-labelledby="editComproModalLabel<?= $profile['id_compro'] ?>" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?= base_url('company_profile/update/' . $profile['id_compro']) ?>" method="post" id="editForm<?= $profile['id_compro'] ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title" id="editComproModalLabel<?= $profile['id_compro'] ?>">Edit Company Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_alamat_web<?= $profile['id_compro'] ?>" class="form-label">Alamat Web</label>
                            <input type="text" class="form-control" id="edit_alamat_web<?= $profile['id_compro'] ?>" 
                                   name="alamat_web" value="<?= esc($profile['alamat_web']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama_client<?= $profile['id_compro'] ?>" class="form-label">Nama Client</label>
                            <input type="text" class="form-control" id="edit_nama_client<?= $profile['id_compro'] ?>" 
                                   name="nama_client" value="<?= esc($profile['nama_client']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama_usaha<?= $profile['id_compro'] ?>" class="form-label">Nama Usaha</label>
                            <input type="text" class="form-control" id="edit_nama_usaha<?= $profile['id_compro'] ?>" 
                                   name="nama_usaha" value="<?= esc($profile['nama_usaha']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_no_hp_client<?= $profile['id_compro'] ?>" class="form-label">No HP Client</label>
                            <input type="text" class="form-control" id="edit_no_hp_client<?= $profile['id_compro'] ?>" 
                                   name="no_hp_client" value="<?= esc($profile['no_hp_client']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_email_client<?= $profile['id_compro'] ?>" class="form-label">Email Client</label>
                            <input type="email" class="form-control" id="edit_email_client<?= $profile['id_compro'] ?>" 
                                   name="email_client" value="<?= esc($profile['email_client']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_kota_kab_client<?= $profile['id_compro'] ?>" class="form-label">Kota/Kabupaten</label>
                            <input type="text" class="form-control" id="edit_kota_kab_client<?= $profile['id_compro'] ?>" 
                                   name="kota_kab_client" value="<?= esc($profile['kota_kab_client']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_harga_awal<?= $profile['id_compro'] ?>" class="form-label">Harga Awal</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" id="edit_harga_awal<?= $profile['id_compro'] ?>" 
                                       name="harga_awal" value="<?= number_format(3000000, 0, ',', '.') ?>" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_id_voucher<?= $profile['id_compro'] ?>" class="form-label">Kode Voucher</label>
                            <select class="form-control" id="edit_id_voucher<?= $profile['id_compro'] ?>" 
                                    name="id_voucher" onchange="hitungHargaAkhir()">
                                <option value="">Pilih Voucher</option>
                                <?php foreach ($vouchers as $voucher): ?>
                                    <option value="<?= $voucher['id_voucher'] ?>" 
                                            data-potongan="<?= $voucher['total_diskon'] ?>"
                                            data-jumlah="<?= $voucher['jumlah_voucher'] ?>"
                                            <?= ($profile['id_voucher'] == $voucher['id_voucher']) ? 'selected' : '' ?>>
                                        <?= $voucher['kode_voucher'] ?> 
                                        (<?= $voucher['total_diskon'] ?>% - Tersedia: <?= $voucher['jumlah_voucher'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_potongan_harga<?= $profile['id_compro'] ?>" class="form-label">Potongan Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" id="edit_potongan_harga<?= $profile['id_compro'] ?>" 
                                       name="potongan_harga" readonly>
                            </div>
                            <div id="edit_potongan_text<?= $profile['id_compro'] ?>" class="text-info mt-1"></div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_harga_akhir<?= $profile['id_compro'] ?>" class="form-label">Harga Akhir</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" id="edit_harga_akhir<?= $profile['id_compro'] ?>" 
                                       name="harga_akhir" readonly>
                            </div>
                            <div id="edit_harga_akhir_text<?= $profile['id_compro'] ?>" class="text-success mt-1"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- Modal Konfirmasi Hapus -->
<?php if(isset($profiles) && !empty($profiles)): ?>
    <?php foreach ($profiles as $profile): ?>
    <div class="modal fade" id="deleteComproModal<?= $profile['id_compro'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data <strong><?= $profile['nama_client'] ?></strong>?</p>
                    <p class="text-danger"><small><i class="fas fa-exclamation-triangle me-1"></i> Semua data terkait akan ikut terhapus!</small></p>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <form action="<?= base_url('company_profile/delete/' . $profile['id_compro']) ?>" method="post" class="deleteForm">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Hapus
                        </button>
        </form>
    </div>
</div>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function hitungHargaAkhir() {
    const hargaAwal = 3000000;
    const selectVoucher = event.target;
    const selectedOption = selectVoucher.options[selectVoucher.selectedIndex];
    
    // Mendapatkan ID modal yang sedang aktif
    const activeModal = document.querySelector('.modal.show');
    const isEditForm = activeModal.id.startsWith('editComproModal');
    const profileId = isEditForm ? activeModal.id.replace('editComproModal', '') : '';
    const prefix = isEditForm ? 'edit_' : '';
    
    const potonganHargaInput = document.getElementById(prefix + 'potongan_harga' + (isEditForm ? profileId : ''));
    const hargaAkhirInput = document.getElementById(prefix + 'harga_akhir' + (isEditForm ? profileId : ''));
    const potonganText = document.getElementById(prefix + 'potongan_text' + (isEditForm ? profileId : ''));
    const hargaAkhirText = document.getElementById(prefix + 'harga_akhir_text' + (isEditForm ? profileId : ''));
    
    let potongan = 0;
    let hargaAkhir = hargaAwal;
    
    if (selectedOption.value) {
        const potonganPersen = parseFloat(selectedOption.dataset.potongan);
        const jumlahVoucher = parseInt(selectedOption.dataset.jumlah);
        
        // Cek ketersediaan voucher
        if (jumlahVoucher <= 0) {
            // Tampilkan alert
            Swal.fire({
                title: 'Voucher Tidak Tersedia!',
                text: 'Maaf, voucher yang dipilih sudah habis.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
            
            // Reset select ke opsi default
            selectVoucher.value = '';
            
            // Reset perhitungan
            potonganHargaInput.value = formatRupiah(0);
            hargaAkhirInput.value = formatRupiah(hargaAwal);
            potonganText.textContent = '';
            hargaAkhirText.textContent = `Total: Rp ${formatRupiah(hargaAwal)}`;
            return;
        }
        
        potongan = (hargaAwal * potonganPersen) / 100;
        hargaAkhir = hargaAwal - potongan;
        potonganText.textContent = `Potongan ${potonganPersen}%`;
    } else {
        potonganText.textContent = '';
    }
    
    // Format angka ke format Rupiah
    potonganHargaInput.value = formatRupiah(potongan);
    hargaAkhirInput.value = formatRupiah(hargaAkhir);
    hargaAkhirText.textContent = `Total: Rp ${formatRupiah(hargaAkhir)}`;
}

function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID').format(angka);
}

// Menutup modal ketika mengklik di luar modal
window.onclick = function(event) {
    if (event.target.className === 'modal') {
        event.target.style.display = "none";
    }
}

// Inisialisasi perhitungan saat modal dibuka
document.addEventListener('DOMContentLoaded', function() {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.addEventListener('show.bs.modal', function() {
            const selectVoucher = this.querySelector('select[id^="id_voucher"]');
            if (selectVoucher) {
                hitungHargaAkhir.call(selectVoucher);
            }
        });
    });
});

$(document).ready(function() {
    // Handle Form Create
    $('#createForm').submit(function(e) {
        e.preventDefault();
        submitForm($(this), 'POST', function() {
            $('#tambahComproModal').modal('hide');
        });
    });

    // Handle Form Edit
    $('form[id^="editForm"]').submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const url = form.attr('action');
        
        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat mengupdate data',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    // Inisialisasi perhitungan saat modal edit dibuka
    $('.modal').on('show.bs.modal', function() {
        const selectVoucher = $(this).find('select[id^="edit_id_voucher"]');
        if (selectVoucher.length) {
            hitungHargaAkhir.call(selectVoucher[0]);
        }
    });

    // Handle Form Delete
    $('.deleteForm').submit(function(e) {
        e.preventDefault();
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            submitForm($(this), 'DELETE');
        }
    });

    function submitForm(form, method, callback) {
        const url = form.attr('action');
        
        $.ajax({
            url: url,
            type: method,
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    if (typeof callback === 'function') callback();
                    location.reload();
                } else {
                    alert(response.message || 'Terjadi kesalahan');
                }
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    }
});
</script>

<?= $this->endSection(); ?>
