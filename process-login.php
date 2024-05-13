<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

// Hardcoded username and password
$valid_username = 'admin';
$valid_password = '123';

if ($username == $valid_username && $password == $valid_password) {
	// Set session variables
	$_SESSION['username'] = $username;
	header('Location: stok-barang.php');
} else {
	header('Location: login-inventaris.html?error=1');
}
?>