<?php
include_once "../base.php";
foreach($_POST['del'] as $id){
    $User->del($id);
}
to("../back.php?do=admin");
?>