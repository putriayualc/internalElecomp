<?= $this->extend('layout/template'); ?>

<?= $this->section('css') ?>
<style>
    :root {
        --primary-color: #0073b7;
        --secondary-color: #f0f4f8;
        --text-color: #333;
        --light-text: #6b7280;
        --accent-color: #4f46e5;
        --border-radius: 12px;
        --box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --transition: all 0.3s ease;
    }

    /* Styling untuk body */
    body {
        margin: 0;
        background-color: #f8fafc;
        color: var(--text-color);
        line-height: 1.6;
    }

    /* Styling untuk sidebar */
    .sidebar {
        width: 240px;
        height: 100vh;
        background: linear-gradient(to bottom, var(--primary-color), #818cf8);
        padding: 20px;
        position: fixed;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        transition: var(--transition);
        z-index: 100;
    }

    .sidebar h2 {
        color: white;
        font-weight: 600;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .sidebar a {
        display: block;
        color: rgba(255, 255, 255, 0.85);
        margin: 16px 0;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 8px;
        transition: var(--transition);
        font-weight: 500;
    }

    .sidebar a:hover {
        background-color: rgba(255, 255, 255, 0.15);
        color: white;
        transform: translateX(5px);
    }

    /* Styling untuk konten utama */
    .main-content {
        margin-left: 240px;
        padding: 30px;
        transition: var(--transition);
    }

    /* Styling untuk container piket */
    .piket {
        background-color: white;
        padding: 25px;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        margin-bottom: 30px;
    }

    .piket h1 {
        color: rgb(51, 48, 48);
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 30px;
        position: relative;
        padding-bottom: 15px;
    }

    .piket h1::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 80px;
        height: 4px;
        border-radius: 2px;
    }

    .piket-container {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        /* grid-template-columns: repeat(auto-fill, minmax(300px, 1fr 1fr 1fr)); */
        gap: 20px;
        margin-top: 30px;
        padding: 15px;
    }

    .piket-box {
        background-color: white;
        padding: 50px;
        border-radius: var(--border-radius);
        min-height: 220px;
        display: flex;
        flex-direction: column;
        box-shadow: var(--box-shadow);
        transition: var(--transition);
        border-top: 5px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .piket-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .piket-box h3 {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--primary-color);
    }

    .piket-box span {
        font-size: 1.2rem;
        cursor: pointer;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        /* background-color: rgba(99, 102, 241, 0.1); */
        border-radius: 50%;
        transition: var(--transition);
    }

    /* .piket-box span:hover {
        background-color: var(--primary-color);
        color: white;
    } */

    .piket-box::before {
        content: "";
        position: absolute;
        top: -50px;
        right: -50px;
        width: 100px;
        height: 100px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        z-index: 0;
    }

    /* Styling untuk daftar nama dalam piket */
    .piket-box ul {
        padding-left: 15px;
        margin-top: 15px;
        z-index: 1;
        position: relative;
    }

    .piket-box ul li {
        margin: 12px 0;
        color: var(--light-text);
        font-weight: 400;
        display: flex;
        align-items: center;
    }

    .piket-box ul li::before {
        content: "•";
        color: var(--light-text);
        font-weight: bold;
        display: inline-block;
        width: 1em;
        margin-left: -1em;
        font-size: 1.2em;
    }

    /* Styling untuk masing-masing hari */
    .piket-box.senin {
        border-top-color: #f87171;
        background: linear-gradient(to bottom right, #fff, #fef2f2);
    }

    .piket-box.senin h3 {
        color: #ef4444;
    }

    .piket-box.selasa {
        border-top-color: #38bdf8;
        background: linear-gradient(to bottom right, #fff, #f0f9ff);
    }

    .piket-box.selasa h3 {
        color: #0ea5e9;
    }

    .piket-box.rabu {
        border-top-color: #4ade80;
        background: linear-gradient(to bottom right, #fff, #f0fdf4);
    }

    .piket-box.rabu h3 {
        color: #22c55e;
    }

    .piket-box.kamis {
        border-top-color: #facc15;
        background: linear-gradient(to bottom right, #fff, #fefce8);
    }

    .piket-box.kamis h3 {
        color: #eab308;
    }

    .piket-box.jumat {
        border-top-color: #60a5fa;
        background: linear-gradient(to bottom right, #fff, #eff6ff);
    }

    .piket-box.jumat h3 {
        color: #3b82f6;
    }

    .piket-box.sabtu {
        border-top-color: #c084fc;
        background: linear-gradient(to bottom right, #fff, #f5f3ff);
    }

    .piket-box.sabtu h3 {
        color: #8b5cf6;
    }

    .piket-container-edit {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 70vh;
    }

    .piket-box-edit {
        position: relative;
        background-color: white;
        padding: 30px;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        min-width: 320px;
    }

    .piket-box-edit h3 {
        margin-bottom: 20px;
        color: var(--primary-color);
        font-size: 1.5rem;
    }

    .add-icon-edit {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 1rem;
        background-color: var(--primary-color);
        color: white;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        text-decoration: none;
        box-shadow: 0 4px 6px rgba(99, 102, 241, 0.25);
        transition: var(--transition);
    }

    .add-icon-edit:hover {
        transform: scale(1.05);
        background-color: var(--accent-color);
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
        padding: 12px 0;
        border-bottom: 1px solid #e5e7eb;
        transition: var(--transition);
    }

    .piket-box-edit li:hover {
        background-color: #f9fafb;
        padding-left: 5px;
    }

    .remove-icon-edit {
        color: #ef4444;
        text-decoration: none;
        font-weight: bold;
        cursor: pointer;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: var(--transition);
    }

    .remove-icon-edit:hover {
        background-color: #fee2e2;
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
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
        transition: var(--transition);
    }

    .modal-content {
        background-color: #fff;
        margin: 10% auto;
        padding: 30px;
        border-radius: var(--border-radius);
        width: 80%;
        max-width: 400px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        position: relative;
        transform: scale(0.95);
        transition: transform 0.3s ease;
    }

    .modal.show .modal-content {
        transform: scale(1);
    }

    .close {
        color: var(--light-text);
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        transition: var(--transition);
    }

    .close:hover,
    .close:focus {
        color: var(--text-color);
    }

    select,
    button {
        width: 100%;
        padding: 12px;
        margin-top: 15px;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        font-family: inherit;
        font-size: 1rem;
        transition: var(--transition);
    }

    select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
    }

    button {
        background-color: var(--primary-color);
        color: white;
        border: none;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(99, 102, 241, 0.25);
    }

    button:hover {
        background-color: var(--accent-color);
        transform: translateY(-2px);
    }

    .form-edit-piket {
        background: white;
        padding: 30px;
        max-width: 500px;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        margin-top: 30px;
    }

    .form-edit-piket label {
        font-weight: 600;
        display: block;
        margin-bottom: 10px;
        color: var(--text-color);
    }

    .form-edit-piket textarea {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        font-size: 1rem;
        font-family: inherit;
        transition: var(--transition);
        resize: vertical;
        min-height: 120px;
    }

    .form-edit-piket textarea:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
    }

    .form-edit-piket button {
        margin-top: 20px;
        background-color: var(--primary-color);
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 600;
        transition: var(--transition);
    }

    .form-edit-piket button:hover {
        background-color: var(--accent-color);
        transform: translateY(-2px);
    }

    .rotate-icon {
        transition: transform 0.3s ease;
    }

    .rotate-icon.rotate {
        transform: rotate(180deg);
    }

    /* Responsive styling untuk perangkat mobile */
    @media screen and (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
            padding: 15px;
        }

        .sidebar h2 {
            margin-bottom: 15px;
            padding-bottom: 10px;
        }

        .sidebar a {
            display: inline-block;
            margin: 5px;
        }

        .main-content {
            margin-left: 0;
            padding: 20px;
        }

        .piket {
            padding: 20px;
        }

        .piket h1 {
            font-size: 1.8rem;
        }

        .piket-container {
            grid-template-columns: 1fr;
        }

        .piket-box {
            min-height: 180px;
        }
    }
</style>

<!-- Adding Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Adding Font Awesome for better icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<?= $this->endSection('css'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid py-3">
    <div class="rounded-3 shadow-sm mb-4"
        style="background: linear-gradient(rgba(0,184,241,0.9), rgba(0,107,148,0.9)), url('https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="d-flex justify-content-between align-items-center p-4 text-white">
            <div>
                <h1 class="h1 fw-bold">Jadwal Piket</h1>
                <p class="text-white-70 small mb-0">Kelola data piket siswa yang sedang melakukan magang</p>
            </div>

            <div class="d-flex gap-2">
                <a href="<?= route_to('tugasPiket') ?>" class="btn btn-light text-info px-4 py-2 fs-6 d-flex align-items-center gap-2">
                    <i class="fas fa-plus-circle me-2"></i>
                    <span class="d-none d-sm-inline">Manage Tugas Piket</span>
                </a>
            </div>

        </div>
    </div>
</div>

<div class="piket">
    <div class="piket-container">
        <?php foreach ($piketData as $hari => $namaList): ?>
            <?php
            $lowerHari = strtolower($hari);
            $class = 'piket-box ' . $lowerHari;

            $icons = [
                'senin'  => 'calendar-day me-3 ps-3',
                'selasa' => 'calendar-day me-3 ps-3',
                'rabu'   => 'calendar-day me-3 ps-3',
                'kamis'  => 'calendar-day me-3 ps-3',
                'jumat'  => 'calendar-day me-3 ps-3',
                'sabtu'  => 'calendar-day me-3 ps-3'
            ];

            $colors = [
                'senin'  => '#ef4444',
                'selasa' => '#0ea5e9',
                'rabu'   => '#22c55e',
                'kamis'  => '#eab308',
                'jumat'  => '#3b82f6',
                'sabtu'  => '#8b5cf6'
            ];

            $icon = isset($icons[$lowerHari]) ? $icons[$lowerHari] : 'calendar-day me-3 ps-3';
            $color = isset($colors[$lowerHari]) ? $colors[$lowerHari] : '#0d6efd';
            ?>

            <div class="<?= $class ?>">
                <h3>
                    <span><i class="fas fa-<?= $icon ?>"></i> <?= $hari ?></span>
                    <?php if (session()->get('role')  === 'admin') : ?>
                        <a href="<?= base_url('piket/edit/' . strtolower($hari)) ?>" title="Edit Jadwal">
                            <span>
                                <i class="fas fa-edit pe-0"
                                    style="color: <?= $color ?>;"
                                    onmouseover="this.style.color='<?= $color ?>';"
                                    onmouseout="this.style.color='<?= $color ?>';">
                                </i>
                            </span>
                        </a>
                    <?php endif; ?>
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

<!-- JavaScript untuk animasi dan interaksi -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // animasi dan hover list item
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animasi untuk piket box saat halaman dimuat
        const boxes = document.querySelectorAll('.piket-box');
        boxes.forEach((box, index) => {
            setTimeout(() => {
                box.style.opacity = '1';
                box.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Menambahkan efek hover untuk list items
        const listItems = document.querySelectorAll('.piket-box ul li');
        listItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.fontWeight = '500';
            });

            item.addEventListener('mouseleave', function() {
                this.style.fontWeight = '400';
            });
        });
    });
</script>

<!-- Tambahkan ini untuk popup pengingat -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- bagian lain dari halaman HTML -->

<?php if (isset($harusPiket) && $harusPiket): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tugasArray = <?= json_encode($tugasHariIni, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;

            Swal.fire({
                title: 'Pengingat Piket!',
                icon: 'info',
                html: tugasArray.length > 0 ?
                    `Hari ini giliran kamu piket!<br><br><strong>Tugas:</strong><br>` + tugasArray.map(t => _.escape(t)).join('<br>') : 'Hari ini kamu tidak ada tugas piket.',
                confirmButtonText: 'Siap!'
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>

<?php endif; ?>

<!-- bagian lain halaman -->


<?= $this->endSection(); ?>