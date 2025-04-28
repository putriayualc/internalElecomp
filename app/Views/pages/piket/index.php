<?= $this->extend('layout/template'); ?>

<?= $this->section('css') ?>
<style>
    /* Styling untuk body */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        background-color: #f5f5f5;
    }

    /* Styling untuk sidebar */
    .sidebar {
        width: 200px;
        height: 100vh;
        background-color: #e0e0e0;
        padding: 20px;
        position: fixed;
    }

    .sidebar h2 {
        color: #d46ac2;
    }

    .sidebar a {
        display: block;
        color: #000;
        margin: 10px 0;
        text-decoration: none;
    }

    /* Styling untuk konten utama */
    .main-content {
        margin-left: 220px;
        padding: 20px;
    }

    /* Styling untuk container piket */
    .piket {
        background-color: #f5f5f5;
        padding: 40px;
        /* Menambah ruang dalam elemen */
        min-height: 300px;
        /* Menambah tinggi minimum */
        min-width: 300px;
        /* Menambah lebar minimum */
        border-radius: 12px;
        /* Tambahan: buat sudut lebih membulat */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        /* Tambahan: efek bayangan */
    }

    .piket-container {
        display: flex;
        gap: 20px;
        overflow-x: auto;
        flex-wrap: wrap;
        /* Agar elemen bisa terbungkus saat lebar tidak cukup */
        margin-top: 20px;
        /* Memberikan jarak dari bagian atas */
    }

    .piket-box {
        background-color: #ddd;
        padding: 30px;
        /* Meningkatkan padding untuk memperbesar isi box */
        border-radius: 12px;
        /* Menambah border-radius agar lebih elegan */
        min-width: 300px;
        /* Memperbesar lebar minimum */
        min-height: 250px;
        /* Menambah tinggi minimum agar box terlihat lebih besar */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        /* Menambahkan shadow untuk kesan 3D */
        margin: 10px;
        /* Memberikan margin agar box tidak terlalu rapat */
    }

    .piket-box h3 {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 0;
        font-size: 1.3em;
        /* Meningkatkan ukuran font pada judul */
        color: #333;
    }

    .piket-box span {
        font-size: 1.2em;
        /* Menambah ukuran ikon */
        cursor: pointer;
        color: #000;
    }

    /* Styling untuk daftar nama dalam piket */
    .piket-box ul {
        padding-left: 20px;
        margin-top: 10px;
    }

    .piket-box ul li {
        margin: 8px 0;
        /* Memberikan jarak lebih pada item list */
        color: #555;
    }

    /* Styling untuk masing-masing hari */
    .piket-box.senin {
        background-color: #f8d7da;
        /* pink */
    }

    .piket-box.selasa {
        background-color: #d1ecf1;
        /* blue */
    }

    .piket-box.rabu {
        background-color: #d4edda;
        /* green */
    }

    .piket-box.kamis {
        background-color: #fff3cd;
        /* yellow */
    }

    .piket-box.jumat {
        background-color: #cce5ff;
        /* light blue */
    }

    .piket-box.sabtu {
        background-color: #e2e3e5;
        /* light gray */
    }

    .piket-container-edit {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 70vh;
    }

    .piket-box-edit {
        position: relative;
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        min-width: 320px;
    }

    .piket-box-edit h3 {
        margin-bottom: 16px;
    }

    .add-icon-edit {
        position: absolute;
        top: 16px;
        right: 16px;
        font-size: 20px;
        background-color: rgb(43, 95, 239);
        color: white;
        border-radius: 50%;
        padding: 6px 10px;
        cursor: pointer;
        text-decoration: none;
    }

    .piket-box-edit ul {
        padding: 0;
        list-style: none;
        text-align: left;
    }

    .piket-box-edit li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 6px 0;
        border-bottom: 1px solid #ddd;
    }

    .remove-icon-edit {
        color: red;
        text-decoration: none;
        font-weight: bold;
        cursor: pointer;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fff;
        margin: 10% auto;
        padding: 20px;
        border-radius: 8px;
        width: 80%;
        max-width: 400px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .close {
        color: #aaa;
        position: absolute;
        top: 10px;
        right: 16px;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
    }

    select,
    button {
        width: 100%;
        padding: 8px;
        margin-top: 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    button {
        background-color: #007BFF;
        color: white;
        border: none;
    }

    .form-edit-piket {
        background: #fff;
        padding: 20px;
        max-width: 500px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .form-edit-piket label {
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
    }

    .form-edit-piket textarea {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    .form-edit-piket button {
        margin-top: 15px;
        background-color: #4caf50;
        color: white;
        padding: 10px 18px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
    }

    .form-edit-piket button:hover {
        background-color: #45a049;
    }

    .rotate-icon {
        transition: transform 0.3s ease;
    }

    .rotate-icon.rotate {
        transform: rotate(180deg);
    }

    /* Responsive styling untuk perangkat mobile */
    @media screen and (max-width: 768px) {
        .piket-container {
            flex-direction: column;
            /* Stack vertical pada layar kecil */
            gap: 15px;
        }

        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }

        .main-content {
            margin-left: 0;
        }
    }
</style>
<?= $this->endSection('css'); ?>

<?= $this->section('content'); ?>

<div class="piket">
    <h1>Data Piket</h1>
    <div class="piket-container">
        <?php foreach ($piketData as $hari => $namaList): ?>
            <?php
            $lowerHari = strtolower($hari);
            $class = 'piket-box ' . $lowerHari;
            ?>
            <div class="<?= $class ?>">
                <h3>
                    <?= $hari ?>
                    <a href="<?= base_url('piket/edit/' . strtolower($hari)) ?>" title="Edit">
                        <span>✎</span>
                    </a>
                </h3>
                <ul>
                    <?php foreach ($namaList as $nama): ?>
                        <li><?= $nama ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection('content'); ?>