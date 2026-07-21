<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('berita', 'Berita::index');
$routes->get('berita/detail', 'Berita::detail');
$routes->get('tentang-kami', 'TentangKami::index');