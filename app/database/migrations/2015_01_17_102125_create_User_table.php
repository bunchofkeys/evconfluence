<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('email', 100)->unique();
			$table->string('password');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('school')->nullable();
			$table->string('unit_required_for')->nullable();
			$table->string('role');
			$table->string('status');
			$table->rememberToken();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user');
	}

}
