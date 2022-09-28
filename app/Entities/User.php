<?php

namespace App\Entities;

use Fluent\Auth\Facades\Hash;
use CodeIgniter\Entity\Entity;
use Fluent\Auth\Traits\AuthorizableTrait;
use Fluent\Auth\Traits\AuthenticatableTrait;
use Fluent\Auth\Traits\HasAccessTokensTrait;
use Fluent\Auth\Traits\MustVerifyEmailTrait;
use Fluent\Auth\Traits\CanResetPasswordTrait;
use Fluent\Auth\Contracts\VerifyEmailInterface;
use Fluent\Auth\Contracts\AuthorizableInterface;
use Fluent\Auth\Contracts\AuthenticatorInterface;
use Fluent\Auth\Contracts\ResetPasswordInterface;
use Fluent\JWTAuth\Contracts\JWTSubjectInterface;
use Fluent\Auth\Contracts\HasAccessTokensInterface;

class User extends Entity implements
    AuthenticatorInterface,
    AuthorizableInterface,
    HasAccessTokensInterface,
    ResetPasswordInterface,
    VerifyEmailInterface,
    JWTSubjectInterface
{
    use AuthenticatableTrait;
    use AuthorizableTrait;
    use CanResetPasswordTrait;
    use HasAccessTokensTrait;
    use MustVerifyEmailTrait;

    /**
     * Array of field names and the type of value to cast them as
     * when they are accessed.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Fill set password hash.
     *
     * @return $this
     */
    public function setPassword(string $password)
    {
        $this->attributes['password'] = Hash::make($password);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getJWTIdentifier()
    {
        return $this->getAuthId();
    }

    /**
     * {@inheritdoc}
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
