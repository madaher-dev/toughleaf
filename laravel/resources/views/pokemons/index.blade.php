<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon List</title>
</head>
<body>
    <h1>Pokemon List</h1>
    <ul>
        @foreach ($pokemons as $pokemon)
            <li>{{ $pokemon->number }} - {{ $pokemon->name }}</li>
        @endforeach
    </ul>
</body>
</html>