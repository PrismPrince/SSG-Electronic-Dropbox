<?php

use Illuminate\Database\Seeder;
// use Faker\Factory;

class PostsTableSeeder extends Seeder
{
  public function run()
  {
    DB::table('posts')->insert([
      'id' => 1000000000, // init
      'user_id' => 1000000000,
      'title' => 'Feb-Ibig Event',
      'desc' => 'Love is in the air! There will be a program on February 14, 2017. All students are invited to show their talents on this event.
      
      There will be no class this day and no uniform day!
      
      #Love
      #February14',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    DB::table('posts')->insert([
      'user_id' => 1000000001,
      'title' => 'Organization Day!',
      'desc' => 'Get to know the different organizations in the university. Have fun and find your interest!
      
      #OrganizationDay',
      'created_at' => date('Y-m-d H:i:s', time()),
      'updated_at' => date('Y-m-d H:i:s', time()),
    ]);

    // Generate fake data

    // $faker = Factory::create();
    // $limit = 50;

    // for ($i=0; $i < $limit; $i++) {
    //   DB::table('posts')->insert([
    //     'user_id' => mt_rand(1000000029, 1000000053),
    //     'title' => $faker->sentence,
    //     'desc' => $faker->paragraph,
    //     'created_at' => date('Y-m-d H:i:s', time()),
    //     'updated_at' => date('Y-m-d H:i:s', time()),
    //   ]);
    // }

  }
}
