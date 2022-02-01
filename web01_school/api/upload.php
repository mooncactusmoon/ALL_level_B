<?php
include_once "../base.php";

if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);

    $data=$DB->find($_POST['id']);
    $data['img']=$_FILES['img']['name']; //update- img
    $DB->save($data);
}
to("../back.php?do=".$DB->table);
?>