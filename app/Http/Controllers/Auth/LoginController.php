<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;

class LoginController extends AuthController
{
    public function login(LoginRequest $request)
    {
        return $this->token($request->email, $request->password);
    }
}
