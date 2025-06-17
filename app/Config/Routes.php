<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'AuthController::index');
$routes->get('/logout', 'AuthController::logout');
$routes->post('/login/proses', 'AuthController::proses_login');

$routes->get('/dashboard', 'HomeUser::index');

// MENU BACKLINK
$routes->group('backlink', function ($routes) {
    $routes->get('/', 'BacklinkController::index', ['as' => 'backlink']);
    $routes->get('tambah', 'BacklinkController::tambah', ['as' => 'email.tambah']);
    $routes->post('proses_tambah', 'BacklinkController::proses_tambah', ['as' => 'email.simpan']);
    $routes->get('edit/(:num)', 'BacklinkController::edit/$1', ['as' => 'email.edit']);
    $routes->post('proses_edit/(:num)', 'BacklinkController::update/$1', ['as' => 'email.update']);
    $routes->get('delete/(:any)', 'BacklinkController::delete/$1', ['as' => 'email.hapus']);

    // BLOG PER EMAIL
    $routes->group('(:num)/blog', function ($routes) {
        $routes->get('/', 'BlogController::index/$1', ['as' => 'blog']);
        $routes->get('tambah', 'BlogController::tambah/$1', ['as' => 'blog.tambah']);
        $routes->post('proses_tambah', 'BlogController::proses_tambah/$1', ['as' => 'blog.simpan']);
        $routes->get('edit/(:num)', 'BlogController::edit/$1/$2', ['as' => 'blog.edit']);
        $routes->post('proses_edit/(:num)', 'BlogController::proses_edit/$1/$2', ['as' => 'blog.update']);
        $routes->get('delete/(:num)', 'BlogController::delete/$1/$2', ['as' => 'blog.hapus']);
        // $1 = id_email, $2 = id_blog

        // ARTIKEL DALAM BLOG PER EMAIL
        $routes->group('(:num)/artikel', function ($routes) {
            // $1 = id_email, $2 = id_blog, $3 = id_artikel
            $routes->get('/', 'ArtikelController::index/$1/$2', ['as' => 'artikel']);
            $routes->get('tambah', 'ArtikelController::tambah/$1/$2', ['as' => 'artikel.tambah']);
            $routes->post('simpan', 'ArtikelController::proses_tambah/$1/$2', ['as' => 'artikel.simpan']);
            $routes->get('edit/(:num)', 'ArtikelController::edit/$1/$2/$3', ['as' => 'artikel.edit']);
            $routes->post('update/(:num)', 'ArtikelController::update/$1/$2/$3', ['as' => 'artikel.update']);
            $routes->get('delete/(:num)', 'ArtikelController::delete/$1/$2/$3', ['as' => 'artikel.hapus']);
        });
    });
});

// MENU SOP
$routes->group('sop', function ($routes) {
    $routes->get('/', 'SopController::index');
    $routes->get('detail/(:num)', 'SopController::detail/$1', ['as' => 'sop.detail']);

    $routes->group('', ['filter' => 'role:admin'], function ($routes) {
        $routes->get('tambah', 'SopController::tambah', ['as' => 'sop.tambah']);
        $routes->post('simpan', 'SopController::simpan');
        $routes->get('edit/(:num)', 'SopController::edit/$1', ['as' => 'sop.edit']);
        $routes->post('update/(:num)', 'SopController::update/$1');
        $routes->get('delete/(:num)', 'SopController::delete/$1', ['as' => 'sop.delete']);
    });
});


//MENU PIKET
$routes->group('piket', function ($routes) {
    $routes->get('/', 'PiketController::index');

    $routes->group('', ['filter' => 'role:admin'], function ($routes) {
        $routes->get('edit/(:segment)', 'PiketController::edit/$1');
        $routes->post('update', 'PiketController::update');
        $routes->get('delete/(:any)/(:any)', 'PiketController::delete/$1/$2');
    });
});

// MENU HOSTING
$routes->group('hosting', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'HostingController::index');
    $routes->get('tambah', 'HostingController::tambah', ['as' => 'hosting.tambah']);
    $routes->post('simpan', 'HostingController::simpan');
    $routes->get('edit/(:num)', 'HostingController::edit/$1', ['as' => 'hosting.edit']);
    $routes->post('update/(:num)', 'HostingController::update/$1');
    $routes->post('delete/(:num)', 'HostingController::delete/$1', ['as' => 'hosting.delete']);
    $routes->get('detail/(:num)', 'HostingController::detail/$1', ['as' => 'hosting.detail']);
});

// MENU DATA SISWA MAGANG
$routes->group('siswa', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'SiswaController::index', ['as' => 'siswa']);
    $routes->get('tambah', 'SiswaController::tambah', ['as' => 'siswa.tambah']);
    $routes->post('simpan', 'SiswaController::simpan', ['as' => 'siswa.simpan']);
    $routes->get('edit/(:num)', 'SiswaController::edit/$1', ['as' => 'siswa.edit']);
    $routes->post('update/(:num)', 'SiswaController::update/$1', ['as' => 'siswa.update']);
    $routes->post('delete/(:num)', 'SiswaController::delete/$1', ['as' => 'siswa.delete']);
    $routes->get('detail/(:segment)', 'SiswaController::detail/$1', ['as' => 'siswa.detail']);
});

$routes->get('addon/hapus/(:num)/(:num)', 'DomainController::hapus/$1/$2', ['as' => 'domain.hapus']);

// MENU Bisnis
$routes->group('bisnis', function ($routes) {
    $routes->get('/', 'BisnisController::index', ['as' => 'bisnis']);
    $routes->get('tambah', 'BisnisController::tambah', ['as' => 'bisnis.tambah']);
    $routes->post('simpan', 'BisnisController::simpan', ['as' => 'bisnis.simpan']);
    $routes->post('update/(:num)', 'BisnisController::update/$1', ['as' => 'bisnis.update']);
    $routes->get('delete/(:num)', 'BisnisController::delete/$1', ['as' => 'bisnis.delete']); // Pastikan ini ada

});

// MENU ARTIKEL
$routes->group('artikel_internal', function ($routes) {
    $routes->get('/', 'ArtikelInternalController::index', ['as' => 'artikel_internal.index']);
    $routes->get('tambah', 'ArtikelInternalController::tambah', ['as' => 'artikel_internal.tambah']);
    $routes->post('simpan', 'ArtikelInternalController::simpan', ['as' => 'artikel_internal.simpan']);
    $routes->get('edit/(:num)', 'ArtikelInternalController::edit/$1', ['as' => 'artikel_internal.edit']);
    $routes->post('update/(:num)', 'ArtikelInternalController::update/$1', ['as' => 'artikel_internal.update']);
    $routes->post('delete/(:num)', 'ArtikelInternalController::delete/$1', ['as' => 'artikel_internal.delete']);
});

// MENU SOSMED
$routes->group('sosmed', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'SosmedController::index', ['as' => 'sosmed']);
    $routes->get('(:num)', 'SosmedController::index/$1', ['as' => 'sosmed.filter']);
    $routes->get('tambah', 'SosmedController::tambah', ['as' => 'sosmed.tambah']);
    $routes->post('simpan', 'SosmedController::simpan', ['as' => 'sosmed.simpan']);
    $routes->get('edit/(:num)', 'SosmedController::edit/$1', ['as' => 'sosmed.edit']);
    $routes->post('update/(:num)', 'SosmedController::update/$1', ['as' => 'sosmed.update']);
    $routes->get('delete/(:num)', 'SosmedController::delete/$1', ['as' => 'sosmed.delete']);
    $routes->get('detail', 'SosmedController::detail', ['as' => 'sosmed.detail']);
});

// MENU Konten
$routes->group('konten', function ($routes) {
    $routes->get('/', 'KontenController::index', ['as' => 'konten']);
    $routes->get('(:num)', 'KontenController::index/$1', ['as' => 'konten.filter']);
    $routes->get('tambah', 'KontenController::tambah', ['as' => 'konten.tambah']);
    $routes->get('getByBisnis/(:num)', 'KontenController::getByBisnis/$1', ['as' => 'konten.getByBisnis']);
    $routes->post('simpan', 'KontenController::simpan', ['as' => 'konten.simpan']);
    $routes->get('edit/(:num)', 'KontenController::edit/$1', ['as' => 'konten.edit']);
    $routes->post('update/(:num)', 'KontenController::update/$1', ['as' => 'konten.update']);
    $routes->get('delete/(:num)', 'KontenController::delete/$1', ['as' => 'konten.delete']);
    $routes->get('detail/(:num)', 'KontenController::detail/$1', ['as' => 'konten.detail']);
    $routes->get('deleteMedia/(:num)', 'KontenController::deleteMedia/$1', ['as' => 'konten.deleteMedia']);
});

// Absen Admin
$routes->group('absen', function ($routes) {
    $routes->get('/', 'AbsenController::user');
    $routes->post('masuk/(:num)', 'AbsenController::masuk/$1');
    $routes->post('masuk/keterangan/(:num)', 'AbsenController::keterangan/$1');
    $routes->post('ijin/(:num)', 'AbsenController::ijin/$1');
    $routes->post('sakit/(:num)', 'AbsenController::sakit/$1');

    $routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
        $routes->get('/', 'AbsenController::index');
        $routes->post('/', 'AbsenController::index');
        $routes->post('terima/(:num)', 'AbsenController::terima/$1');
        $routes->post('tolak/(:num)', 'AbsenController::tolak/$1');
        $routes->post('reset/(:num)', 'AbsenController::reset/$1');
    });
});

// Dashboard Absen Admin
$routes->group('absenDashboard', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'AbsenDashboardController::index');
    $routes->get('grafikMingguan', 'AbsenDashboardController::grafikMingguan');
});

// Route untuk Company Profile
$routes->group('company_profile', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'CompanyProfile::index', ['as' => 'company_profile']);
    $routes->get('create', 'CompanyProfile::create', ['as' => 'company_profile.create']);
    $routes->post('store', 'CompanyProfile::store', ['as' => 'company_profile.store']);
    $routes->get('edit/(:num)', 'CompanyProfile::edit/$1', ['as' => 'company_profile.edit']);
    $routes->match(['get', 'post'], 'update/(:num)', 'CompanyProfile::update/$1', ['as' => 'company_profile.update']);
    $routes->delete('delete/(:num)', 'CompanyProfile::delete/$1', ['as' => 'company_profile.delete']);
    $routes->get('get/(:num)', 'CompanyProfile::get/$1', ['as' => 'company_profile.get']);
});

// Artikulasi
$routes->group('artikulasi', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'ArtikulasiController::index', ['as' => 'artikulasi']);
    $routes->get('getKalenderData', 'ArtikulasiController::getKalenderData', ['as' => 'artikulasi.getKalenderData']);
    $routes->get('getByDate', 'ArtikulasiController::getArtikelByDate', ['as' => 'artikulasi.getByDate']);
    $routes->post('store', 'ArtikulasiController::store', ['as' => 'artikulasi.store']);
    $routes->post('update/(:num)', 'ArtikulasiController::update/$1', ['as' => 'artikulasi.update']);
    $routes->delete('delete/(:num)', 'ArtikulasiController::delete/$1', ['as' => 'artikulasi.delete']);
    $routes->get('filterByDate', 'ArtikulasiController::filterByDate', ['as' => 'artikulasi.filterByDate']);
    $routes->get('filterByUploadDate', 'ArtikulasiController::filterByUploadDate', ['as' => 'artikulasi.filterByUploadDate']);
});


// Routes untuk Prospek
$routes->group('prospek', function ($routes) {
    $routes->get('/', 'ProspekController::index', ['as' => 'prospek']);
    $routes->get('detail/(:num)', 'ProspekController::detail/$1', ['as' => 'prospek.detail']);
    $routes->get('tambah', 'ProspekController::tambah', ['as' => 'prospek.tambah']);
    $routes->post('store', 'ProspekController::store', ['as' => 'prospek.store']);
    $routes->get('edit/(:num)', 'ProspekController::edit/$1', ['as' => 'prospek.edit']);
    $routes->post('update/(:num)', 'ProspekController::update/$1', ['as' => 'prospek.update']);
    $routes->get('delete/(:num)', 'ProspekController::delete/$1', ['as' => 'prospek.delete']);
    $routes->get('detail/(:num)/export', 'DetailProspekController::export/$1');
    $routes->post('detail/(:num)/import', 'DetailProspekController::import/$1');
    $routes->get('detail/template/download', 'DetailProspekController::downloadTemplate');

    // Group untuk detail prospek
    $routes->group('(:num)/perusahaan', function ($routes) {
        $routes->post('store', 'DetailProspekController::store/$1');
        $routes->post('update/(:num)', 'DetailProspekController::update/$2/$1');
        $routes->post('delete/(:num)', 'DetailProspekController::delete/$2/$1');
        $routes->get('get/(:num)', 'DetailProspekController::getDetail/$2/$1');
    });
});

// Routes untuk Prospek Email
$routes->group('email', function ($routes) {
    $routes->get('/', 'ProspekEmailController::index');
    $routes->get('detail/(:num)', 'ProspekEmailController::detail/$1');
    $routes->get('get-prospek-details/(:num)', 'ProspekEmailController::getProspekDetails/$1');
    $routes->post('store', 'ProspekEmailController::store');
    $routes->post('delete/(:num)', 'ProspekEmailController::delete/$1');
    $routes->post('storeEmail', 'ProspekEmailController::storeEmail');
    $routes->post('updateEmail/(:num)', 'ProspekEmailController::updateEmail/$1');
    $routes->post('deleteEmail/(:num)', 'ProspekEmailController::deleteEmail/$1');
});

// MENU KIRIM WHATSAPP
$routes->group('whatsapp', function ($routes) {
    $routes->get('/', 'ProspekWhatsappController::index', ['as' => 'whatsapp']);
    $routes->get('detail/(:num)', 'ProspekWhatsappController::detail/$1');
    $routes->get('get-prospek-details/(:num)', 'ProspekWhatsappController::getProspekDetails/$1');
    $routes->post('store', 'ProspekWhatsappController::store');
    $routes->post('delete/(:num)', 'ProspekWhatsappController::delete/$1');
    $routes->post('storeWhatsapp', 'ProspekWhatsappController::storeWhatsapp');
    $routes->post('updateWhatsapp/(:num)', 'ProspekWhatsappController::updateWhatsapp/$1');
    $routes->post('deleteWhatsapp/(:num)', 'ProspekWhatsappController::deleteWhatsapp/$1');
});

// MENU ARTIKEL TRENDING
$routes->get('/artikeltrending', 'ArtikelTrending::index');
$routes->get('/artikeltrending/tambah', 'ArtikelTrending::tambah');
$routes->post('/artikeltrending/simpan', 'ArtikelTrending::simpan');
$routes->get('/artikeltrending/hapus/(:num)', 'ArtikelTrending::hapus/$1');
$routes->get('artikeltrending', 'ArtikelTrending::index');

// MENU Tugas Piket
$routes->group('tugasPiket', function ($routes) {
    $routes->get('/', 'TugasPiketController::index');
    $routes->get('detail/(:num)', 'TugasPiketController::detail/$1', ['as' => 'tugasPiket.detail']);

    $routes->group('', ['filter' => 'role:admin'], function ($routes) {
        $routes->get('tambah', 'TugasPiketController::tambah', ['as' => 'tugasPiket.tambah']);
        $routes->post('simpan', 'TugasPiketController::simpan', ['as' => 'tugasPiket.simpan']);
        $routes->get('edit/(:num)', 'TugasPiketController::edit/$1', ['as' => 'tugasPiket.edit']);
        $routes->post('update/(:num)', 'TugasPiketController::update/$1', ['as' => 'tugasPiket.update']);
        $routes->post('delete/(:num)', 'TugasPiketController::delete/$1', ['as' => 'tugasPiket.delete']);
    });
});

$routes->group('profile', function ($routes) {
    $routes->get('/', 'ProfileController::index');
    $routes->post('update/(:num)', 'ProfileController::update/$1', ['as' => 'profile.update']);
    $routes->post('update-password', 'ProfileController::updatePassword');
    $routes->post('update-foto', 'ProfileController::updateFoto');
});
