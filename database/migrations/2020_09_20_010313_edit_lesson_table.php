<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            //
            $table->dropColumn('ingredient_0');
            $table->dropColumn('ingredient_1');
            $table->dropColumn('ingredient_2');
            $table->dropColumn('ingredient_3');
            $table->dropColumn('ingredient_4');
            $table->dropColumn('ingredient_5');
            $table->dropColumn('ingredient_6');
            $table->dropColumn('ingredient_7');
            $table->dropColumn('ingredient_8');
            $table->dropColumn('ingredient_9');
            $table->dropColumn('process_0');
            $table->dropColumn('process_1');
            $table->dropColumn('process_2');
            $table->dropColumn('process_3');
            $table->dropColumn('process_4');
            $table->dropColumn('process_5');
            $table->dropColumn('process_6');
            $table->dropColumn('process_7');
            $table->dropColumn('process_8');
            $table->dropColumn('process_9');
            $table->integer('recipe_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lessons', function (Blueprint $table) {
            //
            $table->string('ingredient_0')->nullable();
            $table->string('ingredient_1')->nullable();
            $table->string('ingredient_2')->nullable();
            $table->string('ingredient_3')->nullable();
            $table->string('ingredient_4')->nullable();
            $table->string('ingredient_5')->nullable();
            $table->string('ingredient_6')->nullable();
            $table->string('ingredient_7')->nullable();
            $table->string('ingredient_8')->nullable();
            $table->string('ingredient_9')->nullable();
            $table->string('process_0')->nullable();
            $table->string('process_1')->nullable();
            $table->string('process_2')->nullable();
            $table->string('process_3')->nullable();
            $table->string('process_4')->nullable();
            $table->string('process_5')->nullable();
            $table->string('process_6')->nullable();
            $table->string('process_7')->nullable();
            $table->string('process_8')->nullable();
            $table->string('process_9')->nullable();
            $table->dropColumn('recipe_id');
        });
    }
}
