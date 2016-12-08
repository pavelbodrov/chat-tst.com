<?php

class AuthClass {
	
	private $_filename = "data/db.txt";
	private $_dbPath =  "chat_db.db";
	public function connect_db($path)
	{
			$db = new SQLite3($path);
			return $db;
	}
	
	public function authentification($login, $password)
	{
		$db = $this->connect_db($this->_dbPath);
		$login = $db->escapeString($login);
		$password = $db->escapeString($password);
		$query = $db->query("SELECT id FROM users WHERE login = '$login' AND password = '$password'");
		$result = $query->fetchArray();
		if (strlen($login)!=0&&strlen($password)!=0)
		{
			
				//echo trim($data_str[0]);
				//echo trim($data_str[1]);
				if (!empty($result))
				{
					$_SESSION["is_auth"] = true;
					$_SESSION['login'] = $login;
					header("Location: chat.php");
					//echo $_SESSION["login"] . "success";
					exit;
					return true;
				}
		}
			if (!$_SESSION["is_auth"]) //проверка правильности
			{
				return false;
			}
	}
	public function isLoginFree($login, $path)
	{
		
			$db = $this->connect_db($path);
			$login = $db->escapeString($login);
			$query = $db->query("SELECT id FROM users WHERE login = '$login'");
			$result = $query->fetchArray();
			if (empty($result))
			{
				return true;
			}
			else
			{
				return false;
			}		
			
	}
	public function reg_user($login, $password)
	{
		
		$reg_file = fopen($this->_filename, 'a');
		//$user_login = $_POST['user'];
		//$user_password = $_POST['pass'];
		if (strlen($login)!=0&&strlen($password)!=0)
		{	
			//$db = $this->connect_db("chat_db.db");
			$db=$this->connect_db("chat_db.db");
			$login = $db->escapeString($login);
			$password = $db->escapeString($password);
			$db->query("INSERT INTO users (login,password) VALUES ('$login', '$password')");
			return true;
		}
		else
		{
			//echo "<script>alert(\"Enter some data!\");</script>";
			return false; //возвращаем код ошибки, чтобы отловить и оповестить пользовател€ (Ќовый аккаунт успешно создан)
		}
	}
	
	public function isAuth() {
        if (isset($_SESSION["is_auth"])) { //?сли сесси§ существует
            return $_SESSION["is_auth"]; //ђозвращаем значение переменной сессии is_auth (хранит true если авторизован, false если не авторизован)
        }
        else return false; //Њользователь не авторизован, т.к. переменна§ is_auth не создана
    }
	
	public function getLogin()
	{
		if ($this->isAuth()) { //?сли пользователь авторизован
            return $_SESSION["login"]; //ђозвращаем логин, который записан в сессию
        }
	}
}
?>