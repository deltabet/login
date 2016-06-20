<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
class EditController extends Controller
{
    public function editUser(Request $request){
        $email = \Auth::user()->email;
		if (($newname = $request->input('name')) == ""){
			$newname = \Auth::user()->name;
		}
		if (($newaddress = $request->input('address')) == ""){
			$newaddress = \Auth::user()->address;
		}
		if (($newcity = $request->input('city')) == ""){
			$newcity = \Auth::user()->city;
		}
		if (($newstate = $request->input('state')) == ""){
			$newstate = \Auth::user()->state;
		}
		if (($newzip = $request->input('zip')) == ""){
			$newzip = \Auth::user()->zip;
		}
		if (($newmonth = $request->input('month')) == ""){
			$newmonth = \Auth::user()->month;
		}
		if (($newday = $request->input('day')) == ""){
			$newday = \Auth::user()->day;
		}
		if (($newyear = $request->input('year')) == ""){
			$newyear = \Auth::user()->year;
		}
		if (($newphone = $request->input('phone')) == ""){
			$newphone == \Auth::user()->phone;
		}
		if (($newpassword = $request->input('password')) == ""){
			$newpassword = \Auth::user()->password;
		}
	    DB::update('update users set password = ?, name = ?, address = ?, city = ?, state = ?, zip = ?,
			month = ?, day = ?, year = ?, phone = ? where email = ?', [$newpassword, $newname,
			$newaddress, $newcity, $newstate, $newzip, $newmonth, $newday, $newyear, 
            $newphone, $email]);
 		return redirect('/profile/');
    }
}
