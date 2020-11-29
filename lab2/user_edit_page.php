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
		session_start();
		if (!array_key_exists('id', $_SESSION) || !($_SESSION['id'] == $_GET['id'] || $_SESSION['id_role'] == 1)) {
			echo 'Restricted access.';
			exit();
		}

		require_once 'include/db.php';
		$stmt = $conn->prepare('SELECT id, first_name, last_name, login, id_role, photo FROM users WHERE users.id = ?;');
		$stmt->bind_param('i', $_GET['id']);
		if ($stmt->execute()) {
			$user = $stmt->get_result()->fetch_assoc();
			if (!is_array($user)) {
				echo 'Invalid user id.';
				exit();
			}
		} else {
			echo 'Database error: ';
			echo mysqli_error($conn);
			exit();
		}
	?>

	<div class="container" style="padding: 64px 0 0 0;">
		<div style="width: 20%; float: left; box-sizing: border-box;">
			<?php if ($user['photo']): ?>
				<img src="public/images/<?php echo $user['photo'] ?>" width="90%" alt="Photo" style="padding: 4px;" />
			<?php else: ?>
				<img src="assets/img/logo.svg" width="90%" alt="Photo" style="padding: 4px;" />
			<?php endif ?>
			<form id="form-upload-photo" action="upload_photo.php?id=<?php echo $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
				<button id="btn-upload-photo" class="btn waves-effect waves-light" type="button" style="width: 90%;">Change photo</button>
				<input id="file-photo" type="file" name="file_photo" style="display: none;" required>
			</form>
		</div>
		<div class="container" style="width: 80%; float: left; box-sizing: border-box;">
			<form action="" onsubmit="return validate_passwords(true)" method="POST">
				<div class="input-field col s3">
					<input id="first-name" name="first_name" type="text" class="validate" value="<?php echo $user['first_name'] ?>" required>
					<label for="first-name">First name</label>
				</div>
				<div class="input-field col s3">
					<input id="last-name" name="last_name" type="text" class="validate" value="<?php echo $user['last_name'] ?>" required>
					<label for="last-name">Last name</label>
				</div>
				<div class="input-field col s3">
					<input id="login" name="login" type="text" class="validate" value="<?php echo $user['login'] ?>" required>
					<label for="login">Login</label>
				</div>

				<?php if (array_key_exists('id_role', $_SESSION) && $_SESSION['id_role'] == 1): ?>
				<div class="input-field col s3">
					<select name="id_role" value="<?php echo $user['id_role'] ?>" required>
						<option value="" disabled>Choose your role</option>
						<?php
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
				<?php endif ?>

				<div class="input-field col s3">
					<input id="password" name="password" type="password" class="validate" minlength="6" required>
					<label for="password">Password</label>
				</div>
				<div class="input-field col s3">
					<input id="password2" name="password2" type="password" class="validate" minlength="6" required>
					<label for="password2">Confirm Password</label>
				</div>
				<div style="float: right;">
					<input type="submit" value="Edit" name="edit" class="btn">
				</div>
			</form>
			<form action="" method="POST">
				<input type="submit" value="Delete" name="delete" class="btn red" style="float: right; margin-right: 10px;">
			</form>
			<?php
				if (count($_POST) > 0 && (array_key_exists('edit', $_POST) || array_key_exists('delete', $_POST))) {
					include('include/user_edit.php');
				}
			?>
		</div>
	</div>

</body>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		var elems = document.querySelectorAll('select');
		var instances = M.FormSelect.init(elems, '');
	});
</script>

<script src="assets/js/passwords_validation.js"></script>
<script src="assets/js/photo_upload.js"></script>

</html>