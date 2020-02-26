<?php
require_once('Initialize.php');

final class Status{
	const NONE = 0;
	const SUCCESS = 1;
	const FAILURE = 2;
}

function GetResponseData($message,$status){
	$resultArray = [
		"message" => $message,
		"status" => $status,
	];
	return json_encode($resultArray);
}

// 英数字のみかどうかのチェック
if(!preg_match("/^[a-zA-Z0-9]+$/", $_POST['name'])||
!preg_match("/^[a-zA-Z0-9]+$/", $_POST['password'])){
	echo GetResponseData("入力は英数字のみです。",Status::FAILURE);
	exit;
}

$result = mysqli_query($db,'SELECT id FROM user WHERE name="'.$_POST['name'].'" AND password="'.$_POST['password'].'"');
$row = mysqli_num_rows($result);
if($row == 0){
	echo GetResponseData("該当データなし",Status::FAILURE);
	exit;
}

$data = mysqli_fetch_assoc($result);

setcookie("userId",$data['id'], time() + 60 * 60 * 24 * 30);

echo GetResponseData("ログイン成功",Status::SUCCESS);
exit;
?>