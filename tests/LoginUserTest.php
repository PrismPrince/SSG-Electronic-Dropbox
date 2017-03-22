<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginUserTest extends TestCase
{
  use DatabaseMigrations;

  /**
   * A basic test example.
   */
  public function testLoginUser()
  {
    $this->artisan('db:seed');

    $this->visit('/login')
         ->type('administrator@gmail.com', 'email')
         ->type('123456', 'password')
         ->press('Login')
         ->seePageIs('/home');
  }
}
