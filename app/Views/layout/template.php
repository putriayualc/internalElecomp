<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="robots" content="noindex">
    <title>Internal Elecomp</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <!-- Favicons -->
    <link href="<?= base_url('assets/img/logo_elecomp.png') ?>" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- FontAwesome JS-->
    <script defer src="<?= base_url('assets/plugins/fontawesome/js/all.min.js') ?>"></script>

    <!-- Select -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="<?= base_url('assets/css/portal.css') ?>">
    <!-- <link id="theme-style" rel="stylesheet" href="<?= base_url('assets/css/piket.css') ?>"> -->

    <!-- Link CDN FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- test -->
    <!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
    <script src="<?= base_url('assets/js/tinymce.min.js') ?>"></script>
    <script>
        tinymce.init({
            selector: 'textarea.tiny',
            plugins: 'powerpaste advcode code table lists checklist link image media',
            toolbar: 'undo redo | blocks | bold italic | bullist numlist checklist | code | table | link image media',
        });
    </script>
    <!-- end test -->

    <?= $this->renderSection('css'); ?>
</head>

<body class="app">
    <?= $this->include('layout/header'); ?>

    <div class="app-wrapper">

        <?= $this->renderSection('content'); ?>

    </div>

    <script src="<?= base_url('assets/plugins/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>


    <!-- Page Specific JS -->
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
    <script src="<?= base_url('assets') ?>/js/lazysizes.min.js"></script>
    <!--  -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Menambahkan class active pada navbar -->
    <script>
        // Ambil URL saat ini
        var currentUrl = window.location.href;

        // Dapatkan semua elemen tautan di dalam navbar
        var navLinks = document.querySelectorAll("#app-nav-main .nav-link");

        // Loop melalui setiap tautan untuk memeriksa URL saat ini
        navLinks.forEach(function(link) {
            // Dapatkan href dari tautan
            var linkHref = link.getAttribute("href");

            // Cek apakah URL saat ini mengandung substring terkait dan tambahkan kelas "active" ke tautan yang sesuai
            if (
                (currentUrl.indexOf("dashboard") !== -1 && linkHref.indexOf("dashboard") !== -1) ||
                (currentUrl.indexOf("produk") !== -1 && linkHref.indexOf("produk") !== -1) ||
                (currentUrl.indexOf("slider") !== -1 && linkHref.indexOf("slider") !== -1) ||
                (currentUrl.indexOf("aktivitas") !== -1 && linkHref.indexOf("aktivitas") !== -1) ||
                (currentUrl.indexOf("profil") !== -1 && linkHref.indexOf("profil") !== -1)
            ) {
                link.classList.add("active");
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdown = document.getElementById('adminDropdown');
            const arrow = document.getElementById('dropdownArrow');

            dropdown.addEventListener('show.bs.collapse', function() {
                arrow.classList.add('rotate');
            });

            dropdown.addEventListener('hide.bs.collapse', function() {
                arrow.classList.remove('rotate');
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        function toggleForm(e) {
            e.preventDefault();
            const form = document.getElementById('addForm');
            form.style.display = form.style.display === 'block' ? 'none' : 'block';
            $('.nama-dropdown').select2(); // aktifkan select2
        }
    </script>


</body>

</html>