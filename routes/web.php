<?php

use CodeIgniter\Router\RouteCollection as Routes;
use Fluent\Auth\Facades\Auth;

/** @var \CodeIgniter\Router\RouteCollection $routes */

// Includes auth routes.
Auth::routes([]);

// Socialite authentication
$routes->get('socialite/(:alphanum)', 'SocialiteController::redirectProvider/$1');
$routes->get('socialite/(:alphanum)/callback', 'SocialiteController::providerCallback/$1');

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// Example route dashboard.
$routes->group('dashboard', ['filter' => 'auth:web'], function (Routes $routes) {
    $routes->get('/', 'Home::dashboard', ['filter' => 'verified']);
    $routes->get('confirm', 'Home::confirm', ['filter' => 'confirm']);
});