<!DOCTYPE html>
<html lang="en">

<head>
    <title>Internal Elecomp</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">

    <!-- Favicons -->
    <link href="<?= base_url('favicon2.png') ?>" rel="icon">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="<?= base_url('assets/plugins/fontawesome/js/all.min.js') ?>"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- TinyMCE -->
    <script src="<?= base_url('assets/js/tinymce.min.js') ?>"></script>
    <script>
        tinymce.init({
            selector: 'textarea.tiny',
            plugins: 'powerpaste advcode table lists checklist link image media',
            toolbar: 'undo redo | blocks | bold italic | bullist numlist checklist | code | table | link image media'
        });
    </script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <!-- App CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/portal.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <?= $this->renderSection('css'); ?>
</head>

<body class="app">
    <?= $this->include('layout/header'); ?>

    <div class="app-wrapper">
        <?= $this->renderSection('content'); ?>
    </div>

    <!-- Script JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="<?= base_url('assets/plugins/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
    <script src="<?= base_url('assets/js/lazysizes.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <!-- Global DataTables Initialization -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tables = document.querySelectorAll('table.datatable');

            tables.forEach(table => {
                const $table = $(table);

                // Ambil ID tabel untuk konfigurasi khusus
                const tableId = table.getAttribute('id');

                // Konfigurasi dasar umum
                const defaultConfig = {
                    responsive: true,
                    autoWidth: false,
                    stateSave: true,
                    stateDuration: 60 * 60 * 24, // 24 jam
                    pageLength: 10,
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "Semua"]
                    ],
                    language: {
                        decimal: "",
                        emptyTable: "Tidak ada data yang tersedia",
                        info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        infoEmpty: "Menampilkan 0 - 0 dari 0 data",
                        infoFiltered: "(difilter dari _MAX_ total data)",
                        lengthMenu: "Tampilkan _MENU_ data",
                        loadingRecords: "Memuat...",
                        processing: "Memproses...",
                        search: "Cari:",
                        searchPlaceholder: "Ketik untuk mencari...",
                        zeroRecords: "Tidak ada data yang cocok",
                        paginate: {
                            first: "❮❮",
                            last: "❯❯",
                            next: "❯",
                            previous: "❮"
                        }
                    },
                    dom: '<"row g-3 mb-3"<"col-sm-12 col-md-6 d-flex align-items-center"l><"col-sm-12 col-md-6"f>>' +
                        '<"row"<"col-sm-12"tr>>' +
                        '<"row g-3 mt-2 pt-2 border-top"<"col-sm-12 col-md-5 d-flex align-items-center"i><"col-sm-12 col-md-7"p>>',
                    buttons: [{
                            extend: 'copyHtml5',
                            className: 'btn btn-secondary btn-sm',
                            text: '<i class="fas fa-copy"></i> Salin'
                        },
                        {
                            extend: 'csvHtml5',
                            className: 'btn btn-secondary btn-sm',
                            text: '<i class="fas fa-file-csv"></i> CSV'
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'btn btn-success btn-sm',
                            text: '<i class="fas fa-file-excel"></i> Excel'
                        },
                        {
                            extend: 'pdfHtml5',
                            className: 'btn btn-danger btn-sm',
                            text: '<i class="fas fa-file-pdf"></i> PDF'
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-info btn-sm',
                            text: '<i class="fas fa-print"></i> Cetak'
                        }
                    ],
                    drawCallback: function() {
                        $('[data-bs-toggle="tooltip"]').tooltip();
                    },
                    initComplete: function() {
                        $('.dataTables_length select').addClass('form-select form-select-sm me-2');
                        $('.dataTables_filter input').addClass('form-control form-control-sm');
                        $('.dataTables_length').addClass('d-flex align-items-center');
                        $('.dataTables_filter').addClass('d-flex align-items-center justify-content-end');
                        $('.dataTables_filter label').addClass('d-flex align-items-center mb-0');
                    }
                };

                // Inisialisasi DataTable
                $table.DataTable(defaultConfig);
            });
        });
    </script>

    <!-- Navbar Active Handler -->
    <script>
        var currentUrl = window.location.href;
        var navLinks = document.querySelectorAll("#app-nav-main .nav-link");
        navLinks.forEach(function(link) {
            var linkHref = link.getAttribute("href");
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

    <!-- Dropdown Rotation -->
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

    <!-- Toggle Form (if needed) -->
    <script>
        function toggleForm(e) {
            e.preventDefault();
            const form = document.getElementById('addForm');
            form.style.display = form.style.display === 'block' ? 'none' : 'block';
            $('.nama-dropdown').select2();
        }
    </script>
</body>

</html>