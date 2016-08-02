@extends('layouts.app')
<!-- pass in course, score object -->
@section('content')
<?php $course = \App\Models\Course::where('id', $idCourse)->first(); 
$addr = str_replace(" ", "+", $course->address) . ","
	. str_replace(" ", "+", $course->city) . "+"
    . str_replace(" ", "+", $course->state) . ","
	. str_replace(" ", "+", $course->zip); 
	 ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ucwords($course->name)}}</div>
                <div class="panel-body">
                    Address: {{ucwords($course->address)}}, {{ucwords($course->city)}}, {{ucwords($course->state)}}, {{$course->zip}} </br>
					Phone: {{$course->phone}}</br>
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
							<?php $colorArray = json_decode($color->dis); ?>
							<td>{{$color->color}}</td> <!-- capitalize -->	
							
							@for($k=1; $k<=9; $k++)
								<td>{{$colorArray[$k - 1]}}</td>
							@endfor
							<td>{{$color->disout}}</td>
							@for($k=10; $k<=18; $k++)
								<td>{{$colorArray[$k - 1]}}</td>
							@endfor
							<td>{{$color->disin}}</td>
							<td>{{$color->distotal}}</td>
							<td>{{$color->slope}}</td>
						</tr>
						@endforeach
						<!-- <?php $idUser = \Auth::user()->id;
								$scores = $course->scores;
								$score = $scores->where('user_id', $idUser)->first();?>
						 @foreach($course->colors as $color)
						 <tr>
							<td>{{$color->color}}</td> 	
							<?php $scoreColor = null;
							if ($score != null){
							$scoreColor = 
							$score->scoreColors()->where('color', $color->color)->first();
							}
							$scoreArray = array();
							if ($scoreColor != null){
								$scoreArray = json_decode($scoreColor->sc);
							} ?>	
							@for($k=1; $k<=9; $k++)
								<td>@if($scoreColor != null)
									{{$scoreArray[$k - 1]}}
								@endif</td>
							@endfor
							<td>@if($scoreColor != null) {{$scoreColor->scout}} @endif</td>
							@for($k=10; $k<=18; $k++)
								<td>@if($scoreColor != null)
									{{$scoreArray[$k - 1]}}
								@endif</td>
							@endfor
							<td>@if($scoreColor != null) {{$scoreColor->scin}} @endif</td>
							<td>@if($scoreColor != null) {{$scoreColor->sctotal}} </td>
							
							<td>{{$color->slope}} @endif</td>
						</tr> 
						@endforeach  -->
							<tr>
								<?php $parArray = json_decode($course->par); ?>
								<td>Par</td>
								@for ($i = 1; $i <= 9; $i++)
								<td>{{$parArray[$i - 1]}}</td>
								@endfor
								<td>{{$course->parout}}</td>
								@for ($i = 10; $i <= 18; $i++)
								<td>{{$parArray[$i - 1]}}</td>
								@endfor
								<td>{{$course->parin}}</td>
								<td>{{$course->partotal}}</td>
								<td></td>
							</tr>
							<tr>
								<?php $hdcpArray = json_decode($course->hdcp); ?>
								<td>Handicap</td>
								@for ($i = 1; $i <= 9; $i++)
								<td>{{$hdcpArray[$i - 1]}}</td>
								@endfor
								<td></td>
								@for ($i = 10; $i <= 18; $i++)
								<td>{{$hdcpArray[$i - 1]}}</td>
								@endfor
								<td></td>
								<td></td>
								<td></td>
							</tr>                       
						</table> 
					
					<form action ="{{'/course/' . $course->id . /editScore' }}">
					{{ csrf_field() }}
					<button  method = "GET" name = "enterscore" value = "{{$course->id}}">Edit Score</button> </form>
				</div>
				<div>
					<iframe
					  width="600"
					  height="450"
					  frameborder="0" style="border:0"
					  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBzYHcdBuGkEUB6AJIQVPe6pG2O5-WDKqI 
						&q={{$addr}}" allowfullscreen>
					</iframe>
						
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
