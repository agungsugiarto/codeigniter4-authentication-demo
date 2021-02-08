<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use Fluent\Auth\Config\Services;

class AuthenticatedsessionController extends BaseController
{
    /**
     * Display the login view.
     *
     * @return \CodeIgniter\View\View
     */
    public function new()
    {
        return view('Auth\login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @return \CodeIgniter\Http\RedirectResponse
     */
    public function create()
    {
        $request = (object) $this->request->getPost();

        $credentials = ['email' => $request->email, 'password' => $request->password];
        $remember    = $this->filled('remember');

        if (! $this->validate(['email' => 'required|valid_email', 'password' => 'required'])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if (! Services::auth()->attempt($credentials, $remember)) {
            return redirect()->back()->withInput()->with('error', lang('Auth.failed'));
        }

        return redirect('dashboard')->withCookies();
    }

    /**
     * Destroy an authenticated session.
     *
     * @return \CodeIgniter\Http\RedirectResponse
     */
    public function delete()
    {
        Services::auth()->logout();

        return redirect('/')->withCookies();
    }

    /**
     * Determine if the request contains a non-empty value for an input item.
     *
     * @param  string|array  $key
     * @return bool
     */
    protected function filled($key)
    {
        $keys = is_array($key) ? $key : func_get_args();

        foreach ($keys as $value) {
            if ($this->isEmptyString($value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Determine if the given input key is an empty string for "has".
     *
     * @param  string  $key
     * @return bool
     */
    protected function isEmptyString($key)
    {
        $value = $this->request->getVar($key);

        return ! is_bool($value) && ! is_array($value) && trim((string) $value) === '';
    }
}
