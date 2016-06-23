<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use DB;
use Illuminate\Mail\Message;
class AdminController extends Controller
{


    public static function isAdmin(){
		if (\Auth::guest() == false){
			$isAdminTrue = \Auth::user()->isadmin;
			if ($isAdminTrue === true){
				return true;
			}
		}
		return false;
    }

	/*public function editRedirect(Request $request){
		$idedit = $request->input('idedit');
		//$useredit = DB::select('select 1 from users where email = ?', [$idedit])[0];
		//$request->session()->flash();
		//return view('adminedit')->with(array('useredit' => $useredit));
		return redirect('/admin/edituser/' . $idedit)->withInput('idedit');
	}*/

	public function editSubmit(Request $request){
		$idedit = intval($request->input('idedit'));
		$useredit = DB::select('select name, address, city, state, zip,
		 month, day, year, phone from users where id = ?', [$idedit]);
		if (($newname = $request->input('name')) == ""){
			$newname = $useredit[0]->name;
		}
		if (($newaddress = $request->input('address')) == ""){
			$newaddress = $useredit[0]->address;
		}
		if (($newcity = $request->input('city')) == ""){
			$newcity = $useredit[0]->city;
		}
		if (($newstate = $request->input('state')) == ""){
			$newstate = $useredit[0]->state;
		}
		if (($newzip = $request->input('zip')) == ""){
			$newzip = $useredit[0]->zip;
		}
		if (($newmonth = $request->input('month')) == ""){
			$newmonth = $useredit[0]->month;
		}
		if (($newday = $request->input('day')) == ""){
			$newday = $useredit[0]->day;
		}
		if (($newyear = $request->input('year')) == ""){
			$newyear = $useredit[0]->year;
		}
		if (($newphone = $request->input('phone')) == ""){
			$newphone == $useredit[0]->phone;
		}
		$truefalse = $request->input('isadmin');
		$newisadmin = false;
		if (strcmp($truefalse, 'true') === 0){
			$newisadmin = true;
		}
		//if (($newpassword = $request->input('password')) == ""){
			//$newpassword = $useredit['password'];
		//}
	    DB::update('update users set name = ?, address = ?, city = ?, state = ?, zip = ?,
			month = ?, day = ?, year = ?, phone = ?, isadmin = ? where id = ?', [$newname,
			$newaddress, $newcity, $newstate, $newzip, $newmonth, $newday, $newyear, 
            $newphone, $newisadmin, $idedit]);
 		return redirect('/admin/userlist');
	}

	public function newUser(Request $request){
		$email = $request->input('email');
		//verify
		$userexist = DB::select('select 1 from users where email = ?', [$email]);
		if (count($userexist) >= 1){
		  return redirect('/admin/newuser')->withErrors(['email', 'Email Already Exists']);
		}
		$password = $request->input('password');
		$passwordconfirm = $request->input('password_confirmation');
		if (strcmp($password, $passwordconfirm) !== 0){
			return redirect('/admin/newuser')->withErrors(['password', 'Passwords Must Match']);
		}
		$name = $request->input('name');
		$address = $request->input('address');
		$city = $request->input('city');
		$state = $request->input('state');
		$zip = $request->input('zip');
		$month = $request->input('month');
		$day = $request->input('day');
		$year = $request->input('year');
		$phone = $request->input('phone');
		
		
		//hash password
		$password = \Hash::make($password);
		//store, 
		  DB::insert('insert into users (email, name, password, address, city, 
			state, zip, month, day, year, phone) VALUES(?, ?, ?, ?, ?, ?, ?, ?, 
			?, ?, ?)', [$email, $name, $password, $address, $city, $state, 
			$zip, $month, $day, $year, $phone]);
		return redirect('/admin/userlist');
	}

	public function resetPassword(Request $request){
		$request->session()->flash('adminReset', 'Reset Email Sent to User');
		\Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject('Your Password Reset Link');
        });
		return redirect('/admin/userlist');
	}
}
