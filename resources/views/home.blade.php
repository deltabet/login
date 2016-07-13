@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
   				@if (App\Http\Controllers\AdminController::isAdmin())
					<div class="panel-body">
                    	<a href="{{ route('userlist') }}">User List</a> </br>
						<a href="/admin/courselist">Admin Course List</a>
                	</div>
				@endif
				<div>
				<a href="/courselist">Course List</a>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
