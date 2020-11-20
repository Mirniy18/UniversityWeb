<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<style>
		.container {
			width: 400px;
		}
	</style>
</head>

<body style="padding-top: 3rem;">
	<div class="container">
		<form method="post">
			<div class="input-field col s6">
				<input id="login" name="login" type="text" class="validate" required>
				<label for="login">Login</label>
			</div>
			<div class="input-field col s6">
				<input id="password" name="password" type="password" class="validate" required>
				<label for="password">Password</label>
			</div>
			<input type="submit" value="Submit" class="btn">
		</form>
		<?php
		if (count($_POST) > 0) {
			include('auth.php');
		}
		?>
	</div>

</body>

</html>