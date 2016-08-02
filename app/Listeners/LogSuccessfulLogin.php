<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Course\SearchController;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
		$recentScores = array();
		$user = \Auth::User();
		session()->put('user', $user);
		$i = 0;
		foreach($user->players as $player){
			$i = $player->id;
			$recentScores[$i] = array();
			$recentScore = $player->scores->sortByDesc('created_at')->first();
			$recentScores[$i]['name'] = $player->name;
			$recentScores[$i]['age'] = SearchController::getAge(date('m/d/Y'), $player->birthday);
			if ($recentScore != null){
				$recentScores[$i]['course'] = $recentScore->course->name;
				$recentScores[$i]['score'] = SearchController::getScore($recentScore);
				$recentScores[$i]['scoreid'] = $recentScore->id;
			}
			else{
				$recentScores[$i]['course'] = "";
				$recentScores[$i]['score'] = 0;
				$recentScores[$i]['scoreid'] = -1;
			}
		} 
		session()->put('recentScores', $recentScores);
    }

	
	
	
}
