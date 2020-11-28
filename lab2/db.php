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
	$sql = 'SELECT users.id, users.first_name, users.last_name, users.login, roles.title FROM users LEFT JOIN roles ON users.id_role = roles.id';
	$users = $conn->query($sql);

	if ($users->num_rows > 0) {
		echo '<tr><th>Id</th><th>First Name</th><th>Last Name</th><th>Login</th><th>Role</th></tr>';
		while ($user = $users->fetch_assoc()) {
			echo '<tr>';
			echo '<td><a href="user.php">' . $user['id'] . '</a></td>';
			echo '<td>' . $user['first_name'] . '</td>';
			echo '<td>' . $user['last_name'] . '</td>';
			echo '<td>' . $user['login'] . '</td>';
			echo '<td>' . $user['title'] . '</td>';
			echo '</tr>';
		}
	}
}
