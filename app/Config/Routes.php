<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('berita', 'Berita::index');
$routes->get('berita', 'Berita::index');
$routes->get('berita/(:segment)', 'Berita::detail/$1');

$routes->group('admin', function($routes){

    $routes->get('dashboard', 'Admin\Dashboard::index');

});

/* ROutes Admin 
*/

$routes->get('admin/berita', 'Admin\AdminBerita::index');
$routes->get('admin/berita/create', 'Admin\AdminBerita::create');
$routes->post('admin/berita/store', 'Admin\AdminBerita::store');
$routes->get('admin/berita/edit/(:num)', 'Admin\AdminBerita::edit/$1');
$routes->post('admin/berita/update/(:num)', 'Admin\AdminBerita::update/$1');
$routes->get('admin/berita/delete/(:num)', 'Admin\AdminBerita::delete/$1');


$routes->get('/korsda', 'Korsda::index');
$routes->get('gis', 'Gis::gis');
$routes->get('pengaduan', 'Pengaduan::index');
$routes->get('pengaduan/create', 'Pengaduan::create');
$routes->post('pengaduan/save', 'Pengaduan::save');
