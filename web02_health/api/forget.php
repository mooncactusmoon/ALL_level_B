<?php
include_once "../base.php";
$user=$User->find(['email'=>$_POST['email']]);
if(!empty($user)){
    echo "您的密碼為:".$user['pw'];
}else{
    echo "查無此資料";
}
?>