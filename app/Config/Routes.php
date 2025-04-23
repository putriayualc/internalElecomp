<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// MENU BACKLINK
$routes->group('backlink', function ($routes){
    $routes->get('/', 'BacklinkController::index');
});

// MENU PIKET
$routes->group('piket', function ($routes){
    $routes->get('/', 'PiketController::index');
    $routes->get('edit/(:segment)', 'PiketController::edit/$1');
    $routes->post('update', 'PiketController::update');
    // $routes->get('tambah', 'PiketController::create');       
    // $routes->post('simpan', 'PiketController::store');       

    $routes->get('/piket/edit/(:segment)', 'PiketController::edit/$1');
$routes->post('/piket/update', 'PiketController::update');

});


