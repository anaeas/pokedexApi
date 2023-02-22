<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CadastrarPokemonRequest;

class PokemonController extends Controller
{
    public function index()
    {
        $pokemons = Pokemon::all();

        //codifica as imagens em base64
        foreach ($pokemons as $value) {
            $value->image = base64_encode(Storage::get($value->image));
        }

        return response()->json($pokemons);
    }


    public function cadastrar(CadastrarPokemonRequest $request)
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
            'success' => 'true',
            'message' => 'Pokemon cadastrado com sucesso',
            'data' => $pokemon,
        ]);
    }

    public function pesquisaTipo(Request $request)
    {
        $pokemons = Pokemon::select('nome','tipo')->where('tipo', $request->tipo)->get();
        return response()->json($pokemons);
    }

    public function pesquisaHabilidade(Request $request)
    {
        $pokemons = Pokemon::select('nome','habilidade_1','habilidade_2','habilidade_3')->where('habilidade_1', $request->habilidade)->orWhere('habilidade_2', $request->habilidade)->orWhere('habilidade_3', $request->habilidade)->get();
        return response()->json($pokemons);
    }
}
