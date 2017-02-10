<?php

use Illuminate\Database\Seeder;

// use Faker\Factory;

class AnswersTableSeeder extends Seeder
{
  public function run()
  {
    DB::table('answers')->insert([
      'id'         => 1000000000, // init
      'poll_id'    => 1000000000,
      'answer'     => 'Yes, Ban PTA',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('answers')->insert([
      'poll_id'    => 1000000000,
      'answer'     => 'No, It is helpful',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('answers')->insert([
      'poll_id'    => 1000000001,
      'answer'     => 'College of Arts and Sciences',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('answers')->insert([
      'poll_id'    => 1000000001,
      'answer'     => 'College of Engineering',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('answers')->insert([
      'poll_id'    => 1000000001,
      'answer'     => 'College of Technology',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('answers')->insert([
      'poll_id'    => 1000000001,
      'answer'     => 'College of Education',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('answers')->insert([
      'poll_id'    => 1000000002,
      'answer'     => 'Answer A',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('answers')->insert([
      'poll_id'    => 1000000002,
      'answer'     => 'Answer B',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('answers')->insert([
      'poll_id'    => 1000000002,
      'answer'     => 'Answer C',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('answers')->insert([
      'poll_id'    => 1000000003,
      'answer'     => 'True',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('answers')->insert([
      'poll_id'    => 1000000003,
      'answer'     => 'False',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    // Generate fake data

    // $faker = Factory::create();
    // $limit = 50;
    // $roles = ['admin', 'moderator', 'student'];
    // $lastID = 1000000003;

    // for ($i=0; $i < $limit; $i++) {
    //   $lastID++;
    //   $ans = mt_rand(2, 3);
    //   for ($j=0; $j < $ans; $j++) {
    //     DB::table('answers')->insert([
    //       'poll_id' => $lastID,
    //       'answer' => $faker->words(3, true),
    //       'created_at' => date('Y-m-d H:i:s', time()),
    //       'updated_at' => date('Y-m-d H:i:s', time()),
    //     ]);
    //   }
    // }
  }
}
