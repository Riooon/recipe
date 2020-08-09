<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->integer('recipe_id');
            $table->string('ingredient_1');
            $table->string('ingredient_2');
            $table->string('ingredient_3');
            $table->string('ingredient_4');
            $table->string('ingredient_5');
            $table->string('ingredient_6');
            $table->string('ingredient_7');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients');
    }
}
