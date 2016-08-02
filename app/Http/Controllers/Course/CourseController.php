<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Score;
use App\Models\ScoreColor;
use App\Models\Course;
use App\Models\Color;

class CourseController extends Controller
{

	public function getScore(Request $request){
		$idCourse = $request->input('seeScore');
		return redirect('/score/{$idCourse}');
	}

	public function beginEditScore(Request $request){
		$idCourse = $request->input('enterscore');
		return redirect('/editScore/{$idCourse}');
	}

    public function editScore(Request $request){
		$courseid = $request->input('idPass');
		$curCourse = Course::where('id', $courseid)->first();
		$scores = $curCourse->scores;
		$playerid = $request->input('player');
		if (($currentScore = $scores->where('player_id', $userid)->first()) == null){
			$currentScore = new Score;
			$currentScore->player_id = $playerid;
			$currentScore->course_id = $courseid;
			$currentScore->save();
		}
		
		$colors = $curCourse->colors;
		$oldColors = $currentScore->scoreColors;
		//delete old scorecolors	
		foreach ($oldColors as $oldColor){
			$oldColor->delete();
		}
		echo $currentScore->id;
		foreach ($colors as $color){
			echo $currentScore->id;
			$newColor = new ScoreColor;
			$newColor->score_id = $currentScore->id;
			$newColor->color = $color->color;
			$scoreArray = array();
			$scoreOut = 0;
			$scoreIn = 0;
			$curScore = 0;
			for ($i = 1; $i <= 9; $i++){
				$curScore = intval($request->input($color->color . $i));
				$scoreArray[$i - 1] = $curScore;
				//$newColor->{'sc' . $i} = $curScore;
				$scoreOut += $curScore;
			}
			$newColor->scout = $scoreOut;
			for ($i = 10; $i <= 18; $i++){
				$curScore = intval($request->input($color->color . $i));
				$scoreArray[$i - 1] = $curScore;
				//$newColor->{'sc' . $i} = $curScore;
				$scoreIn += $curScore;
			}
			$newColor->sc = json_encode($scoreArray);
			$newColor->scin = $scoreIn;
			$newColor->sctotal = $scoreOut + $scoreIn;
			$newColor->save();
		}
		$player = \App\Models\Player::where('id', $playerid)->first();
		$sessionArray = session('recentScores');
		$i = $player->id;
		$sessionArray[$i] = array();
		$sessionArray[$i]['name'] = $player->name;
		$sessionArray[$i]['birthday'] = SearchController@getAge(date('m/d/Y'), $player->birthday);
		$sessionArray[$i]['course'] = $curCourse->name;
		$sessionArray[$i]['score'] = \App\Http\Controllers\SearchController::getScore($currentScore);
		session()->put('recentScores', $sessionArray);
		return redirect('/courselist');
		
	}

	
}
