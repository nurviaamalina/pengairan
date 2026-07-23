<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('berita', 'Berita::index');
$routes->get('berita', 'Berita::index');
$routes->get('berita/(:segment)', 'Berita::detail/$1');
$routes->get('kegiatan', 'Kegiatan::index');
$routes->get('kegiatan/tahun/(:num)', 'Kegiatan::tahun/$1');
$routes->get('kegiatan/(:segment)', 'Kegiatan::detail/$1');

    $routes->group('admin', function($routes){

        $routes->get('dashboard', 'Admin\Dashboard::index');

        $routes->get('kegiatan', 'Admin\AdminKegiatan::index');
    $routes->get('kegiatan/create', 'Admin\AdminKegiatan::create');
    $routes->post('kegiatan/store', 'Admin\AdminKegiatan::store');
    $routes->get('kegiatan/edit/(:num)', 'Admin\AdminKegiatan::edit/$1');
    $routes->post('kegiatan/update/(:num)', 'Admin\AdminKegiatan::update/$1');
    $routes->get('kegiatan/delete/(:num)', 'Admin\AdminKegiatan::delete/$1');
    $routes->get('kegiatan/foto/delete/(:num)', 'Admin\AdminKegiatan::deleteFoto/$1');


$routes->get('berita', 'Admin\AdminBerita::index');
$routes->get('berita/create', 'Admin\AdminBerita::create');
$routes->post('berita/store', 'Admin\AdminBerita::store');
$routes->get('berita/edit/(:num)', 'Admin\AdminBerita::edit/$1');
$routes->post('berita/update/(:num)', 'Admin\AdminBerita::update/$1');
$routes->get('berita/delete/(:num)', 'Admin\AdminBerita::delete/$1');

});


$routes->get('/korsda', 'Korsda::index');
$routes->get('gis', 'Gis::gis');
$routes->get('pengaduan', 'Pengaduan::index');
$routes->get('pengaduan/create', 'Pengaduan::create');
$routes->post('pengaduan/save', 'Pengaduan::save');


