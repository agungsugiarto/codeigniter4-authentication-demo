<?php

use CodeIgniter\Router\RouteCollection as Routes;
use Config\Services;

/** @var \CodeIgniter\Router\RouteCollection $routes */

// Login user using authentication JWT.
$routes->group('api/v1', function (Routes $routes) {
    $routes->group('basic', ['filter' => 'auth.basic:web,email,onceBasic'], function ($routes) {
        $routes->get('user', function () {
            return Services::response()->setJSON(auth()->user());
        });
    });
    $routes->post('login', '\App\Controllers\JWTAuth\JWTAuthController::login');
    $routes->post('logout', '\App\Controllers\JWTAuth\JWTAuthController::logout', ['filter' => 'auth:api']);
    $routes->post('refresh', '\App\Controllers\JWTAuth\JWTAuthController::refresh', ['filter' => 'auth:api']);
    $routes->match(['get', 'post'], 'user', '\App\Controllers\JWTAuth\JWTAuthController::user', ['filter' => 'auth:api']);
});