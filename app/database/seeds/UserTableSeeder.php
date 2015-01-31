<?php


class UserTableSeeder extends Seeder {

	public function run()
	{
		$person = new Person();
		$user = new User();

		// create user
		$person->first_name = 'admin';
		$person->last_name = 'admin';
		$person->email = 'foofangliang87@gmail.com';
		$person->save();

		$user->username = $person->email;
		$user->password = Hash::make('b');
		$user->status = 'Approved';
		$user->role = 'Admin';
		$user->person_id = $person->person_id;
		$user->save();
	}

}