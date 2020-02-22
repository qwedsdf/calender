<?php
include 'Initialize.php';

	if(empty($_POST['name'])||empty($_POST['password'])){
		echo "未入力の項目があります。";
		return;
	}

	if(!preg_match("/^[a-zA-Z0-9]+$/", $_POST['name'])){
		echo "名前は半角英数字のみ";
		return;
	}

	mysqli_query($db,'INSERT INTO user (name,password) VALUES ("'.$_POST['name'].'", "'.$_POST['password'].'")');
?>