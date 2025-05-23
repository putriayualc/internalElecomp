<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'AuthController::index');
$routes->get('/logout', 'AuthController::logout');
$routes->post('/login/proses', 'AuthController::proses_login');

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
    $routes->get('delete/(:num)', 'HostingController::delete/$1', ['as' => 'hosting.delete']);
    $routes->get('detail/(:num)', 'HostingController::detail/$1', ['as' => 'hosting.detail']);
});

// MENU DATA SISWA MAGANG
$routes->group('siswa', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'SiswaController::index', ['as' => 'siswa']);
    $routes->get('tambah', 'SiswaController::tambah', ['as' => 'siswa.tambah']);
    $routes->post('simpan', 'SiswaController::simpan', ['as' => 'siswa.simpan']); 
    $routes->get('edit/(:num)', 'SiswaController::edit/$1', ['as' => 'siswa.edit']);
    $routes->post('update/(:num)', 'SiswaController::update/$1', ['as' => 'siswa.update']);
    $routes->get('delete/(:num)', 'SiswaController::delete/$1', ['as' => 'siswa.delete']);
});

$routes->get('addon/hapus/(:num)/(:num)', 'DomainController::hapus/$1/$2', ['as' => 'domain.hapus']);

// MENU LIST PROSPEK
$routes->group('prospek', function ($routes) {
    $routes->get('/', 'ProspekController::index', ['as' => 'prospek']);
    $routes->get('tambah', 'ProspekController::tambah', ['as' => 'prospek.tambah']);
    $routes->post('simpan', 'ProspekController::simpan', ['as' => 'prospek.simpan']); 
    $routes->get('edit/(:num)', 'ProspekController::edit/$1', ['as' => 'prospek.edit']);
    $routes->post('update/(:num)', 'ProspekController::update/$1', ['as' => 'prospek.update']);
    $routes->get('delete/(:num)', 'ProspekController::delete/$1', ['as' => 'prospek.delete']);
    $routes->get('detail', 'ProspekController::detail', ['as' => 'prospek.detail']);
});

// MENU Bisnis
$routes->group('bisnis', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'BisnisController::index', ['as' => 'bisnis']);
    $routes->get('tambah', 'BisnisController::tambah', ['as' => 'bisnis.tambah']);
    $routes->post('simpan', 'BisnisController::simpan', ['as' => 'bisnis.simpan']); 

});

// MENU SOSMED
$routes->group('sosmed', function ($routes) {
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
    $routes->get('detail', 'KontenController::detail', ['as' => 'konten.detail']);
});

// MENU KIRIM EMAIL
$routes->group('email', function ($routes) {
    $routes->get('/', 'EmailController::index', ['as' => 'email']);
    $routes->get('detail', 'EmailController::detail', ['as' => 'email.detail']);
});

// MENU KIRIM WHATSAPP
$routes->group('whatsapp', function ($routes) {
    $routes->get('/', 'WhatsappController::index', ['as' => 'whatsapp']);
    $routes->get('email', 'WhatsappController::detail', ['as' => 'whatsapp.detail']);
});