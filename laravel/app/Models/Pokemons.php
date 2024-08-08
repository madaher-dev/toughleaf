<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemons extends Model
{
    use HasFactory;

    protected $fillable = [
        'number', 'name', 'image', 'first_game', 'designed_by', 'species', 'type', 'notes'
    ];

    public $timestamps = false;
}
