<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pokémon</title>
</head>
<body>
<div style="margin: 20px;">
    <h1>Edit Pokémon</h1>
    <form action="{{ route('pokemons.update', $pokemon->id) }}" method="post">
        @csrf
        @method('PUT')

        <div>
            <label for="number">Number:</label>
            <input type="text" id="number" name="number" value="{{ $pokemon->number }}" required>
        </div>

        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $pokemon->name }}" required>
        </div>

        <div>
            <label>Image:</label>
            <span>{{ $pokemon->image }}</span>
        </div>

        <div>
            <label>First Game:</label>
            <span>{{ $pokemon->first_game }}</span>
        </div>

        <div>
            <label>Designed By:</label>
            <span>{{ $pokemon->designed_by }}</span>
        </div>

        <div>
            <label>Species:</label>
            <span>{{ $pokemon->species }}</span>
        </div>

        <div>
            <label>Type:</label>
            <span>{{ $pokemon->type }}</span>
        </div>

        <div>
            <label>Notes:</label>
            <span>{{ $pokemon->notes }}</span>
        </div>

        <div>
            <label>Active:</label>
            <span>{{ $pokemon->active ? 'Yes' : 'No' }}</span>
        </div>

        <button type="submit">Update Pokémon</button>
    </form>
</div>
</body>
</html>
