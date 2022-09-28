<?php

use CodeIgniter\Router\RouteCollection as Routes;
use Config\Services;

/** @var \CodeIgniter\Router\RouteCollection $routes */

// Login user using authentication JWT.
$routes->group('api/v1', ['namespace' => 'App\Controllers\JWTAuth'], function (Routes $routes) {
    $routes->group('basic', ['filter' => 'auth.basic:web,email,onceBasic'], function ($routes) {
        $routes->get('user', function () {
            return Services::response()->setJSON(auth()->user());
        });
    });
    $routes->post('login', 'JWTAuthController::login');
    $routes->post('logout', 'JWTAuthController::logout', ['filter' => 'auth:api']);
    $routes->post('refresh', 'JWTAuthController::refresh', ['filter' => 'auth:api']);
    $routes->match(['get', 'post'], 'user', 'JWTAuthController::user', ['filter' => 'auth:api']);
});