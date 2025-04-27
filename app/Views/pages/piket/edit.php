<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-11">
            <div class="card shadow p-4 mt-4">
                <div class="row mb-3">
                    <div class="col-md-10">
                        <h4>Edit Piket Hari <?= esc($hari) ?></h4>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-info w-100 btn-sm" onclick="addRow()">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                </div>


                <form action="<?= base_url('piket/update') ?>" method="post" id="piketForm">
                    <input type="hidden" name="hari" value="<?= esc($hari) ?>">

                    <div id="rows">
                        <?php foreach ($namaList as $nama): ?>
                            <div class="row mb-3 align-items-center justify-content-center">
                                <div class="col-md-2">
                                    <select name="nama[]" class="form-control">
                                        <?php foreach ($semuaNama as $namaPilihan): ?>
                                            <option value="<?= esc($namaPilihan) ?>" <?= $namaPilihan == $nama ? 'selected' : '' ?>>
                                                <?= esc($namaPilihan) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger w-100" onclick="removeRow(this)">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addRow() {
            const row = `
    <div class="row mb-3 align-items-center">
        <div class="col-md-10">
            <select name="nama[]" class="form-control">
                <option value="" selected disabled>Pilih Nama</option>
                <?php foreach ($semuaNama as $namaPilihan): ?>
                    <option value="<?= esc($namaPilihan) ?>"><?= esc($namaPilihan) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-danger w-100" onclick="removeRow(this)">
                <i class="fas fa-trash-alt"></i> Hapus
            </button>
        </div>
    </div>
    `;
            document.getElementById('rows').insertAdjacentHTML('beforeend', row);
        }

        function removeRow(button) {
            button.closest('.row').remove();
        }
    </script>

    <?= $this->endSection(); ?>