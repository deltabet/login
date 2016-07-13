@extends('layouts.app')

@section('content')
<?php $course = \App\Models\Course::where('id', $idCourse)->first(); ?>

                    <form class="form-horizontal" role="form" method="POST" action="/editScore">
                        {{ csrf_field() }}
						<table>
							<tr>
								<td>Hole</td>					
								@for ($i = 1; $i <= 18; $i++)
								<td>{{$i}}</td>
								@endfor
							</tr>
						<?php $score = 
							\Auth::user()->scores()->where('course_id', $idCourse)->first();
							$hasScore = ($score != null); ?>
						@foreach($course->colors as $color)
						<tr>
							<?php $scoreColor = null;
								if ($hasScore){
								$scoreColor = 
									$score->scoreColors()->where('color', $color->color)->first();
									$hasScoreColor = ($scoreColor != null);
							} ?>
							<td>{{$color->color}}</td> <!-- capitalize -->	
							
							@for($k=1; $k<=18; $k++)
								<td><input type="text" 
									name="{{'' . $color->color . $k}}" size="2" 
									@if($hasScoreColor)
										value="<?php echo $scoreColor->{'sc' . $k}; ?>"
									@endif>
							@endfor
						</tr>
						@endforeach                      
						</table>
						<input type="hidden" name="idPass" value="{{$course->id}}">
						<input type="submit" value="submit" name="submit">
					 </form>

@endsection
