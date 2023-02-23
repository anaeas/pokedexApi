<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CadastrarPokemonRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

    public function nomesImagens()
    {
        $pokemons = Pokemon::all(['id','nome','image']);
        $result['nomes'] = $pokemons->pluck('nome');
        foreach ($pokemons as $value) {
            $value->image = base64_encode(Storage::get($value->image));
        }
        $result['imagens'] = $pokemons->pluck('image');
        $result['ids'] = $pokemons->pluck('id');
        return response()->json($result);
    }

    public function detalhes(Request $request)
    {
        $pok = Pokemon::find($request->id);
        $pok->image = base64_encode(Storage::get($pok->image));
        return response()->json($pok);
    }


    public function cadastrar(CadastrarPokemonRequest $request)
    {
        // Recupera os dados do formulário
        $data = $request->all();

        // Salva a imagem do Pokemon
        $path = 'public/teste/' . time() . '.jpg';
        Storage::put($path, base64_decode($request['image']));

        $data['habilidade_1'] = ($data['habilidade_1'] == 'Selecione uma habilidade') ? NULL : $data['habilidade_1'];
        $data['habilidade_2'] = ($data['habilidade_2'] == 'Selecione uma habilidade') ? NULL : $data['habilidade_2'];
        $data['habilidade_3'] = ($data['habilidade_3'] == 'Selecione uma habilidade') ? NULL : $data['habilidade_3'];

        // Cria um novo Pokemon com os dados informados
        $pokemon = new Pokemon([
            'nome' => $data['nome'],
            'tipo' => $data['tipo'],
            'habilidade_1' => $data['habilidade_1'],
            'habilidade_2' => $data['habilidade_2'],
            'habilidade_3' => $data['habilidade_3'],
            'image' => $path,
        ]);

        // Salva o Pokemon no banco de dados
        $pokemon->save();

        // Retorna a resposta
        return response()->json(1);
    }

    public function pesquisaTipo(Request $request)
    {
        $pokemons = Pokemon::select('nome')->where('tipo', $request->tipo)->get();
        $result['nomes'] = $pokemons->pluck('nome');
        return response()->json($result);
    }

    public function pesquisaHabilidade(Request $request)
    {
        $pokemons = Pokemon::select('nome', 'habilidade_1', 'habilidade_2', 'habilidade_3')->where('habilidade_1', $request->habilidade)->orWhere('habilidade_2', $request->habilidade)->orWhere('habilidade_3', $request->habilidade)->get();
        $result['pokemons'] = $pokemons->pluck('nome');
        return response()->json($result);
    }

    public function quantPokemons()
    {
        $res = DB::select('SELECT COUNT(*) as quant FROM pokemon');
        return response()->json($res[0]->quant);
    }

    public function top3tipos()
    {
        $res = DB::select('SELECT tipo, COUNT(*) as quant FROM pokemon GROUP BY tipo ORDER BY quant DESC LIMIT 3');
        foreach ($res as $value) {
            $result['tipos'][] = $value->tipo;
        }
        return response()->json($result);
    }

    public function top3habilidades()
    {
        $res = DB::select('SELECT habilidade, COUNT(*) as quant FROM (SELECT habilidade_1 as habilidade FROM pokemon UNION ALL SELECT habilidade_2 FROM pokemon UNION ALL SELECT habilidade_3 FROM pokemon) as result WHERE habilidade is not NULL GROUP BY habilidade ORDER BY quant DESC LIMIT 3');
        foreach ($res as $value) {
            $result['habilidades'][] = $value->habilidade;
        }
        return response()->json($result);
    }
}
