<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


/*
|--------------------------------------------------------------------------
| LOGIN & REGISTER
|--------------------------------------------------------------------------
*/

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::prosesLogin');

$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::prosesRegister');

$routes->get('logout', 'Auth::logout');


/*
|--------------------------------------------------------------------------
| FRONTEND - HOME
|--------------------------------------------------------------------------
*/

$routes->get('/', 'Home::index');
$routes->get('search', 'Home::search');


/*
|--------------------------------------------------------------------------
| FRONTEND - INSTAGRAM
|--------------------------------------------------------------------------
*/

$routes->get('instagram-sync', 'InstagramSync::index');
$routes->get('instagram', 'Instagram::index');


/*
|--------------------------------------------------------------------------
| FRONTEND - BERITA
|--------------------------------------------------------------------------
*/

$routes->get('berita', 'Berita::index');
$routes->get('berita/(:segment)', 'Berita::detail/$1');


/*
|--------------------------------------------------------------------------
| FRONTEND - KEGIATAN
|--------------------------------------------------------------------------
*/

$routes->get('kegiatan', 'Kegiatan::index');
$routes->get('kegiatan/tahun/(:num)', 'Kegiatan::tahun/$1');
$routes->get('kegiatan/(:segment)', 'Kegiatan::detail/$1');


/*
|--------------------------------------------------------------------------
| FRONTEND - PENGADUAN
|--------------------------------------------------------------------------
*/

$routes->get('pengaduan', 'Pengaduan::index');
$routes->get('pengaduan/create', 'Pengaduan::create');
$routes->post('pengaduan/save', 'Pengaduan::save');

$routes->get('pengaduan/track', 'Pengaduan::trackForm');
$routes->post('pengaduan/track', 'Pengaduan::track');
$routes->get('pengaduan/track-json', 'Pengaduan::trackJson');


/*
|--------------------------------------------------------------------------
| FRONTEND - DOKUMEN
|--------------------------------------------------------------------------
*/

$routes->get('dokumen', 'DokumenController::index');
$routes->get('dokumen/detail/(:num)', 'DokumenController::detail/$1');
$routes->get('dokumen/download/(:num)', 'DokumenController::download/$1');


/*
|--------------------------------------------------------------------------
| FRONTEND - KORSDA
|--------------------------------------------------------------------------
*/

$routes->get('korsda', 'Korsda::index');

$routes->get(
    'korsda/korsdawilayah/(:num)',
    'Korsda::korsdawilayah/$1'
);

$routes->get(
    'korsda/profil/(:num)',
    'Korsda::profil/$1'
);

$routes->get(
    'korsda/peta/(:num)',
    'Korsda::peta/$1'
);

$routes->get(
    'korsda/kegiatan/(:num)',
    'Korsda::kegiatan/$1'
);

$routes->get(
    'korsda/detail_kegiatan/(:num)',
    'Korsda::detailKegiatan/$1'
);

$routes->get(
    'korsda/gis/(:num)',
    'Korsda::gis/$1'
);


/*
|--------------------------------------------------------------------------
| FRONTEND - GIS
|--------------------------------------------------------------------------
*/

$routes->get('gis', 'Gis::index');


/*
|--------------------------------------------------------------------------
| FRONTEND - CCTV
|--------------------------------------------------------------------------
*/

$routes->get('cctv', 'Cctv::index');


/*
|--------------------------------------------------------------------------
| FRONTEND - TENTANG KAMI
|--------------------------------------------------------------------------
*/

$routes->get('tentang-kami', 'TentangKami::index');


/*
|--------------------------------------------------------------------------
| ADMIN - FULL ACCESS
|--------------------------------------------------------------------------
|
| Semua route di bawah hanya dapat diakses oleh ADMIN.
|
*/

$routes->group('admin', ['filter' => 'admin'], function ($routes) {


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    $routes->get(
        'dashboard',
        'Admin\Dashboard::index'
    );


    /*
    |--------------------------------------------------------------------------
    | BERITA ADMIN
    |--------------------------------------------------------------------------
    */

    $routes->get(
        'berita',
        'Admin\AdminBerita::index'
    );

    $routes->get(
        'berita/create',
        'Admin\AdminBerita::create'
    );

    $routes->post(
        'berita/store',
        'Admin\AdminBerita::store'
    );

    $routes->get(
        'berita/edit/(:num)',
        'Admin\AdminBerita::edit/$1'
    );

    $routes->post(
        'berita/update/(:num)',
        'Admin\AdminBerita::update/$1'
    );

    $routes->get(
        'berita/delete/(:num)',
        'Admin\AdminBerita::delete/$1'
    );

    $routes->get(
        'berita/import',
        'Admin\AdminBerita::import'
    );

    $routes->post(
        'berita/import',
        'Admin\AdminBerita::importProcess'
    );


    /*
    |--------------------------------------------------------------------------
    | KEGIATAN ADMIN
    |--------------------------------------------------------------------------
    */

    $routes->get(
        'kegiatan',
        'Admin\AdminKegiatan::index'
    );

    $routes->get(
        'kegiatan/create',
        'Admin\AdminKegiatan::create'
    );

    $routes->post(
        'kegiatan/store',
        'Admin\AdminKegiatan::store'
    );

    $routes->get(
        'kegiatan/edit/(:num)',
        'Admin\AdminKegiatan::edit/$1'
    );

    $routes->post(
        'kegiatan/update/(:num)',
        'Admin\AdminKegiatan::update/$1'
    );

    $routes->get(
        'kegiatan/delete/(:num)',
        'Admin\AdminKegiatan::delete/$1'
    );

    $routes->get(
        'kegiatan/foto/delete/(:num)',
        'Admin\AdminKegiatan::deleteFoto/$1'
    );

    $routes->get(
        'kegiatan/import',
        'Admin\AdminKegiatan::import'
    );

    $routes->post(
        'kegiatan/import',
        'Admin\AdminKegiatan::importProcess'
    );


    /*
    |--------------------------------------------------------------------------
    | PENGADUAN ADMIN
    |--------------------------------------------------------------------------
    */

    $routes->get(
        'pengaduan',
        'Admin\AdminPengaduan::index'
    );

    $routes->get(
        'pengaduan/detail/(:num)',
        'Admin\AdminPengaduan::detail/$1'
    );

    $routes->post(
        'pengaduan/update/(:num)',
        'Admin\AdminPengaduan::updateStatus/$1'
    );

    $routes->get(
        'pengaduan/delete/(:num)',
        'Admin\AdminPengaduan::delete/$1'
    );

    $routes->post(
        'pengaduan/tindaklanjut/(:num)',
        'Admin\AdminPengaduan::tindaklanjut/$1'
    );


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD KORSDA
    |--------------------------------------------------------------------------
    */

    $routes->get(
        'korsda/dashboard',
        'Admin\DashboardKorsda::index'
    );


    /*
    |--------------------------------------------------------------------------
    | DATA KORSDA
    |--------------------------------------------------------------------------
    */

    $routes->get(
        'korsda',
        'Admin\Korsda::index'
    );

    $routes->get(
        'korsda/data',
        'Admin\Korsda::index'
    );

    $routes->get(
        'korsda/create',
        'Admin\Korsda::create'
    );

    $routes->post(
        'korsda/store',
        'Admin\Korsda::store'
    );

    $routes->get(
        'korsda/edit/(:num)',
        'Admin\Korsda::edit/$1'
    );

    $routes->post(
        'korsda/update/(:num)',
        'Admin\Korsda::update/$1'
    );

    $routes->get(
        'korsda/delete/(:num)',
        'Admin\Korsda::delete/$1'
    );


    /*
    |--------------------------------------------------------------------------
    | PROFIL KORSDA
    |--------------------------------------------------------------------------
    */

    $routes->get(
        'korsda/profil',
        'Admin\ProfilKorsda::index'
    );

    $routes->get(
        'korsda/profil_korsda',
        'Admin\ProfilKorsda::index'
    );

    $routes->get(
        'korsda/profil_korsda/create',
        'Admin\ProfilKorsda::create'
    );

    $routes->post(
        'korsda/profil_korsda/store',
        'Admin\ProfilKorsda::store'
    );

    $routes->get(
        'korsda/profil_korsda/edit/(:num)',
        'Admin\ProfilKorsda::edit/$1'
    );

    $routes->post(
        'korsda/profil_korsda/update/(:num)',
        'Admin\ProfilKorsda::update/$1'
    );

    $routes->get(
        'korsda/profil_korsda/delete/(:num)',
        'Admin\ProfilKorsda::delete/$1'
    );


    /*
    |--------------------------------------------------------------------------
    | WILAYAH KORSDA
    |--------------------------------------------------------------------------
    */

    $routes->get(
        'korsda/wilayah',
        'Admin\PetaKorsda::index'
    );

    $routes->get(
        'peta',
        'Admin\PetaKorsda::index'
    );

    $routes->get(
        'wilayah',
        'Admin\PetaKorsda::index'
    );

    $routes->get(
        'wilayah/create',
        'Admin\PetaKorsda::create'
    );

    $routes->post(
        'wilayah/store',
        'Admin\PetaKorsda::store'
    );

    $routes->post(
        'korsda/wilayah/store',
        'Admin\PetaKorsda::store'
    );

    $routes->get(
        'wilayah/edit/(:num)',
        'Admin\PetaKorsda::edit/$1'
    );

    $routes->post(
        'wilayah/update/(:num)',
        'Admin\PetaKorsda::update/$1'
    );

    $routes->get(
        'wilayah/delete/(:num)',
        'Admin\PetaKorsda::delete/$1'
    );


    /*
    |--------------------------------------------------------------------------
    | GIS KORSDA
    |--------------------------------------------------------------------------
    */

    $routes->get(
        'korsda/gis',
        'Admin\GisKorsda::index'
    );


    /*
    |--------------------------------------------------------------------------
    | KECAMATAN
    |--------------------------------------------------------------------------
    */

    $routes->get(
        'korsda/kecamatan',
        'Admin\Kecamatan::index'
    );

    $routes->get(
        'korsda/kecamatan/create',
        'Admin\Kecamatan::create'
    );

    $routes->post(
        'korsda/kecamatan/store',
        'Admin\Kecamatan::store'
    );

    $routes->get(
        'korsda/kecamatan/edit/(:num)',
        'Admin\Kecamatan::edit/$1'
    );

    $routes->post(
        'korsda/kecamatan/update/(:num)',
        'Admin\Kecamatan::update/$1'
    );

    $routes->get(
        'korsda/kecamatan/delete/(:num)',
        'Admin\Kecamatan::delete/$1'
    );


    /*
    |--------------------------------------------------------------------------
    | PROFIL ADMIN
    |--------------------------------------------------------------------------
    */

    $routes->get(
        'profil',
        'Admin\AdminProfil::index'
    );

    $routes->get(
        'profil/create',
        'Admin\AdminProfil::create'
    );

    $routes->post(
        'profil/save',
        'Admin\AdminProfil::save'
    );

    $routes->get(
        'profil/edit/(:num)',
        'Admin\AdminProfil::edit/$1'
    );

    $routes->post(
        'profil/update/(:num)',
        'Admin\AdminProfil::update/$1'
    );

    $routes->get(
        'profil/delete/(:num)',
        'Admin\AdminProfil::delete/$1'
    );


    // =========================
    // MANAJEMEN USER
    // =========================
    $routes->get(
        'manajemen-user',
        'Admin\ManajemenUser::index'
    );

    $routes->delete(
        'manajemen-user/delete/(:num)',
        'Admin\ManajemenUser::delete/$1'
    );



    /*
    |--------------------------------------------------------------------------
    | INSTAGRAM ADMIN
    |--------------------------------------------------------------------------
    */

    $routes->get(
        'instagram',
        'Admin\AdminInstagram::index'
    );

    $routes->get(
        'instagram/sync',
        'Admin\AdminInstagram::sync'
    );

    $routes->get(
        'instagram/create',
        'Admin\AdminInstagram::create'
    );

    $routes->post(
        'instagram/store',
        'Admin\AdminInstagram::store'
    );

    $routes->get(
        'instagram/edit/(:num)',
        'Admin\AdminInstagram::edit/$1'
    );

    $routes->post(
        'instagram/update/(:num)',
        'Admin\AdminInstagram::update/$1'
    );

    $routes->get(
        'instagram/delete/(:num)',
        'Admin\AdminInstagram::delete/$1'
    );


    /*
    |--------------------------------------------------------------------------
    | KATEGORI DOKUMEN
    |--------------------------------------------------------------------------
    */

    $routes->get(
        'kategori',
        'Admin\AdminKategoriDokumen::index'
    );

    $routes->get(
        'kategori/create',
        'Admin\AdminKategoriDokumen::create'
    );

    $routes->post(
        'kategori/store',
        'Admin\AdminKategoriDokumen::store'
    );

    $routes->get(
        'kategori/edit/(:num)',
        'Admin\AdminKategoriDokumen::edit/$1'
    );

    $routes->post(
        'kategori/update/(:num)',
        'Admin\AdminKategoriDokumen::update/$1'
    );

    $routes->get(
        'kategori/delete/(:num)',
        'Admin\AdminKategoriDokumen::delete/$1'
    );

    $routes->post(
        'dokumen/kategori/store',
        'Admin\AdminKategoriDokumen::store'
    );

    $routes->get(
        'kategori/(:segment)',
        'Admin\AdminDokumen::kategori/$1'
    );


    /*
    |--------------------------------------------------------------------------
    | DOKUMEN ADMIN
    |--------------------------------------------------------------------------
    */

    $routes->get(
        'dokumen',
        'Admin\AdminDokumen::index'
    );

    $routes->get(
        'dokumen/create',
        'Admin\AdminDokumen::create'
    );

    $routes->get(
        'dokumen/create/(:segment)',
        'Admin\AdminDokumen::create/$1'
    );

    $routes->post(
        'dokumen/store',
        'Admin\AdminDokumen::store'
    );

    $routes->get(
        'dokumen/edit/(:num)',
        'Admin\AdminDokumen::edit/$1'
    );

    $routes->post(
        'dokumen/update/(:num)',
        'Admin\AdminDokumen::update/$1'
    );

    $routes->get(
        'dokumen/delete/(:num)',
        'Admin\AdminDokumen::delete/$1'
    );

});


/*
|--------------------------------------------------------------------------
| KORSDA KEGIATAN
|--------------------------------------------------------------------------
|
| Bisa diakses oleh ADMIN dan USER.
| Admin dan User bisa:
| - Lihat
| - Tambah
| - Edit
| - Hapus
|
*/

$routes->group(
    'admin/korsda',
    ['filter' => 'korsda'],
    function ($routes) {

        // LIST
        $routes->get(
            'kegiatan',
            'Admin\KegiatanKorsda::index'
        );

        // CREATE
        $routes->get(
            'kegiatan/create', 'Admin\KegiatanKorsda::create'
        );

        // STORE
        $routes->post(
            'kegiatan/store',
            'Admin\KegiatanKorsda::store'
        );

        // EDIT
        $routes->get(
            'kegiatan/edit/(:num)',
            'Admin\KegiatanKorsda::edit/$1'
        );

        // UPDATE
        $routes->post(
            'kegiatan/update/(:num)',
            'Admin\KegiatanKorsda::update/$1'
        );

        // DELETE
        $routes->get(
            'kegiatan/delete/(:num)',
            'Admin\KegiatanKorsda::delete/$1'
        );

    }
);