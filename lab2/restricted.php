<?php
session_start();
?>

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
		<?php
			if (array_key_exists('auth', $_SESSION) && $_SESSION['auth']) {
				echo 'Login: ';
				echo $_SESSION['login'];
				session_unset();
				session_destroy();
			} else {
				?>
				<a href="login.php">Click here to login.</a>
				<?php
			}
		?>
		
	</div>

</body>

</html>