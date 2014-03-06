<?php 
$h1 = "Messenger";
$pageTitle = 'Messenger';
$db_connection = mysqli_connect("localhost","msg","pass","messenger");
mysqli_set_charset($db_connection, 'utf8');

require 'header.php';
require	'index_body.php';
require 'footer.php';
 ?>