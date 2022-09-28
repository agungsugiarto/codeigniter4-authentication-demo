<?php

namespace App\Providers;

use Fluent\Auth\AbstractServiceProvider;
use Fluent\Auth\Facades\Auth;
use Fluent\Auth\Facades\Gate;
use Fluent\JWTAuth\Config\Services;
use Fluent\JWTAuth\JWTGuard;

class AuthServiceProvider extends AbstractServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected static $policies = [];

    /**
     * {@inheritdoc}
     */
    public static function register()
    {
        static::registerPolicies();

        Auth::extend(JWTGuard::class, function ($auth, $name, array $config) {
            return new JWTGuard(
                Services::getSharedInstance('jwt'),
                Services::getSharedInstance('request'),
                $auth->createUserProvider($config['provider']),
            );
        });

        Gate::define('admin', function ($user) {
            return $user->id == 1;
        });
    }
}
