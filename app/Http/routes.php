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

Route::post('/profile/edit', array('uses'=>'EditController@editUser'));

Route::get('/admin/userlist', ['middleware'=>'admin', function(){
	return view('userlist');
}]);


Route::get('/admin/user/{idedit}', ['middleware'=>'admin', function($idedit){
	return view('adminuserview', array('idedit' => $idedit));
}]);

Route::get('/admin/edituser/{idedit}', ['middleware'=>'admin', function($idedit){
	return view('adminedit', array('idedit' => $idedit));
}]);

Route::post('/admin/edituser/edit', array('uses'=>'AdminController@editSubmit'));

Route::get('/admin/newuser', ['middleware'=>'admin', function(){
	return view('adminnewuser');
}]);

Route::post('/admin/newuser', array('uses'=>'AdminController@newUser'));

Route::any('/admin/reset', array('uses'=>'AdminController@resetPassword'));

