<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginUserTest extends TestCase
{
  use DatabaseMigrations;

  /**
   * A basic test example.
   */
  public function testLoginUser()
  {
    $this->artisan("db:Seed");

    $this->visit('/register')
         ->type('administrator@gmail.com', 'email')
         ->type('123456', 'password')
         ->press('Login')
         ->seePageIs('/home');
  }
}
