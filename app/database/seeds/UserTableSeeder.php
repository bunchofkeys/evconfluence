<?php


class UserTableSeeder extends Seeder {

	public function run()
	{
		$user = new user();
		$user->email = 'admin@test.com';
		$user->first_name = 'name';
		$user->last_name = 'name';
		$user->password = Hash::make('b');
		$user->role = 'Admin';
		$user->status = 'Approved';
		$user->save();
	}

}