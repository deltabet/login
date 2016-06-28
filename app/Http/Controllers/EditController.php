<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use DB;
class EditController extends Controller
{
    public function editUser(Request $request){
        $email = \Auth::user()->email;
		$thisUser = User::where('email', $email)->first();
		if ($request->input('name') != ""){
			$thisUser->name = $request->input('name');
		}
		if ($request->input('address') != ""){
			$thisUser->address = $request->input('address');
		}
		if ($request->input('city') != ""){
			$thisUser->city = $request->input('city');
		}
		if ($request->input('state') != ""){
			$thisUser->state = $request->input('state');
		}
		if ($request->input('zip') != ""){
			$thisUser->zip = $request->input('zip');
		}
		if ($request->input('month') != ""){
			$thisUser->month = $request->input('month');
		}
		if ($request->input('day') != ""){
			$thisUser->day = $request->input('day');
		}
		if ($request->input('year') != ""){
			$thisUser->year = $request->input('year');
		}
		if ($request->input('phone') != ""){
			$thisUser->phone = $request->input('phone');
		}
		if ($request->input('password') != ""){
			$thisUser->password = \Hash::make($request->input('password'));
		}
		$thisUser->save();
	    /*DB::update('update users set password = ?, name = ?, address = ?, city = ?, state = ?, zip = ?,
			month = ?, day = ?, year = ?, phone = ? where email = ?', [$newpassword, $newname,
			$newaddress, $newcity, $newstate, $newzip, $newmonth, $newday, $newyear, 
            $newphone, $email]);*/
 		return redirect('/profile/');
    }
}
