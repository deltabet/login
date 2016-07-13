<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CourseTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testNew()
    {
        $this->visit('/login')->type('admin@neuone.com', 'email')->type('password', 'password')
			->press('Login')
			->visit('/admin/courselist')
			->click(
    }
}
