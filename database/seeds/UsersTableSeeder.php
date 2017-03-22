<?php

use Illuminate\Database\Seeder;

// use Faker\Factory;

class UsersTableSeeder extends Seeder
{
  public function run()
  {
    DB::table('users')->insert([
      'id'         => 1000000, // init
      'fname'      => 'Administrator',
      'lname'      => 'User',
      'email'      => 'administrator@gmail.com',
      'password'   => bcrypt('123456'),
      'role'       => 'administrator',
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);
  }
}
