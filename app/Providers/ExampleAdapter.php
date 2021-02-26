<?php

namespace App\Providers;

use Fluent\Auth\Contracts\AuthenticationInterface;
use Fluent\Auth\Contracts\AuthenticatorInterface;
use Fluent\Auth\Traits\GuardHelperTrait;
use Fluent\Auth\Contracts\UserProviderInterface;

class ExampleAdapter implements AuthenticationInterface
{
    use GuardHelperTrait;

    public function __construct($config, $name, UserProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * {@inheritdoc}
     */
    public function getSessionName()
    {
        return 'string';
    }

    /**
     * {@inheritdoc}
     */
    public function getCookieName()
    {
        return 'string';
    }

    /**
     * {@inheritdoc}
     */
    public function viaRemember()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function attempt(array $credentials, bool $remember = false)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function validate(array $credentials): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function login(AuthenticatorInterface $user, bool $remember = false): void
    {
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function loginById($userId, bool $remember = false)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function logout()
    {
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function user()
    {
        return null;
    }
}