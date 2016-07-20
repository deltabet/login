@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
				<form action ="/admin/newCourse">
					{{ csrf_field() }}
					<button  method = "GET" name = "newCourse">New Course</button> </form>
                <div class="panel-heading">Course List</div>
				<table border="1">
					<tr>
						<th style="width:150px">Name</th>
						<th style="width:200px">Address</th>
						<th style="width:100px">Phone</th>
						<th style="width:100px">Email</th>
						<th style="width:250px">Websites</th>
						<th style="width:20px">Get Score</th>
					</tr>
					@foreach(App\Models\Course::all() as $course)
					<tr>
						<td>{{ucwords($course->name)}}</td>
						<td>{{ucwords($course->address)}}, </br> {{ucwords($course->city)}}, {{ucwords($course->state)}}, {{$course->zip}}</td>
						<?php $phone = $course->phone;
								$phone1 = substr($phone, 0, 3);
								$phone2 = substr($phone, 3, 3);
								$phone3 = substr($phone, 6, 4); ?>
						<td>{{$phone1}}-{{$phone2}}-{{$phone3}}</td>
						<td>{{$course->email}}</td>
						<td><a href= "{{$course->website}}">{{$course->website}}</a> 
							<a href="{{$course->twitter}}"><img alt="twitter" src="/twitter.png" width="25" height="25"></a>
							<a href="{{$course->facebook}}"><img alt="facebook" src="/facebook.jpeg" width="25" height="25"></a>
							<a href="{{$course->pinterest}}"><img alt="pinterest" src="/pinterest.jpg" width="25" height="25"></a>
						</td>
						<td><form action ="{{'/admin/course/' . $course->id}}">
					{{ csrf_field() }}
					<button  method = "GET" name = "seeCourse" value = "{{$course->id}}">See Course</button> </form></td>
					</tr>
					@endforeach

				</table>
                </div>    
        </div>
    </div>
</div>
@endsection
