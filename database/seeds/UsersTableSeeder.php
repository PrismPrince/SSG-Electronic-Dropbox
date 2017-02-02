<?php

use Illuminate\Database\Seeder;
// use Faker\Factory;

class UsersTableSeeder extends Seeder
{
  public function run()
  {
    DB::table('users')->insert([
      'id' => 1000000, // init
      'fname' => 'Dave Dane',
      'lname' => 'Pacilan',
      'email' => 'dave@gmail.com',
      'password' => bcrypt('123456'),
      'role' => 'admin',
      'api_token' => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id' => 1000001,
      'fname' => 'Chiarra',
      'lname' => 'Sebial',
      'email' => 'chiarra@gmail.com',
      'password' => bcrypt('123456'),
      'role' => 'moderator',
      'api_token' => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id' => 1000002,
      'fname' => 'Maria Divina',
      'mname' => 'Alterejos',
      'lname' => 'Alegre',
      'email' => 'iya@gmail.com',
      'password' => bcrypt('123456'),
      'api_token' => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id' => 1000003,
      'fname' => 'Rachel Anne',
      'mname' => 'Agravante',
      'lname' => 'Quiamco',
      'email' => 'rachel@gmail.com',
      'password' => bcrypt('123456'),
      'api_token' => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    // Generate fake data

    // $faker = Factory::create();
    // $limit = 50;
    // $roles = ['admin', 'moderator', 'student'];

    // for ($i=0; $i < $limit; $i++) {

    //   if ($i >= 25) $rand = mt_rand(0, 1);
    //   else $rand = 2;

    //   DB::table('users')->insert([
    //     'fname' => $faker->firstName,
    //     'mname' => $faker->lastName,
    //     'lname' => $faker->lastName,
    //     'email' => $faker->unique()->safeEmail,
    //     'password' => bcrypt('123456'),
    //     'role' => $roles[$rand],
    //     'api_token' => str_random(60),
    //     'created_at' => date('Y-m-d H:i:s', time()),
    //     'updated_at' => date('Y-m-d H:i:s', time()),
    //   ]);
    // }

  }
}
