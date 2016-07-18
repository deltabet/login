<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/profile', function(){
 	return view('profile');
});

Route::get('/profile/edit', function(){
	return view('edit');
});



Route::post('/profile/edit', ['uses'=>'EditController@editUser']);

Route::group(['middleware'=>'admin'], function(){

	Route::get('/admin/userlist', ['as' => 'userlist', function(){
		return view('admin/userlist');
	}]);


	Route::get('/admin/user/{idedit}', ['as' => 'adminview', function($idedit){
		return view('admin/adminuserview', ['idedit' => $idedit]);
	}]);

	Route::get('/admin/edituser/{idedit}', ['as' => 'adminedit', function($idedit){
		return view('admin/adminedit', ['idedit' => $idedit]);
	}]);

	Route::post('/admin/edituser/edit', ['as' => 'admineditaction', 'uses'=>'AdminController@editSubmit']);

	Route::get('/admin/newuser', ['as' => 'adminnew', function(){
		return view('admin/adminnewuser');
	}]);

	Route::post('/admin/newuser', ['as' => 'adminnew', 'uses'=>'AdminController@newUser']);

	Route::post('/admin/reset', ['as' => 'adminreset','uses'=>'AdminController@resetPassword']);

});

Route::get('/courselist', function(){
	return view('course/courselist', ['courses' => \App\Models\Course::all(), 'curString' => 'aaa']);
});
Route::get('/courselist/{filter}','Course\SearchController@filterList'); 
Route::post('/courselist/filter', ['uses' => 'Course\SearchController@filterURL']);
Route::post('/courselist', ['uses'=>'Course\CourseController@getScore']);
Route::get('/score/{idCourse}', function($idCourse){
	return view('course/coursescore', ['idCourse' => $idCourse]);
});
Route::post('/coursescore', ['uses'=>'Course\CourseController@beginEditScore']);
Route::get('/editScore/{idCourse}', function($idCourse){
	return view('course/coursescoreedit', ['idCourse'=> $idCourse]);
});
Route::post('/editScore', ['uses'=>'Course\CourseController@editScore']);

Route::group(['middleware'=>'admin'], function(){
	Route::get('admin/courselist', function(){
		return view('course/admincourselist');
	});
	Route::post('/admin/courselist', ['uses'=>'Course\AdminCourseController@seeCourse']);
	Route::get('/admin/course/{idCourse}', function($idCourse){
		return view('course/admincourseview', ['idCourse' => $idCourse]);
	});
	Route::post('admincourseview', ['uses'=>'Course\AdminCourseController@editCourseForm']);
	Route::get('/admin/courseEdit/{idCcourse}', function($idCourse){
		return view('course/courseedit', ['idCourse'=>$idCourse]);
	});
	Route::post('/admin/courseEdit', ['uses'=>'Course\AdminCourseController@editCourse']);
	Route::post('/admin/courseEdit2', ['uses'=>'Course\AdminCourseController@editCourse2']);
	Route::get('admin/newCourse', function(){
		return view('course/newcourse');
	});
	Route::get('/admin/newCourse2', function(){
		return view('course/newcourse2');
	});
	Route::post('/admin/newCourse', ['uses'=>'Course\AdminCourseController@newCourse']);
	Route::post('/admin/newCourse2', ['uses'=>'Course\AdminCourseController@newCourse2']);
});

Route::get('/403', function(){
	return view('403');
});

