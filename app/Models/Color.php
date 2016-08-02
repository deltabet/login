<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';
	protected $fillable = [
		'course_id', 'color', 'slope', 
		'dis', 'disin', 'disout', 'distotal',
	];

	public function course(){
		return $this->belongsTo('App\Models\Course');
	}
	/* 1','dis2','dis3','dis4','dis5','dis6','dis7','dis8','dis9','dis10',
		'dis11','dis12','dis13','dis14','dis15','dis16','dis17','dis18 */
}
