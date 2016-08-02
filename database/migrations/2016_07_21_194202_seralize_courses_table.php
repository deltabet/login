<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeralizeCoursesTable extends Migration
{
	
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		
       /* Schema::table('courses', function (Blueprint $table) {
            for ($i = 1; $i <= 18; $i++){
				$table->dropColumn('par' . $i);
				$table->dropColumn('hdcp' . $i);
			}
			$table->json('par')->default('[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]');
			$table->json('hdcp')->default('[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]');
        });*/

		Schema::table('colors', function (Blueprint $table) {
            for ($i = 1; $i <= 18; $i++){
				$table->dropColumn('dis' . $i);
			}
			$table->json('dis')->default('[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]');
        });

		Schema::table('scoreColors', function (Blueprint $table) {
            for ($i = 1; $i <= 18; $i++){
				$table->dropColumn('sc' . $i);
			}
			$table->json('sc')->default('[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]');
        });	
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            //
        });
    }
}
