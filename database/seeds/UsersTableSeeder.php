<?php

use Illuminate\Database\Seeder;

// use Faker\Factory;

class UsersTableSeeder extends Seeder
{
  public function run()
  {
    DB::table('users')->insert([
      'id'         => 1000000, // init
      'fname'      => 'Dave Dane',
      'lname'      => 'Pacilan',
      'email'      => 'dave@gmail.com',
      'password'   => bcrypt('123456'),
      'role'       => 'administrator',
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000001,
      'fname'      => 'Chiarra',
      'lname'      => 'Sebial',
      'email'      => 'chiarra@gmail.com',
      'password'   => bcrypt('123456'),
      'role'       => 'moderator',
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000002,
      'fname'      => 'Maria Divina',
      'mname'      => 'Alterejos',
      'lname'      => 'Alegre',
      'email'      => 'iya@gmail.com',
      'password'   => bcrypt('123456'),
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000003,
      'fname'      => 'Rachel Anne',
      'mname'      => 'Agravante',
      'lname'      => 'Quiamco',
      'email'      => 'rachel@gmail.com',
      'password'   => bcrypt('123456'),
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000004,
      'fname'      => 'John',
      'lname'      => 'Mayer',
      'email'      => 'mayer@gmail.com',
      'password'   => bcrypt('123456'),
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000005,
      'fname'      => 'Lady',
      'lname'      => 'Gaga',
      'email'      => 'lady_gaga@gmail.com',
      'password'   => bcrypt('123456'),
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000006,
      'fname'      => 'Sarah',
      'lname'      => 'Geronimo',
      'email'      => 'sarah123@gmail.com',
      'password'   => bcrypt('123456'),
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000007,
      'fname'      => 'Eric',
      'lname'      => 'Santos',
      'email'      => 'santoseric@gmail.com',
      'password'   => bcrypt('123456'),
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000008,
      'fname'      => 'Piolo',
      'lname'      => 'Pascual',
      'email'      => 'papaPee@gmail.com',
      'password'   => bcrypt('123456'),
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000009,
      'fname'      => 'Quen',
      'lname'      => 'Gil',
      'email'      => 'enrique_gil@gmail.com',
      'password'   => bcrypt('123456'),
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000010,
      'fname'      => 'Vice',
      'lname'      => 'Ganda',
      'email'      => 'josemarieviceral@gmail.com',
      'password'   => bcrypt('123456'),
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000011,
      'fname'      => 'Justin',
      'lname'      => 'Bebier',
      'email'      => 'justin@gmail.com',
      'password'   => bcrypt('123456'),
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000012,
      'fname'      => 'Jake',
      'lname'      => 'Sali',
      'email'      => 'sali_jake@gmail.com',
      'password'   => bcrypt('123456'),
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000013,
      'fname'      => 'Princess',
      'lname'      => 'Aurora',
      'email'      => 'sleeping_beauty@gmail.com',
      'password'   => bcrypt('123456'),
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000014,
      'fname'      => 'Snow',
      'lname'      => 'White',
      'email'      => 'snow7@gmail.com',
      'password'   => bcrypt('123456'),
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000015,
      'fname'      => 'Revica',
      'lname'      => 'Black',
      'email'      => 'black@gmail.com',
      'password'   => bcrypt('123456'),
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000016,
      'fname'      => 'Charlie',
      'lname'      => 'Green',
      'email'      => 'green@gmail.com',
      'password'   => bcrypt('123456'),
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000017,
      'fname'      => 'JC',
      'lname'      => 'May',
      'email'      => 'mayJC@gmail.com',
      'password'   => bcrypt('123456'),
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000018,
      'fname'      => 'Fred',
      'lname'      => 'Wood',
      'email'      => 'woody@gmail.com',
      'password'   => bcrypt('123456'),
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000019,
      'fname'      => 'Mark',
      'lname'      => 'Cordova',
      'email'      => 'cordova@gmail.com',
      'password'   => bcrypt('123456'),
      'api_token'  => str_random(60),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('users')->insert([
      'id'         => 1000020,
      'fname'      => 'Jane',
      'lname'      => 'Titan',
      'email'      => 'titan@gmail.com',
      'password'   => bcrypt('123456'),
      'api_token'  => str_random(60),
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
