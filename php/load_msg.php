<?php
//$data = json_decode($_POST['field1']);
//$data = $_POST['jsonData'];
//$response = 'Получено параметров '.count($data).'\n';
//foreach ($data as $key=>$value) {
 //   $response .= 'Параметр: '.$key.'; Значение: '.$value.'\n';
 
require "../authClass.php";
$connector = new authClass();
$db=$connector->connect_db("../chat_db.db");



$msg;
	$i=0;
	$query = $db->query("SELECT (SELECT login FROM users WHERE users.id = messages.login_id) as login, time, comment, id FROM messages");
	while ($row = $query->fetchArray()) {
		//echo $row;
		$msg[$i]=$row;
		$i++;
		//$msg[$i]=$row;
	}
	//echo $msg[0]["comment"];
	echo json_encode($msg)
?>