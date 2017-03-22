<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
  use DatabaseMigrations;

  public function testDatabase()
  {
    $this->seeInDatabase('users', [
      'email' => 'administrator@gmail.com',
    ]);
  }
}
