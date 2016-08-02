@extends('layouts.app')

@section('content')
<?php $recentScores = session('recentScores'); 
		$user = session('user'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>
				@if(Auth::Guest() == false)
                <div class="panel-body">
                    Recent Scores
					<a href="/player/new">Add Player</a>
						

                </div>
				<div>
					<table border="1">
						<tr>
							<th style="width:65px">Player(view)</th>
							<th style="width:65px">Age</th>
							<th style="width:65px">Course</th>
							<th style="width:65px">Score(view)</th>
						</tr>
						@foreach($recentScores as $score)
						<tr>
							<td><a href="{{'/player/' . $user->id}}">{{$score['name']}}</a></td>
							<td>{{$score['age']}}</td>
							<td>{{$score['course']}}</td>
							<td><a href="{{'/player/' . $user->id . '/' . $score['scoreid']}}">{{$score['score']}}</a></td>
						</tr>
						@endforeach
					</table>
				</div> 
				@endif
            </div>
        </div>
    </div>
</div>
@endsection
