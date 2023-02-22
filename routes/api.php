<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\TesteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::get('listaPokemon', [PokemonController::class, 'index']);
Route::post('registroPokemon', [PokemonController::class, 'cadastrar']);



Route::get('testeget', [TesteController::class, 'testeget']);
Route::get('testelista', [TesteController::class, 'testelista']);
Route::post('testepost', [TesteController::class, 'testepost']);
Route::post('testelogin', [TesteController::class, 'testelogin']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});