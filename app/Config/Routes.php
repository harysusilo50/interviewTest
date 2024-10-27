<?php

use CodeIgniter\Router\RouteCollection;

$routes->group('auth', function ($routes) {
    $routes->group('register', function ($routes) {
        $routes->get('/', 'Auth\RegisterController::index');
        $routes->post('registerAction', 'Auth\RegisterController::registerUser');
    });
    $routes->group('login', function ($routes) {
        $routes->get('/', 'Auth\LoginController::index');
        $routes->post('loginAction', 'Auth\LoginController::loginAction');
    });
    $routes->group('logout', function ($routes) {
        $routes->post('/', 'Auth\LogoutController::index');
    });
});

$routes->get('/datatable-get', 'ProductController::datatableServerSide');

$routes->group('', ['filter' => 'authfilter'], function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('/home', 'Home::index');

    $routes->group('', ['filter' => 'rolefilter'], function ($routes) {
        $routes->get('products', 'ProductController::index');
        $routes->post('products/store', 'ProductController::store');
        $routes->post('products/update/(:num)', 'ProductController::update/$1');
        $routes->get('products/delete/(:num)', 'ProductController::delete/$1');
    });
});

$routes->group('API', function ($routes) {
    $routes->post('login', 'API\AuthController::login');
    $routes->group('',['filter' => 'apifilter'],function ($routes) {
        $routes->get('get-profile','API\AuthController::getProfile');
        $routes->resource('products', ['controller' => 'API\ProductController']);
    });
});
