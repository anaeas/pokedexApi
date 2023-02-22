<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PokemonController extends Controller
{
    public function index()
    {
        $pokemons = Pokemon::all();

        //codifica as imagens em base64
        foreach ($pokemons as $value) {
            $value->image = base64_encode(Storage::get($pokemons[0]->image));
        }

        return response()->json($pokemons);
    }


    public function store(Request $request)
    {
        // Recupera os dados do formulário
        $data = $request->all();

        // Salva a imagem do Pokemon
        $imagem = $request->file('image')->store('pokemons');

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
