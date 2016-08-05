@extends('layouts.app')

@section('content')
<!-- <script>
	function validateEmpty(field){
		var x = document.getElementById(field).value;
		if (x == null || x == ""){
			document.getElementById(field + "Error").innerHTML = "Need Name";
		}
		else{
			document.getElementById(field + "Error").innerHTML = "";
		}
	}
</script> -->
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">New Player</div>
                <div class="panel-body">
                     <form class="form-horizontal" role="form" method="POST" action="/player/new">
                        {{ csrf_field() }}


						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
								<p id = "nameError"></p>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" onblur = "validateEmpty('name')" onfocus = "validateEmpty('name')">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                            <label for="birthday" class="col-md-4 control-label">Birthday:</label>

                            <div class="col-md-6">
								<p id = "birthdayError"></p>
                                <input id="birthday" type="text" class="form-control"  name="birthday" value="{{ old('birthday') }}" onblur = "validateEmpty('birthday')" onfocus = "validateEmpty('birthday')">

                                @if ($errors->has('birthday'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

			


						<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" name="submit" onclick="changeHome()">
                                    <i class="fa fa-btn fa-user"></i> Submit
                                </button>
                            </div>
                        </div>
					</form> 
					
 
					<script>
					function changeHome(){
						var date = new Date();
						date.setTime(date.getTime() + (2 * 24 * 60 * 60 * 1000));
						var expires = date.toUTCString();
						document.cookie = 'change_home='+'true'+';'+'expires='+expires+';path=/;';
					}
					</script>
					
					<p id="test">yyy</p>
					<p id="test2">ok</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
