<?php
include_once "../base.php";

$id=$_GET['id'];
$news=$News->find($id);

echo nl2br($news['text']);
//或者 echo "<pre>".$news['text']."</pre>";

?>