<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        $token = $request->user()->token();

        $token->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
