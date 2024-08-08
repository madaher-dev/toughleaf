<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;

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
    return view('welcome');
});

// Show the form to create a new Pokémon first
Route::get('/pokemons/create', [PokemonController::class, 'create'])->name('pokemons.create');

// Routes that interpret '{id}' or other parameters should come after specific routes
Route::get('/pokemons', [PokemonController::class, 'index'])->name('pokemons.index');
Route::get('/pokemons/{id}', [PokemonController::class, 'show'])->name('pokemons.show');
Route::post('/pokemons', [PokemonController::class, 'store'])->name('pokemons.store');
Route::get('/pokemons/{id}/edit', [PokemonController::class, 'edit'])->name('pokemons.edit');
Route::put('/pokemons/{id}', [PokemonController::class, 'update'])->name('pokemons.update');
Route::delete('/pokemons/{id}', [PokemonController::class, 'destroy'])->name('pokemons.destroy');
