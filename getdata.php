<?php
// try{
// 	$ini = parse_ini_file('./db.ini', FALSE);
// 	$db = new PDO('mysql:host='.$ini['host'].';dbname='.$ini['dbname'].';charset=utf8', $ini['dbuser'], $ini['dbpass']);
// 	$sql = $db->prepare('SELECT * FROM calender');
// } catch(PDOException $e) {
//   die('エラーメッセージ：'.mb_convert_encoding($e->getMessage(), 'utf-8', 'sjis'));
// }
	

	// $db=new mysqli($ini['host'],$ini['dbuser'],$ini['dbpass'],$ini['dbname']) or die(mysqli_connect_error());
	// if($db->connect_error){
	// 	echo "接続できませんでした";
	// 	echo $db->connect_error;
	// 	exit;
	// }
	// mysqli_set_charset($db,'utf8');

//接続テスト
	$ini = parse_ini_file('./db.ini', FALSE);
	$db=mysqli_connect($ini['host'],$ini['dbuser'],$ini['dbpass'],$ini['dbname']) or die(mysqli_connect_error());
	mysqli_set_charset($db,'utf8');

	$result = mysqli_query($db,'SELECT * FROM contents WHERE userId = 102 AND inputdate = "'.$_POST['date'].'"') or die(mysqli_error($db));

	$data = mysqli_fetch_assoc($result);
	$content = $data['content'];
	echo $data['content'];
?>