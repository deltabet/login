<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class AdminTest extends TestCase
{
	use DatabaseTransactions;    
	
	public function setUp(){
		parent::setUp();
		$olduser = User::where('email', 'adminedit@gmail.com')->get();
		if (count($olduser) > 0){
			$olduser[0]->delete();
		}	
		$user = new User;
		$user->email = 'adminedit@gmail.com';
		$user->name = 'test';
		$user->address = '';
		$user->city = '';
		$user->state = '';
		$user->zip = 00000;
		$user->birthday = '0/0/0000';
		$user->phone = 00000;
		$password = \Hash::make('password');
		$user->password = $password;
		$user->id = 9999;
		$user->save();
	}
	
	public function testNewUser(){
		$this->visit('/login')->type('admin@neuone.com', 'email')->type('password', 'password')
			->press('Login')
			->visit('/admin/userlist')->click('Add User')
			->type('nam', 'name')
			->type('test4admin@gmail.com', 'email')
			->type('ln','address')
			->type('ct', 'city')
			->type('t', 'state')
			->type('00000', 'zip')
			->type('2/2/2014', 'birthday')
			->type('1234567890', 'phone')
			->type('password', 'password')
			->type('password', 'password_confirmation')		
			->press('Register');	
	
		\Auth::logout();
		$olduser = User::where('email', 'test4admin@gmail.com')->first();
		//$olduser->id = 9999;
		//$olduser->save();

		$this->visit('/login')->type('test4admin@gmail.com', 'email')
			->type('password', 'password')->press('Login')
			->visit('/profile');
			$this->see('Name: nam');
			$this->see('Email: test4admin@gmail.com');
			$this->see('Address: ln, ct, t, 00000');
			$this->see('Date of Birth: 2/2/2014');
			$this->see('Phone Number: 1234567890');	
		\Auth::logout();
	}

	/**
     * A basic test example.
     *
     * @return void
     */
    public function testEdit()
    {
		//$olduser = User::where('email', 'test@gmail.com')->first();
		//echo $olduser->id;
        //login
		$this->visit('/login')->type('admin@neuone.com', 'email')->type('password', 'password')
			->press('Login')
			->visit('/admin/userlist')->press('idedit9999')->click('Change Profile Information')
			->type('Test Name', 'name')
			->type('321 Test Ln','address')
			->type('Test City', 'city')
			->type('TS', 'state')
			->type('54321', 'zip')
			->type('6/30/2016', 'birthday')
			->type('0987654321', 'phone')		
			->press('Submit');
			\Auth::logout();
			$this->visit('/login')->type('admin@neuone.com', 'email')->type('password', 'password')
			->press('Login')
			->visit('/admin/user/9999');
			$this->see('Name: Test Name');
			$this->see('Email: adminedit@gmail.com');
			$this->see('Address: 321 Test Ln, Test City, TS, 54321');
			$this->see('Date of Birth: 6/30/2016');
			$this->see('Phone Number: 0987654321');
    }

	public function tearDown(){
		$olduser = User::where('email', 'test4admin@gmail.com')->get();
		if (count($olduser) > 0){
			$olduser[0]->delete();
		}
		$olduser2 = User::where('email', 'adminedit@gmail.com')->get();
		if (count($olduser2) > 0){
			$olduser2[0]->delete();
		}		
		parent::tearDown();
	}
}
