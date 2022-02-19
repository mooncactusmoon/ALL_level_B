<?php
include_once "../base.php";

$ck=$User->math('count','*',['acc'=>$_POST['acc'],'pw'=>$_POST['pw']]);
if($ck>0){
    $_SESSION['login']=$_POST['acc'];
    echo 1;
}else{
    echo 0;
}
?>