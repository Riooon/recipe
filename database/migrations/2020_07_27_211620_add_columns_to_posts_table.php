<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPostsTable extends Migration
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
            $table->string('img2')->nullable();
            $table->string('desc2')->nullable();
            $table->string('img3')->nullable();
            $table->string('desc3')->nullable();
            $table->string('img4')->nullable();
            $table->string('desc4')->nullable();
            $table->string('img5')->nullable();
            $table->string('desc5')->nullable();
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //
        });
    }
}
