<?php

namespace Config;

use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use Fluent\Auth\Filters\ThrottleFilter;
use Fluent\Auth\Filters\AuthorizeFilter;
use Fluent\Auth\Filters\EmailVerifiedFilter;
use Fluent\Auth\Filters\AuthenticationFilter;
use Fluent\Auth\Filters\ConfirmPasswordFilter;
use Fluent\Auth\Filters\AuthenticationBasicFilter;
use Fluent\Auth\Filters\RedirectAuthenticatedFilter;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'auth'          => AuthenticationFilter::class,
        'auth.basic'    => AuthenticationBasicFilter::class,
        'can'           => AuthorizeFilter::class,
        'confirm'  => [
            AuthenticationFilter::class,
            ConfirmPasswordFilter::class,
        ],
        'guest'    => RedirectAuthenticatedFilter::class,
        'throttle' => ThrottleFilter::class,
        'verified' => EmailVerifiedFilter::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            // 'honeypot',
            'csrf' => ['except' => ['api/*']],
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
