<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginUser extends TestCase
{
  use DatabaseMigrations;

  /**
   * A basic test example.
   */
  public function testLoginUser()
  {
    $this->visit('/register')
         ->type('administrator@gmail.com', 'email')
         ->type('123456', 'password')
         ->press('Login')
         ->seePageIs('/home');
  }
}
