<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubmissionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('submission', function(Blueprint $table)
		{
			$table->increments('submission_id');
			$table->integer('form_id');
			$table->integer('student_id');
			$table->boolean('alert');
			$table->string('status');
			$table->dateTime('submission_date_time');

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('submission');
	}

}
