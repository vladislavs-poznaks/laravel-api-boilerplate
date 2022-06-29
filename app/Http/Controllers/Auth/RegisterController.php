<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

class RegisterController extends AuthController
{
    public function register(RegisterRequest $request)
    {
        User::create($request->validated());

        return $this->token($request->email, $request->password);
    }
}
