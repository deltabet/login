<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Color;

class SearchController extends Controller
{
    public function filterList(Request $request){
		$filter = explode('/', $request->fullurl());
		$final = $filter[count($filter) - 1];
		if ($final == 'courselist'){
			return redirect('/courselist');
		}
		$params = explode('+', $final);
		$courses = Course::all();
		$count = 0;
		$max = count($params);
		$curString = "";
		if ($count < $max){
			$curStrArr = explode(':', $params[$count]);
			if ($curStrArr[0] == 'name'){
				$curString = str_replace('%20', ' ', $curStrArr[1]);
				$courses = $courses->where('name', $curString);
				$count++;
			}
		}
		if ($count < $max){
			$curStrArr = explode(':', $params[$count]);
			if ($curStrArr[0] == 'city'){
				$curString = str_replace('%20', ' ', $curStrArr[1]);
				$courses = $courses->where('city', $curString);
				$count++;
			}
		}
		if ($count < $max){
			$curStrArr = explode(':', $params[$count]);
			if ($curStrArr[0] == 'state'){
				$curString = str_replace('%20', ' ', $curStrArr[1]);
				$courses = $courses->where('state', $curString);
				$count++;
			}
		}
		if ($count < $max){
			$curStrArr = explode(':', $params[$count]);
			if ($curStrArr[0] == 'zip'){
				$curString = str_replace('%20', ' ', $curStrArr[1]);
				$courses = $courses->where('zip', $curString);
				$count++;
			}
		}
		return view('course/courselist', ['courses' => $courses, 'curString' => $curString]);
	}

	public function filterURL(Request $request){
		$name = strtolower($request->input('name'));	
		$city = strtolower($request->input('city'));
		$state = strtolower($request->input('state'));
		$zip = strtolower($request->input('zip'));	
		$url = '/courselist/';
		if ($name != "" && $name != null){
			$name = str_replace(' ', '%20', $name);
			$url = $url . 'name:' . $name . '+';
		}
		if ($city != "" && $city != null){
			$city = str_replace(' ', '%20', $city);
			$url = $url . 'city:' . $city . '+';
		}
		if ($state != "" && $state != null){
			$state = str_replace(' ', '%20', $state);
			$url = $url . 'st:' . $state . '+';
		}
		if ($zip != "" && $zip != null){
			$zip = str_replace(' ', '%20', $zip);
			$url = $url . 'zip:' . $zip . '+';
		}
		//remove last '+'
		$url = substr($url, 0, -1);
		return redirect($url);
		
	}
}
