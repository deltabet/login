<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotalToScorecolors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scoreColors', function (Blueprint $table) {
            $table->integer('scout')->default(-1);
			$table->integer('scin')->default(-1);
			$table->integer('sctotal')->default(-1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scoreColors', function (Blueprint $table) {
            //
        });
    }
}
