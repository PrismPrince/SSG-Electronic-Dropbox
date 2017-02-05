<?php

use Illuminate\Database\Seeder;

class UserRegistrationRequestsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('user_registration_requests')->insert([
      'id' => 1000000, // init
      'code' => strtoupper(substr(md5(time()),0,5) . '-' . substr(md5(1000000),0,5) . '-' . str_random(5)),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('user_registration_requests')->insert([
      'id' => 1000001, // init
      'code' => strtoupper(substr(md5(time()),0,5) . '-' . substr(md5(1000001),0,5) . '-' . str_random(5)),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('user_registration_requests')->insert([
      'id' => 1000002, // init
      'code' => strtoupper(substr(md5(time()),0,5) . '-' . substr(md5(1000002),0,5) . '-' . str_random(5)),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);

    DB::table('user_registration_requests')->insert([
      'id' => 1000003, // init
      'code' => strtoupper(substr(md5(time()),0,5) . '-' . substr(md5(1000003),0,5) . '-' . str_random(5)),
      'created_at' => '2017-1-1',
      'updated_at' => '2017-1-1',
    ]);
  }
}
