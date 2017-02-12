<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('comments')->insert([
      'user_id' => 1000000,
      'suggestion_id' => 1000000000,
      'comment'     => 'Okay, we\'ll take note about that. Thank you!',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('comments')->insert([
      'user_id' => 1000003,
      'suggestion_id' => 1000000001,
      'comment'     => 'And make it BIG!',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('comments')->insert([
      'user_id' => 1000001,
      'suggestion_id' => 1000000001,
      'comment'     => 'Thank you for your concern.',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('comments')->insert([
      'user_id' => 1000002,
      'suggestion_id' => 1000000000,
      'comment'     => 'Thanks kuya',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);
  }
}
