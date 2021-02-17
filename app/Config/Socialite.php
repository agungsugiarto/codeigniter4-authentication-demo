<?php

namespace Fluent\Socialite\Config;

use CodeIgniter\Config\BaseConfig;

class Socialite extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Third Party Services
     * --------------------------------------------------------------------------
     *
     * This file is for storing the credentials for third party services such
     * as Github, Facebook, Google and more. This file provides the de facto
     * location for this type of information, allowing packages to have
     * a conventional file to locate the various service credentials.
     */
    public $services = [
        'github'    => [
            'client_id'     => '',
            'client_secret' => '',
            'redirect'      => '',
        ],
        'facebook'  => [
            'client_id'     => '',
            'client_secret' => '',
            'redirect'      => '',
        ],
        'google'    => [
            'client_id'     => '',
            'client_secret' => '',
            'redirect'      => '',
        ],
        'linkedin'  => [
            'client_id'     => '',
            'client_secret' => '',
            'redirect'      => '',
        ],
        'bitbucket' => [
            'client_id'     => '',
            'client_secret' => '',
            'redirect'      => '',
        ],
        'gitlab'    => [
            'client_id'     => '',
            'client_secret' => '',
            'redirect'      => '',
        ],
    ];
}
