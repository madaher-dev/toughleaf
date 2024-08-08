<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pokémon</title>
</head>
<body>
<div style="margin: 20px;">
    <h1>Create New Pokémon</h1>
    <form action="{{ route('pokemons.store') }}" method="post">
        @csrf
        <div>
            <label for="number">Number:</label>
            <input type="text" id="number" name="number" required>
        </div>
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <button type="submit">Create Pokémon</button>
    </form>
</div>
</body>
</html>
