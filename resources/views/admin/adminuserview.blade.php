@extends('layouts.app')

@section('content')
<?php $useredit = App\User::where('id', $idedit)->first(); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>

                <div class="panel-body">
                    Name: {{ $useredit->name }}
                </div>

			<div class="panel-body">
                    Email: {{ $useredit->email }}
                </div>

 			<div class="panel-body">
                    Address: {{ $useredit->address }}, {{$useredit->city}}, {{ $useredit->state }}, {{ $useredit->zip }}
                </div>

			<div class="panel-body">
                    Date of Birth: {{ $useredit->month }} {{ $useredit->day }}, {{ $useredit->year }}  
                </div>

			<div class="panel-body">
                    Phone Number: {{ $useredit->phone }}
                </div>
			<div class="panel-body">
	<a href="{{route('adminedit', ['idedit' => $idedit])}}">Change Profile Information</a>
			</div>
            </div>
        </div>
    </div>
</div>
@endsection
