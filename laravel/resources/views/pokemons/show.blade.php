<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Details</title>
    <!-- You can add your CSS files here if needed -->
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: 20px auto; }
        img { max-width: 300px; }
        .btn-primary { background-color: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; }
        .btn-primary:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $pokemon->name }}</h1>
        <div>
            <img src="{{ $pokemon->image }}" alt="Image of {{ $pokemon->name }}">
        </div>
        <p><strong>Number:</strong> {{ $pokemon->number }}</p>
        <p><strong>Type:</strong> {{ $pokemon->type }}</p>
        <p><strong>Species:</strong> {{ $pokemon->species }}</p>
        <p><strong>First Game:</strong> {{ $pokemon->first_game }}</p>
        <p><strong>Designed By:</strong> {{ $pokemon->designed_by }}</p>
        <p><strong>Description:</strong> {{ $pokemon->notes }}</p>
        <p><strong>Active:</strong> {{ $pokemon->active ? 'Yes' : 'No' }}</p>

        <a href="{{ route('pokemons.index') }}" class="btn-primary">Back to List</a>
    </div>
</body>
</html>
