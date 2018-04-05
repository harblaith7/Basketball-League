<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "head.php"; ?>
</head>

<body id="body" class="home-classic" ng-app="leagueApp" ng-controller="leagueController">
	<div class="container">
		<form class="form-signin" style="max-width: 300px;margin: 25px auto;">
			<div id="loginResponse"></div>
			<label for="inputEmail" class="sr-only">Email address</label>
			<input type="email" id="loginEmail" class="form-control" placeholder="Email address" required autofocus>
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" id="loginPassword" class="form-control" placeholder="Password" required>
			<button class="btn btn-lg btn-primary btn-block" type="submit" ng-click="login()">Sign in</button>
		</form>
	</div>
	<!-- JAVASCRIPTS -->
	<?php include "js-compile.php"; ?>
</body>

</html>
