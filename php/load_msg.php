<?php
//$data = json_decode($_POST['field1']);
//$data = $_POST['jsonData'];
//$response = 'Получено параметров '.count($data).'\n';
//foreach ($data as $key=>$value) {
 //   $response .= 'Параметр: '.$key.'; Значение: '.$value.'\n';
//}
$data = file("../data/msg.txt");
echo json_encode($data);
?>