<?php
require "php/auth.php";
if($_SESSION['login']){
	header("Location: chat.php");
	exit;
}
?>
<head>
	<link rel="stylesheet" href="style.css">
</head>
<div id="menu">
			<a href="index.php">Home</a>
			<a href="contact.php">Join Us</a>
			<a href="chat.php">Chat</a>
</div>