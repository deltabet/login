<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use DB;
class EditController extends Controller
{
    public function editUser(Request $request){
		$this->validate($request, [
			'name' => 'max:255',
            'email' => 'email|max:255|unique:users',
			'zip' => 'numeric|digits:5',
			'birthday' => 'date_format:m/d/Y',
			'phone' => 'numeric|digits:10',
		]);
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
		if ($request->input('birthday') != ""){
			$thisUser->birthday = $request->input('birthday');
		}
		if ($request->input('phone') != ""){
			$thisUser->phone = $request->input('phone');
		}
		if ($request->input('password') != ""){
			$thisUser->password = \Hash::make($request->input('password'));
		}
		$thisUser->save();
 		return redirect('/profile/');
    }
}
