<?php
class AuthClass {
	
	private $_filename = "data/db.txt";
	
	public function authentification($login, $password)
	{
		$data = file($this->_filename);
		if (strlen($login)!=0&&strlen($password)!=0)
		{
			foreach ($data as $value)
			{
				$data_str=explode(",", $value);
				//echo trim($data_str[0]);
				//echo trim($data_str[1]);
				if ($login == trim($data_str[0]) && $password == trim($data_str[1]))
				{
					$_SESSION["is_auth"] = true;
					$_SESSION['login'] = $login;
					header("Location: chat.php");
					//echo $_SESSION["login"] . "success";
					exit;
					return true;
				}
			}
		}
			if (!$_SESSION["is_auth"]) //�������� ������������
			{
				return false;
			}
	}
	public function isLoginFree($login)
	{
		$data = file($this->_filename);
		foreach ($data as $value)
		{
			$data_str=explode(",", $value);
			if ($login == trim($data_str[0]))
			{
				return false; //���������� ��� ������, ����� �������� � ���������� ������������ (����� �����)
			}
		}
		return true;
	}
	public function reg_user($login, $password)
	{
		$reg_file = fopen($this->_filename, 'a');
		//$user_login = $_POST['user'];
		//$user_password = $_POST['pass'];
		if (strlen($login)!=0&&strlen($password)!=0)
		{
			$str = $login . "," . $password . "\r\n";
			fputs($reg_file, $str);
			fclose($reg_file);
			//header("Location: contact.php");
			//echo "asd";
			//echo '<span id="new_accaunt_greet">New accaunt has been succsessfully made!</span>';
			return true;
		}
		else
		{
			//echo "<script>alert(\"Enter some data!\");</script>";
			return false; //���������� ��� ������, ����� �������� � ���������� ������������ (����� ������� ������� ������)
		}
	}
	
	public function isAuth() {
        if (isset($_SESSION["is_auth"])) { //?��� ����� ����������
            return $_SESSION["is_auth"]; //���������� �������� ���������� ������ is_auth (������ true ���� �����������, false ���� �� �����������)
        }
        else return false; //������������ �� �����������, �.�. ��������� is_auth �� �������
    }
	
	public function getLogin()
	{
		if ($this->isAuth()) { //?��� ������������ �����������
            return $_SESSION["login"]; //���������� �����, ������� ������� � ������
        }
	}
}
?>