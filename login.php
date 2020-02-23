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


$result = mysqli_query($db,'SELECT id FROM user WHERE name="'.$_POST['name'].'" AND password="'.$_POST['password'].'"');
$row = mysqli_num_rows($result);
if($row == 0){
	echo GetResponseData("該当データなし",Status::NOTFOUND);
	exit;
}

$data = mysqli_fetch_assoc($result);

setcookie("userId",$data['id'], time() + 60 * 60 * 24 * 30);

echo GetResponseData("ログイン成功",Status::SUCCESS);
exit;
?>