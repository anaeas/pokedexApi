<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\CadastroPokemonController;
use App\Http\Controllers\PokemonController;
use App\Http\Controller\AuthController;
use App\Http\Controllers\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return 'Hello World';
});
Route::get('cadastro', [CadastroController::class, 'cadastroDoTreinador']);
Route::post('cadastro', [CadastroController::class, 'salvarCadastro']);


Route::get('pokemons', [PokemonController::class, 'index']);
