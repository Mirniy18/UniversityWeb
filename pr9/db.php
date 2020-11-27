<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'testdb';

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
	die('Connection to DB failed: ' . $conn->connect_error);
}

function getUsers()
{
	global $conn;
	$sql = 'SELECT id, login, password FROM users';
	return $conn->query($sql);
}

function hasUser($login, $password)
{
	$users = getUsers();

	if ($users->num_rows > 0) {
		while ($row = $users->fetch_assoc()) {
			if ($login == $row['login']) {
				return $password == $row['password'];
			}
		}

		return false;
	}
}
