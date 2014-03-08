<?php
$h1 = "Messenger";
$pageTitle = 'Messenger';
$db_connection = mysqli_connect("localhost", "msg", "pass", "messenger");
mysqli_set_charset($db_connection, 'utf8');

require_once 'header.php';

if (isset($_SESSION['isLogged'])) {
	if ($_SESSION['isLogged'] == true) {		
		require 'index_body.php';
	} else {
		echo "Session logged = false";
	}
} else {
	header('Location: login.php');
}

require 'footer.php';
?>