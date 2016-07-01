@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if(Session::has('adminReset'))
				<div class="adminReset">
					<font color="green">{{Session::get('adminReset')}}</font>
				</div>
			@endif
            <div class="panel panel-default">
                <div class="panel-heading">Profiles</div>
				<div class="panel-body">
				<a href="/admin/newuser">Add User</a>
				</div>
				@foreach (App\User::all() as $user)
					<div class="panel-body">
                    {{$user->name}}, {{$user->email}}
					<form action ="{{route('adminview', ['idedit' => $user->id])}}">
					{{ csrf_field() }}
					<button  method = "POST" name = "idedit{{$user->id}}" value = "{{$user->id}}"> View User</button> </form>
					<form action ="{{route('adminreset')}}" method="POST">
					{{ csrf_field() }}
					<button  method="POST" name = "email" value = "{{$user->email}}"> Reset Password</button> </form>
                </div>
				@endforeach
            </div>
        </div>
    </div>
</div>
@endsection
