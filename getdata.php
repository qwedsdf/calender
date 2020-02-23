<?php

require_once('Initialize.php');
require_once('userData.php');

$id = $_COOKIE['userId'];

$result = mysqli_query($db,'SELECT * FROM contents WHERE userId = '.$id.' AND inputdate = "'.$_POST['date'].'"') or die(mysqli_error($db));

$data = mysqli_fetch_assoc($result);
if(is_null($data)){
	return;
}
$content = $data['content'];
echo $content;
?>