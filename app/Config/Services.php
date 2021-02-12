<?php

namespace Config;

use App\Providers\ExampleAdapter;
use CodeIgniter\Config\BaseService;
use Fluent\Auth\Contracts\AuthFactoryInterface;
use Fluent\Auth\Contracts\AuthenticationInterface;
use Fluent\Auth\Facades\Auth;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    /**
     * Example using service with method extend to driver.
     * 
     * @return AuthFactoryInterface|AuthenticationInterface
     */
    public static function example($getShared = true)
    {
        $config = config('Auth');

        if ($getShared) {
            return static::getSharedInstance('extend');
        }
    
        return Auth::extend('withExtend', function () use ($config) {
            return new ExampleAdapter(
                $config,
                'withExtend',
                Auth::createUserProvider($config->guards['extend']['provider'])
            );
        });
    }
}
