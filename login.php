<?php
define('DB_HOST', 'phpmyadmin-sv8384');
define('DB_NAME', 'calender');
define('DB_USER', 'blog0112_yoha');
define('DB_PASSWORD', 'mituki51031');

	$db=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die(mysqli_connect_error());
	mysqli_set_charset($db,'utf8');

	// $option=array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET CHARACTER SET 'utf8'");

	// error_reporting(E_ALL & ~E_NOTICE);

	// try{
	// 	$dbh=new PDO('');
	// } catch (PDOException $e){
	// 	echo $e->getMessage();
	// }

	// mysqli_query($db,'INSERT INTO user (name,passward) VALUES ("'.$_POST['name'].'", "'.$_POST['passward'].'"');

	mysqli_query($db,'INSERT INTO user (name,password) VALUES ("'.$_POST['name'].'", "'.$_POST['password'].'")');
?>