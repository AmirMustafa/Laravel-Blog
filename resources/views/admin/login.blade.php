@extends('layouts.admin-master')

@section('styles')
<!-- <link rel="stylesheet" href="{{ URL::secure('public/src/css/form.css') }}" type="text/css"> -->

<link rel="stylesheet" href="{{ URL::to('public/src/css/form.css') }}" type="text/css">

@endsection		<!-- Note: URL::secure handles URL::to (better when SSL Certificate is used) -->

@section('content')
	<div class="container">
		@include('includes.info-box')

		<form action="{{ route('admin.login') }}" method="post">
			<div class="input-group">
				<label for="email">E-Mail</label>
				<input type="text" name="email" id="email" {{ $errors->has('email') ? 'class=has-error' : '' }} value="{{ Request::old('email') }}" />

				<label for="password">Password</label>
				<input type="password" name="password" id="password" {{ $errors->has('password') ? 'class=has-error' : '' }}  />

				<button type="submit" class="btn">Login</button>
				<input type="hidden" name="_token" value="{{ Session::token() }}" />
			</div>
		</form>
	</div>
@endsection