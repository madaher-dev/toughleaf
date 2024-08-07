<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemons; 


class PokemonController extends Controller
{
    public function index()
    {
        $pokemons = Pokemons::all();
        return view('pokemons.index', compact('pokemons'));
    }
}