<?php
require 'functions.php';
session_start();
logUser($db_connection, $_SESSION['user'], FALSE);
session_destroy();
header('Location: index.php');
//exit ;
?>