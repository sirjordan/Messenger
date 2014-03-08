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

function getUserContacts($link, $user) {
	$q = 'SELECT * FROM `contacts` WHERE `user_name` = "' . $user . '" ';
	$contacts = mysqli_query($link, $q);
	$result = array();
	if (strlen((mysqli_error($link))) == 0) {
		while ($row = mysqli_fetch_assoc($contacts)) {
			$result[] = $row;
		}
		return $result;
	} else {
		return null;
	}
}

function logUser($link, $user, $isLogged) {	
	$q = 'UPDATE `messenger`.`users` SET `is_logged` = '.(int)$isLogged.' WHERE `users`.`user_name` = "' . mysqli_real_escape_string($link, $user) . ' "';
	mysqli_query($link, $q);
}
?>

