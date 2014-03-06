<?php
$pageTitle = 'Register';
$h1 = "Register new user";
require 'header.php';
require 'register_body.php';
require 'footer.php';
require 'functions.php';

if ($_POST) {
	$username = trim($_POST['user_name']);
	$pass = trim($_POST['user_password']);
	$fname = trim($_POST['user_fName']);
	$surename = trim($_POST['user_surname']);
	$errors = array();
	// TODO: Call javaScript function to display the messages!
	// TODO: Set HASH for password
	if (mb_strlen($username) < 6) {
		$errors[] = 'User name has to be at least 6 symbols.';
	}
	if (mb_strlen($pass) < 8) {
		$errors[] = 'Password length has to be at least 8 symbols.';
	}
	if (mb_strlen($fname) < 3) {
		$errors[] = 'First name has to be at least 3 symbols.';
	}
	if (mb_strlen($surename) < 3) {
		$errors[] = 'Surname name has to be at least 3 symbols.';
	}

	if (count($errors) < 1) {
		if (!isThereUser($db_connection, $username)) {
			$querry = 'INSERT INTO `users` (`user_id`, `user_name`, `user_pwd`, `user_first_name`, `user_surname`, `user_photo`, `user_contacts`) 
			VALUES (NULL, "' . $username . '", "' . $pass . '", "' . $fname . '", "' . $surename . '", ' . '""' . ', 0);';
			mysqli_query($db_connection, $querry);
			if (strlen((mysqli_error($db_connection))) == 0) {
				echo "Registration succeeded!";
			} else {
				echo "Error registering!";
			}

		} else {
			echo 'User with name: <strong>' . $username . '</strong> already registered, pick another name.';
		}

	} else {
		foreach ($errors as $value) {
			echo $value . '</br>';
		}
		unset($value);
	}

}
?>

