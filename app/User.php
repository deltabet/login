<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Auth\CanResetPassword;
use DB;
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'city', 'state', 'zip','day','month','year', 'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


 	/*public static function getUserByID($id){
		$useredit = array();	
		$useredit['name'] = DB::select('select name from users where id = ?', [$id])[0];
		$useredit['email'] = DB::select('select email from users where id = ?', [$id])[0];
		$useredit['address'] = DB::select('select address from users where id = ?', [$id])[0];
		$useredit['city'] = DB::select('select city from users where id = ?', [$id])[0];
		$useredit['state'] = DB::select('select state from users where id = ?', [$id])[0];
		$useredit['zip'] = DB::select('select zip from users where id = ?', [$id])[0];
		$useredit['month'] = DB::select('select month from users where id = ?', [$id])[0];
		$useredit['day'] = DB::select('select day from users where id = ?', [$id])[0];
		$useredit['year'] = DB::select('select year from users where id = ?', [$id])[0];
		$useredit['phone'] = DB::select('select phone from users where id = ?', [$id])[0];
		//$useredit['password'] = DB::select('select password from users where id = ?', [$id])[0];
		return $useredit;
	}*/
}
