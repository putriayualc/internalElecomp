<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// MENU BACKLINK
$routes->group('backlink', function ($routes) {
    $routes->get('/', 'BacklinkController::index', ['as' => 'backlink']);
    $routes->get('/tambah', 'BacklinkController::tambah', ['as' => 'email.tambah']);
    $routes->post('/proses_tambah', 'BacklinkController::proses_tambah', ['as' => 'email.simpan']);
    $routes->get('/edit/(:num)', 'BacklinkController::edit/$1', ['as' => 'email.edit']);
    $routes->post('/proses_edit/(:num)', 'BacklinkController::proses_edit/$1', ['as' => 'email.update']);
    $routes->get('/delete/(:any)', 'BacklinkController::delete/$1', ['as' => 'email.delete']);

    // BLOG PER EMAIL
    $routes->group('(:num)/blog', function($routes) {
        $routes->get('/', 'BlogController::index/$1', ['as' => 'blog']);
        $routes->get('tambah', 'BlogController::tambah/$1', ['as' => 'blog.tambah']);
        $routes->post('proses_tambah', 'BlogController::proses_tambah/$1', ['as' => 'blog.simpan']);
        $routes->get('edit/(:num)', 'BlogController::edit/$1/$2', ['as' => 'blog.edit']);
        $routes->post('proses_edit/(:num)', 'BlogController::proses_edit/$1/$2', ['as' => 'blog.update']);
        $routes->get('hapus/(:num)', 'BlogController::hapus/$1/$2', ['as' => 'blog.hapus']);
        // $1 = id_email, $2 = id_blog

        // ARTIKEL DALAM BLOG PER EMAIL
        $routes->group('(:num)/artikel', function($routes) {
            // $1 = id_email, $2 = id_blog, $4 = id_artikel
            $routes->get('/', 'ArtikelController::index/$1/$2', ['as' => 'artikel']);
            $routes->get('tambah', 'ArtikelController::tambah/$1/$2', ['as' => 'artikel.tambah']);
            $routes->post('simpan', 'ArtikelController::simpan/$1/$2', ['as' => 'artikel.simpan']);
            $routes->get('edit/(:num)', 'ArtikelController::edit/$1/$2/$3', ['as' => 'artikel.edit']);
            $routes->post('update/(:num)', 'ArtikelController::update/$1/$2/$3', ['as' => 'artikel.update']);
            $routes->get('hapus/(:num)', 'ArtikelController::hapus/$1/$2/$3', ['as' => 'artikel.hapus']);
        });
    });    
});
