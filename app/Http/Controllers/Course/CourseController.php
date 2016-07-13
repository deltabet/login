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
		if (($curScore = $scores->where('user_id', $userid)->first()) == null){
			$curScore = new Score;
			$curScore->user_id = $userid;
			$curScore->course_id = $courseid;
			$curScore->save();
		}
		
		$colors = $curCourse->colors;
		$oldColors = $curScore->scoreColors;
		//delete old scorecolors	
		foreach ($oldColors as $oldColor){
			$oldColor->delete();
		}
	
		foreach ($colors as $color){
			$newColor = new ScoreColor;
			$newColor->score_id = $curScore->id;
			$newColor->color = $color->color;
			for ($i = 1; $i <= 18; $i++){
				$newColor->{'sc' . $i} = intval($request->input($color->color . $i));
			}
			$newColor->save();
		}
		return redirect('/courselist');
		
	}
}
