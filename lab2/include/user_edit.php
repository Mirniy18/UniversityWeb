<?php

if (count($_POST) == 0 || !array_key_exists('login', $_POST)) {
	echo 'Access restricted.';
}

require_once 'include/db.php';
if ($_SESSION['id'] == $_GET['id'] || $_SESSION['id_role'] == 1) {
	if (array_key_exists('edit', $_POST)) {
		if ($_POST['password'] != $_POST['password2']) {
			echo 'Passwords do not match.';
			exit();
		}

		if ($_SESSION['id_role'] == 1) {
			$stmt = $conn->prepare('UPDATE users SET first_name = ?, last_name = ?, password = ?, login = ?, id_role = ? WHERE id = ?;');
			$stmt->bind_param('ssssii', $_POST['first_name'], $_POST['last_name'], $_POST['password'], $_POST['login'], $_POST['id_role'], $_GET['id']);	
		} else {
			$stmt = $conn->prepare('UPDATE users SET first_name = ?, last_name = ?, password = ?, login = ? WHERE id = ?;');
			$stmt->bind_param('ssssi', $_POST['first_name'], $_POST['last_name'], $_POST['password'], $_POST['login'], $_GET['id']);
		}
		if (!$stmt->execute()) {
			echo 'Database error: ';
			echo mysqli_error($conn);
		}
	} elseif (array_key_exists('delete', $_POST)) {
		$conn->query('DELETE FROM users WHERE id = ' . $_GET['id']);

		if ($_SESSION['id'] == $_GET['id']) {
			header('location: sign_out.php');
		}
	}
}
