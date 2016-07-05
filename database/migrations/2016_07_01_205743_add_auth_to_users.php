<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuthToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('birthday')->default("00/00/00");
			$table->string('name')->default("")->change();
			$table->string('address')->default("")->change();
			$table->string('city')->default("")->change();
			$table->string('state')->default("")->change();
			$table->string('zip')->default("")->change();
			$table->string('phone')->default("")->change();
			$table->dropColumn(['day', 'month', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
