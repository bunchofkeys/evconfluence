<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTemporaryLinkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('temporary_link', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('link_code');
			$table->string('reference_table');
			$table->string('reference_id');
			$table->dateTime('start_date');
			$table->dateTime('end_date');
			$table->boolean('active');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('temporary_link');
	}

}
