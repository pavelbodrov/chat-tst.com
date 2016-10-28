<?php
require "php/auth.php";
if($_SESSION['login']){
	echo "<script>alert(\"It seems you have already signed in!\");</script>";
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