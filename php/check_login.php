<?php
require("../authClass.php");
$auth = new authClass();
	$login = $_POST['log'];
	if ($auth->isLoginFree($login, "../chat_db.db"))
	{
		echo "free";
	}
	else echo "busy";
	//echo in_array($login, $logins); // Проверяем наличие переданного логина в массиве с уже занятыми
	//echo $response;

?>