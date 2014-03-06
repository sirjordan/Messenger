<?php
$db_connection = mysqli_connect("localhost", "msg", "pass", "messenger");
mysqli_set_charset($db_connection, 'utf8');

function isThereUser($link, $name) {
	$querry = 'SELECT `user_name` FROM `users` WHERE `user_name` = "' . mysqli_real_escape_string($link, $name) . '"';
	$userName = mysqli_query($link, $querry);
	if (mysqli_num_rows($userName) > 0) {
		return true;
	} else {
		return false;
	}

}
?>