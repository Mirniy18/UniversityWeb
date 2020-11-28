<?php
if (!array_key_exists('login', $_POST)) {
	echo 'Access restricted.';
	exit();
}
session_start();
require_once 'db.php';
if (count($_POST) > 0) {
	$sql = 'SELECT users.id, users.first_name, users.last_name, users.login, roles.title FROM users LEFT JOIN roles ON users.id_role = roles.id';
	$users = $conn->query($sql);
	
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
