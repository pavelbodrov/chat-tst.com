<?
	///$json = '{"id":1,"login":"admin","time":"22:15","comment":"hello all"}';
	//$res = json_decode($json);
	$db = new SQLite3("chat_db.db");
	$msg;
	$i=0;
	$query = $db->query("SELECT (SELECT login FROM users WHERE users.id = messages.login_id), time, comment FROM messages");
	while ($row = $query->fetchArray()) {
		//echo $row;
		$msg[$i]=$row;
		$i++;
		//$msg[$i]=$row;
	}
	//echo $msg[0]["comment"];
	echo json_encode($msg)
	//$result=$query->fetchArray();
	//echo "hello";
	
?>