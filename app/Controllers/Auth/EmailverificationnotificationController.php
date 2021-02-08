<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use Fluent\Auth\Config\Services;
use Fluent\Auth\Contracts\PasswordBrokerInterface;

class EmailverificationnotificationController extends BaseController
{
    /**
     * Send a new verification notification.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function create()
    {
        $user = auth()->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        $status = Services::passwords()->sendVerifyLink([
            'email' => $user->email,
        ]);

        return $status === PasswordBrokerInterface::VERIFY_LINK_SENT
            ? redirect()->back()->with('message', lang($status))
            : redirect()->back()->with('error', lang($status));
    }
}
