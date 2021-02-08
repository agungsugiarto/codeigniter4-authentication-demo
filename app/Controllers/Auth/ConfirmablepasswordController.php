<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use Fluent\Auth\Config\Services;
use Fluent\Auth\Facades\Auth;

class ConfirmablepasswordController extends BaseController
{
    /**
     * Show the confirm password view.
     *
     * @return \CodeIgniter\View\View
     */
    public function show()
    {
        return view('Auth\confirm_password');
    }

    /**
     * Confirm the users password.
     *
     * @return mixed
     */
    public function create()
    {
        $request = (object) $this->request->getPost();

        if (
            ! Services::auth()->validate([
            'email' => auth()->user()->email,
            'password' => $request->password,
            ])
        ) {
            return redirect()->back()->with('error', lang('Auth.password'));
        }

        session()->set('password_confirmed_at', time());

        return redirect()->route('dashboard');
    }
}
