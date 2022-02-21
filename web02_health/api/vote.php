<?php
include_once "../base.php";

$que=$Que->find($_POST['opt']);
$que['count']++;
$subject=$Que->find($que['parent']);
$subject['count']++;

// dd($que);
// dd($subject);
$Que->save($que);
$Que->save($subject);

to("../index.php?do=result&id=".$subject['id']);
?>