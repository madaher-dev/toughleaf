<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokemonsTable extends Migration
{
    public function up()
    {

Schema::create('pokemons', function (Blueprint $table) {
    $table->id();
    $table->string('number');
    $table->string('name');
});

    }

    public function down()
    {
        Schema::dropIfExists('pokemons');
    }
}
