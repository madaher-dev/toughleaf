<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PokemonApiController;  

// API route to list all Pokemons
Route::get('/pokemons', [PokemonApiController::class, 'index'])->name('api.pokemons.index');

// API route to get a single Pokemon by name
Route::get('/pokemons/name/{name}', [PokemonApiController::class, 'showName'])->name('api.pokemons.showName');

// API route to get a single Pokemon by ID
Route::get('/pokemons/{id}', [PokemonApiController::class, 'show'])->name('api.pokemons.show');



// API route to create a new Pokemon
Route::post('/pokemons', [PokemonApiController::class, 'store'])->name('api.pokemons.store');

// API route to update a Pokemon
Route::put('/pokemons/{id}', [PokemonApiController::class, 'update'])->name('api.pokemons.update');

// API route to delete a Pokemon
Route::delete('/pokemons/{id}', [PokemonApiController::class, 'destroy'])->name('api.pokemons.destroy');
