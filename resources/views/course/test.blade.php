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
