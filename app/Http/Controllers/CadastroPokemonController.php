<?php

namespace App\Http\Controllers;
use App\Models\Pokemon;
use Illuminate\Support\Facades\Http;


use Illuminate\Http\Request;

class CadastroPokemonController extends Controller
{


    public function store(Request $request)
    {
        // Recupera os dados do formulário
        $data = $request->all();

        // Salva a imagem do Pokemon
        $imagem = $request->file('image')->store('public/pokemons');

        // Cria um novo Pokemon com os dados informados
        $pokemon = new Pokemon([
            'nome' => $data['nome'],
            'tipo' => $data['tipo'],
            'habilidade_1' => $data['habilidade_1'],
            'habilidade_2' => $data['habilidade_2'],
            'habilidade_3' => $data['habilidade_3'],
            'image' => $imagem,
        ]);

        // Salva o Pokemon no banco de dados
        $pokemon->save();

        // Retorna a resposta
        return response()->json([
            'message' => 'Pokemon cadastrado com sucesso',
            'data' => $pokemon,
        ]);
    }
}
