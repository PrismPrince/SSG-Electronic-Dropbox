<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginUser extends TestCase
{
  use DatabaseMigrations;

  /**
   * A basic test example.
   *
   * @return void
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
