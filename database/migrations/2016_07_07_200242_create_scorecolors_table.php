<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScorecolorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scoreColors', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
			$table->integer('score_id')->default(-1);
			$table->string('color')->default("");
			$table->integer('sc1')->default(-1);
			$table->integer('sc2')->default(-1);
			$table->integer('sc3')->default(-1);
			$table->integer('sc4')->default(-1);
			$table->integer('sc5')->default(-1);
			$table->integer('sc6')->default(-1);
			$table->integer('sc7')->default(-1);
			$table->integer('sc8')->default(-1);
			$table->integer('sc9')->default(-1);
			$table->integer('sc10')->default(-1);
			$table->integer('sc11')->default(-1);
			$table->integer('sc12')->default(-1);
			$table->integer('sc13')->default(-1);
			$table->integer('sc14')->default(-1);
			$table->integer('sc15')->default(-1);
			$table->integer('sc16')->default(-1);
			$table->integer('sc17')->default(-1);
			$table->integer('sc18')->default(-1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('scoreColors');
    }
}
