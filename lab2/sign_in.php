<?php
if (!array_key_exists('login', $_POST)) {
	echo 'Access restricted.';
	exit();
}

require_once 'include/db.php';

if (count($_POST) > 0) {
    session_start();

	if (array_key_exists('id', $_SESSION)) {
		echo 'You are already signed in.';
		exit();
    }
    
    $stmt = $conn->prepare('SELECT id, id_role FROM users WHERE users.login = ? AND users.password = ?;');
    $stmt->bind_param('ss', $_POST['login'], $_POST['password']);
    if ($stmt->execute()) {
        $user = $stmt->get_result()->fetch_assoc();
        if (!is_array($user)) {
            echo 'Invalid login or password.';
            exit();
        }
        
        $_SESSION['id'] = $user['id'];
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['id_role'] = $user['id_role'];

		header('location: index.php');
    } else {
        echo 'Database error: ';
		echo mysqli_error($conn);
    }
}
