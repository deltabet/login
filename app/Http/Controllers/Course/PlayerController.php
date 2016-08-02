<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Course\SearchController;
use App\Models\Player;

class PlayerController extends Controller
{
	
	protected $player;

	public function __construct(Player $playerParam){
		$this->player = $playerParam;
	}
	
    public function newPlayer(Request $request){
		$this->validate($request, [
			'name' => 'required|unique:players',
			'birthday' => 'required|date_format:m/d/Y',
		]);
		$newPlayer = $this->player;
		$newPlayer->user_id = \Auth::User()->id;
		$newPlayer->name = $request->input('name');
		$newPlayer->birthday = $request->input('birthday');
		$newPlayer->save();
		$sessionArray = session('recentScores');
		$i = $newPlayer->id;
		$sessionArray[$i] = array();
		$sessionArray[$i]['name'] = $newPlayer->name;
		$sessionArray[$i]['age'] = SearchController::getAge(date('m/d/Y'), $newPlayer->birthday);
		$sessionArray[$i]['course'] = "";
		$sessionArray[$i]['score'] = 0;
		$sessionArray[$i]['scoreid'] = -1;
		$sessionArray[$i]['playerid'] = $newPlayer->id;
		session()->put('recentScores', $sessionArray);
		return redirect('/');
	}
}
