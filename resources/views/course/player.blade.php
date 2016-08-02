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
					<table>
						<tr>
							<th>Course</th>
							<th>Score(view)</th>
							<th>Date</th>
						</tr>
						@foreach($player->scores as $score)
						<tr>
							<td>{{$score->course}}</td>
							<td>{{App\Http\Controllers\SearchController::getScore($score)}}</td>
							<td>{{$score->date}}</td>
							<td><form action ="{{'/player/ . $player->id .'/' . $score->id}}">
					
					<button  method = "GET" name = "seeScore" value = "{{$score->id}}">See Score
						</button> </form></td>
						</tr>
						@endforeach
					</table>
				</div> 
            </div>
        </div>
    </div>
</div>
@endsection
