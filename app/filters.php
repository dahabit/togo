<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. Also, a "guest" filter is
| responsible for performing the opposite. Both provide redirects.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

Route::filter('api_auth', function()
{
	if(!is_null(Auth::user()))
		return;

	$params = array(
		// Retrieve user credentials via basic authentication
		'email' => Request::getUser(),
		'password' => Request::getPassword()
	);

	if(!Auth::attempt($params))
		return Response::json(array(
			array(
				'error' => true,
				'message' => 'Invalid credentials provided.'
			),
			401
		));
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::getToken() != Input::get('csrf_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
