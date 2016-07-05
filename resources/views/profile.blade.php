@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>

                <div class="panel-body">
                    Name: {{ Auth::user()->name }}
                </div>

			<div class="panel-body">
                    Email: {{ Auth::user()->email }}
                </div>

 			<div class="panel-body">
                    Address: {{ Auth::user()->address }}, {{Auth::user()->city}}, {{ Auth::user()->state }}, {{ Auth::user()->zip }}
                </div>

			<div class="panel-body">
                    Date of Birth: {{ Auth::user()->birthday }}  
                </div>

			<div class="panel-body">
                    Phone Number: {{ Auth::user()->phone }}
                </div>
			<div class="panel-body">
	<a href="{{ url('/profile/edit') }}">Change Profile Information</a>
			</div>
            </div>
        </div>
    </div>
</div>
@endsection
