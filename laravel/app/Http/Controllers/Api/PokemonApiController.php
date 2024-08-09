<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pokemons;

class PokemonApiController extends Controller
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
        
        return response()->json($pokemons);
    }

    public function show($id)
    {
        $pokemon = Pokemons::findOrFail($id);
        return response()->json($pokemon);
    }

    public function store(Request $request)
    {
        $pokemon = new Pokemons($request->all());
        $pokemon->save();
        return response()->json($pokemon, 201); // 201 Created
    }

    public function update(Request $request, $id)
    {
        $pokemon = Pokemons::findOrFail($id);
        $pokemon->update($request->all());
        return response()->json($pokemon);
    }

    public function destroy($id)
    {
        $pokemon = Pokemons::findOrFail($id);
        $pokemon->delete(); // Assuming 'delete' is the desired action rather than deactivating
        return response()->json(['message' => 'Pokemon deleted successfully']);
    }
}
