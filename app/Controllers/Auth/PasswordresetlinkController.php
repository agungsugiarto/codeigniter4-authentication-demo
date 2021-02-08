<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use Fluent\Auth\Config\Services;
use Fluent\Auth\Contracts\PasswordBrokerInterface;

class PasswordresetlinkController extends BaseController
{
    /**
     * Display the password reset link request view.
     *
     * @return \CodeIgniter\View\View
     */
    public function new()
    {
        return view('Auth/forgot_password');
    }

    /**
     * Handle an incomming password reset link request.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function create()
    {
        $request = (object) $this->request->getPost();

        if (! $this->validate(['email' => 'required|valid_email'])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Services::passwords()->sendResetLink([
            'email' => $request->email,
        ]);

        return $status === PasswordBrokerInterface::RESET_LINK_SENT
            ? redirect()->back()->with('message', lang($status))
            : redirect()->back()->withInput()->with('error', lang($status));
    }
}
