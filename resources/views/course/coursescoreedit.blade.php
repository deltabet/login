@extends('layouts.app')

@section('content')
<?php $course = \App\Models\Course::where('id', $idCourse)->first();
	$players = Auth::User()->players; ?>
					<script>
					function changeHome(){
						var date = new Date();
						date.setTime(date.getTime() + (2 * 24 * 60 * 60 * 1000));
						var expires = date.toUTCString();
						document.cookie = 'change_home='+'true'+';'+'expires='+expires+';path=/;';
					}
					</script>

                    <form class="form-horizontal" role="form" method="POST" action="/editScore">
                        {{ csrf_field() }}
						Select Player:</br>
						@foreach($players as $player)
						<input type="radio" name="playerSelect" value="{{$player->id}}" checked>{{$player->name}}
					@endforeach
						<table>
							<tr>
								<td>Hole</td>					
								@for ($i = 1; $i <= 18; $i++)
								<td>{{$i}}</td>
								@endfor
							</tr>
						@foreach($course->colors as $color)
						<tr>
							<td>{{$color->color}}</td> 
							
							@for($k=1; $k<=18; $k++)
								<td><input type="text" 
									name="{{'' . $color->color . $k}}" size="2" >
							@endfor
						</tr>
						@endforeach                      
						</table>
						<input type="hidden" name="idPass" value="{{$course->id}}">
						<input type="submit" value="submit" name="submit" onclick="changeHome()">
					 </form>

@endsection
