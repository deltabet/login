@extends('layouts.app')

@section('content')
<?php $player = App\Models\Player::where('id', $idPlayer)->first(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{$player->name}}</div>
                <div class="panel-body">
                    Scores
                </div>
				<div>
					<table border="1">
						<tr>
							<th style="width:65px">Course</th>
							<th style="width:65px">Score(view)</th>
							<th style="width:65px">Date</th>
						</tr>
						@foreach($player->scores as $score)
						<tr>
							<td>{{$score->course}}</td>
							<td>{{App\Http\Controllers\SearchController::getScore($score)}}</td>
							<td>{{$score->date}}</td>
							<td><a href ="{{'/player/view/' . $player->id .'/' . $score->id}}">
					
					<button  method = "GET" name = "seeScore" value = "{{$score->id}}">See Score
						</a></td>
						</tr>
						@endforeach
					</table>
				</div> 
				</div> 
            </div>
        </div>
    </div>
</div> 
@endsection
