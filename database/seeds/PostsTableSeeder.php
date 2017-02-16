<?php

// use Faker\Factory;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
  public function run()
  {
    DB::table('posts')->insert([
      'id'      => 1000000000, // init
      'user_id' => 1000000,
      'title'   => 'Medyo Maldito @ CTU',
      'desc'    => 'CONFIRMED!
Medyo Maldito and as requested by the TECHNO People Snake Princess will be joining us this TECHNO Fest 2017!
Photos below are during the Contract Signing earlier between the Tomorrow\'s Council represented by our SSG President Benj Oberes, SSG Vice-President Marian Lay Andales and SSG Executive Secretary Allen Marie Recto Arriesgado and the team of Medyo Maldito (Rowell Ucat) and Snake Princess (Mark Anthony Abucejo). :)
Keep posted for TECHNO Fest 2017 Updates TECHNO People. :)
#TECHNOFest2017
#TomorrowsCouncil
#CTUMCSSG',
      'created_at' => '2017-2-4 19:06:00',
      'updated_at' => '2017-2-4 19:06:00',
    ]);

    DB::table('posts')->insert([
      'user_id' => 1000001,
      'title'   => 'Official UNIVERSITY SHIRT',
      'desc'    => 'Official UNIVERSITY SHIRT and merchandise for TECHNO Fest 2017 for only PHP 250.00!
You may start placing your orders tomorrow in front of the TrAcc Board of the Supreme Student Government.
DEADLINE FOR BATCH 1 will be on February 8.
GRAB ONE NOW! Limited Stocks only. :)
Look for A-jay Sollano for your orders. :)
#TECHNOFest2017
#TomorrowsCouncil
#CTUMCSSG',
      'created_at' => '2017-2-6 12:59:00',
      'updated_at' => '2017-2-6 12:59:00',
    ]);

    DB::table('posts')->insert([
      'user_id' => 1000001,
      'title'   => 'TechnoFest 2017',
      'desc'    => 'Here\'s your guide for your First TECHNO Fest Experice TECHNO People. :)
#TECHNOFest2017
#TomorrowsCouncil
#CTUMCSSG',
      'created_at' => '2017-2-12 21:43:00',
      'updated_at' => '2017-2-12 21:43:00',
    ]);

    DB::table('posts')->insert([
      'user_id' => 1000000,
      'title'   => 'MR. TECHNO FEST 2017',
      'desc'    => 'Hey, TECHNO people!
Here are your male candidates for the MR. TECHNO FEST 2017!
Show some support to your chosen candidateundefineds on Facebook with the following criteria:
LIKE = 1 PT.
HEART REACTION = 3 PTS.
SHARE = 5 PTS.
Like the page first before Liking, Reacting and Sharing the photo.
The candidate with the most accumulated points will be awarded as the Mr. Social Media during the Coronation Night.
Voting will start NOW and will end on FEBRUARY 16, 2017 AT 10 PM.',
      'created_at' => '2017-2-14 18:53:00',
      'updated_at' => '2017-2-14 18:53:00',
    ]);

    DB::table('posts')->insert([
      'user_id' => 1000001,
      'title'   => 'DEADLINE FOR BATCH 2 ORDERS',
      'desc'    => 'Please be informed that the deadline for Batch 2 orders will be tomorrow undefinedFebruary 15). As of the moment the we will only be opening TWO BATCHES OF ORDERS. So this will probably be your last chance to order the shirts.
Order na TECHNO People!
#TECHNOFest2017
#TomorrowsCouncil
#CTUMCSSG',
      'created_at' => '2017-2-14 19:01:00',
      'updated_at' => '2017-2-14 19:01:00',
    ]);

    DB::table('posts')->insert([
      'user_id' => 1000001,
      'title'   => 'Kung Hei Fat Choi!',
      'desc'    => 'Tomorrow\'s Council is wishing all of you luck, cheers, and a wonderful future this Chinese Lunar New Year!
#TomorrowsCouncil
#CTUMCSSG
#GongHeiFatChoy',
      'created_at' => '2017-1-28 13:07:00',
      'updated_at' => '2017-1-28 13:07:00',
    ]);

    DB::table('posts')->insert([
      'user_id' => 1000000,
      'title'   => 'Student Participatory Governance (SPG) Program',
      'desc'    => 'In pursuit of attaining the Supreme Student Government’s (Tomorrow’s Council) goal of addressing the students need in order to lift the students way of learning in the institution, and promoting good governance in the institution, the Supreme Student Government, through the Accredited Student Organizations of Cebu Technological University – Main Campus, shall implement the Student Participatory Governance (SPG) Program. This program seeks to give an immediate aid to the common need of the members of every organization, increase students\' access to service delivery through a demand-driven budget planning process and to strengthen Supreme Student Governments accountability in student service provision.
The Supreme Student Government (Tomorrow’s Council) of Cebu Technological University – Main Campus is tasked to ensure the implementation of priority projects as identified at the Organizational Students Dialogue through the SPG participatory planning and budgeting process.',
      'created_at' => '2017-1-23 12:46:00',
      'updated_at' => '2017-1-23 12:46:00',
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
