<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticação bem-sucedida
            return response()->json(['message' => 'Login realizado com sucesso']);
        } else {
            // Autenticação falhou
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

    }
}
