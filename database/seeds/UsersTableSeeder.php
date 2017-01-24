<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
  public function run()
  {
    DB::table('users')->insert([
      'id' => 1000000000, // init
      'fname' => 'Dave Dane',
      'lname' => 'Pacilan',
      'email' => 'davedanepacilan3p@gmail.com',
      'password' => bcrypt('123456'),
      'role' => 'admin',
      'api_token' => str_random(60),
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('users')->insert([
      'fname' => 'Chiarra',
      'lname' => 'Sebial',
      'email' => 'chiarra@gmail.com',
      'password' => bcrypt('123456'),
      'role' => 'moderator',
      'api_token' => str_random(60),
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('users')->insert([
      'fname' => 'Maria Divina',
      'mname' => 'Alterejos',
      'lname' => 'Alegre',
      'email' => 'iya@gmail.com',
      'password' => bcrypt('123456'),
      'role' => 'student',
      'api_token' => str_random(60),
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('users')->insert([
      'fname' => 'Rachel Anne',
      'mname' => 'Agravante',
      'lname' => 'Quiamco',
      'email' => 'rachel@gmail.com',
      'password' => bcrypt('123456'),
      'role' => 'student',
      'api_token' => str_random(60),
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);
  }
}
