@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
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
					<form action ="{{'/score/' . $course->id}}">
					{{ csrf_field() }}
					<button  method = "GET" name = "seeScore" value = "{{$course->id}}">See Score</button> </form>
					
					
					</div>
				@endforeach 
                </div>    
        </div>
    </div>
</div>
@endsection



<?php /*
<div class="panel-body">
                    {{$course->name}} <\br>
                    Address: {{$course->address}}, {{$course->city}}, {{$course->state}}, {{$course->zip}} </br>
					<a href= "{{$course->website}}">Website </a></br>
					Email: {{$course->email}}</br>
					Twitter: {{$course->twitter}}</br>
					Facebook: {{$course->facebook}}</br>
					Pinterest: {{$course->pinterest}}</br>
					<form action ="/courselist">
					{{ csrf_field() }}
					<button  method = "POST" name = "seeScore" value = "{{$course->id}}">See Score</button> </form>
					</div>
*/?>
