<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CourseTest extends TestCase
{
	use DatabaseTransactions; 
    /**
     * A basic test example.
     *
     * @return void
     */
	public function setUp(){
		parent::setUp();
		$oldCourse = \App\Models\Course::where('id', 9998)->first();
		if ($oldCourse != null){
			$oldCourse->delete();
		}
		$testCourse = new \App\Models\Course;
		$testCourse->name = "New Test Course";
		$testCourse->address = "addr";
		$testCourse->city = "city";	
		$testCourse->state = "st";
		$testCourse->zip = "12345";
		$testCourse->phone = "1234567890";
		$testCourse->email = "";
		$testCourse->twitter = "";
		$testCourse->facebook = "";
		$testCourse->pinterest = "";
		$testCourse->id = 9998;
		for ($i = 1; $i <= 18; $i++){
			$testCourse->{'par' . $i} = 0;
			$testCourse->{'hdcp' . $i} = 0;
		}
		$testCourse->parin = 0;
		$testCourse->parout = 0;
		$testCourse->partotal = 0;
		$testCourse->save();
		$blue = new \App\Models\Color;
		$white = new \App\Models\Color;
		$black = new \App\Models\Color;
		$blue->course_id = 9998;
		$blue->color = "Blue";
		$blue->slope = 0;
		$white->course_id = 9998;
		$white->color = "White";
		$white->slope = 0;
		$black->course_id = 9998;
		$black->color = "Black";
		$black->slope = 0;
		for ($i = 1; $i <= 18; $i++){
			$blue->{'dis' . $i} = -27;
			$white->{'dis' . $i} = -27;
		}
		for ($i = 1; $i <= 18; $i++){
			$black->{'dis' . $i} = -99;
		}
		$blue->disout = -1;
		$blue->disin = -1;
		$blue->distotal = -1;
		$white->disout = -1;
		$white->disin = -1;
		$white->distotal = -1;
		$black->disout = -1;
		$black->disin = -1;
		$black->distotal = -1;
		$blue->save();
		$white->save();
		$black->save();
	}

    public function testNew()
    {
        $this->visit('/login')->type('admin@neuone.com', 'email')->type('password', 'password')
			->press('Login')
			->visit('/admin/courselist')
			->press('newCourse')
			->type('Test Golf Course', 'name')
			->type('2301 Greenhill dr', 'address')
			->type('Round Rock', 'city')
			->type('TX', 'state')
			->type('78664', 'zip')
			->type('9725684930', 'phone')
			->type('test@gmail.com', 'email')
			->check('blacktee')
			->check('goldtee')
			->press('Continue');
		$colors = ['Blue', 'White', 'Black', 'Gold'];
		$mult = 5;
		foreach($colors as $color){
			for ($i = 1; $i <= 18; $i++){
				$this->type($i * $mult, $color . $i);
			}
			$this->type($mult, $color . 'slope');
			$mult -= 1;
		}
		for($i = 1; $i <= 18; $i++){
			$this->type($i, 'par' . $i);
			$this->type(5, 'hdcp' . $i);
		}
		$this->press('submit');
		//change id to 9999
		$course = \App\Models\Course::where('name', 'test golf course')->first();
		$courseColors = $course->colors;
		foreach ($courseColors as $courseColor){
			$courseColor->course_id = 9999;
			$courseColor->save();
		}
		$course->id = 9999;
		$course->save();
		\Auth::logout();
		$this->visit('/login')->type('admin@neuone.com', 'email')->type('password', 'password')
			->press('Login')
			->visit('/admin/course/' . '9999')
			->see('Test Golf Course')
			->see('2301 Greenhill Dr')
			->see('Round Rock')
			->see('Tx')
			->see('78664')
			->see('9725684930')
			->see('test@gmail.com')
			->see('630')->see('225')->see('504')->see('180')->see('378')
			->see('135')->see('252')->see('90')
			->see('855')->see('684')->see('513')->see('342')
			->see('45')->see('126')->see('171');			
    }

	public function testEdit(){
		 $this->visit('/login')->type('admin@neuone.com', 'email')->type('password', 'password')
			->press('Login')
			->visit('admin/courseEdit/9998')
			->type('2301 Greenhill dr', 'address')
			->type('Round Rock', 'city')
			->type('TX', 'state')
			->type('78664', 'zip')
			->type('9725684930', 'phone')
			->type('test@gmail.com', 'email')
			->check('redtee')
			->uncheck('blacktee')
			->press('submit');
			$colors = ['Blue', 'White', 'Red'];
			foreach($colors as $color){
				for ($i = 1; $i <= 18; $i++){
					$this->type($i, $color . $i);
				}
			}
			$this->press('submit');
			\Auth::logout();
		$this->visit('/login')->type('admin@neuone.com', 'email')->type('password', 'password')
			->press('Login')
			->visit('/admin/course/' . '9998')
			->see('New Test Course')
			->see('2301 Greenhill Dr')
			->see('Round Rock')
			->see('Tx')
			->see('78664')
			->see('9725684930')
			->see('test@gmail.com')
			->see('45')->see('126')->see('171')
			->dontSee('-99')->dontSee('-27');
	}

	public function testScoreEdit(){
		$this->visit('/login')->type('admin@neuone.com', 'email')->type('password', 'password')
			->press('Login')
			->visit('/editScore/9998');
			for ($i = 1; $i <= 18; $i++){
				$this->type($i, 'Blue' . $i);
			}
			$this->press('submit');
			\Auth::logout();
		$this->visit('/login')->type('admin@neuone.com', 'email')->type('password', 'password')
			->press('Login')
			->visit('/score/9998')
			->see('45')->see('126')->see('171');
	}

	public function tearDown(){
		$deleteCourse = \App\Models\Course::where('id', 9998)->first();
		if ($deleteCourse != null){
			$deleteColors = $deleteCourse->colors;
			foreach($deleteColors as $deleteColor){
				$deleteColor->delete();
			}
			$deleteCourse->delete();
		}		
		parent::tearDown();
	}
}
