@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Course List</div>
				<div>
						Filter List:
					<form action="/courselist/filter" method = "POST">
						{{ csrf_field() }}
						Name: <input type="text" name="name"></br>
						City: <input type="text" name="city"></br>
						State: <input type="text" name="state"></br>
						Zip: <input type="text" name="zip"></br>
						<input type="submit" name="submit"></br>
					</form>
				</div>
				<table border="1">
					<tr>
						<th style="width:150px">Name</th>
						<th style="width:200px">Address</th>
						<th style="width:100px">Phone</th>
						<th style="width:100px">Email</th>
						<th style="width:250px">Websites</th>
						<th style="width:20px">Get Score</th>
					</tr>
					@foreach($courses as $course)
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
							<a href="{{$course->twitter}}"><img alt="twitter" src="twitter.png" width="25" height="25"></a>
							<a href="{{$course->facebook}}"><img alt="facebook" src="facebook.jpeg" width="25" height="25"></a>
							<a href="{{$course->pinterest}}"><img alt="pinterest" src="pinterest.jpg" width="25" height="25"></a>
						</td>
						<td><form action ="{{'/course/' . $course->id'}}">
					
					<button  method = "GET" name = "seeScore" value = "{{$course->id}}">See Score
						</button> </form></td>
					</tr>
					@endforeach

				</table>
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
