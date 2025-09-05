<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('recursos', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('/', 'RecursosController::index');
    $routes->get('create', 'RecursosController::create');
    $routes->post('store', 'RecursosController::store');
    $routes->get('edit/(:num)', 'RecursosController::edit/$1');
    $routes->post('update/(:num)', 'RecursosController::update/$1');
    $routes->get('delete/(:num)', 'RecursosController::delete/$1');
});


