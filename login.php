<?php
	request_once('Initialize.php');

	$result = mysqli_query($db,'SELECT id FROM calender WHERE name="'.$_POST['name'].'" password="'.$_POST['password'].'"');

	$data = mysqli_fetch_assoc($result);
	if(isset($data['id']){
		echo $data['id'];
	}
?>