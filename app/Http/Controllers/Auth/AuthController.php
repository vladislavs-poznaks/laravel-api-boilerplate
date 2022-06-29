<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function token(string $email, string $password)
    {
        $url = config('app.url') . route('passport.token', [], false);

        try {
            $response = Http::post($url, [
                'grant_type' => 'password',
                'client_id' => config('services.passport.client_id'),
                'client_secret' => config('services.passport.client_secret'),
                'username' => $email,
                'password' => $password
            ]);
        } catch (BadResponseException $e) {
            if ($e->getCode() === Response::HTTP_UNAUTHORIZED) {
                return response()->json('Incorrect credentials.');
            }

            return response()->json($e->getMessage(), $e->getCode());
        }

        return $response;
    }
}
