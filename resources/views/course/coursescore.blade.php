@extends('layouts.app')
<!-- pass in course, score object -->
@section('content')
<?php $course = \App\Models\Course::where('id', $idCourse)->first(); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$course->name}}</div>
                <div class="panel-body">
                    Address: {{$course->address}}, {{$course->city}}, {{$course->state}}, {{$course->zip}} </br>
					<a href= "{{$course->website}}">Website </a></br>
					Email: {{$course->email}}</br>
					Twitter: {{$course->twitter}}</br>
					Facebook: {{$course->facebook}}</br>
					Pinterest: {{$course->pinterest}}</br>
					<table border="1">
							<tr>
								<th style="width:65px">Hole</th>						
								@for ($i = 1; $i <= 9; $i++)
								<th style="width:35px">{{$i}}</th>
								@endfor
								<th style="width:35px">Out</th>
								@for ($i = 10; $i <= 18; $i++)
								<th style="width:35px">{{$i}}</th>
								@endfor
								<th style="width:35px">In</th>
								<th style="width:35px">Total</th>
								<th style="width:35px">Slope</th>
							</tr>
						@foreach($course->colors as $color)
						<tr>
							<td>{{$color->color}}</td> <!-- capitalize -->	
							
							@for($k=1; $k<=9; $k++)
								<td><?php echo $color->{'dis' . $k}; ?></td>
							@endfor
							<td>{{$color->disout}}</td>
							@for($k=10; $k<=18; $k++)
								<td><?php echo $color->{'dis' . $k}; ?></td>
							@endfor
							<td>{{$color->disin}}</td>
							<td>{{$color->distotal}}</td>
							<td>{{$color->slope}}</td>
						</tr>
						@endforeach
						<?php $idUser = \Auth::user()->id;
								$scores = $course->scores;
								$score = $scores->where('user_id', $idUser)->first();?>
						@foreach($course->colors as $color)
						<tr>
							<td>{{$color->color}}</td> <!-- capitalize -->	
							<?php $scoreColor = null;
							if ($score != null){
							$scoreColor = 
							$score->scoreColors()->where('color', $color->color)->first();
							} ?>	
							@for($k=1; $k<=9; $k++)
								<td>@if($scoreColor != null)
									<?php echo $scoreColor->{'sc' . $k}; ?>
								@endif</td>
							@endfor
							<td></td><!--out-->
							@for($k=10; $k<=18; $k++)
								<td>@if($scoreColor != null)
									<?php echo $scoreColor->{'sc' . $k}; ?>
								@endif</td>
							@endfor
							<td></td>
							<td></td>
							
							<td>{{$color->slope}}</td>
						</tr>
						@endforeach
							<tr>
								<td>Par</td>
								@for ($i = 1; $i <= 9; $i++)
								<td><?php echo $course->{'par' . $i}; ?></td>
								@endfor
								<td>{{$course->parout}}</td>
								@for ($i = 10; $i <= 18; $i++)
								<td><?php echo $course->{'par' . $i}; ?></td>
								@endfor
								<td>{{$course->parin}}</td>
								<td>{{$course->partotal}}</td>
								<td></td>
							</tr>
							<tr>
								<td>Handicap</td>
								@for ($i = 1; $i <= 9; $i++)
								<td><?php echo $course->{'hdcp' . $i}; ?></td>
								@endfor
								<td></td>
								@for ($i = 1; $i <= 9; $i++)
								<td><?php echo $course->{'hdcp' . $i}; ?></td>
								@endfor
								<td></td>
								<td></td>
								<td></td>
							</tr>                        
						</table>
					<form action ="{{'/editScore/' . $course->id}}">
					{{ csrf_field() }}
					<button  method = "GET" name = "enterscore" value = "{{$course->id}}">Edit Score</button> </form>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
