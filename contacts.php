<?php
$pageTitle = 'Contacts';
$h1 = "Contacts";
require_once 'header.php';
//require 'functions.php';

if (isset($_POST['user'])) {
	$searchedUser = trim($_POST['user']);
	if (isThereUser($db_connection, $searchedUser)) {
		echo '
		<form method="POST" class="inviteForm"> 
		<span class="greetings"> Found it! Send invitation:</span>
		<input type="submit" value="Invite ' . $searchedUser . '" name="invite"/>
		</form>';
		$_SESSION['foundedUser'] = $searchedUser;
	} else {
		echo '<div class="greetings">There\'s no user with name <strong>' . $searchedUser . '</strong></div>';
	}
}

if (isset($_POST['invite'])) {
	sendInvitation($db_connection, $_SESSION['user'], $_SESSION['foundedUser']);
	unset($_SESSION['foundedUser']);
	echo '<div><span class="greetings">Invitation has sended!</span></div>';
}

if (showInvitations($db_connection, $_SESSION['user']) != false) {
	include 'newInvitations.php';
}

if (isset($_POST['submitInvitations'])) {
	if (!empty($_POST['accepted'])) {
		foreach ($_POST['accepted'] as $check) {
			if ($check != null) {
				if(setContact($db_connection, $_SESSION['user'], $check)){
					echo 'User <span class="greetings">'.$check. '</span> added to your contacts!';
					header('Location: contacts.php');
					exit;
				}
			}
		}
	}
}

require 'contacts_body.php';
require 'footer.php';





