<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('berita', 'Berita::index');
$routes->get('berita/detail', 'Berita::detail');

$routes->group('admin', function($routes){

    $routes->get('dashboard', 'Admin\Dashboard::index');

});

$routes->get('/korsda', 'Korsda::index');
$routes->get('gis', 'Gis::gis');