<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class EmailverificationPromptController extends BaseController
{
    /**
     * Display the email verification prompt.
     *
     * @return mixed
     */
    public function new()
    {
        return auth()->user()->hasVerifiedEmail()
            ? redirect()->route('dashboard')
            : view('Auth/verify_email');
    }
}
