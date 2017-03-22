<?php


class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     */
    public function testBasicExample()
    {
        $this->visit('/')
            ->see('About')
            ->see('Campuses')
            ->see('Location')
            ->see('Contact Us');
    }
}
