<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

	public function run()
	{

		\App\User::create([
			'first' => 'Admin',
			'last' => 'User',
			'username' => 'admin_user',
			'email' => 'admin@admin.com',
			'password' => bcrypt('admin'),
			'confirmed' => 1,
			'admin' => 1,
			'confirmation_code' => md5(microtime() . env('APP_KEY')),
		]);

		\App\User::create([
			'first' => 'Test',
			'last' => 'User',
			'username' => 'test_user',
			'email' => 'user@user.com',
			'password' => bcrypt('user'),
			'confirmed' => 1,
			'confirmation_code' => md5(microtime() . env('APP_KEY')),
		]);

		\App\User::create([
			'first' => 'Anton',
			'last' => 'Alexander',
			'username' => 'DMVevents',
			'email' => 'dmvevents@gmail.com',
			'password' => bcrypt('password'),
			'dob' => '1985-06-26',
			'gender' =>'male',
			'instagram' =>'dmvevents',
			'twitter' =>'dmvevents',
			'facebook' =>'dmvevents1',

			'confirmed' => 1,
			'confirmation_code' => md5(microtime() . env('APP_KEY')),
		]);

	}

}
