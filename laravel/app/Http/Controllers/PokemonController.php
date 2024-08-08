<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemons;

class PokemonController extends Controller
{
    public function index(Request $request)
    {
        $query = Pokemons::query();
        
        // Ensure only active Pokémons are fetched
        $query->where('active', true);

        // Filter by 'type' if provided
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // Apply search filter on 'name' and 'notes' if 'search' parameter is given
        if ($request->has('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                  ->orWhere('notes', 'like', '%' . $keyword . '%');
            });
        }

        // Retrieve and sort Pokémons by 'id'
        $pokemons = $query->orderBy('id', 'asc')->get();
        
        return view('pokemons.index', compact('pokemons'));
    }

    public function show($id)
    {
        // Retrieve the Pokémon by its ID
        $pokemon = Pokemons::findOrFail($id);
        
        // Return the view with Pokémon data
        return view('pokemons.show', compact('pokemon'));
    }

    public function create()
{
    return view('pokemons.create');
}

public function store(Request $request)
{
    $pokemon = new Pokemons($request->all());
    $pokemon->save();
    return redirect()->route('pokemons.index');
}

public function edit($id)
{
    $pokemon = Pokemons::findOrFail($id);
    return view('pokemons.edit', compact('pokemon'));
}

public function update(Request $request, $id)
{
    $pokemon = Pokemons::findOrFail($id);
    $pokemon->update($request->all());
    return redirect()->route('pokemons.index');
}
public function destroy($id)
{
    $pokemon = Pokemons::findOrFail($id);
    $pokemon->active = false;
    $pokemon->save();
    return redirect()->route('pokemons.index');
}
}
