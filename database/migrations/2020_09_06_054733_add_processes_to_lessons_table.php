<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProcessesToLessonsTable extends Migration
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
            $table->string('process_0');
            $table->string('process_1')->nullable();
            $table->string('process_2')->nullable();
            $table->string('process_3')->nullable();
            $table->string('process_4')->nullable();
            $table->string('process_5')->nullable();
            $table->string('process_6')->nullable();
            $table->string('process_7')->nullable();
            $table->string('process_8')->nullable();
            $table->string('process_9')->nullable();
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
        });
    }
}
