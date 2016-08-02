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

	public function __construct(Player $player){
		$this->player = $player;
	}
	
    public function newPlayer(Request $request){
		$this->validate($request, [
			'name' => 'required|unique:players',
			'birthday' => 'required|date_format:m/d/Y',
		]);
		$player->user_id = \Auth::User()->id;
		$player->name = $request->input('name');
		$player->birthday = $request->input('birthday');
		//$player->save();
		/*$sessionArray = session('recentScores');
		$i = $player->id;
		$sessionArray[$i] = array();
		$sessionArray[$i]['name'] = $player->name;
		$sessionArray[$i]['birthday'] = SearchController@getAge(date('m/d/Y'), $player->birthday);
		$sessionArray[$i]['course'] = "";
		$sessionArray[$i]['score'] = 0;
		session()->put('recentScores', $sessionArray);*/
		//return redirect('/');
	}
}
