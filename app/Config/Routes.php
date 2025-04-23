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

// MENU SOP
$routes->group('sop', function ($routes){
    $routes->get('/', 'SOPController::index');
});
