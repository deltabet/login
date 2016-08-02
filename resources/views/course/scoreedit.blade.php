@extends('layouts.app')

@section('content')
<?php $score = \App\Models\Score::where('id', $idScore)->first();
	$player = \App\Models\Player::where('id', $idPlayer)->first();
	$course = $score->course; ?>

                    <form class="form-horizontal" role="form" method="POST" action="/editScore">
                        {{ csrf_field() }}
						
						
					
						<table>
							<tr>
								<td>Hole</td>					
								@for ($i = 1; $i <= 18; $i++)
								<td>{{$i}}</td>
								@endfor
							</tr>
						@foreach($course->colors as $color)
						<tr>
							<?php $scoreColor = null;
								$hasScoreColor = false;
								$scoreArray = array();
								if ($hasScore){
								$scoreColor = 
									$score->scoreColors()->where('color', $color->color)->first();
									$hasScoreColor = ($scoreColor != null);
									$scoreArray = json_decode($scoreColor->sc);
							} ?>
							<td>{{$color->color}}</td> <!-- capitalize -->	
							
							@for($k=1; $k<=18; $k++)
								<td><input type="text" 
									name="{{'' . $color->color . $k}}" size="2" 
									@if($hasScoreColor)
										value="{{$scoreArray[$k-1]}}"
									@endif>
							@endfor
						</tr>
						@endforeach                      
						</table>
						<input type="hidden" name="idPass" value="{{$course->id}}">
						<input type="hidden" name="playerSelect" value="{{$player->id}}">
						<input type="submit" value="submit" name="submit">
					 </form>

@endsection
