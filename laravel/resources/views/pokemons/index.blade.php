<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon List</title>
    <style>
        .delete-button, .edit-button {
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .delete-button {
            background-color: red;
        }
        .edit-button {
            background-color: blue;
        }
    </style>
</head>
<body>
    <h1>Pokemon List</h1>
    <ul>
        @foreach ($pokemons as $pokemon)
            <li>
                {{ $pokemon->number }} - {{ $pokemon->name }} -  {{ $pokemon->image }} -  {{ $pokemon->first_game }} -  {{ $pokemon->designed_by }} - {{ $pokemon->species }} -  {{ $pokemon->type }} -  {{ $pokemon->notes }}
                <!-- Edit Button -->
                <a href="{{ route('pokemons.edit', $pokemon->id) }}" class="edit-button">Edit</a>
                <!-- Delete Form -->
                <form action="{{ route('pokemons.destroy', $pokemon->id) }}" method="post" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to deactivate this Pokémon?');">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
