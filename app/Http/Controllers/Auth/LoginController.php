<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        $msg = 'Incorrect credentials';

        abort_if(is_null($user), Response::HTTP_UNPROCESSABLE_ENTITY, $msg);

        abort_if(!Hash::check($request->password, $user->password), Response::HTTP_UNPROCESSABLE_ENTITY, $msg);

        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        return response()->json([
            'token' => $token
        ]);
    }
}
