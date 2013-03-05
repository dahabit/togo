@extends('layouts.master')

@section('title')
&ndash; Register
@stop

@section('css')
	.register-form {
		@if( count($errors->all()) > 0 )
			max-width: 800px;
		@else
			max-width: 500px;
		@endif
		margin: auto;
	}
@stop

@section('content')
	<div class="row-fluid">
		<form class="register-form form-horizontal well" action="/register" method="post">
			<fieldset>
				<legend>Create an account...</legend>

				@if ( Session::has('registerSuccess') && !Session::get('registerSuccess') )
					<div class="alert alert-error">
						An error occurred during the registration process. Please try again later.
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
						<input type="password" id="password" name="password" placeholder="a new password" required>
						@if ( $errors->has('password') )
							{{{ $errors->first('password') }}}
						@endif
					</div>
				</div>

				<div class="control-group @if( $errors->has('password_confirmation') )error@endif">
					<div class="controls">
						<input type="password" id="password_confirmation"  name="password_confirmation" placeholder="repeat your password" required>
						@if ( $errors->has('password_confirmation') )
							{{{ $errors->first('password_confirmation') }}}
						@endif
					</div>
				</div>

				<div class="control-group @if( $errors->has('name') )error@endif">
					<label class="control-label" for="name">Name</label>
					<div class="controls">
						<input type="text" id="name" name="name" placeholder="your name" value="{{ Input::old('name') }}" required>
						@if ( $errors->has('name') )
							{{{ $errors->first('name') }}}
						@endif
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-primary btn-large">Register</button>
						<span class="help-inline"><a href="/login">Already have an account?</a></span>
					</div>
				</div>

        <input type="hidden" name="csrf_token" value="{{{ csrf_token() }}}">
			</fieldset>
		</form>
	</div>
@stop

