<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\UserRegistrationRequest;

class RegisterTest extends TestCase
{
  use DatabaseMigrations;

  /**
   * A basic test example.
   *
   * @return void
   */
  public function testExample()
  {
    $code = new UserRegistrationRequest();
    $code->id = 1234567;
    $code->code = 'XXXXX-XXXXX-XXXXX';
    $code->save();

    $this->visit('/register')
        ->type($code->id, 'id')
        ->type($code->code, 'code')
        ->type('Fox', 'first_name')
        ->type('Red', 'middle_name')
        ->type('Snow', 'last_name')
        ->type('snow_fox@gmail.com', 'email')
        ->type('fox123', 'password')
        ->type('fox123', 'password_confirmation')
        ->press('Register')
        ->seePageIs('/home');
  }
}
