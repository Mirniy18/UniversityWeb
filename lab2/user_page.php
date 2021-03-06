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
		</div>
	</nav>

	<?php
	require_once 'include/db.php';
	$sql = 'SELECT users.id, users.first_name, users.last_name, users.login, users.photo, roles.title FROM users LEFT JOIN roles ON users.id_role = roles.id WHERE users.id = ?;';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i', $_GET['id']);
	
	if ($stmt->execute()) {
		$res = $stmt->get_result();
		$user = $res->fetch_assoc();
		if (!is_array($user)) {
			echo 'Invalid user id';
			exit();
		}
	} else {
		echo 'Database error: ';
		echo mysqli_error($conn);
		exit();
	}
	?>

	<div class="container" style="padding: 64px 0 0 0;">
		<div style="width: 50%; float: left; box-sizing: border-box;">
			<?php if ($user['photo']): ?>
				<img src="public/images/<?php echo $user['photo'] ?>" width="90%" alt="Photo" style="padding: 4px;" />
			<?php else: ?>
				<img src="assets/img/Portrait_Placeholder.png" width="90%" alt="Photo" style="padding: 4px;" />
			<?php endif ?>
		</div>
		<div class="container" style="width: 50%; float: left; box-sizing: border-box;">
			<h5>First name: <?php echo $user['first_name'] ?></h5>
			<h5>Last name: <?php echo $user['last_name'] ?></h5>
			<h5>Login: <?php echo $user['login'] ?></h5>
			<h5>Role: <?php echo $user['title'] ?></h5>
		</div>
		<?php
		session_start();
		if (array_key_exists('id', $_SESSION) && ($_SESSION['id'] == $_GET['id'] || $_SESSION['id_role'] == 1)):
		?>
			<a href="user_edit_page.php?id=<?php echo $_GET['id'] ?>" class="waves-effect waves-light btn blue accent-3" style="float: right;">Edit</a>
		<?php endif ?>
	</div>

</body>

</html>