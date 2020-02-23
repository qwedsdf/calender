<?php
require_once('Initialize.php');

final class Status{
	const NONE = 0;
	const SUCCESS = 1;
	const NOTFOUND = 2;
}

function GetResponseData($message,$status){
	$resultArray = [
		"message" => $message,
		"status" => $status,
	];
	return json_encode($resultArray);
}


if(empty($_POST['name'])||empty($_POST['password'])){
	echo "未入力の項目があります。";
	exit;
}

if(!preg_match("/^[a-zA-Z0-9]+$/", $_POST['name'])){
	echo "名前は半角英数字のみ";
	exit;
}

mysqli_query($db,'INSERT INTO user (name,password) VALUES ("'.$_POST['name'].'", "'.$_POST['password'].'")');
$result = mysqli_query($db,'SELECT id FROM user WHERE name="'.$_POST['name'].'" AND password="'.$_POST['password'].'"');

$data = mysqli_fetch_assoc($result);
setcookie("userId",$data['id'], time() + 60 * 60 * 24 * 30);
echo GetResponseData("ログイン成功",Status::SUCCESS);
?>