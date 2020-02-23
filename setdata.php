<?php
require_once('Initialize.php');

$id = $_COOKIE['userId'];

mysqli_query($db,'INSERT INTO contents (inputdate, content, userId) VALUES ("'.$_POST['date'].'", "'.$_POST['content'].'", '.$id.') ON DUPLICATE KEY UPDATE content = VALUES (content)');
?>