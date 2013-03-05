@extends('layouts.master')

@section('title')
&ndash; Login
@stop

@section('css')
	.login-form {
		@if ( count($errors->all()) > 0 )
			max-width: 800px;
		@else
			max-width: 500px;
		@endif
		margin: auto;
	}
@stop

@section('content')
	<div class="row-fluid">
		<form class="login-form form-horizontal well" action="/login" method="post">
			<fieldset>
				<legend>Please login...</legend>

				@if ( Session::has('loginError') )
					<div class="alert alert-error">
						{{ Session::get('loginError') }}
					</div>
				@endif

				<div class="control-group @if( $errors->has('email') )error@endif">
					<label class="control-label" for="email">Email</label>
					<div class="controls">
						<input type="email" id="email" name="email" placeholder="your email address" value="{{ Input::old('email') }}" required>
						@if ( $errors->has('email') )
							{{{ $errors->first('email') }}}
						@endif
					</div>
				</div>

				<div class="control-group @if( $errors->has('password') )error@endif">
					<label class="control-label" for="password">Password</label>
					<div class="controls">
						<input type="password" id="password" name="password" placeholder="your password" required>
						@if ( $errors->has('password') )
							{{{ $errors->first('password') }}}
						@endif
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="remember">Remember me?</label>
					<div class="controls">
						<input type="checkbox" id="remember" name="remember" @if( Input::old('remember') )checked@endif>
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-large btn-primary">Login</button>
						<span class="help-inline"><a href="/password/remind">Forgot your password?</a></span>
					</div>
				</div>
        
        <input type="hidden" name="csrf_token" value="{{{ csrf_token() }}}">
			</fieldset>
		</form>
	</div>
@stop

