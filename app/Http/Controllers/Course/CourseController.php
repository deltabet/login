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
		$userid = \Auth::User()->id;
		$courseid = $request->input('idPass');
		$curUser = User::where('id', $userid)->first();
		$curCourse = Course::where('id', $courseid)->first();
		$scores = $curCourse->scores;
		if (($currentScore = $scores->where('user_id', $userid)->first()) == null){
			$currentScore = new Score;
			$currentScore->user_id = $userid;
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
			$scoreOut = 0;
			$scoreIn = 0;
			$curScore = 0;
			for ($i = 1; $i <= 9; $i++){
				$curScore = intval($request->input($color->color . $i));
				$newColor->{'sc' . $i} = $curScore;
				$scoreOut += $curScore;
			}
			$newColor->scout = $scoreOut;
			for ($i = 10; $i <= 18; $i++){
				$curScore = intval($request->input($color->color . $i));
				$newColor->{'sc' . $i} = $curScore;
				$scoreIn += $curScore;
			}
			$newColor->scin = $scoreIn;
			$newColor->sctotal = $scoreOut + $scoreIn;
			$newColor->save();
		}
		return redirect('/courselist');
		
	}

	
}
