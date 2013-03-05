<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Togo @yield('title')</title>

		<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/css/bootstrap-combined.no-icons.min.css" rel="stylesheet" type="text/css">
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet" type="text/css">
		<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" type="text/css">

		<style type="text/css">
			body {
				padding-top: 25px;
				font-family: "Source Sans Pro", sans-serif;
			}
			.pull-close {
				padding: 0 20px 0 20px;
			}
			.brand a:hover {
				text-decoration: none;
			}
			hr {
				margin: 30px 0 30px 0;
			}
			.profile-image {
				margin-top: 10px;
				margin-right: 40px;
				max-height: 50px;
			}
			.foot-nav {
				margin-right: 40px;
			}

			@yield('css')
		</style>
	</head>

	<body>
		<a href="https://github.com/alanly/togo">
			<img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_green_007200.png" alt="Fork me on GitHub">
		</a>

		<div class="container">
			<div class="row-fluid pull-close">
				<h1 class="brand pull-left"><a href="/">Togo.</a></h1>
				@if ( Auth::check() )
					<img class="profile-image img-rounded pull-right" src="http://www.gravatar.com/avatar/{{ md5(strtolower(Auth::user()->email)) }}?s=50" alt="Profile Image">
				@endif
			</div>

			<hr>

			@yield('content')

			<hr>

			<div class="row-fluid pull-close">
				<p class="muted pull-left"><small>&copy; Togo.</small></p>
				@if ( Auth::check() )
					<p class="foot-nav pull-right"><small><a href="/profile">Profile</a> &nbsp; <a href="/logout">Logout</a></small></p>
        @else
          <p class="foot-nav pull-right"><small><a href="/register">Create an account?</a></small></p>
				@endif
			</div>
		</div>

		<script src="//cdn.jsdelivr.net/jquery/1.9.1/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/js/bootstrap.min.js" type="text/javascript"></script>
		@yield('js')	
	</body>
</html>

