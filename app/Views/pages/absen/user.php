<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<?php if ($waktuSekarang >= $mulai && $waktuSekarang <= $selesai) :?>
<?php if (!$sudahAbsen): ?>
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
      <!-- Judul dan Tombol Tambah -->
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Absen Hari Ini</h1>
            </div>
        </div>


        <style>
            .scale-hover{
                cursor: pointer;
            }
            .scale-hover:hover{
            transform: scale(1.05); 
            transition: .5s ease;
            }
        </style>
        <div class="container my-4">
            <div class="row">
                <div class="col-12 col-md-4 mb-4 scale-hover" id="absen">
                    <div class="card bg-success text-white h-100">
                        <img src="assets/img/absen-1.png" class="card-img-top" alt="Absen">
                        <div class="card-body">
                            <h5 class="card-title text-center">Masuk</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4 scale-hover" id="ijin">
                    <div class="card bg-warning text-white h-100 p-4">
                        <img src="assets/img/ijin-2.png" class="card-img-top" alt="Ijin">
                        <div class="card-body">
                            <h5 class="card-title text-center">Ijin</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4 scale-hover" id="sakit">
                    <div class="card bg-danger text-white h-100">
                        <img src="assets/img/sakit-3.png" class="card-img-top" alt="Sakit">
                        <div class="card-body">
                            <h5 class="card-title text-center">Sakit</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
          .close-btn {
                background: none;
                border: none;
                font-size: 24px;
                cursor: pointer;
                color: #888;
            }

            .close-btn:hover {
                color: #000;
            }
        </style>
        <!-- Modal Bootstrap 4 -->
        <div class="modal fade" id="absenModal">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h6 class="modal-title" id="terimaModalLabel">Silahkan Absen, Lengkapi Data Diri Anda Hari Ini!!</h6>
                        <button id="closeAbsen" class="close-btn">&times;</button>
                    </div>
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        <form action="<?= base_url('/absen/masuk/' . $user['id_user']) ?>" method="post" enctype="multipart/form-data" class="p-4 shadow rounded bg-white">
                            <?= csrf_field() ?>
                            <h4 class="mb-4 text-success font-weight-bold text-center">Formulir Absen</h4>

                                <label for="bukti_foto" class="font-weight-bold">Upload Bukti Foto</label>
                                <input type="file" name="bukti_foto" class="form-control-file mb-2" id="bukti_foto" accept=".png,.jpg,.jpeg" onchange="previewImg()">

                                <div class="mt-2">
                                    <img src="" id="preview" class="shadow-lg rounded" style="max-height: 200px; object-fit: cover;" >
                                </div>

                            <!-- <div class="form-group mt-4">
                                <label for="exampleFormControlTextarea1" class="font-weight-bold">Kegiatan Hari Ini</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="keterangan" style="height: 30%;" placeholder="Jelaskan kegiatan hari ini..." ></textarea>
                            </div> -->

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success px-5 py-2">
                                    <i class="fas fa-paper-plane mr-2"></i> Kirim Absen
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Bootstrap 4 Ijin -->
        <div class="modal fade" id="ijinModal">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h6 class="modal-title" id="terimaModalLabel">Silahkan Lengkapi Data Ijin Anda Hari Ini!!</h6>
                        <button id="closeIjin" class="close-btn">&times;</button>
                    </div>
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        <form action="<?= base_url('/absen/ijin/' . $user['id_user']) ?>" method="post" enctype="multipart/form-data" class="p-4 shadow rounded bg-white">
                            <?= csrf_field() ?>
                            <h4 class="mb-4 text-info font-weight-bold text-center">Formulir Absen</h4>

                                <label for="bukti_ijin" class="font-weight-bold">Upload Bukti Ijin</label>
                                <input type="file" name="bukti_foto" class="form-control-file mb-2" id="bukti_ijin" accept=".png,.jpg,.jpeg" onchange="previewIjin()">

                                <div class="mt-2">
                                    <img src="" id="previewIjinImg" class="shadow-lg rounded" style="max-height: 200px; object-fit: cover;" >
                                </div>

                            <div class="form-group mt-4">
                                <label for="exampleFormControlTextarea1" class="font-weight-bold">Kegiatan Hari Ini</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="keterangan" style="height: 30%;" placeholder="Jelaskan kegiatan hari ini..." ></textarea>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success px-5 py-2">
                                    <i class="fas fa-paper-plane mr-2"></i> Kirim Absen
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Bootstrap 4 Sakit -->
        <div class="modal fade" id="sakitModal">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-white">
                        <h6 class="modal-title" id="terimaModalLabel">Silahkan Lengkapi Data Ijin Anda Hari Ini!!</h6>
                        <button id="closeSakit" class="close-btn">&times;</button>
                    </div>
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        <form action="<?= base_url('/absen/sakit/' . $user['id_user']) ?>" method="post" enctype="multipart/form-data" class="p-4 shadow rounded bg-white">
                            <?= csrf_field() ?>
                            <h4 class="mb-4 text-info font-weight-bold text-center">Formulir Absen</h4>

                                <label for="bukti_ijin" class="font-weight-bold">Upload Bukti Sakit</label>
                                <input type="file" name="bukti_foto" class="form-control-file mb-2" id="bukti_sakit" accept=".png,.jpg,.jpeg" onchange="previewSakit()">

                                <div class="mt-2">
                                    <img src="" id="previewSakitImg" class="shadow-lg rounded" style="max-height: 200px; object-fit: cover;" >
                                </div>

                            <div class="form-group mt-4">
                                <label for="exampleFormControlTextarea1" class="font-weight-bold">Kegiatan Hari Ini</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="keterangan" style="height: 30%;" placeholder="Jelaskan kegiatan hari ini..." ></textarea>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success px-5 py-2">
                                    <i class="fas fa-paper-plane mr-2"></i> Kirim Absen
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<script>
    // Masuk=================================
    const absen = document.getElementById('absen');
    const absenModal = document.getElementById('absenModal');
    const closeAbsen = document.getElementById('closeAbsen')
    
    absen.addEventListener('click', () => {
        $('#absenModal').modal('show');
    })

    closeAbsen.addEventListener('click', () => {
         $('#absenModal').modal('hide');
    })

    // Ijin ======================================
    const ijin = document.getElementById('ijin');
    const ijinModal = document.getElementById('ijinModal');
    const closeIjin = document.getElementById('closeIjin')
    
    ijin.addEventListener('click', () => {
        $('#ijinModal').modal('show');
    })

    closeIjin.addEventListener('click', () => {
         $('#ijinModal').modal('hide');
    })

    // Sakit ==================================
    const sakit = document.getElementById('sakit');
    const sakitModal = document.getElementById('sakitModal');
    const closeSakit = document.getElementById('closeSakit')
    
    sakit.addEventListener('click', () => {
        $('#sakitModal').modal('show');
    })

    closeSakit.addEventListener('click', () => {
         $('#sakitModal').modal('hide');
    })

    // img preview
    function previewImg(){
        const bukti_foto = document.getElementById('bukti_foto');
        const preview = document.getElementById('preview');

        const fileBukti = new FileReader();
        fileBukti.readAsDataURL(bukti_foto.files[0])

        fileBukti.onload = (e) => {
            preview.src = e.target.result;
        }
    }

    function previewIjin(){
        const bukti_ijin = document.getElementById('bukti_ijin');
        const previewIjinImg = document.getElementById('previewIjinImg'); // <- diganti

        const fileBuktiIjin = new FileReader();
        fileBuktiIjin.readAsDataURL(bukti_ijin.files[0]);

        fileBuktiIjin.onload = (e) => {
            previewIjinImg.src = e.target.result;
        }
    }


    function previewSakit(){
    const bukti_sakit = document.getElementById('bukti_sakit');
    const previewSakitImg = document.getElementById('previewSakitImg'); // <- diganti

    const fileBuktiSakit = new FileReader();
    fileBuktiSakit.readAsDataURL(bukti_sakit.files[0]);

    fileBuktiSakit.onload = (e) => {
        previewSakitImg.src = e.target.result;
    }}
</script>

<?php elseif ($sudahAbsen['status'] == 'Masuk'):?>
    <div class="app-content pt-3 p-md-3 p-lg-4 " style="height: 100vh; background-color: #00FF9C;">
    <div class="container-xl ">
        
    <h2 class="text-center mb-2">Hai <?= $user['username'] ?>, Absenmu Masih <?= $sudahAbsen['persetujuan'] ?></h2>

    <img src="assets/img/absen-1.png" class="d-block mx-auto" style="width: 35%;" alt="">

    <table class="table table-bordered">
        <thead>
            <tr class="table-success">
                <th class="text-center" style="width: 30%;">Bukti Foto</th>
                <th class="text-center" style="width: 30%;">Kegiatan</th>
                <th class="text-center" style="width: 30%;">Tanggal\Waktu</th>
                <th class="text-center" style="width: 30%;">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <img class="d-block mx-auto" src="<?= base_url('assets/img/absensi/' . $sudahAbsen['bukti_foto']) ?>" style="width: 70%;" alt="">
                </td>
                <td> 
                    <?php if ($sudahAbsen['keterangan'] == '--' && $waktuSekarang > $mengisiKegiatan) : ?>
                        <form action="<?= base_url('/absen/masuk/keterangan/' . $sudahAbsen['id_absen']) ?>" method="post">
                            <input type="text" name="keteranganMasuk" class="form-control" placeholder="Masukkan Kegiatan">
                            <button type="submit" class="btn btn-sm btn-primary mt-1">Simpan</button>
                        </form>
                    <?php else: ?>
                        <?= $sudahAbsen['keterangan'] ?>
                    <?php endif ?>
                </td>
                <td><?= $sudahAbsen['tanggal_waktu'] ?></td>
                <td><?= $sudahAbsen['status'] ?></td>
            </tr>
        </tbody>
    </table>

    </div>
</div>
<?php else: ?>
    <?php
        if($sudahAbsen['status'] == 'Ijin') {
            $color = '#4379F2';
        } elseif($sudahAbsen['status'] == 'Sakit') {
            $color = '#FFE700';
        } else {
            $color = 'gray';
        }
        ?>
<div class="app-content pt-3 p-md-3 p-lg-4 " style="height: 100vh; background-color: <?= $color ?>;">
    <div class="container-xl ">
        
    <h2 class="text-center mb-2">Hai <?= $user['username'] ?>, Absenmu Masih <?= $sudahAbsen['persetujuan'] ?></h2>

    <img src="assets/img/absen-1.png" class="d-block mx-auto" style="width: 35%;" alt="">

    <table class="table table-bordered">
        <thead>
            <tr class="table-success">
                <th class="text-center" style="width: 30%;">Bukti Foto</th>
                <th class="text-center" style="width: 30%;">Keterangan</th>
                <th class="text-center" style="width: 30%;">Tanggal\Waktu</th>
                <th class="text-center" style="width: 30%;">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <img class="d-block mx-auto" src="<?= base_url('assets/img/absensi/' . $sudahAbsen['bukti_foto']) ?>" style="width: 70%;" alt="">
                </td>
                <td><?= $sudahAbsen['keterangan'] ?></td>
                <td><?= $sudahAbsen['tanggal_waktu'] ?></td>
                <td><?= $sudahAbsen['status'] ?></td>
            </tr>
        </tbody>
    </table>

    </div>
</div>
<?php endif ?>









<?php else: ?>
    <div class="app-content pt-3 p-md-3 p-lg-4 bg-secondary w">
    <div class="container-xl">
      <!-- Judul dan Tombol Tambah -->
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Silahkan Beristirahat Untuk menenangkan Pikiran</h1>
            </div>
        </div>
    </div>
    </div>
<?php endif ?>

<?= $this->endSection(); ?>