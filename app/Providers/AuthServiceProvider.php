<?php

namespace App\Providers;

use Fluent\Auth\AbstractServiceProvider;
use Fluent\Auth\Facades\Auth;

class AuthServiceProvider extends AbstractServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public static function register()
    {
        // Example adding guard implementation. The accept function is
        // `auth` auth is the full config auth reference from config
        // auth. `name` is the guard name and `config` is array
        // from guards key value. If you dont need this property
        // just remove from your implementation constructor.
        Auth::extend('exampleGuard', function ($auth, $name, array $config) {
            return new ExampleAdapter(
                $auth, $name, Auth::createUserProvider($config['provider'])
            );
        });

        // Example adding provider implementation. The accept function is
        // `auth` auth is the full config auth reference from config
        // auth and `config` is array from providers key value.
        // If you dont need this property just remove from
        // your implementation constructor.
        Auth::provider('exampleProvider', function ($auth, array $config) {
            return new $config['table'];
        });
    }
}
