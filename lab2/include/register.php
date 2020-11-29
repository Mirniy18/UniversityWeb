<?php
if (!array_key_exists('login', $_POST)) {
	echo 'Access restricted.';
	exit();
}

require_once 'db.php';

if (count($_POST) > 0) {
	session_start();

	if (array_key_exists('add', $_POST) && !(array_key_exists('id_role', $_SESSION) && $_SESSION['id_role'] == 1)) {
		echo 'Access restricted.';
		exit();
	}

	if ($_POST['password'] != $_POST['password2']) {
		echo 'Passwords do not match.';
		exit();
	}

	$stmt = $conn->prepare('INSERT INTO users (first_name, last_name, password, login, id_role) VALUES (?, ?, ?, ?, ?);');
	$stmt->bind_param('sssss', $_POST['first_name'], $_POST['last_name'], $_POST['password'], $_POST['login'], $_POST['id_role']);

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
