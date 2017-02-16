<?php

use Illuminate\Database\Seeder;

// use Faker\Factory;

class SuggestionsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run()
  {
    DB::table('suggestions')->insert([
      'id'         => 1000000000,
      'user_id'    => 1000002,
      'title'      => 'Vandal Walls',
      'direct'     => 'Admin',
      'message'    => 'Please paint the walls on the ground rooms. It is not nice to see.',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('suggestions')->insert([
      'user_id' => 1000003,
      'title'   => 'Trashbins Everywhere',
      'direct'  => 'SSG Officers',
      'message' => 'Please add more trashbins in the campus to minimize littering.
#TrashbinsEverywhere',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    // Generate fake data

    // $faker = Factory::create();
    // $limit = 50;

    // for ($i=0; $i < $limit; $i++) {
    //   DB::table('suggestions')->insert([
    //     'user_id' => mt_rand(1000000002, 1000000028),
    //     'title' => $faker->sentence,
    //     'direct' => $faker->words(3, true),
    //     'message' => $faker->paragraph,
    //     'created_at' => date('Y-m-d H:i:s', time()),
    //     'updated_at' => date('Y-m-d H:i:s', time()),
    //   ]);
    // }
  }
}
