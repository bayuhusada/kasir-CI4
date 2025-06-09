<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/barang', 'Barang::index');
$routes->get('/barang/create', 'Barang::create');
$routes->post('/barang', 'Barang::store');


