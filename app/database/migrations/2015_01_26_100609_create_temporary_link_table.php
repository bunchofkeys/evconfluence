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
			$table->increments('link_id');
			$table->dateTime('startDateTime');
			$table->dateTime('endDateTime');
			$table->boolean('active');
			$table->string('token', 100);
			$table->integer('person_id')->unsigned();
			$table->string('action', 100);
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
