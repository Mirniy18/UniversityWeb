<?php
if (!array_key_exists('id', $_GET)) {
    echo 'Access restricted1.';
    exit();
}

session_start();

if (!array_key_exists('id', $_SESSION) || !($_SESSION['id'] == $_GET['id'] || $_SESSION['id_role'] == 1)) {
    echo 'Access restricted2.';
    exit();
}

$target_dir = 'public/images/';
$target_file = $target_dir . basename($_FILES['file_photo']['name']);
$uploadOk = true;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (file_exists($target_file)) {
    echo 'Sorry, file already exists.<br>';
    $uploadOk = false;
}

if ($_FILES['file_photo']['size'] > 500000) {
    echo 'Sorry, your file is too large.<br>';
    $uploadOk = false;
}

if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif', 'svg'])) {
    echo 'Sorry, only JPG, JPEG, PNG, GIF and SVG files are allowed.<br>';
    $uploadOk = false;
}

if (isset($_POST['submit'])) {
    $check = getimagesize($_FILES['file_photo']['tmp_name']);
    if (!$check) {
        echo 'File is not an image.<br>';
        $uploadOk = false;
    }
}

if (!$uploadOk) {
    echo 'Sorry, your file was not uploaded.<br>';
    exit();
}

if (move_uploaded_file($_FILES['file_photo']['tmp_name'], $target_file)) {
    require_once 'include/db.php';
    $file_name = basename($_FILES['file_photo']['name']);
    $stmt = $conn->prepare('UPDATE users SET photo = ? WHERE id = ?;');
    $stmt->bind_param('ss', $file_name, $_GET['id']);
    $stmt->execute();
    header('location: index.php');
} else {
    echo 'Sorry, there was an error uploading your file.<br>';
}
