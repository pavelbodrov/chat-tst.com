<?php
	require "../authClass.php";

	$lastMsg = $_POST['lastMsg'];
	
	$connector = new authClass();
	$db=$connector->connect_db("../chat_db.db");
	$query = $db->query("SELECT MAX(id) FROM messages");
	$row = $query->fetchArray();
	if ($row[0]!=$lastMsg)
	{
		echo "refresh";
	}
	else echo "listen";
?>