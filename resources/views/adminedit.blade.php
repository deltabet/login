@extends('layouts.app')

@section('content')
<?php $useredit = App\User::getUserById($idedit) ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/edituser/edit') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $useredit['name']->name }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Street:</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control"  name="address" value="{{ $useredit['address']->address }}">

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

			<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label">City:</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control"  name="city" value="{{ $useredit['city']->city }}">

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

   			<div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <label for="state" class="col-md-4 control-label">State:</label>

                            <div class="col-md-6">
                                <input id="state" type="text" class="form-control"  name="state" value="{{ $useredit['state']->state }}">

                                @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

				<div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                            <label for="zip" class="col-md-4 control-label">Zip Code:</label>

                            <div class="col-md-6">
                                <input id="zip" type="text" class="form-control"  name="zip" value="{{ $useredit['zip']->zip }}">

                                @if ($errors->has('zip'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

				<div class="form-group{{ $errors->has('month') ? ' has-error' : '' }}">
                            <label for="month" class="col-md-4 control-label">Month:</label>

                            <div class="col-md-6">
                                <input id="month" type="text" class="form-control"  name="month" value="{{ $useredit['month']->month }}">

                                @if ($errors->has('month'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('month') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

				<div class="form-group{{ $errors->has('day') ? ' has-error' : '' }}">
                            <label for="day" class="col-md-4 control-label">Day:</label>

                            <div class="col-md-6">
                                <input id="day" type="text" class="form-control"  name="day" value="{{ $useredit['day']->day }}">

                                @if ($errors->has('day'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('day') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

				<div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                            <label for="year" class="col-md-4 control-label">Year:</label>

                            <div class="col-md-6">
                                <input id="year" type="text" class="form-control"  name="year" value="{{ $useredit['year']->year }}">

                                @if ($errors->has('year'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

					<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone:</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control"  name="phone" value="{{ $useredit['phone']->phone }}">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

					<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="isadmin" class="col-md-4 control-label">Set as Admin?:</label>

                            <div class="col-md-6">
                                <input type="radio" name="isadmin" value="false" checked>No Admin Privliges</br>
<input type="radio" name="isadmin" value="true">Grant Admin Privliges</br>
                              
                            </div>
                        </div>
				

                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id = "idedit" name = "idedit" value = "{{$idedit}}>
                                    <i class="fa fa-btn fa-user"></i> Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
