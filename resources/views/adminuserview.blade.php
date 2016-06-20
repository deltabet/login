@extends('layouts.app')

@section('content')
<?php $useredit = App\User::getUserById($idedit); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>

                <div class="panel-body">
                    Name: {{ $useredit['name']->name }}
                </div>

			<div class="panel-body">
                    Email: {{ $useredit['email']->email }}
                </div>

 			<div class="panel-body">
                    Address: {{ $useredit['address']->address }}, {{$useredit['city']->city}}, {{ $useredit['state']->state }}, {{ $useredit['zip']->zip }}
                </div>

			<div class="panel-body">
                    Date of Birth: {{ $useredit['month']->month }} {{ $useredit['day']->day }}, {{ $useredit['year']->year }}  
                </div>

			<div class="panel-body">
                    Phone Number: {{ $useredit['phone']->phone }}
                </div>
			<div class="panel-body">
	<a href="{{'/admin/edituser/' . $idedit}}">Change Profile Information</a>
			</div>
            </div>
        </div>
    </div>
</div>
@endsection
