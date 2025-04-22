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
