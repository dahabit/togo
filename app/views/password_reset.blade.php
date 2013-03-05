@extends('layouts.master')

@section('title')
&ndash; Reset Password
@stop

@section('css')
  #reset-form {
    max-width: 600px;
    margin: auto;
  }
@stop

@section('content')
  <div class="row-fluid">
    <form id="reset-form" class="form-horizontal well" method="post">
      @if ( Session::has('error')) )
        <div class="alert alert-block alert-warning">
          {{ trans(Session::get('reason')) }}
        </div>
      @endif

      <input type="hidden" name="csrf_token" value="{{{ csrf_token() }}}">
      <input type="hidden" name="token" value="{{ $token }}">

      <fieldset>
        <legend>Reset your password...</legend>

        <div class="control-group">
          <label class="control-label" for="email">Email</label>
          <div class="controls">
            <input type="email" id="email" name="email" placeholder="your account email address">
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="password">Password</label>
          <div class="controls">
            <input type="password" id="password" name="password" placeholder="a new password">
          </div>
        </div>

        <div class="control-group">
          <div class="controls">
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="repeat the new password">
          </div>
        </div>

        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn btn-primary btn-large">Reset Password</button>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
@stop

