<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>
	<nav>
		<div class="nav-wrapper blue lighten-3">
			<a href="index.php" class="brand-logo">
				<img src="assets/img/logo.svg" height="60px" alt="Logo" style="padding: 4px;" />
			</a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li><a class="waves-effect waves-light btn blue accent-3">Sign In</a></li>
				<li><a class="waves-effect waves-light btn blue accent-3">Sign Up</a></li>
			</ul>
		</div>
	</nav>
	<div class="container" style="padding-top: 64px;">
		<table class="striped responsive-table blue lighten-4">
			<?php
			require_once 'db.php';

			createTable();
			?>
		</table>
	</div>

</body>

</html>