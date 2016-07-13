<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScoreColor extends Model
{
    protected $table = 'scoreColors';
	protected $fillable = [
		'score_id', 'color', 
		'sc1','sc2','sc3','sc4','sc5','sc6','sc7','sc8','sc9','sc10',
		'sc11','sc12','sc13','sc14','sc15','sc16','sc17','sc18'
	];

	public function scores(){
		return $this->belongsTo('App\Models\Score');
	}
}
