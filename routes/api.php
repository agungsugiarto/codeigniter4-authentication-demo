<?php

use CodeIgniter\Router\RouteCollection as Routes;

/** @var \CodeIgniter\Router\RouteCollection $routes */

// Login user using authentication JWT.
$routes->group('api/v1', ['namespace' => 'App\Controllers\JWTAuth'], function (Routes $routes) {
    $routes->post('login', 'JWTAuthController::login');
    $routes->post('logout', 'JWTAuthController::logout', ['filter' => 'auth:api']);
    $routes->post('refresh', 'JWTAuthController::refresh', ['filter' => 'auth:api']);
    $routes->match(['get', 'post'], 'user', 'JWTAuthController::user', ['filter' => 'auth:api']);
});