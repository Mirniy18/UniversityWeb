<?php
if (!array_key_exists('login', $_POST)) {
	echo 'Access restricted.';
	exit();
}

require_once 'db.php';

if (count($_POST) > 0) {
	session_start();

	if ($_POST['add'] && !(array_key_exists('id_role', $_SESSION) && $_SESSION['id_role'] == 1)) {
		echo 'Access restricted.';
		exit();
	}

	$sql = 'SELECT users.id, users.first_name, users.last_name, users.login, roles.title FROM users LEFT JOIN roles ON users.id_role = roles.id';
	$users = $conn->query($sql);

	if ($stmt->execute()) {
		if ($_POST['sign_up']) {
			$_SESSION['id'] = $conn->insert_id;
			$_SESSION['login'] = $_POST['login'];
			$_SESSION['id_role'] = $_POST['id_role'];
		}
		header('location: index.php');
	} else {
		echo 'Database error: ';
		echo mysqli_error($conn);
	}
}
