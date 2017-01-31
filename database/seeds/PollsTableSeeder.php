<?php

use Illuminate\Database\Seeder;

class PollsTableSeeder extends Seeder
{
  public function run()
  {
    DB::table('polls')->insert([
      'id' => 1000000000, // init
      'user_id' => 1000000001,
      'title' => 'Ban PTA???',
      'desc' => 'Complete no fees for students.',
      'start' => '2017-01-01 00:00:00',
      'end' => '2017-02-28 00:00:00',
      'type' => 'once',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('polls')->insert([
      'user_id' => 1000000000,
      'title' => 'Your Favorite College',
      'desc' => 'Give a stand for your favorite College Department.',
      'start' => '2017-01-01 00:00:00',
      'end' => '2017-02-28 00:00:00',
      'type' => 'multi',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);
  }
}
