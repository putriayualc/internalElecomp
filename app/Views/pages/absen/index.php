<?php

use CodeIgniter\I18n\Time; ?>
<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
  <div class="container-xl">
    <!-- Judul dan Tombol Tambah -->
    <div class="row g-3 mb-4 align-items-center justify-content-between">
      <div class="col-auto">
        <h1 class="app-page-title mb-0">Absen</h1>
      </div>
      <div class="col-auto d-flex gap-2">
        <div class="d-flex gap-2">
          <button class="btn btn-primary" type="button" id="btnTerima">Riwayat Diterima</button>
        </div>
        <div class="d-flex gap-2">
          <button class="btn btn-danger" type="button" id="btnTolak">Riwayat Ditolak</button>
        </div>
        <!-- <div class="d-flex gap-2">
            <button  class="btn btn-secondary" type="button" id="btnTB">Telat/Bolos</button>
          </div> -->
      </div>
    </div>

    <!-- daftar yang absen hari ini -->
    <div class="app-card app-card-orders-table shadow-sm mb-5">
      <div class="app-card-header p-3">
        <div class="row justify-content-between align-items-center">
          <div class="col-auto d-flex gap-5">
            <h4 class="app-card-title">Daftar Absen</h4>

            <form action="/absen/admin" method="post">
              <?= csrf_field() ?>
              <input type="hidden" name="date" value="masuk">
              <button type="submit" class="btn btn-success">Masuk</button>
            </form>

            <form action="/absen/admin" method="post">
              <?= csrf_field() ?>
              <input type="hidden" name="date" value="Ijin">
              <button type="submit" class="btn btn-warning">Ijin</button>
            </form>

            <form action="/absen/admin" method="post">
              <?= csrf_field() ?>
              <input type="hidden" name="date" value="Sakit">
              <button type="submit" class="btn btn-danger">Sakit</button>
            </form>

            <form action="/absen/admin" method="post">
              <?= csrf_field() ?>
              <input type="hidden" name="date" value="Bolos">
              <button type="submit" class="btn btn-dark">Bolos</button>
            </form>

          </div>
        </div>
      </div>

      <!-- Tampilan Data ========================================================================= -->
      <div class="app-card-body">
        <div class="table-responsive">
          <table class="table app-table-hover mb-0 text-left table-striped">

            <?php $no = 1 ?>
            <?php if ($statusTerpilih == 'Masuk'): ?>
              <!-- ======================= Data Absen Masuk ============================= -->

              <thead>
                <tr>
                  <th class="cell" width="5%">No</th>
                  <th class="cell" width="15%">Nama</th>
                  <th class="cell" width="15%">Bukti Foto</th>
                  <th class="cell" width="8%">Status</th>
                  <th class="cell" width="25%">Kegiatan</th>
                  <th class="cell" width="15%">Tanggal-Waktu</th>
                  <th class="cell" width="20%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $adaData = false;

                foreach ($absen as $item):
                  $waktuAbsenItem = \CodeIgniter\I18n\Time::parse($item['tanggal_waktu']);
                  $tanggalAbsenItem = $waktuAbsenItem->toDateString();
                  $jamItem = (int) $waktuAbsenItem->format('H');
                  $menitItem = (int) $waktuAbsenItem->format('i');

                  if (
                    $item['persetujuan'] == 'Pending' &&
                    $tanggalAbsenItem == $tanggalHariIni &&
                    $jamItem == 8 &&
                    $menitItem >= 0 && $menitItem <= 15
                  ):
                    $adaData = true;
                ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $item['username'] ?></td>
                      <td>
                        <img src="<?= base_url('assets/img/absensi/' . $item['bukti_foto']) ?>" style="width: 100%;" alt="Bukti Foto">
                      </td>
                      <td><?= $item['persetujuan'] ?></td>
                      <td><?= $item['keterangan'] ?></td>
                      <td><?= $item['tanggal_waktu'] ?></td>
                      <td>
                        <form action="<?= base_url('absen/admin/terima/' . $item['id_absen']) ?>" method="post" class="d-inline">
                          <?= csrf_field() ?>
                          <button class="btn btn-primary">Terima</button>
                        </form>

                        <form action="<?= base_url('absen/admin/tolak/' . $item['id_absen']) ?>" method="post" class="d-inline">
                          <?= csrf_field() ?>
                          <button class="btn btn-danger">Tolak</button>
                        </form>

                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editStatusModal<?= $item['id_absen'] ?>">
                          Edit Status
                        </button>
                      </td>
                    </tr>
 
                  <?php
                  endif;
                endforeach;

                if (!$adaData):
                  ?>
                  <tr>
                    <td colspan="7" class="text-center">Data Masuk Masih Belum Ada</td>
                  </tr>
                <?php endif; ?>
              </tbody>
              




            <?php elseif ($statusTerpilih == 'Sakit'): ?>
              <!-- ======================= Data Absen Sakit ============================= -->

              <thead>
                <tr>
                  <th class="cell" width="5%">No</th>
                  <th class="cell" width="15%">Nama</th>
                  <th class="cell" width="8%">Status</th>
                  <th class="cell" width="25%">Keterangan</th>
                  <th class="cell" width="15%">Surat Dokter / Semacamnya</th>
                  <th class="cell" width="15%">Tanggal-Waktu</th>
                  <th class="cell" width="20%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $adaData = false;
                foreach ($absen as $item):
                  $waktuAbsenItem = \CodeIgniter\I18n\Time::parse($item['tanggal_waktu']);
                  $tanggalAbsenItem = $waktuAbsenItem->toDateString();
                  $jamItem = (int) $waktuAbsenItem->format('H');
                  $menitItem = (int) $waktuAbsenItem->format('i');

                  if (
                    $item['persetujuan'] == 'Pending' &&
                    $tanggalAbsenItem == $tanggalHariIni &&
                    $jamItem == 8 &&
                    $menitItem >= 0 && $menitItem <= 15
                  ):
                    $adaData = true;
                ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $item['username'] ?></td>
                      <td><?= $item['persetujuan'] ?></td>
                      <td><?= $item['keterangan'] ?></td>
                      <td><img src="<?= base_url('assets/img/absensi/' . $item['bukti_foto']) ?>" width="100" alt=""></td>
                      <td><?= $item['tanggal_waktu'] ?></td>
                      <td>
                        <form action="<?= base_url('absen/admin/terima/' . $item['id_absen']) ?>" method="post" class="d-inline">
                          <?= csrf_field() ?>
                          <button class="btn btn-primary">Terima</button>
                        </form>
                        <form action="<?= base_url('absen/admin/tolak/' . $item['id_absen']) ?>" method="post" class="d-inline">
                          <?= csrf_field() ?>
                          <button class="btn btn-danger">Tolak</button>
                        </form>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editStatusModal<?= $item['id_absen'] ?>">
                          Edit Status
                        </button>
                      </td>
                    </tr>
                    <!-- Modal Edit Status -->
                    <div class="modal fade" id="editStatusModal<?= $item['id_absen'] ?>" tabindex="-1" aria-labelledby="editStatusLabel<?= $item['id_absen'] ?>" aria-hidden="true">
                      <div class="modal-dialog">
                        <form action="<?= base_url('absen/admin/editStatus/' . $item['id_absen']) ?>" method="post">
                          <?= csrf_field() ?>
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editStatusLabel<?= $item['id_absen'] ?>">Edit Status Absen</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                              <div class="mb-3">
                                <label for="status" class="form-label">Pilih Status</label>
                                <select name="status" class="form-select" required>
                                  <option value="">-- Pilih Status --</option>
                                  <option value="masuk" <?= $item['status'] == 'masuk' ? 'selected' : '' ?>>Masuk</option>
                                  <option value="bolos" <?= $item['status'] == 'bolos' ? 'selected' : '' ?>>Bolos</option>
                                  <option value="ijin" <?= $item['status'] == 'ijin' ? 'selected' : '' ?>>Ijin</option>
                                  <option value="sakit" <?= $item['status'] == 'sakit' ? 'selected' : '' ?>>Sakit</option>
                                </select>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success">Simpan</button>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>

                  <?php
                  endif;
                endforeach;

                if (!$adaData): ?>
                  <tr>
                    <td colspan="7" class="text-center">Data Sakit Masih Belum Ada</td>
                  </tr>
                <?php endif; ?>

              </tbody>

            <?php elseif ($statusTerpilih == 'Ijin'): ?>
              <!-- ======================= Data Absen Ijin ============================= -->

              <thead>
                <tr>
                  <th class="cell" width="5%">No</th>
                  <th class="cell" width="15%">Nama</th>
                  <th class="cell" width="8%">Status</th>
                  <th class="cell" width="25%">Keterangan</th>
                  <th class="cell" width="15%">Bukti Ijin</th>
                  <th class="cell" width="15%">Tanggal-Waktu</th>
                  <th class="cell" width="20%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $adaData = false;
                foreach ($absen as $item):
                  $waktuAbsenItem = \CodeIgniter\I18n\Time::parse($item['tanggal_waktu']);
                  $tanggalAbsenItem = $waktuAbsenItem->toDateString();
                  $jamItem = (int) $waktuAbsenItem->format('H');
                  $menitItem = (int) $waktuAbsenItem->format('i');

                  if (
                    $item['persetujuan'] == 'Pending' &&
                    $tanggalAbsenItem == $tanggalHariIni &&
                    $jamItem == 8 &&
                    $menitItem >= 0 && $menitItem <= 15
                  ):
                    $adaData = true;
                ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $item['username'] ?></td>
                      <td><?= $item['persetujuan'] ?></td>
                      <td><?= $item['keterangan'] ?></td>
                      <td><img src="<?= base_url('assets/img/absensi/' . $item['bukti_foto']) ?>" width="100" alt=""></td>
                      <td><?= $item['tanggal_waktu'] ?></td>
                      <td>
                        <form action="<?= base_url('absen/admin/terima/' . $item['id_absen']) ?>" method="post" class="d-inline">
                          <?= csrf_field() ?>
                          <button class="btn btn-primary">Terima</button>
                        </form>
                        <form action="<?= base_url('absen/admin/tolak/' . $item['id_absen']) ?>" method="post" class="d-inline">
                          <?= csrf_field() ?>
                          <button class="btn btn-danger">Tolak</button>
                        </form>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editStatusModal<?= $item['id_absen'] ?>">
                          Edit Status
                        </button>
                      </td>
                    </tr>
                  <?php
                  endif;
                endforeach;

                if (!$adaData): ?>
                  <tr>
                    <td colspan="7" class="text-center">Data Ijin Masih Belum Ada</td>
                  </tr>
                <?php endif; ?>

              </tbody>
              <!-- Modal Edit Status -->
              <div class="modal fade" id="editStatusModal<?= $item['id_absen'] ?>" tabindex="-1" aria-labelledby="editStatusLabel<?= $item['id_absen'] ?>" aria-hidden="true">
                <div class="modal-dialog">
                  <form action="<?= base_url('absen/admin/editStatus/' . $item['id_absen']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editStatusLabel<?= $item['id_absen'] ?>">Edit Status Absen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                      </div>
                      <div class="modal-body">
                        <div class="mb-3">
                          <label for="status" class="form-label">Pilih Status</label>
                          <select name="status" class="form-select" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="masuk" <?= $item['status'] == 'masuk' ? 'selected' : '' ?>>Masuk</option>
                            <option value="bolos" <?= $item['status'] == 'bolos' ? 'selected' : '' ?>>Bolos</option>
                            <option value="ijin" <?= $item['status'] == 'ijin' ? 'selected' : '' ?>>Ijin</option>
                            <option value="sakit" <?= $item['status'] == 'sakit' ? 'selected' : '' ?>>Sakit</option>
                          </select>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>


            <?php else:  ?>
              <!-- ======================= Data Absen Bolos ============================= -->

              <thead>
                <tr>
                  <th class="cell" width="5%">No</th>
                  <th class="cell" width="15%">Nama</th>
                  <th class="cell" width="8%">Status</th>
                  <th class="cell" width="25%">Keterangan</th>
                  <th class="cell" width="15%">Foto(opsional)</th>
                  <th class="cell" width="15%">Tanggal-Waktu</th>
                  <!-- <th class="cell" width="20%">Aksi</th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                $adaData = false;
                foreach ($absen as $item):
                  $waktuAbsenItem = \CodeIgniter\I18n\Time::parse($item['tanggal_waktu']);
                  $tanggalAbsenItem = $waktuAbsenItem->toDateString();
                  $jamItem = (int) $waktuAbsenItem->format('H');
                  $menitItem = (int) $waktuAbsenItem->format('i');

                  if (
                    $item['persetujuan'] == 'Pending' &&
                    $tanggalAbsenItem == $tanggalHariIni
                    // $jamItem == 8 &&
                    // $menitItem >= 0 && $menitItem <= 15
                  ):
                    $adaData = true;
                ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $item['username'] ?></td>
                      <td><?= $item['persetujuan'] ?></td>
                      <td><?= $item['keterangan'] ?></td>
                      <td><img src="<?= base_url('assets/img/absensi/' . $item['bukti_foto']) ?>" width="100" alt=""></td>
                      <td><?= $item['tanggal_waktu'] ?></td>
                      <td>
                        <form action="<?= base_url('absen/admin/terima/' . $item['id_absen']) ?>" method="post" class="d-inline">
                          <?= csrf_field() ?>
                          <button class="btn btn-primary">Terima</button>
                        </form>
                        <form action="<?= base_url('absen/admin/tolak/' . $item['id_absen']) ?>" method="post" class="d-inline">
                          <?= csrf_field() ?>
                          <button class="btn btn-danger">Tolak</button>
                        </form>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editStatusModal<?= $item['id_absen'] ?>">
                          Edit Status
                        </button>
                      </td>
                    </tr>
                  <?php
                  endif;
                endforeach;

                if (!$adaData): ?>
                  <tr>
                    <td colspan="7" class="text-center">Data Bolos Masih Belum Ada</td>
                  </tr>
                <?php endif; ?>

              </tbody>

            <?php endif ?>
            <!-- Modal Edit Status -->
            <div class="modal fade" id="editStatusModal<?= $item['id_absen'] ?>" tabindex="-1" aria-labelledby="editStatusLabel<?= $item['id_absen'] ?>" aria-hidden="true">
              <div class="modal-dialog">
                <form action="<?= base_url('absen/admin/editStatus/' . $item['id_absen']) ?>" method="post">
                  <?= csrf_field() ?>
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editStatusLabel<?= $item['id_absen'] ?>">Edit Status Absen</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="status" class="form-label">Pilih Status</label>
                        <select name="status" class="form-select" required>
                          <option value="">-- Pilih Status --</option>
                          <option value="masuk" <?= $item['status'] == 'masuk' ? 'selected' : '' ?>>Masuk</option>
                          <option value="bolos" <?= $item['status'] == 'bolos' ? 'selected' : '' ?>>Bolos</option>
                          <option value="ijin" <?= $item['status'] == 'ijin' ? 'selected' : '' ?>>Ijin</option>
                          <option value="sakit" <?= $item['status'] == 'sakit' ? 'selected' : '' ?>>Sakit</option>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Simpan</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Modal Popup Terima -->
<style>
  /* Background overlay */
  .custom-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    justify-content: center;
    align-items: center;
  }

  /* Modal box */
  .custom-modal-content {
    background: #fff;
    width: 90vw;
    height: 90vh;
    border-radius: 10px;
    overflow: auto;
    display: flex;
    flex-direction: column;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    animation: fadeIn 0.3s ease-in-out;
    position: relative;
  }

  .custom-modal-header,
  .custom-modal-footer {
    padding: 15px 20px;
    background-color: #f8f9fa;
    border-bottom: 1px solid #ddd;
  }

  .custom-modal-header {
    font-size: 18px;
    font-weight: bold;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .custom-modal-body {
    padding: 20px;
    flex-grow: 1;
    overflow-y: auto;
  }

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

  .custom-modal-footer {
    text-align: right;
    border-top: 1px solid #ddd;
  }

  .btn-secondary {
    background-color: #6c757d;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .btn-secondary:hover {
    background-color: #5a6268;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: scale(0.95);
    }

    to {
      opacity: 1;
      transform: scale(1);
    }
  }
</style>

<!-- Pop Up Terima -->
<center>
  <div id="terimaModal" class="custom-modal">
    <div class="custom-modal-content">
      <div class="custom-modal-header" style="background-color: green; color: black;">
        <span id="customModalLabel">Riwayat Terima</span>
        <button id="closeTerima" class="close-btn">&times;</button>
      </div>
      <div class="custom-modal-body" style="overflow-y: scroll;">
        <table class="table table-striped">
          <thead>
            <tr>
              <th class="cell" width="5%">No</th>
              <th class="cell" width="15%">Nama</th>
              <th class="cell" width="15%">Bukti Foto</th>
              <th class="cell" width="8%">Status</th>
              <th class="cell" width="25%">Kegiatan</th>
              <th class="cell" width="15%">Tanggal-Waktu</th>
              <th class="cell" width="20%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1 ?>
            <?php foreach ($absen as $item): ?>
              <?php if ($item['persetujuan'] == 'Terima' && $item['id_user'] != '1'): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $item['username'] ?></td>
                  <td>
                    <img src="<?= base_url('assets/img/absensi/' . $item['bukti_foto']) ?>" width="100" alt="">
                  </td>
                  <td><?= $item['keterangan'] ?></td>
                  <td><?= $item['tanggal_waktu'] ?></td>
                  <td>
                    <form action="<?= base_url('absen/admin/reset/' . $item['id_absen']) ?>" method="post" class="d-inline">
                      <?= csrf_field() ?>
                      <button class="btn btn-warning">Reset</button>
                    </form>
                  </td>
                </tr>
              <?php endif ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</center>

<!-- Pop Up Tolak -->
<center>
  <div id="tolakModal" class="custom-modal">
    <div class="custom-modal-content">
      <div class="custom-modal-header" style="background-color: red; color: black;">
        <span id="customModalLabel">Riwayat Tolak</span>
        <button id="closeTolak" class="close-btn">&times;</button>
      </div>
      <div class="custom-modal-body" style="overflow-y: scroll;">
        <table class="table table-striped">
          <thead>
            <tr>
              <th class="cell" width="5%">No</th>
              <th class="cell" width="15%">Nama</th>
              <th class="cell" width="15%">Bukti Foto</th>
              <th class="cell" width="8%">Status</th>
              <th class="cell" width="25%">Kegiatan</th>
              <th class="cell" width="15%">Tanggal-Waktu</th>
              <th class="cell" width="20%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1 ?>
            <?php foreach ($absen as $item): ?>
              <?php if ($item['persetujuan'] == 'Tolak' && $item['id_user'] != '1'): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $item['username'] ?></td>
                  <td>
                    <img src="/assets/img/<?= $item['bukti_foto'] ?>" width="100" alt="">
                  </td>
                  <td>
                    <?php if ($item['status'] == 'Sakit'): ?>
                      <button type="button" id="btnSakit" style="border: none;" data-keterangan="<?= $item['keterangan'] ?>" data-bukti="<?= $item['foto_suratDokter'] ?>" data-username="<?= $item['username'] ?>"><?= $item['status'] ?></button>
                    <?php else: ?>
                      <?= $item['status'] ?>
                    <?php endif ?>
                  </td>
                  <td><?= $item['keterangan'] ?></td>
                  <td><?= $item['tanggal_waktu'] ?></td>
                  <td>
                    <form action="<?= base_url('absen/admin/reset/' . $item['id_absen']) ?>" method="post" class="d-inline">
                      <?= csrf_field() ?>
                      <button class="btn btn-warning">Reset</button>
                    </form>
                  </td>
                </tr>
              <?php endif ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</center>






<!-- Modal Popup Sakit -->
<style>
  .modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow-y: auto;
    background-color: rgba(0, 0, 0, 0.6);
    padding: 40px 10px;
    /* Jarak dari atas dan bawah */
    box-sizing: border-box;
  }

  .modal-content {
    background-color: #fff;
    padding: 25px 30px;
    border-radius: 12px;
    width: 100%;
    max-width: 700px;
    margin: 0 auto;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    animation: fadeIn 0.3s ease-in-out;
    position: relative;
  }

  .modal-header {
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 15px;
    color: #333;
  }

  .close-btn {
    position: absolute;
    top: 15px;
    right: 20px;
    background: none;
    border: none;
    font-size: 26px;
    cursor: pointer;
    color: #aaa;
  }

  .close-btn:hover {
    color: #000;
  }

  #bukti {
    width: 100%;
    border-radius: 8px;
    margin-top: 15px;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: scale(0.95);
    }

    to {
      opacity: 1;
      transform: scale(1);
    }
  }

  @media (max-width: 768px) {
    .modal-content {
      padding: 20px;
    }
  }
</style>
<div class="modal" id="modalSakit">
  <div class="modal-content">
    <button class="close-btn" id="closeSakit">&times;</button>
    <div class="modal-header" id="user"></div>
    <div class="modal-body">
      <p id="keterangan"></p>
      <img id="bukti" alt="Bukti Sakit">
    </div>
  </div>
</div>








<script>
  //   ================ Pop Up Terima =================
  const btnTerima = document.getElementById('btnTerima');
  const terimaModal = document.getElementById('terimaModal');
  const closeTerima = document.getElementById('closeTerima')
  btnTerima.addEventListener('click', () => {
    terimaModal.style.display = 'block';
  })
  closeTerima.addEventListener('click', () => {
    terimaModal.style.display = 'none';
  })

  //   ================ Pop Up Tolak =================
  const btnTolak = document.getElementById('btnTolak');
  const tolakModal = document.getElementById('tolakModal');
  const closeTolak = document.getElementById('closeTolak')
  btnTolak.addEventListener('click', () => {
    tolakModal.style.display = 'block';
  })
  closeTolak.addEventListener('click', () => {
    tolakModal.style.display = 'none';
  })


  //   ================ Pop Up TelatBolos =================
  const btnTB = document.getElementById('btnTB');
  const TBModal = document.getElementById('TelatBolos');
  const closeTB = document.getElementById('closeTB')


  btnTB.addEventListener('click', () => {
    TBModal.style.display = 'block';
  })

  closeTB.addEventListener('click', () => {
    TBModal.style.display = 'none';
  })




  const btnSakit = document.querySelectorAll('.btnSakit'); // ✅ ini benar
  const modalSakit = document.getElementById('modalSakit');
  const closeSakit = document.getElementById('closeSakit');
  const keterangan = document.getElementById('keterangan');
  const bukti = document.getElementById('bukti');
  const user = document.getElementById('user');

  btnSakit.forEach((element) => {
    element.addEventListener('click', () => {
      modalSakit.style.display = 'block';

      const dataKeterangan = element.dataset.keterangan;
      const dataBukti = element.dataset.bukti;
      const username = element.dataset.username;

      keterangan.textContent = dataKeterangan;
      user.textContent = `Keterangan ${username}`;
      bukti.src = `/assets/img/${dataBukti}`;
    });
  });

  closeSakit.addEventListener('click', () => {
    modalSakit.style.display = 'none';
  });
</script>

<?= $this->endSection('content') ?>