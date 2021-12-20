<?php

namespace App\Providers;

use Fluent\Auth\AbstractServiceProvider;
use Fluent\Auth\Facades\Auth;
use Fluent\JWTAuth\Config\Services;
use Fluent\JWTAuth\JWTGuard;

class AuthServiceProvider extends AbstractServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public static function register()
    {
        Auth::extend(JWTGuard::class, function ($auth, $name, array $config) {
            return new JWTGuard(
                Services::getSharedInstance('jwt'),
                Services::getSharedInstance('request'),
                $auth->createUserProvider($config['provider']),
            );
        });
    }
}
