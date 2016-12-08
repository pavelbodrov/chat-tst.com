<?php
require "../authClass.php";

	$data = $_POST['jsonMsg'];
	if (!empty($data))
	{	
		$connector = new authClass();
		$db=$connector->connect_db("../chat_db.db");
		$msg_obj=json_decode($data);
		
		$time = $db->escapeString($msg_obj->time);
		$comment = $db->escapeString($msg_obj->comment);
		$login = $db->escapeString($msg_obj->login);
		
		$login_id_query= $db->query("SELECT id FROM users where login = '$login'");	
		$result=$login_id_query->fetchArray();
		$login_id = $result[0];
		$query = $db->query("INSERT INTO messages (login_id, time, comment) VALUES ('$login_id', '$time', '$comment')");
	}
	//$msg_obj=json_decode($data);
	//$reg_file = fopen("../data/msg.txt", 'a');
	//fputs($reg_file, $msg_obj->login . $msg_obj);
	//fputs($reg_file, "\r\n");
	//fclose($reg_file);


?>