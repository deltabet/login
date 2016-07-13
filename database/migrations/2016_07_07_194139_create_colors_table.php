<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
			$table->integer('course_id');
			$table->string('color')->default("");
			$table->integer('slope')->default(-1);
			$table->integer('dis1')->default(-1);
			$table->integer('dis2')->default(-1);
			$table->integer('dis3')->default(-1);
			$table->integer('dis4')->default(-1);
			$table->integer('dis5')->default(-1);
			$table->integer('dis6')->default(-1);
			$table->integer('dis7')->default(-1);
			$table->integer('dis8')->default(-1);
			$table->integer('dis9')->default(-1);
			$table->integer('dis10')->default(-1);
			$table->integer('dis11')->default(-1);
			$table->integer('dis12')->default(-1);
			$table->integer('dis13')->default(-1);
			$table->integer('dis14')->default(-1);
			$table->integer('dis15')->default(-1);
			$table->integer('dis16')->default(-1);
			$table->integer('dis17')->default(-1);
			$table->integer('dis18')->default(-1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('colors');
    }
}
