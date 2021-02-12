<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        /**
         * Example using service with method extend to driver,
         * see service at \app\Config\Services.
         * 
         * d(\Config\Services::example()->guard('extend'));
         */

        /**
         * Example using driver already directly in config. Since codeigniter4 don't have dependency
         * injection like container, i am recommend this way because is shortly syntax.
         * 
         * d(\Fluent\Auth\Facades\Auth::guard('example'));
         */
        return view('welcome_message');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function confirm()
    {
        return 'granted password';
    }
}
