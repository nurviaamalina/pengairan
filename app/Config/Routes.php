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
$routes->get('korsda/profil', 'Korsda::profil');

$routes->get('gis', 'Gis::gis');

$routes->group('admin', function ($routes) {

    $routes->get('korsda', 'Admin\Korsda::index');
    $routes->get('korsda/create', 'Admin\Korsda::create');
    $routes->post('korsda/store', 'Admin\Korsda::store');

    $routes->get('korsda/edit/(:num)', 'Admin\Korsda::edit/$1');
    $routes->post('korsda/update/(:num)', 'Admin\Korsda::update/$1');
    $routes->get('korsda/delete/(:num)', 'Admin\Korsda::delete/$1');
//profil korsda
    $routes->get('korsda/profil_korsda', 'Admin\ProfilKorsda::index');
    $routes->post('korsda/profil_korsda/update/(:num)', 'Admin\ProfilKorsda::update/$1');
    $routes->get('korsda/profil_korsda/edit/(:num)', 'Admin\ProfilKorsda::edit/$1');
    $routes->get('korsda/profil_korsda/create', 'Admin\ProfilKorsda::create');
    $routes->post('korsda/profil_korsda/store', 'Admin\ProfilKorsda::store');
    $routes->get('korsda/profil_korsda/delete/(:num)', 'Admin\ProfilKorsda::delete/$1');

    //dashboard korsda
    $routes->get('korsda/dashboard', 'Admin\DashboardKorsda::index');

    $routes->get('korsda/data', 'Admin\Korsda::index');

    $routes->get('korsda/profil', 'Admin\ProfilKorsda::index');

    $routes->get('korsda/wilayah', 'Admin\WilayahKorsda::index');

    $routes->get('korsda/gis', 'Admin\GisKorsda::index');

    $routes->get('korsda/kecamatan', 'Admin\KecamatanKorsda::index');

    //kegiatan korsda
     $routes->get('korsda/kegiatan', 'Admin\KegiatanKorsda::index');

    $routes->get('korsda/kegiatan/create', 'Admin\KegiatanKorsda::create');

    $routes->post('korsda/kegiatan/store', 'Admin\KegiatanKorsda::store');

    $routes->get('korsda/kegiatan/edit/(:num)', 'Admin\KegiatanKorsda::edit/$1');

    $routes->post('korsda/kegiatan/update/(:num)', 'Admin\KegiatanKorsda::update/$1');

    $routes->get('korsda/kegiatan/delete/(:num)', 'Admin\KegiatanKorsda::delete/$1');
});

//frontend korsda
$routes->get('korsda', 'Korsda::index');
$routes->get('korsda/profil/(:num)', 'Korsda::profil/$1');
$routes->get('korsda/peta/(:num)', 'Korsda::peta/$1');
$routes->get('korsda/kegiatan/(:num)', 'Korsda::kegiatan/$1');
$routes->get('korsda/detail_kegiatan/(:num)', 'Korsda::detailKegiatan/$1');
