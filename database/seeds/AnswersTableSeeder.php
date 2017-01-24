<?php

use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{
  public function run()
  {
    DB::table('answers')->insert([
      'id' => 1000000000, // init
      'poll_id' => 1000000000,
      'answer' => 'Yes, Ban PTA',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('answers')->insert([
      'poll_id' => 1000000000,
      'answer' => 'No, It is helpful',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('answers')->insert([
      'poll_id' => 1000000001,
      'answer' => 'College of Arts and Sciences',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('answers')->insert([
      'poll_id' => 1000000001,
      'answer' => 'College of Engineering',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('answers')->insert([
      'poll_id' => 1000000001,
      'answer' => 'College of Technology',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('answers')->insert([
      'poll_id' => 1000000001,
      'answer' => 'College of Education',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);
  }
}
