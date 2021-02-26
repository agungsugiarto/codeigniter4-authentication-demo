<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        /**	
         * Example using guard and driver implementation,
         * now we can call this guard example.	
         * 	
         * dd(\Fluent\Auth\Facades\Auth::guard('example'));	
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
