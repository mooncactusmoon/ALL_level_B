<?php
include_once "../base.php";

$ck=$User->math('count','*',['acc'=>$_POST['acc']]);
if($ck>0){
    echo 1;
}else{
    echo 0;
}
?>