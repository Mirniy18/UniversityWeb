<!doctype html>
<html lang="en">

 <!-- TODO form: add required and checking -->

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
		</div>
	</nav>
	<div class="container" style="padding: 64px 20% 0 20%;">
		<form action="" method="POST">
			<div class="input-field col s3">
				<input id="first-name" name="first_name" type="text" class="validate">
				<label for="first-name">First name</label>
			</div>
			<div class="input-field col s3">
				<input id="last-name" name="last_name" type="text" class="validate">
				<label for="last-name">Last name</label>
			</div>
			<div class="input-field col s3">
				<input id="login" name="login" type="text" class="validate">
				<label for="login">Login</label>
			</div>
			<div class="input-field col s3">
				<select name="id_role">
					<option value="" disabled selected>Choose your role</option>
					<?php
					require_once 'include/db.php';
					$roles = getRoles();
					if ($roles->num_rows > 0) {
						while ($role = $roles->fetch_assoc()) {
							echo '<option value="' . $role['id'] . '">' . $role['title'] . '</option>';
						}
					}
					?>
				</select>
				<label>Role</label>
			</div>
			<div class="input-field col s3">
				<input id="password" name="password" type="password" class="validate" minlength="6">
				<label for="password">Password</label>
			</div>
			<div class="input-field col s3">
				<input id="password2" name="password2" type="password" class="validate" minlength="6">
				<label for="password2">Confirm Password</label>
			</div>
			<?php if (array_key_exists('add', $_GET)): ?>
				<input type="submit" value="Add user" class="btn" name="add" style="float: right;">
			<?php else: ?>
				<input type="submit" value="Sign Up" class="btn" name="sign_up" style="float: right;">
			<?php endif ?>
		</form>
		<?php
			if (count($_POST) > 0) {
				include('include/register.php');
			}
		?>
	</div>

</body>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		var elems = document.querySelectorAll('select');
		var instances = M.FormSelect.init(elems, '');
	});
</script>

</html>