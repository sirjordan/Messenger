<?php
require 'functions.php';
session_start();
 ?>
<!DOCTYPE html>
<html>
	<head>
		<title><?= $pageTitle ?></title>
		<link rel="stylesheet" href="styles.css" type="text/css"/>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
	</head>
	<body>
		<h1><?= $h1 ?></h1>
		<nav class="navigation">
			<a href="index.php">Main</a>
			<a href="register.php">Register</a>
			<a href="login.php">Log In</a>
		</nav>
		<div id="container">
		