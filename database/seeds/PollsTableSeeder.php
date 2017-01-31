<?php

use Illuminate\Database\Seeder;
// use Faker\Factory;

class PollsTableSeeder extends Seeder
{
  public function run()
  {
    DB::table('polls')->insert([
      'id' => 1000000000, // init
      'user_id' => 1000000000,
      'title' => 'Ban PTA???',
      'desc' => 'Complete no fees for students.',
      'start' => '2017-01-01 00:00:00',
      'end' => '2017-02-28 00:00:00',
      'type' => 'once',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('polls')->insert([
      'user_id' => 1000000001,
      'title' => 'Your Favorite College',
      'desc' => 'Give a stand for your favorite College Department.',
      'start' => '2017-01-01 00:00:00',
      'end' => '2017-02-28 00:00:00',
      'type' => 'multi',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('polls')->insert([
      'user_id' => 1000000000,
      'title' => 'This Poll is Pending',
      'desc' => 'Sorry, you have to wait for a long time.

      #forever
      hehehe',
      'start' => '2020-01-01 00:00:00',
      'end' => '2020-12-31 23:59:59',
      'type' => 'multi',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('polls')->insert([
      'user_id' => 1000000001,
      'title' => 'This Poll is Expired',
      'desc' => 'This sample poll is expired and you can\'t vote anymore.',
      'start' => '2014-01-01 00:00:00',
      'end' => '2014-12-31 23:59:59',
      'type' => 'once',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    // Generate fake data

    // $faker = Factory::create();
    // $limit = 50;
    // $type = ['multi', 'once'];

    // for ($i=0; $i < $limit; $i++) {
    //   DB::table('polls')->insert([
    //     'user_id' => mt_rand(1000000029, 1000000053),
    //     'title' => $faker->sentence,
    //     'desc' => $faker->paragraph,
    //     'start' => '2017-01-01 00:00:00',
    //     'end' => '2017-02-28 00:00:00',
    //     'type' => $type[mt_rand(0, 1)],
    //     'created_at' => date('Y-m-d H:i:s', time()),
    //     'updated_at' => date('Y-m-d H:i:s', time()),
    //   ]);
    // }

  }
}
