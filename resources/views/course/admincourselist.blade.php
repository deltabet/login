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
				@foreach (App\Models\Course::all() as $course)
					<div class="panel-body">
                    {{$course->name}} </br>
                    Address: {{$course->address}}, {{$course->city}}, {{$course->state}}, {{$course->zip}} </br>
					<a href= "{{$course->website}}">Website </a></br>
					Email: {{$course->email}}</br>
					Twitter: {{$course->twitter}}</br>
					Facebook: {{$course->facebook}}</br>
					Pinterest: {{$course->pinterest}}</br>
					<a href= "{{$course->website}}">Website </a></br>
					<form action ="{{'/admin/course/' . $course->id}}">
					{{ csrf_field() }}
					<button  method = "GET" name = "seeCourse" value = "{{$course->id}}">See Course</button> </form>
					</div>
				@endforeach
                </div>    
        </div>
    </div>
</div>
@endsection
