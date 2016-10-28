<?php
session_start();

if($_GET['do'] == 'logout'){
	unset($_SESSION['login']);
	session_destroy();
}

if(!$_SESSION['login']){
	header("Location: ../enter.php");
	exit;
}
?>