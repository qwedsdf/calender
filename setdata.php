<?php
	$db=mysqli_connect('localhost','root','','calender') or die(mysqli_connect_error());
	mysqli_set_charset($db,'utf8');

	mysqli_query($db,'INSERT INTO contents (inputdate, content, userId) VALUES ("'.$_POST['date'].'", "'.$_POST['content'].'", '.$_POST['userId'].') ON DUPLICATE KEY UPDATE content = VALUES (content)');
?>