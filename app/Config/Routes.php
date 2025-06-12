<?php

use CodeIgniter\Router\RouteCollection;
use PHPUnit\Framework\Attributes\Group;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');

// routes untuk autentikasi
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::doLogin');
$routes->get('/logout', 'Auth::logout');

// Hanya admin yang bisa akses barang
$routes->group('barang', ['filter' => 'auth:admin'], function($routes) {
    $routes->get('', 'Barang::index');
    $routes->get('create', 'Barang::create');
    $routes->post('/', 'Barang::store');
    $routes->get('edit/(:num)', 'Barang::edit/$1');
    $routes->post('update/(:num)', 'Barang::update/$1');
    $routes->get('delete/(:num)', 'Barang::delete/$1');
});

// Hanya kasir yang bisa akses kasir
$routes->group('kasir', ['filter' => 'auth:kasir'], function($routes) {
    $routes->get('', 'Kasir::index');
    $routes->post('simpanTransaksi', 'Kasir::simpanTransaksi');
});


