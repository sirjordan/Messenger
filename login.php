<?php
$pageTitle = 'Log In';
$h1 = "Login";
require_once 'header.php';
require 'login_body.php';
require 'footer.php';
//require 'functions.php';

if ($_POST) {
	$username = trim($_POST['user_name']);
	$pass = trim($_POST['user_password']);
	if (isThereUser($db_connection, $username)) {
		$q = 'SELECT * FROM `users` WHERE `user_name` = "' . mysqli_real_escape_string($db_connection, $username) . '"';
		$userInfo = mysqli_query($db_connection, $q);
		if (strlen((mysqli_error($db_connection))) == 0) {
			$userInfo = $userInfo -> fetch_assoc();
			if (sha1($pass . $username) === $userInfo['user_pwd']) {
				//$q = 'UPDATE `messenger`.`users` SET `is_logged` = 1 WHERE `users`.`user_name` = "' . mysqli_real_escape_string($db_connection, $username) . ' "';
				//mysqli_query($db_connection, $q);
				logUser($db_connection, $username, true);
				$_SESSION['isLogged'] = true;
				$_SESSION['user'] = $username;
				echo 'Login Succeeded!';
				header('Location: index.php');
				exit ;
			} else {
				echo 'Password incorrect!';
			}
		} else {
			echo 'Error connection!';
		}
	} else {
		echo 'There\'s no user with name: <strong>' . $username . ' !<strong>';
	}
}
?>