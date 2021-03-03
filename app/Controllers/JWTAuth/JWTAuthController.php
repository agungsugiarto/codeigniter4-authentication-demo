<?php

namespace App\Controllers\JWTAuth;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class JWTAuthController extends BaseController
{
    use ResponseTrait;

    /**
     * Get a JWT via given credentials.
     *
     * @return \CodeIgniter\Http\Response
     */
    public function login()
    {
        // Validate this credentials request.
        if (! $this->validate(['email' => 'required|valid_email', 'password' => 'required'])) {
            return $this->fail($this->validator->getErrors());
        }

        $credentials = [
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password')
        ];

        if (! $token = auth('api')->attempt($credentials)) {
            return $this->fail(lang('Auth.failed'), 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \CodeIgniter\Http\Response
     */
    public function user()
    {
        return $this->response->setJson(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \CodeIgniter\Http\Response
     */
    public function logout()
    {
        auth('api')->logout();

        return $this->response->setJson(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \CodeIgniter\Http\Response
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \CodeIgniter\Http\Response
     */
    protected function respondWithToken($token)
    {
        return $this->response->setJson([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60,
        ]);
    }
}