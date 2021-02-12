<?php

namespace App\Providers;

use Fluent\Auth\Adapters\AbstractAdapter;
use Fluent\Auth\Contracts\AuthenticatorInterface;

class ExampleAdapter extends AbstractAdapter
{
    public function attempt(array $credentials, bool $remember = false)
    {
        return true;
    }

    public function validate(array $credentials): bool
    {
        return true;
    }

    public function login(AuthenticatorInterface $user, bool $remember = false): void
    {
        return;
    }

    public function loginById(int $userId, bool $remember = false)
    {
        return true;
    }

    public function logout()
    {
        return;
    }

    public function user()
    {
        return null;
    }
}