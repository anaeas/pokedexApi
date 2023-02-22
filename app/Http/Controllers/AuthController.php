<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('login', 'password');
        $user = User::where('email', $credentials['login'])->where('password', $credentials['password'])->first();

        if ($user) {
            return response()->json(1);
        } else {
            return response()->json(0);
        }
    }
}
