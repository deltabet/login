@extends('layouts.app')

@section('content')


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
				<div id="recent">
					<?php $recentScores = session('recentScores'); ?>

					<table border="1">
						<tr>
							<th style="width:65px">Player(view)</th>
							<th style="width:65px">Age</th>
							<th style="width:65px">Course</th>
							<th style="width:65px">Score(view)</th>
							<th style="width:65px"></th>
						</tr>
						@foreach($recentScores as $key => $score)
						<tr>
							<td><a href="{{'/player/view/' . $key}}">{{$score['name']}}</a></td>
							<td>{{$score['age']}}</td>
							<td>{{$score['course']}}</td>
	
							@if ($score['score'] != "" && $score['score'] != null)
							<td><a href="{{'/player/view/' . $key . '/' . $score['scoreid']}}">{{$score['score']}}</a></td>
							@else
							<td>{{$score['score']}}</td>
							@endif
							<td><form action ="/deleteplayer" method="POST">
					{{ csrf_field() }}
					<button name = "iddelete" value = "{{$key}}">Delete</button> </form></td>
						</tr>
						@endforeach
					</table>
				</div> 
				<script>
					function getCookieValue(){
						var ca = document.cookie.split(';')[1];
							var cookieNameValue = ca.split('=');
							var cookieName = cookieNameValue[0];
							var cookieValue = cookieNameValue[1];
							return cookieValue;

					}
					var x = 0;
					function listenCookie(callback){
						setInterval(function(){
							var cookieValue = getCookieValue();
							document.getElementById("test").innerHTML = cookieValue;
							document.getElementById("test2").innerHTML = x;
							if (cookieValue == 'true'){
								x++;
								//set cookie to false
								var date = new Date();
								date.setTime(date.getTime() + (2 * 24 * 60 * 60 * 1000));
								var expires = date.toUTCString();
								document.cookie = 'change_home='+'false'+';'+'expires='+expires+';path=/;';
								return callback();
							}
						}, 1000);
					}
					//bind
					listenCookie(function(){
						req = new XMLHttpRequest();
						req.onload = function(){
							document.getElementById("recent").innerHTML = this.response;
						};
						req.open("GET", "/recent", false);
						req.send(null);
					});
				</script>
				@endif
				<p id="test">ok</p>
				<p id="test2">ok</p>
            </div>
        </div>
    </div>
</div>
@endsection
