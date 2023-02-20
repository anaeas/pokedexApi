<?php

namespace App\Http\Controllers;
use App\Http\Controller\AuthController;
use App\Models\Treinador;
use App\Models\Pokemon;
use App\Models\User;

use Illuminate\Http\Request;

class CadastroController extends Controller
{
    public function cadastroDoTreinador()
    {
        return view('cadastro');
    }

    public function salvarCadastro(Request $request)
{
    $request->validate([
        'nome' => 'required|max:255',
        'email' => 'required|email|unique:users,email',
        'senha' => 'required|min:6',
    ]);

    $senhaCriptografada = bcrypt($request->input('senha'));
    $treinador = new User();
    $treinador->name = $request->input('nome');
    $treinador->email = $request->input('email');
    $treinador->password = $senhaCriptografada;
    $treinador->save();

    return redirect('/cadastro')->with('sucesso', 'Treinador cadastrado com sucesso!');
}
}
