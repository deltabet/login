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

	public function editSubmit(Request $request){
		$this->validate($request, [
			'name' => 'max:255',
            'email' => 'email|max:255|unique:users',
			'zip' => 'numeric|digits:5',
			'birthday' => 'date_format:m/d/Y',
			'phone' => 'numeric|digits:10',
		]);

		$idedit = intval($request->input('idedit'));
		$useredit = User::where('id', $idedit)->first();
		if ($request->input('name') != ""){
			$useredit->name = $request->input('name');
		}
		if ($request->input('address') != ""){
			$useredit->address = $request->input('address');
		}
		if ($request->input('city') != ""){
			$useredit->city = $request->input('city');
		}
		if ($request->input('state') != ""){
			$useredit->state = $request->input('state');
		}
		if ($request->input('zip') != ""){
			$useredit->zip = $request->input('zip');
		}
		if ($request->input('birthday') != ""){
			$useredit->birthday = $request->input('birthday');
		}
		if ($request->input('phone') != ""){
			$useredit->phone = $request->input('phone');
		}
		$truefalse = $request->input('isadmin');
		$newisadmin = false;
		if (strcmp($truefalse, 'true') === 0){
			$newisadmin = true;
		}
		$useredit->isadmin = $newisadmin;
		$useredit->save();
	    /*DB::update('update users set name = ?, address = ?, city = ?, state = ?, zip = ?,
			month = ?, day = ?, year = ?, phone = ?, isadmin = ? where id = ?', [$newname,
			$newaddress, $newcity, $newstate, $newzip, $newmonth, $newday, $newyear, 
            $newphone, $newisadmin, $idedit]);*/
 		return redirect(route('userlist'));
	}

	public function newUser(Request $request){
		$this->validate($request, [
			'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'address' => 'required',
			'city' => 'required',
			'state' => 'required',
			'zip' => 'required|numeric|digits:5',
			'birthday' => 'required|date_format:m/d/Y',
			'phone' => 'required|numeric|digits:10',
		]);
		$email = $request->input('email');
		//verify
		$userexist = User::where('email', $email)->get();
		//$userexist = DB::select('select 1 from users where email = ?', [$email]);
		if (count($userexist) >= 1){
		  return redirect(route('adminnew'))->withErrors(['email', 'Email Already Exists']);
		}
		$newUser = new User;
		$password = $request->input('password');
		$passwordconfirm = $request->input('password_confirmation');
		if (strcmp($password, $passwordconfirm) !== 0){
			return redirect(route('adminnew'))->withErrors(['password', 'Passwords Must Match']);
		}
		//hash password
		$password = \Hash::make($password);

		$newUser->password = $password;
		$newUser->email = $email;
		$newUser->name = $request->input('name');
		$newUser->address = $request->input('address');
		$newUser->city = $request->input('city');
		$newUser->state = $request->input('state');
		$newUser->zip = $request->input('zip');
		$newUser->birthday = $request->input('birthday');
		$newUser->phone = $request->input('phone');
		
		$newUser->save();
		
		//store, 
		  /*DB::insert('insert into users (email, name, password, address, city, 
			state, zip, month, day, year, phone) VALUES(?, ?, ?, ?, ?, ?, ?, ?, 
			?, ?, ?)', [$email, $name, $password, $address, $city, $state, 
			$zip, $month, $day, $year, $phone]);*/
		return redirect(route('userlist'));
	}

	public function resetPassword(Request $request){
		$request->session()->flash('adminReset', 'Reset Email Sent to User');
		\Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject('Your Password Reset Link');
        });
		return redirect(route('userlist'));
	}
}
