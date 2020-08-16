<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
            $table->dropColumn('img6');
            $table->dropColumn('desc6');
            $table->dropColumn('img7');
            $table->dropColumn('desc7');
            $table->dropColumn('img8');
            $table->dropColumn('desc8');
            $table->dropColumn('img9');
            $table->dropColumn('desc9');
            $table->dropColumn('img10');
            $table->dropColumn('desc10');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
            $table->string('img6')->nullable();
            $table->string('desc6')->nullable();
            $table->string('img7')->nullable();
            $table->string('desc7')->nullable();
            $table->string('img8')->nullable();
            $table->string('desc8')->nullable();
            $table->string('img9')->nullable();
            $table->string('desc9')->nullable();
            $table->string('img10')->nullable();
            $table->string('desc10')->nullable();
        });
    }
}
