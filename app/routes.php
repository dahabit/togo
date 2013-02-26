<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('before' => 'auth', function()
{
	return View::make('task');
}));

Route::get('/login', array('before' => 'guest', function()
{
	return View::make('login');
}));

Route::post('/login', function()
{
	$validator = Validator::make(
		Input::all(),
		array(
			'email' => 'required|email',
			'password' => 'required|between:6,255'
		)
	);

	if($validator->fails())
		return Redirect::to('login')->withErrors($validator)->withInput();

	$params = array(
		'email' => Input::get('email'),
		'password' => Input::get('password')
	);

	$remember = Input::has('remember');

	if(!Auth::attempt($params, $remember)) {
		Session::flash('loginError', 'Invalid credentials entered.');
		return Redirect::to('login')->withInput();
	}

	return Redirect::to('/');
});

Route::get('/logout', function()
{
	Auth::logout();

	return Redirect::to('/');
});

Route::get('/register', array('before' => 'guest', function()
{
	return View::make('register');
}));

Route::post('/register', array('before' => 'guest', function()
{
	$validator = Validator::make(
		Input::all(),
		array(
			'email' => 'required|email|unique:users',
			'password' => 'required|between:6,255|confirmed',
			'password_confirmation' => 'required',
			'name' => 'required'
		),
		array(
			'email.unique' => 'This address is already registered.'
		)
	);

	if($validator->fails())
		return Redirect::to('register')->withErrors($validator)->withInput();

	$user = new User;
	$user->email = Input::get('email');
	$user->password = Hash::make(Input::get('password'));
	$user->name = Input::get('name');
	$user->save();

	$registerSuccess = Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')));
	Session::flash('registerSuccess', $registerSuccess);

	if($registerSuccess)
		return Redirect::to('/');
	else
		return Redirect::to('register')->withInput();
}));

Route::get('/profile', array('before' => 'auth', function()
{
	return View::make('profile');
}));

Route::post('/profile', array('before' => 'auth', function()
{
	$rules = array(
			'email' => 'required|email|unique:users,email,' . Auth::user()->id,
			'current_password' => 'required|between:6,255',
			'name' => 'required'
		);

	$messages = array(
			'email.unique' => 'This address is registered with another account.'
		);

	$updatePassword = false;

	if( Input::has('new_password') ) { // Check if the user wants to change their password
		$rules['new_password'] = 'between:6,255|confirmed';
		$updatePassword = true;
	}

	$validator = Validator::make(Input::all(),$rules,$messages);

	if($validator->fails())
		return Redirect::to('profile')->withErrors($validator)->withInput();

	if( ! Auth::validate(array('email' => Auth::user()->email, 'password' => Input::get('current_password'))) ) {
		Session::flash('profileUpdateError', 'Please make sure that the current password has been entered and is correct.');
		return Redirect::to('profile')->withInput();
	}

	$user = Auth::user();
	$user->email = Input::get('email');
	$user->name = Input::get('name');

	if($updatePassword)
		$user->password = Hash::make(Input::get('new_password'));

	$user->save();

	$profileUpdateSuccess = Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get($updatePassword ? 'new_password' : 'current_password')));

	if($profileUpdateSuccess)
		Session::flash('profileUpdateSuccess', true);
	else
		Session::flash('profileUpdateError', 'An error occured while attempting to update your profile. Please try again later.');

	return Redirect::to('profile')->withInput();
}));

Route::group(array('prefix' => 'api/v1', 'before' => 'api_auth'), function()
{
	Route::resource('task', 'ApiTaskController');
});
