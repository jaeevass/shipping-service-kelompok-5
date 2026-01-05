<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Shipping API Routes
$routes->group('api/shipping', ['namespace' => 'App\Controllers'], function ($routes) {
    // Create new shipping data
    $routes->post('create', 'Shipping::create');
    
    // Get shipping status by order_id
    $routes->get('status/(:segment)', 'Shipping::status/$1');
    
    // Additional RESTful routes
    $routes->get('/', 'Shipping::index');
    $routes->get('(:num)', 'Shipping::show/$1');
    $routes->put('(:num)', 'Shipping::update/$1');
    $routes->patch('(:num)', 'Shipping::update/$1');
    $routes->delete('(:num)', 'Shipping::delete/$1');
});
