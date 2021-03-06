@extends('layouts.app')

@section('content')
<?php $course = \App\Models\Course::where('id', $idCourse)->first(); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ucwords($course->name)}}</div>
                <div class="panel-body">
                   {{ucwords($course->name)}} </br>
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
							<?php $disArray = json_decode($color->dis); ?>
							<td>{{$color->color}}</td> <!-- capitalize -->	
							
							@for($k=1; $k<=9; $k++)
								<td>{{$disArray[$k - 1]}}</td>
							@endfor
							<td>{{$color->disout}}</td>
							@for($k=10; $k<=18; $k++)
								<td>{{$disArray[$k - 1]}}</td>
							@endfor
							<td>{{$color->disin}}</td>
							<td>{{$color->distotal}}</td>
							<td>{{$color->slope}}</td>
						</tr>
						@endforeach
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
						<form action ="{{'/admin/courseEdit/' . $course->id}}">
					{{ csrf_field() }}
					<button  method = "GET" name = "editcourse" value = "{{$course->id}}">Edit Course</button> </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
