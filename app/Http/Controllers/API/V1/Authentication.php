<?php

namespace App\Http\Controllers\API\V1;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class Authentication extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate(['email' => 'required|email', 'password' => 'required']);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ["Les informations d'authentification sont incorrects."],
            ]);
        }

        $user = $request->user();

        dd($user);

        return $user->createToken($request->device_name)->plainTextToken;
    }
}
