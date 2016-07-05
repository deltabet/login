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
			->type('6/30/2016', 'birthday')
			->type('0987654321', 'phone')		
			->press('Submit');
			\Auth::logout();
			$this->visit('/login')->type('test@gmail.com', 'email')->type('password', 'password')
			->press('Login')
			->visit('/profile');
			$this->see('Name: Test Name');
			$this->see('Email: test@gmail.com');
			$this->see('Address: 321 Test Ln, Test City, TS, 54321');
			$this->see('Date of Birth: 6/30/2016');
			$this->see('Phone Number: 0987654321');
			\Auth::logout();
		//right url    
    }
	
	public function testZip(){
		$this->visit('/login')->type('test@gmail.com', 'email')->type('password', 'password')
			->press('Login')
			->visit('/profile')->click('Change Profile Information')
			->type('Test Name', 'name')
			->type('321 Test Ln','address')
			->type('Test City', 'city')
			->type('TS', 'state')
			->type('5432', 'zip')
			->type('6/30/2016', 'birthday')
			->type('0987654321', 'phone')		
			->press('Submit');
			$this->see('The zip must be 5 digits.');
			$this->type('Test Name', 'name')
			->type('321 Test Ln','address')
			->type('Test City', 'city')
			->type('TS', 'state')
			->type('543210', 'zip')
			->type('6/30/2016', 'birthday')
			->type('0987654321', 'phone')		
			->press('Submit');
			$this->see('The zip must be 5 digits.');
			\Auth::logout();
	}

	public function testPhone(){
		$this->visit('/login')->type('test@gmail.com', 'email')->type('password', 'password')
			->press('Login')
			->visit('/profile')->click('Change Profile Information')
			->type('Test Name', 'name')
			->type('321 Test Ln','address')
			->type('Test City', 'city')
			->type('TS', 'state')
			->type('54321', 'zip')
			->type('6/30/2016', 'birthday')
			->type('098765432', 'phone')		
			->press('Submit');
			$this->see('The phone must be 10 digits.');
			$this->type('Test Name', 'name')
			->type('321 Test Ln','address')
			->type('Test City', 'city')
			->type('TS', 'state')
			->type('54321', 'zip')
			->type('6/30/2016', 'birthday')
			->type('09876543210', 'phone')		
			->press('Submit');
			$this->see('The phone must be 10 digits.');
			\Auth::logout();
	}

	public function testBirthday(){
		//31
		$this->visit('/login')->type('test@gmail.com', 'email')->type('password', 'password')
			->press('Login')
			->visit('/profile')->click('Change Profile Information')
			->type('Test Name', 'name')
			->type('321 Test Ln','address')
			->type('Test City', 'city')
			->type('TS', 'state')
			->type('54321', 'zip')
			->type('6/31/2016', 'birthday')
			->type('0987654321', 'phone')		
			->press('Submit');
			$this->see('The birthday does not match the format m/d/Y.');
		//leap year
			$this->type('Test Name', 'name')
			->type('321 Test Ln','address')
			->type('Test City', 'city')
			->type('TS', 'state')
			->type('54321', 'zip')
			->type('2/29/2015', 'birthday')
			->type('0987654321', 'phone')		
			->press('Submit');
			$this->see('The birthday does not match the format m/d/Y.');
			\Auth::logout();
	}


}
