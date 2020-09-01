<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCompletedLessonIdToLessonIdOnCompletedLessonsTable extends Migration
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
            $table->renameColumn('completed_lesson_id', 'lesson_id');
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
            $table->renameColumn('lesson_id', 'completed_lesson_id');
        });
    }
}
