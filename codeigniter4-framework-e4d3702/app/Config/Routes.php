<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('test-db', 'TestDB::index');
$routes->post('shipping', 'ShippingController::create');
$routes->post('api/shipping/create', 'ShippingController::create');
$routes->get('api/shipping/status/(:num)', 'ShippingController::status/$1');
