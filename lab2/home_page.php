<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<?php
session_start();

// $_SESSION['id'] = 1; $_SESSION['login'] = 'Donald44'; $_SESSION['id_role'] = 1; // TODO remove
?>

<body>
	<nav>
		<div class="nav-wrapper blue lighten-3">
			<a href="index.php" class="brand-logo hide-on-med-and-down">
				<img src="assets/img/logo.svg" height="60px" alt="Logo" style="padding: 4px;" />
			</a>
			<ul id="nav-mobile" class="right">
				<?php if (array_key_exists('id', $_SESSION)): ?>
					<li><a href="user_edit_page.php?id=<?php echo $_SESSION['id']; ?>" class="waves-effect waves-light btn blue accent-3"><?php echo $_SESSION['login']; ?></a></li>
					<li><a href="sign_out.php" class="waves-effect waves-light btn blue accent-3">Sign Out</a></li>
				<?php else: ?>
					<li><a href="#modal_sign_in" class="waves-effect waves-light btn modal-trigger blue accent-3">Sign In</a></li>
					<li><a href="register_page.php" class="waves-effect waves-light btn blue accent-3">Sign Up</a></li>
				<?php endif ?>
			</ul>
		</div>
	</nav>
	
	<?php include 'include/login_modal.php' ?>

	<div class="container" style="padding-top: 64px;">
		<table class="striped responsive-table blue lighten-4">
			<?php
			require_once 'include/db.php';

			createTable();
			?>
		</table>

		<?php if (array_key_exists('id_role', $_SESSION) && $_SESSION['id_role'] == 1): ?>
		<a href="register_page.php?add=1" class="waves-effect waves-light btn blue accent-3" style="margin-top: 16px; float: right;">Add user</a>
		<?php endif ?>
	</div>

</body>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		var elems = document.querySelectorAll('.modal');
		var instances = M.Modal.init(elems, '');
	});
</script>

</html>