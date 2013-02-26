@extends('layouts.master')

@section('title')
&ndash; Profile
@stop

@section('css')
	.content {
		max-width: 600px;
		margin: auto;
	}
@stop

@section('content')
	<div class="row-fluid">
		<div class="content well">
			<form class="form-horizontal" method="post">
				<fieldset>
					<legend>My Profile</legend>

					@if( Session::has('profileUpdateError') )
						<div class="alert alert-error">
							{{ Session::get('profileUpdateError') }}
						</div>
					@endif

					@if( count($errors->all()) == 0 && Session::has('profileUpdateSuccess') )
						<div class="alert alert-success">
							Profile updated!
						</div>
					@endif

					<div class="control-group @if($errors->has('name'))error@endif">
						<label class="control-label" for="name">Name</label>
						<div class="controls">
							<input type="text" id="name" name="name" placeholder="your name" value="{{ Auth::user()->name }}">
							@if($errors->has('name'))
								{{{ $errors->first('name') }}}
							@endif
						</div>
					</div>


					<div class="control-group @if($errors->has('email'))error@endif">
						<label class="control-label" for="email">Email</label>
						<div class="controls">
							<input type="email" id="email" name="email" placeholder="your email address" value="{{ Auth::user()->email }}">
							@if($errors->has('email'))
								{{{ $errors->first('email') }}}
							@endif
						</div>
					</div>

					<div class="control-group @if($errors->has('current_password'))error@endif">
						<label class="control-label" for="current_password">Current Password</label>
						<div class="controls">
							<input type="password" id="current_password" name="current_password" placeholder="your current password">
							@if($errors->has('current_password'))
								{{{ $errors->first('current_password') }}}
							@endif
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<span class="muted">Leave the following blank unless you want to change your password.</span>
						</div>
					</div>

					<div class="control-group @if($errors->has('new_password'))error@endif">
						<label class="control-label" for="new_password">New Password</label>
						<div class="controls">
							<input type="password" id="new_password" name="new_password" placeholder="a new password">
							@if($errors->has('new_password'))
								{{{ $errors->first('new_password') }}}
							@endif
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="repeat your new password">
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<button class="btn btn-primary btn-large" type="submit">Update</button>
							<button class="btn" type="reset">Undo</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
@stop
