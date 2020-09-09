<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToLessonsTable extends Migration
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
            $table->string('hd_img');
            $table->string('ingredient_0');
            $table->string('ingredient_1')->nullable();
            $table->string('ingredient_2')->nullable();
            $table->string('ingredient_3')->nullable();
            $table->string('ingredient_4')->nullable();
            $table->string('ingredient_5')->nullable();
            $table->string('ingredient_6')->nullable();
            $table->string('ingredient_7')->nullable();
            $table->string('ingredient_8')->nullable();
            $table->string('ingredient_9')->nullable();
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
            $table->dropColumn('hd_img');
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
        });
    }
}
