@extends('layouts.app')

@section('content')
<?php $course = \App\Models\Course::where('id', $idCourse)->first(); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Course</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/admin/courseEdit"> 	
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Street:</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control"  name="address" value="{{ $course->address }}">

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
                                <input id="city" type="text" class="form-control"  name="city" value="{{ $course->city }}">

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
                                <input id="state" type="text" class="form-control"  name="state" value="{{ $course->state }}">

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
                                <input id="zip" type="text" class="form-control"  name="zip" value="{{ $course->zip }}">

                                @if ($errors->has('zip'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


						<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone:</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control"  name="phone" value="{{ $course->phone }}">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $course->email }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


						<div class="form-group{{ $errors->has('twitter') ? ' has-error' : '' }}">
                            <label for="twitter" class="col-md-4 control-label">Twitter Link:</label>

                            <div class="col-md-6">
                                <input id="twitter" type="twitter" class="form-control" name="twitter" value="{{ $course->twitter }}">

                                @if ($errors->has('twitter'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('twitter') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


						<div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
                            <label for="facebook" class="col-md-4 control-label">Facebook Link:</label>

                            <div class="col-md-6">
                                <input id="facebook" type="facebook" class="form-control" name="facebook" value="{{ $course->facebook }}">

                                @if ($errors->has('facebook'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('facebook') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

						<div class="form-group{{ $errors->has('pinterest') ? ' has-error' : '' }}">
                            <label for="pinterest" class="col-md-4 control-label">Pinterest Link:</label>

                            <div class="col-md-6">
                                <input id="pinterest" type="pinterest" class="form-control" name="pinterest" value="{{ $course->pinterest }}">

                                @if ($errors->has('pinterest'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pinterest') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

						<div class="form-group{{ $errors->has('numcolor') ? ' has-error' : '' }}">
                            <label for="numcolor" class="col-md-4 control-label">Number of Tee Colors:</label>

                            <div class="col-md-6">
								<?php $hasBlack = 
							($course->colors()->where('color', 'Black')->first() != null);
									$hasGold = 
							($course->colors()->where('color', 'Gold')->first() != null);
									$hasGreen = 
							($course->colors()->where('color', 'Green')->first() != null);
									$hasRed = 
							($course->colors()->where('color', 'Red')->first() != null); ?>
								Blue and White Required</br>
                                <input type="radio" name="blacktee" value="Black"
								@if($hasBlack)
									checked
								@endif  >Black</br>
								<input type="radio" name="goldtee" value="Gold"
								@if($hasGold)
									checked
								@endif  >Gold</br>
								<input type="radio" name="greentee" value="Green"
								@if($hasGreen)
									checked
								@endif  >Green</br>
								<input type="radio" name="redtee" value="Red"
								@if($hasRed)
									checked
								@endif  >Red</br>
                            </div>
                        </div>

						<input type="hidden" name="idPass" value="{{$course->id}}">
						<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" name="submit">
                                    <i class="fa fa-btn fa-user"></i> Continue
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
