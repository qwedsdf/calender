<?php
require_once('Initialize.php');

final class Status{
	const NONE = 0;
	const SUCCESS = 1;
	const FAILURE = 2;
}

const MIN_PASS_LENGTH = 8;

function GetResponseData($message,$status){
	$resultArray = [
		"message" => $message,
		"status" => $status,
	];
	return json_encode($resultArray);
}

// 入力値が空じゃないかどうか
if(empty($_POST['name'])||empty($_POST['password'])){
	echo GetResponseData("未入力の項目があります。",Status::FAILURE);
	exit;
}

// 英数字チェック
if(!preg_match("/^[a-zA-Z0-9]+$/", $_POST['name'])||
!preg_match("/^[a-zA-Z0-9]+$/", $_POST['password'])){
	echo GetResponseData("入力は英数字のみ。",Status::FAILURE);
	exit;
}

// パスワードの文字数チェック
if(strlen($_POST['password']) < MIN_PASS_LENGTH){
	echo GetResponseData("パスワードの文字数が足りません",Status::FAILURE);
	exit;
}

$result = mysqli_query($db,'SELECT id FROM user WHERE name="'.$_POST['name'].'" AND password="'.$_POST['password'].'"');
$row = mysqli_num_rows($result);
if($row == 1){
	echo GetResponseData("すでに登録されています",Status::FAILURE);
	exit;
}

mysqli_query($db,'INSERT INTO user (name,password) VALUES ("'.$_POST['name'].'", "'.$_POST['password'].'")');
$result = mysqli_query($db,'SELECT id FROM user WHERE name="'.$_POST['name'].'" AND password="'.$_POST['password'].'"');

$data = mysqli_fetch_assoc($result);
setcookie("userId",$data['id'], time() + 60 * 60 * 24 * 30);
echo GetResponseData("ログイン成功",Status::SUCCESS);
?>