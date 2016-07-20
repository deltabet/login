<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Color;

//name not here
	

class AdminCourseController extends Controller
{
	protected $inputs = ['address', 'city', 'state', 'zip', 'phone', 'website', 'email', 'twitter',
		'facebook', 'pinterest'];

	public static function deleteByID(int $id){
		$course = \App\Models\Course::where('id', $id)->first();
		$colors = $course->colors;
		foreach($colors as $color){
			$color->delete();
		}
		$course->delete();
	}

	public function seeCourse(Request $request){
		$idCourse = $request->input('seecourse');
		return redirect('/admin/course/{$idCourse}');
	}
	public function editCourseForm(Request $request){
		$idCourse = $request->input('editcourse');
		return redirect('/admin/courseEdit/{$idCourse}');
	}

    public function newCourse(Request $request){
		$this->validate($request,[
			'name' => 'required|max:255|unique:courses',
			'address' => 'required',
			'city' => 'required',
			'state' => 'required',
			'zip' => 'required|numeric|digits:5',
			'phone' => 'required|numeric|digits:10',
			'website' => 'active_url',
			'twitter' => 'active_url',
			'facebook' => 'active_url',
			'pinterest' => 'active_url',
	
		]);
		//pass on data and move to second part
		$request->flash();
		$colors = array(0 => 'Blue', 1 => 'White');
		$colorCount = 2;
		if ($request->input('blacktee') == 'Black'){
			$colors[$colorCount] = 'Black';
			$colorCount++;
		}
		if ($request->input('goldtee') == 'Gold'){
			$colors[$colorCount] = 'Gold';
			$colorCount++;
		}
		if ($request->input('greentee') == 'Green'){
			$colors[$colorCount] = 'Green';
			$colorCount++;
		}
		if ($request->input('redtee') == 'Red'){
			$colors[$colorCount] = 'Red';
			$colorCount++;
		}
		return view('course/newcourse2', ['colors'=> $colors]);
	}

	public function newCourse2(Request $request){
		$colors = array(0 => 'Blue', 1 => 'White');
		$colorCount = 2;
		if ($request->old('blacktee') == 'Black'){
			$colors[$colorCount] = 'Black';
			$colorCount++;
		}
		if ($request->old('goldtee') == 'Gold'){
			$colors[$colorCount] = 'Gold';
			$colorCount++;
		}
		if ($request->old('greentee') == 'Green'){
			$colors[$colorCount] = 'Green';
			$colorCount++;
		}
		if ($request->old('redtee') == 'Red'){
			$colors[$colorCount] = 'Red';
			$colorCount++;
		}
		$validator = array();
		for ($k = 1; $k <= 18; $k++){
			$validator['par' . $k] = 'required|numeric';
			$validator['hdcp' . $k] = 'required|numeric';
		}
 		for($i = 0; $i < count($colorCount); $i++){
			$validator[$colors[$i] . 'slope'] = 'required|numeric|between:55,150';
			for ($k = 1; $k <= 18; $k++){
				$validator[$colors[$i] . $k] = 'required|numeric';
			}
		}
		//$this->validate($request, $validator);
		//new course
		$newCourse = new Course;
		//$newCourse->name = $request->input('name');
		//add text fields
		$newCourse->name = strtolower($request->old('name'));
		foreach ($this->inputs as $input){
			$data = strtolower($request->old($input));
			$newCourse->{$input} = $data;
			if ($newCourse->{$input} == null){
				$newCourse->{$input} = "";
			}
		}
		$parSum1 = 0;
		$parSum2 = 0;
		for ($k = 1; $k <= 9; $k++){
			$curPar = intval($request->input('par' . $k));
			$newCourse->{'par' . $k} = $curPar;
			$newCourse->{'hdcp' . $k} = intval($request->input('hdcp' . $k));
			$parSum1 += $curPar;
		}
		$newCourse->parout = $parSum1;
		for ($k = 10; $k <= 18; $k++){
			$curPar = intval($request->input('par' . $k));
			$newCourse->{'par' . $k} = $curPar;
			$newCourse->{'hdcp' . $k} = intval($request->input('hdcp' . $k));
			$parSum2 += $curPar;
		}
		$newCourse->parin = $parSum2;
		$newCourse->partotal = $parSum1 + $parSum2;
		$newCourse->save();

		//colors of course
		foreach($colors as $color){
			$newColor = new Color;
			$newColor->course_id = $newCourse->id;
			$newColor->color = $color;
			$newColor->slope = intval($request->input($color . 'slope'));
			$disSum1 = 0;
			$disSum2 = 0;
			for ($k = 1; $k <= 9; $k++){
				$curDis = intval($request->input($color . $k));
				$newColor->{'dis' . $k} = $curDis;
				$disSum1 += $curDis;
			}
			$newColor->disout = $disSum1;
			for ($k = 10; $k <= 18; $k++){
				$curDis = intval($request->input($color . $k));
				$newColor->{'dis' . $k} = $curDis;
				$disSum2 += $curDis;
			}
			$newColor->disin = $disSum2;
			$newColor->distotal = $disSum1 + $disSum2;
			$newColor->save();
		}
		
		return redirect('/admin/courselist');
	} 

	public function editCourse(Request $request){
		$this->validate($request,[
			'address' => 'required',
			'city' => 'required',
			'state' => 'required',
			'zip' => 'required|numeric|digits:5',
			'phone' => 'required|numeric|digits:10',
			'website' => 'active_url',
			'twitter' => 'active_url',
			'facebook' => 'active_url',
			'pinterest' => 'active_url',
	
		]);
		//pass on data and move to second part
		$request->flash();
		$colors = array(0 => 'Blue', 1 => 'White');
		$colorCount = 2;
		if ($request->input('blacktee') == 'Black'){
			$colors[$colorCount] = 'Black';
			$colorCount++;
		}
		if ($request->input('goldtee') == 'Gold'){
			$colors[$colorCount] = 'Gold';
			$colorCount++;
		}
		if ($request->input('greentee') == 'Green'){
			$colors[$colorCount] = 'Green';
			$colorCount++;
		}
		if ($request->input('redtee') == 'Red'){
			$colors[$colorCount] = 'Red';
			$colorCount++;
		}
		return view('course/courseedit2', ['idCourse' => $request->input('idPass'), 'colors'=> $colors]);
	}

	public function editCourse2(Request $request){
		
		//validate grid
		$colors = array(0 => 'Blue', 1 => 'White');
		$colorCount = 2;
		if ($request->old('blacktee') == 'Black'){
			$colors[$colorCount] = 'Black';
			$colorCount++;
		}
		if ($request->old('goldtee') == 'Gold'){
			$colors[$colorCount] = 'Gold';
			$colorCount++;
		}
		if ($request->old('greentee') == 'Green'){
			$colors[$colorCount] = 'Green';
			$colorCount++;
		}
		if ($request->old('redtee') == 'Red'){
			$colors[$colorCount] = 'Red';
			$colorCount++;
		}
		$validator = array();
		for ($k = 1; $k <= 18; $k++){
			$validator['par' . $k] = 'required|numeric';
			$validator['hdcp' . $k] = 'required|numeric';
		}
 		foreach($colors as $color){
			$validator[$color . 'slope'] = 'required|numeric|between:55,150';
			for ($k = 1; $k <= 18; $k++){
				$validator[$color . $k] = 'required|numeric';
			}
		}
		$curCourse = \App\Models\Course::where('id', $request->old('idPass'))->first();
		//$this->validate($request, validator);
		foreach ($this->inputs as $input){
			$data = strtolower($request->old($input));
			$curCourse->{$input} = $data;
			if ($curCourse->{$input} == null){
				$curCourse->{$input} = "";
			}
		}
		$parSum1 = 0;
		$parSum2 = 0;
		for ($k = 1; $k <= 9; $k++){
			$curPar = intval($request->input('par' . $k));
			$curCourse->{'par' . $k} = $curPar;
			$curCourse->{'hdcp' . $k} = intval($request->input('hdcp' . $k));
			$parSum1 += $curPar;
		}
		$curCourse->parout = $parSum1;
		for ($k = 10; $k <= 18; $k++){
			$curPar = intval($request->input('par' . $k));
			$curCourse->{'par' . $k} = $curPar;
			$curCourse->{'hdcp' . $k} = intval($request->input('hdcp' . $k));
			$parSum2 += $curPar;
		}
		$curCourse->parin = $parSum2;
		$curCourse->partotal = $parSum1 + $parSum2;
		$curCourse->save();

		//delete old colors
		$oldColors = $curCourse->colors;
		foreach ($oldColors as $oldColor){
			$oldColor->delete();
		}
		

		//colors of course
		foreach($colors as $color){
			$newColor = new Color;
			$newColor->course_id = $curCourse->id;
			$newColor->color = $color;
			$newColor->slope = intval($request->input($color . 'slope'));
			$disSum1 = 0;
			$disSum2 = 0;
			for ($k = 1; $k <= 9; $k++){
				$curDis = intval($request->input($color . $k));
				$newColor->{'dis' . $k} = $curDis;
				$disSum1 += $curDis;
			}
			$newColor->disout = $disSum1;
			for ($k = 10; $k <= 18; $k++){
				$curDis = intval($request->input($color . $k));
				$newColor->{'dis' . $k} = $curDis;
				$disSum2 += $curDis;
			}
			$newColor->disin = $disSum2;
			$newColor->distotal = $disSum1 + $disSum2;
			$newColor->save();
		}
		return redirect('/admin/courselist');
	}
}
