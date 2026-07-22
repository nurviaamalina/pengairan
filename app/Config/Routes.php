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
// Routes Admin Pengaduan
$routes->get('admin/pengaduan', 'Admin\AdminPengaduan::index');
$routes->get('admin/pengaduan/detail/(:num)', 'Admin\AdminPengaduan::detail/$1');
$routes->post('admin/pengaduan/update/(:num)', 'Admin\AdminPengaduan::updateStatus/$1');
$routes->get('admin/pengaduan/delete/(:num)', 'Admin\AdminPengaduan::delete/$1');

// pengaduan publik
$routes->get('pengaduan', 'Pengaduan::index');           
$routes->post('pengaduan/save', 'Pengaduan::save');      
$routes->get('pengaduan/track', 'Pengaduan::trackForm'); 
$routes->post('pengaduan/track', 'Pengaduan::track');    


$routes->get('/korsda', 'Korsda::index');
$routes->get('gis', 'Gis::gis');