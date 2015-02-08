<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form', function(Blueprint $table)
		{
			$table->increments('form_id');
			$table->string('period_id',10);
			$table->dateTime('start_date_time');
			$table->dateTime('end_date_time');
			$table->string('status');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('form');
	}

}
