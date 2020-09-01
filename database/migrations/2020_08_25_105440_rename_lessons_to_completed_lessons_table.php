<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameLessonsToCompletedLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('completed_lessons', function (Blueprint $table) {
            //
            Schema::rename('lessons', 'completed_lessons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('completed_lessons', function (Blueprint $table) {
            //
            Schema::rename('completed_lessons', 'lessons');
        });
    }
}