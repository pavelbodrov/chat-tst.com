<?php
require "../authClass.php";
$connector = new authClass();
$db=$connector->connect_db("../chat_db.db");

	$data = $_POST['jsonMsg'];
	$msg_obj=json_decode($data);
	$login_id_query= $db->query("SELECT id FROM users where login = '$msg_obj->login'");
	
	$result=$login_id_query->fetchArray();
	$login_id = $result[0];
	$query = $db->query("INSERT INTO messages (login_id, time, comment) VALUES ('$login_id', '$msg_obj->time', '$msg_obj->comment')");
	
	//$msg_obj=json_decode($data);
	//$reg_file = fopen("../data/msg.txt", 'a');
	//fputs($reg_file, $msg_obj->login . $msg_obj);
	//fputs($reg_file, "\r\n");
	//fclose($reg_file);


?>