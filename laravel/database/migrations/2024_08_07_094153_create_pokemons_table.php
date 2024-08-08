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
            $table->string('image')->nullable();
            $table->string('first_game')->nullable();
            $table->string('designed_by')->nullable();
            $table->string('species')->nullable();
            $table->string('type')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('active')->default(true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pokemons');
    }
}
