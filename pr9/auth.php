<?php
if (array_key_exists('login', $_POST)) {
	session_start();
	$_SESSION['login'] = $_POST['login'];
	$_SESSION['password'] = $_POST['password'];

	include('db.php');

	if (hasUser($_SESSION['login'], $_SESSION['password'])) {
		$_SESSION['auth'] = true;
		header('location: restricted.php');
	} else {
		echo 'Invalid login or password';
	}
} else {
	echo 'Access restricted.';
}
