@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Profiles</div>
				<div class="panel-body">
				<a href="/admin/newuser"> Add User</a>
				</div>
				@foreach (App\User::allUsers() as $user)
					<div class="panel-body">
                    {{$user->name}}, {{$user->email}}
					<form action ="/admin/user/{{$user->id}}">
					<button  method = "POST" name = "idedit" value = "{{$user->id}}"> View User</button> </form>
					<form action ="/admin/reset">
					<button  method = "POST" name = "email" value = "{{$user->email}}"> Reset Password</button> </form>
                </div>
				@endforeach
            </div>
        </div>
    </div>
</div>
@endsection
