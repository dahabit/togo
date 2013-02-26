<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	</head>

	<body>
		<section id="app" ng-app>
			<h1>Hello, {{name}}!</h1>
			<hr>
			<label for="name">Your name: </label>
			<input type="text" id="name" placeholder="Enter your name here..." ng-model="name">
		</section>

		<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.0.4/angular.min.js" type="text/javascript"></script>
	</body>
</html>
