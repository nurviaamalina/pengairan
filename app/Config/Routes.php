<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('berita', 'Berita::index');
$routes->get('berita/detail', 'Berita::detail');
$routes->get('tentang-kami', 'TentangKami::index');

$routes->group('admin', ['filter' => 'auth'], function ($routes) {

    $routes->get('dashboard', 'Admin\Dashboard::index');

});


// =========================
// LOGIN & REGISTER
// =========================

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::prosesLogin');

$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::prosesRegister');

$routes->get('logout', 'Auth::logout');

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


/*Dokumen 
*/

$routes->get('dokumen', 'DokumenController::index');
$routes->get('dokumen/(:num)', 'DokumenController::detail/$1');
$routes->get('/dokumen/download/(:num)', 'DokumenController::download/$1');

$routes->group('admin', function ($routes) {

    $routes->get('dashboard', 'Admin\Dashboard::index');


    // ==========================
    // KATEGORI DOKUMEN
    // ==========================

   $routes->get('kategori', 'Admin\AdminKategoriDokumen::index');
$routes->get('kategori/create', 'Admin\AdminKategoriDokumen::create');
$routes->post('kategori/store', 'Admin\AdminKategoriDokumen::store');
$routes->get('kategori/edit/(:num)', 'Admin\AdminKategoriDokumen::edit/$1');
$routes->post('kategori/update/(:num)', 'Admin\AdminKategoriDokumen::update/$1');
$routes->get('kategori/delete/(:num)', 'Admin\AdminKategoriDokumen::delete/$1');

// Halaman isi kategori
$routes->get('kategori/(:segment)', 'Admin\AdminDokumen::kategori/$1');



    // ==========================
    // DOKUMEN
    // ==========================

    $routes->get('dokumen', 'Admin\AdminDokumen::index');

    $routes->get('dokumen/create', 'Admin\AdminDokumen::create');
    $routes->get('dokumen/create/(:segment)', 'Admin\AdminDokumen::create/$1');

    $routes->post('dokumen/store', 'Admin\AdminDokumen::store');

    $routes->get('dokumen/edit/(:num)', 'Admin\AdminDokumen::edit/$1');

    $routes->post('dokumen/update/(:num)', 'Admin\AdminDokumen::update/$1');

    $routes->get('dokumen/delete/(:num)', 'Admin\AdminDokumen::delete/$1');


    
});
