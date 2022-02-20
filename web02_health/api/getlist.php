<?php
include_once "../base.php";

$type=$_GET['type'];
$posts=$News->all(['type'=>$type]);

foreach($post as $post){
    echo "<p><a href='#' onclick='getpost({$post['id']})'>";
    echo $post['title'];
    echo "</a></p>";
}
?>