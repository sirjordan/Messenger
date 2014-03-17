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
	$q = 'UPDATE `messenger`.`users` SET `is_logged` = ' . (int)$isLogged . ' WHERE `users`.`user_name` = "' . mysqli_real_escape_string($link, $user) . ' "';
	mysqli_query($link, $q);
}

function sendInvitation($link, $from, $to) {
	$senderId = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `user_id` FROM `users` WHERE `user_name`="' . $from . '"'));
	$reseverId = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `user_id` FROM `users` WHERE `user_name`="' . $to . '"'));

	$q = 'INSERT INTO `messenger`.`invitations` (`invitation_id`, `sender_id`, `resever_id`) VALUES (NULL, ' . $senderId['user_id'] . ', ' . $reseverId['user_id'] . ');';
	mysqli_query($link, $q);
}

function showInvitations($link, $user) {
	// Find the invitations to $user, and associate the sender'd id to him name, and return the result
	$userId = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `user_id` FROM `users` WHERE `user_name`="' . $user . '"'));
	$_invite = 'SELECT * FROM `invitations` LEFT JOIN `users` ON invitations.resever_id = users.user_id WHERE `invitations`.`resever_id`="' . $userId['user_id'] . '"';

	$invitations = mysqli_query($link, $_invite);
	if (mysqli_num_rows($invitations) > 0) {
		$result = array();
		while ($row = mysqli_fetch_assoc($invitations)) {
			$sender = mysqli_query($link, 'SELECT `user_name` FROM `users` WHERE `user_id`="' . $row['sender_id'] . '"');
			$sender = mysqli_fetch_assoc($sender);
			$result[] = $sender['user_name'];
		}
		return $result;
	} else {
		return false;
	}
}

function deleteInvitationsIds($link, $user1, $user2) {
	$senderId = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `user_id` FROM `users` WHERE `user_name`="' . $user1 . '"'));
	$reseverId = mysqli_fetch_assoc(mysqli_query($link, 'SELECT `user_id` FROM `users` WHERE `user_name`="' . $user2 . '"'));

	$invitationId = 'SELECT `invitation_id` 
	FROM `invitations` 
	WHERE (`sender_id` = '.$senderId['user_id'].' AND `resever_id` = '.$reseverId['user_id'].') 
	OR (`sender_id` = '.$reseverId['user_id'].' AND `resever_id` = '.$senderId['user_id'].')';
	
	$invitationId = mysqli_query($link, $invitationId);

	while ($a = mysqli_fetch_assoc($invitationId)) {
		$q = 'DELETE FROM `messenger`.`invitations` WHERE `invitations`.`invitation_id` = '.$a['invitation_id'].'';
		mysqli_query($link,$q);
	}
	
}

function setContact($link, $user, $userContact) {
	// Make user to user contact, and delete the invitations
	$q = 'INSERT INTO `messenger`.`contacts` (`user_name`, `contact_user_name`, `contact_id`) VALUES ("' . $user . '", "' . $userContact . '", NULL)';
	mysqli_query($link, $q);
	$q = 'INSERT INTO `messenger`.`contacts` (`user_name`, `contact_user_name`, `contact_id`) VALUES ("' . $userContact . '", "' . $user . '", NULL)';
	mysqli_query($link, $q);
	
	deleteInvitationsIds($link, $user, $userContact);
	
	if (strlen((mysqli_error($link))) == 0) {
		return true;
	} else {
		return false;
	}
}
?>

