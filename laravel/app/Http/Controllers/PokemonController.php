<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemons;

class PokemonController extends Controller
{
    public function index()
    {
        // Sort Pokémons by their 'id' in ascending order
        $pokemons = Pokemons::orderBy('id', 'asc')->get();
        return view('pokemons.index', compact('pokemons'));
    }
}
