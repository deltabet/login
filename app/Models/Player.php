<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'players';
	protected $fillable = [
        'user_id', 'name', 'birthday'
    ];

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function scores(){
		return $this->hasMany('App\Models\Score');
	}
}
