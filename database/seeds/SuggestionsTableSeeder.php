<?php

use Illuminate\Database\Seeder;

class SuggestionsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('suggestions')->insert([
      'id' => 1000000000,
      'user_id' => 1000000002,
      'title' => 'Vandal Walls',
      'direct' => 'Admin',
      'message' => 'Please paint the walls on the ground rooms. It is not nice to see.',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('suggestions')->insert([
      'user_id' => 1000000003,
      'title' => 'Trashbins Everywhere',
      'direct' => 'SSG Officers',
      'message' => 'Please add more trashbins in the campus to minimize littering.
      #TrashbinsEverywhere',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);
  }
}
