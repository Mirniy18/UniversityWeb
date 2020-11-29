<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'testdb';

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
	die('Connection to DB failed: ' . $conn->connect_error);
}

function createTable() {
	global $conn;

	$admin = array_key_exists('id_role', $_SESSION) && $_SESSION['id_role'] == 1;

	if ($admin) {
		$sql = 'SELECT users.id, users.first_name, users.last_name, users.login, users.password, roles.title FROM users LEFT JOIN roles ON users.id_role = roles.id';
	} else {
		$sql = 'SELECT users.id, users.first_name, users.last_name, users.login, roles.title FROM users LEFT JOIN roles ON users.id_role = roles.id';
	}

	$users = $conn->query($sql);

	if ($users->num_rows > 0) {
		echo '<tr><th>Id</th><th>First Name</th><th>Last Name</th><th>Login</th><th>Role</th>';

		if ($admin) {
			echo '<th>Password</th></tr>';
		} else {
			echo '</tr>';
		}

		while ($user = $users->fetch_assoc()) {
			echo '<tr>';
			echo '<td><a href="user_page.php?id=' . $user['id'] . '">' . $user['id'] . '</a></td>';
			echo '<td>' . $user['first_name'] . '</td>';
			echo '<td>' . $user['last_name'] . '</td>';
			echo '<td>' . $user['login'] . '</td>';
			echo '<td>' . $user['title'] . '</td>';
			if ($admin) {
				echo '<td>' . $user['password'] . '</td>';
			}
			echo '</tr>';
		}
	}
}

function getRoles() {
	global $conn;
	$sql = 'SELECT * FROM roles';
	
	return $conn->query($sql);
}
