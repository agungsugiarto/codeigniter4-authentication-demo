<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Exception;
use Fluent\Auth\Facades\Auth;
use Fluent\Socialite\Facades\Socialite;

class SocialiteController extends BaseController
{
    /** @var UserModel */
    protected $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function redirectProvider(string $provider)
    {
        try {
            return Socialite::driver($provider)->redirect();
        } catch (Exception $e) {
            return redirect()->to('login')->with('errors', [$e->getMessage()]);
        }
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database. If the user exists,
     * log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function providerCallback(string $provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            
            $authUser = $this->model->firstOrCreate(
                ['provider_id' => $user->getId()],
                [
                    'username' => $user->getNickname(),
                    'email'    => $user->getEmail(),
                    'provider' => $provider,
                ]
            );
        } catch (Exception $e) {
            return redirect()->to('login')->with('errors', [$e->getMessage()]);
        }

        Auth::login($authUser, true);

        return redirect(config('Auth')->home)->withCookies();
    }
}
