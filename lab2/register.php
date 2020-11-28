<?php
if (array_key_exists('login', $_POST)) {
	session_start();
	require_once 'db.php';
	if (count($_POST) > 0) {
		$stmt = $conn->prepare('INSERT INTO users (first_name, last_name, password, login, id_role) VALUES (?, ?, ?, ?, ?);');
		$stmt->bind_param('sssss', $_POST['first_name'], $_POST['last_name'], $_POST['password'], $_POST['login'], $_POST['id_role']);
		
		if ($stmt->execute()) {
			$_SESSION['id'] = $conn->insert_id;
			$_SESSION['login'] = $_POST['login'];
			$_SESSION['auth'] = true;
			header('location: restricted.php');
		} else {
			echo 'Database error: ';
			echo mysqli_error($conn);
		}
	}
} else {
	echo 'Access restricted.';
}
