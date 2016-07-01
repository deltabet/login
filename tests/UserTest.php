<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class UserTest extends TestCase
{
    use DatabaseTransactions;
	//use DatabaseMigrations;


	

    public function testEditUser()
    {
		//login
		$this->visit('/login')->type('test@gmail.com', 'email')->type('password', 'password')
			->press('Login')
			->visit('/profile')->click('Change Profile Information')
			->type('Test Name', 'name')
			->type('321 Test Ln','address')
			->type('Test City', 'city')
			->type('TS', 'state')
			->type('54321', 'zip')
			->select(6, 'month')
			->select(30, 'day')
			->type('2016', 'year')
			->type('0987654321', 'phone')		
			->press('Submit');
			\Auth::logout();
			$this->visit('/login')->type('test@gmail.com', 'email')->type('password', 'password')
			->press('Login')
			->visit('/profile');
			$this->see('Name: Test Name');
			$this->see('Email: test@gmail.com');
			$this->see('Address: 321 Test Ln, Test City, TS, 54321');
			$this->see('Date of Birth: 6 30, 2016');
			$this->see('Phone Number: 0987654321');

		//right url    
    }


}
