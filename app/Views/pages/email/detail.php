<?= $this->extend('layout/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <!-- Judul dan Tombol Kembali -->
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Detail Prospek: Prospek ECP</h1>
            </div>
            <div class="col-auto">
                <a href="<?= route_to('prospek') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        <!-- Tabel Kontak -->
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-header p-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="app-card-title">Daftar Kontak Email</h4>
                    </div>
                </div>
            </div>
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell" width="5%">No</th>
                                <th class="cell" width="20%">Nama</th>
                                <th class="cell" width="15%">Email</th>
                                <th class="cell" width="30%">Pesan yang dikirim</th>
                                <th class="cell" width="10%">Status</th>
                                <th class="cell" width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data Statis -->
                            <tr>
                                <td class="cell">1</td>
                                <td class="cell">Ahmad Fauzi</td>
                                <td class="cell">ahmad.fauzi@email.com</td>
                                <td class="cell">Halo Bapak Ahmad, kami menawarkan produk ECP terbaru dengan diskon 20%...</td>
                                <td class="cell"><span class="badge bg-success">Terkirim</span></td>
                                <td class="cell">
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-eye me-1"></i> Lihat
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell">2</td>
                                <td class="cell">Siti Nurhayati</td>
                                <td class="cell">siti.nur@email.com</td>
                                <td class="cell">Selamat siang Ibu Siti, perkenalkan kami dari ECP ingin menawarkan...</td>
                                <td class="cell"><span class="badge bg-success">Terkirim</span></td>
                                <td class="cell">
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-eye me-1"></i> Lihat
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell">3</td>
                                <td class="cell">Budi Santoso</td>
                                <td class="cell">budi.santoso@gmail.com</td>
                                <td class="cell">Halo Pak Budi, kami menawarkan produk ECP dengan fitur terbaru...</td>
                                <td class="cell"><span class="badge bg-danger">Gagal</span></td>
                                <td class="cell">
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-eye me-1"></i> Lihat
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell">4</td>
                                <td class="cell">Dewi Anggraini</td>
                                <td class="cell">dewi.a@company.co.id</td>
                                <td class="cell">Selamat pagi Bu Dewi, kami ingin menginformasikan tentang produk ECP...</td>
                                <td class="cell"><span class="badge bg-success">Terkirim</span></td>
                                <td class="cell">
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-eye me-1"></i> Lihat
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell">5</td>
                                <td class="cell">Rudi Hermawan</td>
                                <td class="cell">rudi.h@email.net</td>
                                <td class="cell">Halo Pak Rudi, apakah Anda tertarik dengan produk ECP kami yang baru?</td>
                                <td class="cell"><span class="badge bg-warning text-dark">Pending</span></td>
                                <td class="cell">
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-eye me-1"></i> Lihat
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell">6</td>
                                <td class="cell">Maya Wulandari</td>
                                <td class="cell">maya.w@email.com</td>
                                <td class="cell">Halo Ibu Maya, kami ingin menawarkan paket spesial untuk produk ECP...</td>
                                <td class="cell"><span class="badge bg-success">Terkirim</span></td>
                                <td class="cell">
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-eye me-1"></i> Lihat
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell">7</td>
                                <td class="cell">Andi Suryanto</td>
                                <td class="cell">andi.s@corporate.com</td>
                                <td class="cell">Halo Pak Andi, kami dari ECP menawarkan produk dengan diskon 25%...</td>
                                <td class="cell"><span class="badge bg-success">Terkirim</span></td>
                                <td class="cell">
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-eye me-1"></i> Lihat
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell">8</td>
                                <td class="cell">Nina Agustina</td>
                                <td class="cell">nina.a@business.id</td>
                                <td class="cell">Selamat sore Bu Nina, kami ingin menginformasikan promo terbaru produk ECP...</td>
                                <td class="cell"><span class="badge bg-warning text-dark">Pending</span></td>
                                <td class="cell">
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-eye me-1"></i> Lihat
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell">9</td>
                                <td class="cell">Hendra Wijaya</td>
                                <td class="cell">hendra.w@mail.co.id</td>
                                <td class="cell">Halo Pak Hendra, kami ingin memberitahu tentang fitur baru pada produk ECP...</td>
                                <td class="cell"><span class="badge bg-danger">Gagal</span></td>
                                <td class="cell">
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-eye me-1"></i> Lihat
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell">10</td>
                                <td class="cell">Ratna Sari</td>
                                <td class="cell">ratna.s@email.com</td>
                                <td class="cell">Selamat pagi Bu Ratna, kami mengundang Anda untuk mencoba produk ECP terbaru...</td>
                                <td class="cell"><span class="badge bg-success">Terkirim</span></td>
                                <td class="cell">
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-eye me-1"></i> Lihat
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content') ?>