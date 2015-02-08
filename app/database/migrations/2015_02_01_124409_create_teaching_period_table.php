<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeachingPeriodTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teaching_period', function(Blueprint $table)
		{
			$table->increments('period_id');
			$table->integer('user_id')->unsigned();
			$table->string('unit_code', 6);
			$table->integer('year')->unsigned();
			$table->string('semester_code',4);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('teaching_period');
	}

}
