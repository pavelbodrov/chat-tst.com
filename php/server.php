<?php
/*
	$str = $_POST['c'];

	//что-то делаем на сервере, преобразуем строку в верхний регистр
	//$str = $str + ",";
	$reg_file = fopen("msg.txt", 'a');
	
	$ara = array($str);
	$str = json_encode($ara);
	
	fputs($reg_file, $str);
	fputs($reg_file, ',');
	fclose($reg_file);
	//отправляем обратно, помещаем строку в массив
	//$ara = array($str);

	//кодируем массив в строку формата JSON
	//$str = json_encode($ara);

	//возрващаем строку в формате JSON
	echo $str;
	*/

	$data = $_POST['jsonData'];
	$reg_file = fopen("../data/msg.txt", 'a');
	fputs($reg_file, $data);
	fputs($reg_file, "\r\n");
	fclose($reg_file);

	echo $data;

?>