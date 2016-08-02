<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'scores';
	protected $fillable = [
        'player_id', 'course_id', 'date',
    ];

	public function player(){
		return $this->belongsTo('App\Models\Player');
	}

	public function course(){
		return $this->belongsTo('App\Models\Course');
	}

	public function scoreColors(){
		return $this->hasMany('App\Models\ScoreColor');
	}
}
