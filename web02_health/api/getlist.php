<?php
include_once "../base.php";

$type=$_GET['type'];
$posts=$News->all(['type'=>$type]);

foreach($posts as $key=> $value){
    echo "<p><a href='#' onclick='getnews({$value['id']})'>";
    echo $value['title'];
    echo "</a></p>";
}
?>