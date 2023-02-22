<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->where('password', $credentials['password'])->first();

        if ($user) {
            return response()->json(['message' => 'Login realizado com sucesso']);
        } else {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }
    }
}
