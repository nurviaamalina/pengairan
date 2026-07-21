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


/*
Route Admin
*/

$routes->get('admin/berita', 'Admin\AdminBerita::index');

$routes->get('admin/berita/create', 'Admin\AdminBerita::create');

$routes->post('admin/berita/store', 'Admin\AdminBerita::store');

$routes->get('admin/berita/edit/(:num)', 'Admin\AdminBerita::edit/$1');

$routes->post('admin/berita/update/(:num)', 'Admin\AdminBerita::update/$1');

$routes->get('admin/berita/delete/(:num)', 'Admin\AdminBerita::delete/$1');