<?php


class WelcomeTest extends TestCase
{
  /**
   * A basic test example.
   */
  public function testExample()
  {
    $this->visit('/')
        ->see('About')
        ->see('Campuses')
        ->see('Location')
        ->see('Contact Us');
  }
}
