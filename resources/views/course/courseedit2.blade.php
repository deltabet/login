@extends('layouts.app')

@section('content')
<?php $course = \App\Models\Course::where('id', $idCourse)->first(); ?>
                    <form class="form-horizontal" role="form" method="POST" action="/admin/courseEdit2">
                        {{ csrf_field() }}
						<table>
							<tr>
								<td>Hole</td>					
								@for ($i = 1; $i <= 18; $i++)
								<td>{{$i}}</td>
								@endfor
								<td>Slope</td>
							</tr>
						@foreach($colors as $color)
						<tr>
							<td>{{$color}}</td> <!-- capitalize -->	
							<?php $hasColor = 
							($course->colors()->where('color', $color)->first() != null); 
								$curColor = "";?>
							@if($hasColor == true)
								<?php $curColor = 
								$course->colors()->where('color', $color)->first(); 
							    $disArray = json_decode($color->dis); ?>
							@endif
							@for($k=1; $k<=18; $k++)
								<td><input type="text" size="2" name="{{'' . $color . $k}}" 
								@if($hasColor == true)
								value={{$disArray[$k-1]}}"
								@endif
								></td>
							@endfor
							<td><input type="text" size="2" name="{{$color . 'slope'}}"
								@if($hasColor == true) 
								value="{{$curColor->slope}}"></td>
								@endif
						</tr>
						@endforeach
							<tr>
								<?php $parArray = json_decode($course->par); ?>
								<td>Par</td>
								@for ($i = 1; $i <= 18; $i++)
								<td><input type="text" size="2" name="{{'par' . $i}}" 				
							value="{{$parArray[$i-1]}}"></td>
								@endfor
								<td></td>
							</tr>
							<tr>
								<?php $hdcpArray = json_decode($course->hdcp); ?>
								<td>Handicap</td>
								@for ($i = 1; $i <= 18; $i++)
								<td><input type="text" size="2" name="{{'hdcp' . $i}}" 	
									value="{{$hdcpArray[$i-1]}}"></td>
								@endfor
								<td></td>
							</tr>                        
						</table>
						<input type="submit"  name="submit">
					 </form>
@endsection
