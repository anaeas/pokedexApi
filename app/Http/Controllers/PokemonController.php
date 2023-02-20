<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use App\Models\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function index()
    {
        $response = Pokemon::all();
        $pokemons = $response->toArray();

        return view('index', ['pokemons' => $pokemons]);
    }

    /* public function index()
    {
        $pokemons = Pokemon::all();
        return response()->json($pokemons);
    } */



}
