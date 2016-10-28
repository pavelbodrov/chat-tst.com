<?php

session_start();

if($_SESSION['login']){
	header("Location: chat.php");
	exit;
}

require("authClass.php");
$auth = new AuthClass();
if(isset($_POST['auth_button'])) //если нажата кнопка входа
{
	if (!$auth->authentification($_POST['user'], $_POST['pass']))
	{
		?>
		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/script.js"></script>
		<?php
		echo '<script>inform_user("<br>Wrong login or password! Try again!");</script>';
		//echo "<script>alert(\"Enter some data!\");</script>";
	}
	
}
if(isset($_POST['reg_button'])) //если нажата кнопка регистрации
{
	?>
	<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/script.js"></script>
	<?php
	if ($auth->isLoginFree($_POST['user'])) //если логин не занят, регестрируем пользователя
	{
		if($auth->reg_user($_POST['user'], $_POST['pass'])) //если функция регистрации завершилась успешно, выводим сообщение об успешной регистрации
		{
			echo '<script>inform_user("<br>New accaunt has been succsessfully made!");</script>';
		}
		else 
		{
			echo '<script>inform_user("<br>For Gods sake, dont push this button!!");</script>';
		}
	}
	else 
	{
			echo '<script>inform_user("<br>This Login is already used!");</script>';
	}
}

?>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/script.js"></script>
		
	</head>
		<body>
			<div id="menu">
				<a href="index.php">Home</a>
				<a href="enter.php">Join Us</a>
				<a href="chat.php">Chat</a>
			</div>
			<br />
			<div id="star-form">
				<form method="post">
					<label for="login" id="log-label">Login</br>
					<input type="text" name="user" id="log"/><br />
					<label for="pass" id="pass-label">Password</br>
					<input type="password" name="pass" id="pass"/><br />
					<input type="submit" name="auth_button" value="Sign In" title="If you already have an accaunt" />
					<input type="submit" name="reg_button" value="Sign Up" title="Create new accaunt!"/>
				</form>
				<span id="inform_user"></span>
			</div>
			<div id="helper">
				Already have an accaunt? <span>Sign In!</span>
				First time here? <span>Sign Up!</span>
			</div>
			<script>
				showFormHint();
			</script>
		</body>
</html>

