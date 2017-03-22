<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
  use DatabaseMigrations;

  public function testDatabase()
  {
  	$this->artisan("db:Seed");

    $this->seeInDatabase('users', [
      'email' => 'administrator@gmail.com',
    ]);
  }
}
