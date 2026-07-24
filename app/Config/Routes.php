<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

/*
|--------------------------------------------------------------------------
| FRONTEND
|--------------------------------------------------------------------------
*/

$routes->get('/', 'Home::index');

/*
|--------------------------------------------------------------------------
| BERITA
|--------------------------------------------------------------------------
*/
$routes->get('berita', 'Berita::index');
$routes->get('berita/(:segment)', 'Berita::detail/$1');

/*
|--------------------------------------------------------------------------
| KEGIATAN
|--------------------------------------------------------------------------
*/
$routes->get('kegiatan', 'Kegiatan::index');
$routes->get('kegiatan/tahun/(:num)', 'Kegiatan::tahun/$1');
$routes->get('kegiatan/(:segment)', 'Kegiatan::detail/$1');

/*
|--------------------------------------------------------------------------
| GIS
|--------------------------------------------------------------------------
*/
$routes->get('gis', 'Gis::gis');

/*
|--------------------------------------------------------------------------
| PENGADUAN
|--------------------------------------------------------------------------
*/
$routes->get('pengaduan', 'Pengaduan::index');
$routes->get('pengaduan/create', 'Pengaduan::create');
$routes->post('pengaduan/save', 'Pengaduan::save');
$routes->get('pengaduan/track', 'Pengaduan::trackForm');
$routes->post('pengaduan/track', 'Pengaduan::track');

/*
|--------------------------------------------------------------------------
| FRONTEND KORSDA
|--------------------------------------------------------------------------
*/
$routes->get('korsda', 'Korsda::index');
$routes->get('korsda/profil/(:num)', 'Korsda::profil/$1');
$routes->get('korsda/peta/(:num)', 'Korsda::peta/$1');
$routes->get('korsda/kegiatan/(:num)', 'Korsda::kegiatan/$1');
$routes->get('korsda/detail_kegiatan/(:num)', 'Korsda::detailKegiatan/$1');

/*
|--------------------------------------------------------------------------
| TENTANG KAMI
|--------------------------------------------------------------------------
*/
$routes->get('tentang-kami', 'TentangKami::index');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
$routes->group('admin', function ($routes) {

    /*
    | Dashboard
    */
    $routes->get('dashboard', 'Admin\Dashboard::index');

    /*
    | BERITA
    */
    $routes->get('berita', 'Admin\AdminBerita::index');
    $routes->get('berita/create', 'Admin\AdminBerita::create');
    $routes->post('berita/store', 'Admin\AdminBerita::store');
    $routes->get('berita/edit/(:num)', 'Admin\AdminBerita::edit/$1');
    $routes->post('berita/update/(:num)', 'Admin\AdminBerita::update/$1');
    $routes->get('berita/delete/(:num)', 'Admin\AdminBerita::delete/$1');

    /*
    | KEGIATAN
    */
    $routes->get('kegiatan', 'Admin\AdminKegiatan::index');
    $routes->get('kegiatan/create', 'Admin\AdminKegiatan::create');
    $routes->post('kegiatan/store', 'Admin\AdminKegiatan::store');
    $routes->get('kegiatan/edit/(:num)', 'Admin\AdminKegiatan::edit/$1');
    $routes->post('kegiatan/update/(:num)', 'Admin\AdminKegiatan::update/$1');
    $routes->get('kegiatan/delete/(:num)', 'Admin\AdminKegiatan::delete/$1');
    $routes->get('kegiatan/foto/delete/(:num)', 'Admin\AdminKegiatan::deleteFoto/$1');

    /*
    | PENGADUAN
    */
    $routes->get('pengaduan', 'Admin\AdminPengaduan::index');
    $routes->get('pengaduan/detail/(:num)', 'Admin\AdminPengaduan::detail/$1');
    $routes->post('pengaduan/update/(:num)', 'Admin\AdminPengaduan::updateStatus/$1');
    $routes->get('pengaduan/delete/(:num)', 'Admin\AdminPengaduan::delete/$1');

    /*
    | DASHBOARD KORSDA
    */
    $routes->get('korsda/dashboard', 'Admin\DashboardKorsda::index');

    /*
    | DATA KORSDA
    */
    $routes->get('korsda', 'Admin\Korsda::index');
    $routes->get('korsda/data', 'Admin\Korsda::index');

    $routes->get('korsda/create', 'Admin\Korsda::create');
    $routes->post('korsda/store', 'Admin\Korsda::store');

    $routes->get('korsda/edit/(:num)', 'Admin\Korsda::edit/$1');
    $routes->post('korsda/update/(:num)', 'Admin\Korsda::update/$1');

    $routes->get('korsda/delete/(:num)', 'Admin\Korsda::delete/$1');

    /*
    | PROFIL KORSDA
    */
    $routes->get('korsda/profil', 'Admin\ProfilKorsda::index');

    $routes->get('korsda/profil_korsda', 'Admin\ProfilKorsda::index');
    $routes->get('korsda/profil_korsda/create', 'Admin\ProfilKorsda::create');
    $routes->post('korsda/profil_korsda/store', 'Admin\ProfilKorsda::store');

    $routes->get('korsda/profil_korsda/edit/(:num)', 'Admin\ProfilKorsda::edit/$1');
    $routes->post('korsda/profil_korsda/update/(:num)', 'Admin\ProfilKorsda::update/$1');

    $routes->get('korsda/profil_korsda/delete/(:num)', 'Admin\ProfilKorsda::delete/$1');

    /*
    | WILAYAH
    */
    $routes->get('korsda/wilayah', 'Admin\WilayahKorsda::index');

    /*
    | GIS
    */
    $routes->get('korsda/gis', 'Admin\GisKorsda::index');

    /*
    | KECAMATAN
    */
    $routes->get('korsda/kecamatan', 'Admin\KecamatanKorsda::index');

    /*
    | KEGIATAN KORSDA
    */
    $routes->get('korsda/kegiatan', 'Admin\KegiatanKorsda::index');
    $routes->get('korsda/kegiatan/create', 'Admin\KegiatanKorsda::create');
    $routes->post('korsda/kegiatan/store', 'Admin\KegiatanKorsda::store');
    $routes->get('korsda/kegiatan/edit/(:num)', 'Admin\KegiatanKorsda::edit/$1');
    $routes->post('korsda/kegiatan/update/(:num)', 'Admin\KegiatanKorsda::update/$1');
    $routes->get('korsda/kegiatan/delete/(:num)', 'Admin\KegiatanKorsda::delete/$1');

    /*
    | PROFIL ADMIN
    */
    $routes->get('profil', 'Admin\AdminProfil::index');
    $routes->get('profil/create', 'Admin\AdminProfil::create');
    $routes->post('profil/save', 'Admin\AdminProfil::save');
    $routes->get('profil/edit/(:num)', 'Admin\AdminProfil::edit/$1');
    $routes->post('profil/update/(:num)', 'Admin\AdminProfil::update/$1');
    $routes->get('profil/delete/(:num)', 'Admin\AdminProfil::delete/$1');


    // Tambahkan jika memang ada halaman detail kegiatan admin
    // $routes->get('korsda/kegiatan/detail/(:num)', 'Admin\KegiatanKorsda::detail/$1');
});