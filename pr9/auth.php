<?php
if (array_key_exists('login', $_POST)) {
	session_start();
	require_once 'db.php';
	if (count($_POST) > 0) {
		$stmt = $conn->prepare('SELECT * FROM users WHERE login = ? and password = ?;');
		$stmt->bind_param('ss', $_POST['login'], $_POST['password']);
		$stmt->execute();
		$res = $stmt->get_result();
		$row = $res->fetch_assoc();
		if (is_array($row)) {
			$_SESSION['login'] = $row['login'];
			$_SESSION['password'] = $row['password'];
			$_SESSION['auth'] = true;
			header('location: restricted.php');
		} else {
			echo 'Invalid login or password';
		}
	}
} else {
	echo 'Access restricted.';
}
